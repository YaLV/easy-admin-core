<?php

namespace App\Plugins\Products;

use App\Functions\General;
use App\Http\Controllers\Controller;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductMeta;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Units\Model\Unit;
use App\Plugins\Vat\Model\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Product(), 'modalId' => str_random(10)]);
    }

    public function store(Request $request, $id = false)
    {

        if ($id) {
            $unique = ",$id";
        }

        $val = [
            'main_category' => 'required',
            'sku'           => 'required|unique:products,sku' . ($unique ?? ""),
            'supplier'      => 'required',
        ];

        $msg = [
            'main_category.required' => 'Main Category can not be empty',
            'sku.required'           => 'Product Code can not be empty',
            'sku.unique'             => 'Product with this Product Code already exists',
            'supplier.required'      => 'Supplier can not be empty',
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
            'og_title',
            'og_description',
            'twiter_title',
            'twitter_description',
        ];

        try {
            DB::beginTransaction();

            $product = Product::updateOrCreate(['id' => $id], [
                'sku'            => request('sku'),
                'state'          => $this->switch(request('state')),
                'is_bio'         => $this->switch(request('is_bio')),
                'is_lv'          => $this->switch(request('is_lv')),
                'is_suggested'   => $this->switch(request('is_suggested')),
                'is_highlighted' => $this->switch(request('is_highlighted')),
                'main_category'  => request('main_category'),
                'supplier'       => request('supplier'),
            ]);

            $this->handleMetas($product, $metas, 'name-id');
            $this->handleImages($product);
            $this->setVariations($product);
            $this->addCategories($product);
            $this->addMarketDays($product);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            return ['state' => 'false', 'message' => 'DB error:' . $e->getMessage()];
        }

        return redirect(route('products.list'))->with(['message' => ['msg' => "Product Saved"]]);
    }

    public function destroy($id)
    {
        $cc = Product::findOrFail($id);

        $cc->forceDelete();

        ProductMeta::where('owner_id', $cc->id)->delete();
        ProductVariation::where('product_id', $cc->id)->delete();

        return ['status' => true, "message" => "Product Deleted"];
    }

    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Product::findOrFail($id), 'modalId' => str_random(10)]);
    }

    public function getEditName($id)
    {
        return Product::findOrFail($id)->name;
    }

    public function state($id)
    {
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
        $price = calcPrice(request('cost'), [request('mark_up') ?: 0, $vat->amount]);

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
