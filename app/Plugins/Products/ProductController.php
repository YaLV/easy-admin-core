<?php

namespace App\Plugins\Products;

use App\Functions\General;
use App\Http\Controllers\CacheController;
use App\Plugins\Admin\AdminController;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductMeta;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Vat\Model\Vat;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends AdminController
{
    use Products;
    use General;

    public function index()
    {
//        dd((new \App\Plugins\Products\Model\Product)->MetaLanguage());

        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Products',
                'list'         => Product::withTrashed()->with('metaData')->paginate(20),
                'idField'      => 'name',
                'destroyName'  => 'Product',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Product(), 'modalId' => ["attributes" => str_random(10), "variations" => str_random(10)]]);
    }

    public function store(Request $request, $id = false)
    {
        if ($id) {
            $unique = ",$id";
        }

        $val = [
            'main_category' => 'required',
            'sku'           => 'required|unique:products,sku' . ($unique ?? ""),
            'supplier_id'   => 'required',
            'mark_up'       => 'required',
            'cost'          => 'required',
            'vat_id'        => 'required',
            'unit_id'       => 'required',
        ];

        $msg = [
            'main_category.required' => 'Main Category can not be empty',
            'sku.required'           => 'Product Code can not be empty',
            'sku.unique'             => 'Product with this Product Code already exists',
            'supplier_id.required'   => 'Supplier can not be empty',
            'cost.required'          => 'Product Cost can not be empty',
            'vat_id.required'        => 'Vat can not be empty',
            'unit_id.required'       => 'Measurement Unit can not be empty',
            'mark_up.required'       => 'Mark-up can not be empty',
        ];

        foreach (languages() as $lang) {
            $val["name.{$lang->code}"] = "required";
            $msg["name.{$lang->code}.required"] = "Category Name in {$lang->name} Should Be Filled";
        }


        $request->validate($val, $msg);


        $metas = [
            'name',
            'slug',
            'description',
            'ingredients',
            'expire_date',
            'google_keywords',
            'google_description',
        ];

        try {
            DB::beginTransaction();

            /** @var Product $product */
            $product = Product::updateOrCreate(['id' => $id], [
                'sku'            => request('sku'),
                'state'          => $this->switch(request('state')),
                'is_bio'         => $this->switch(request('is_bio')),
                'is_lv'          => $this->switch(request('is_lv')),
                'is_suggested'   => $this->switch(request('is_suggested')),
                'is_highlighted' => $this->switch(request('is_highlighted')),
                'mark_up'        => request('mark_up'),
                'cost'           => request('cost'),
                'vat_id'         => request('vat_id'),
                'unit_id'        => request('unit_id'),
                'main_category'  => request('main_category'),
                'supplier_id'    => request('supplier_id'),
            ]);
            $this->handleMetas($product, $metas, 'name-id');
            $this->handleImages($product);
            $res = $this->setVariations($product)??$product->createVariation();
            $this->addCategories($product);
            $this->addMarketDays($product);
            $product->attributeValues()->sync(request('attributeValues'));
            $product->attributes()->sync(request('attribute'));
            DB::commit();
            $product->forgetMeta(['slug', 'name']);
            (new CacheController)->createProductCache($product->id, true);
        } catch (\PDOException $e) {
            DB::rollBack();

            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

        return redirect(route('products.list'))->with(['message' => ['msg' => "Product Saved"]]);
    }

    public function destroy($id)
    {
        /** @var Product $cc */
        $cc = Product::findOrFail($id);

        try {
            DB::beginTransaction();
            $cc->extra_categories()->detach();
            $cc->metaData()->delete();
            $cc->variations()->delete();
            $cc->forceDelete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            abort(500);
        }

        return ['status' => true, "message" => "Product Deleted"];
    }

    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Product::findOrFail($id), 'modalId' => ["attributes" => str_random(10), "variations" => str_random(10)]]);
    }

    public function getEditName($id)
    {
        return Product::findOrFail($id)->name;
    }

    public function state($id)
    {
        /** @var Product $md */
        if ($md = Product::find($id)) {
            $md->delete();

            return ['status' => true, 'newState' => true, "message" => 'Product set as Draft'];
        }

        if ($md = Product::onlyTrashed()->findOrFail($id)) {
            $md->restore();

            return ['status' => true, 'newState' => true, "message" => 'Product set as Active'];
        }
    }


    // Variations
    public function calculatePrice()
    {

        request()->validate([
            'vat_id' => 'required',
            'cost'   => 'required',
        ]);

        $vat = Vat::findOrFail(request('vat_id')) ?? (object)['amount' => 0];
        $price = calcPrice(request('cost'), $vat->amount, request('mark_up')?:0, 0);

        return ['status' => true, 'noMessage' => true, 'result' => $price];
    }

    public function makeDisplayString()
    {
        request()->validate([
            'unit_id' => 'required',
            'amount'  => 'required',
        ]);


        $result = $this->makeDisplayName(request(['unit_id', 'price', 'amount']));

        return ['status' => true, 'noMessage' => true, 'result' => $result['display_name']];
    }

    public function storeVariation()
    {
        $id = request('id');

        $variation = ProductVariation::updateOrCreate(
            [
                'id' => $id,
            ],

            $this->withoutID(request((new ProductVariation)->getFillable()))
        );

        if ($variation) {
            return ['status' => true, "message" => 'Product Variation Saved', "variation" => $variation->id, "result" => view('Products::variation', compact('variation'))->render()];
        } else {
            return ['status' => false, "message" => "Some Error happened"];
        }
    }

    public function loadVariation()
    {
        $id = request('id');

        return ['status' => true, "noMessage" => true, "result" => ProductVariation::findOrFail($id)];
    }

}
