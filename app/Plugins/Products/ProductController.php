<?php

namespace App\Plugins\Products;

use App\Functions\General;
use App\Http\Controllers\CacheController;
use App\Plugins\Admin\AdminController;
use App\Plugins\Products\Functions\ProductImport;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Vat\Model\Vat;
use App\Schedules;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class ProductController extends AdminController
{
    use Products;
    use General;

    public function index($search = false)
    {
        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[1] ?? false) == 'search') {
            return redirect()->route($cr[0] . ".list");
        }


        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Products',
                'list'         => $this->getProducts(),
                'idField'      => 'name',
                'destroyName'  => 'Product',
                'operations'   => view("Products::partials.extraButtons")->render(),
                'js'           => [
                    'js/productIO.js',
                ],
            ]);
    }

    public function getProducts()
    {

        /** @var Product $products */
        $products = Product::withTrashed();

        if ($search = request()->route('search')) {
            $products = $products->whereHas('metaData', function (Builder $q) use ($search) {
                $q->whereIn('meta_name', ['name', 'slug'])->where('meta_value', 'like', "%$search%");
            });
        }

        return $products->with('metaData')->paginate(20);
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
            $res = $this->setVariations($product) ?? $product->createVariation();
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
        $r = explode(".", Route::currentRouteName());
        if ((array_pop($r) ?? "") == 'search') {
            return request()->route('search');
        }

        return Product::findOrFail($id)->name;
    }

    public function state($id)
    {
        $state = [];
        /** @var Product $md */
        if ($md = Product::find($id)) {
            $md->delete();

            $state = ['status' => true, 'newState' => true, "message" => 'Product set as Draft'];
        }

        if ($md = Product::onlyTrashed()->findOrFail($id)) {
            $md->restore();

            $state = ['status' => true, 'newState' => true, "message" => 'Product set as Active'];
        }

        return $state;
    }


    // Variations
    public function calculatePrice()
    {

        request()->validate([
            'vat_id' => 'required',
            'cost'   => 'required',
        ]);

        $vat = Vat::findOrFail(request('vat_id')) ?? (object)['amount' => 0];
        $price = calcPrice(request('cost'), $vat->amount, request('mark_up') ?: 0, 0);

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

    public function import()
    {
        request()->validate([
            'importFile' => 'file|required',
        ]);

        $file = request()->file('importFile');
        $filename = $file->storeAs('imports/products', str_random(40) . "." . $file->getClientOriginalExtension());

        Schedules::create([
            'filename' => basename($filename),
            'type'     => 'productImport',
        ]);

        return ['status' => true, 'message' => "Product Import Scheduled"];
    }

    public function export()
    {
        app('debugbar')->disable();
        /** @var ProductImport $export */
        $export = new ProductImport();

        return $export->exportdata();

    }

    public function importImages()
    {
        request()->validate([
            'importFile' => 'file|required',
        ]);

        $zip = new \ZipArchive();
        $file = request()->file('importFile');
        $zresult = $zip->open($file);

        if ($zresult === true) {
            $zip->extractTo(storage_path('app/imports/product_images'));
            $zip->close();
            $result = ['status' => true, 'message' => 'Images uploaded, task scheduled'];

            Schedules::create([
                'filename'    => 'images',
                'type'        => 'productImageImport',
                'total_lines' => count(Storage::files('imports/product_images')),
            ]);

        } else {
            $result = ['status' => false, 'message' => 'Uploaded file is not an archive'];
        }


        return $result;

    }


    public function storage($search = false)
    {

        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[2] ?? false) == 'search') {
            return redirect()->route(implode(".", [$cr[0], $cr[1], "list"]));
        }

        return view('admin.elements.table',
            [
                'tableHeaders' => $this->storageList(),
                'header'       => 'Storage',
                'list'         => $this->getProducts(),
                'idField'      => 'name',
                'destroyName'  => 'Product',
                'operations'   => view("Products::partials.extraButtonsStorage")->render(),
                'js'           => [
                    'js/productIOStorage.js',
                ],
            ]);
    }

    public function storeStorage()
    {
        $product = '';

        request()->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        dd(request()->has('amount'));

        try {
            DB::beginTransaction();
            /** @var Product $product */
            $product = Product::where('id', request()->get('product_id'));
            if(request()->has('info')) {
                $product->update(['info' => request('info')]);
            } elseif(request()->has('amount')) {
                if(!is_null($product->firstOrFail()->storage_amount)) {
                    $product->increment('storage_amount', request()->get('amount'));
                } else {
                    $product->update(['storage_amount' => request()->get('amount')]);
                }
            } elseif(request()->has('reset')) {
                $product->update(['storage_amount' => null]);
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
        }
        $product = $product->first();
        return ['status' => true, 'message' => 'Product Updated', 'data' => ['product_id' => $product->id,'info' => $product->info, 'storage_amount' => $product->storage_amount]];
    }

}
