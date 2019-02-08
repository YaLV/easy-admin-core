<?php

namespace App\Plugins\Categories;

use App\Functions\General;
use App\Http\Controllers\CacheController;
use App\Languages;
use App\Plugins\Admin\AdminController;
use App\Plugins\Admin\Model\File;
use App\Plugins\Categories\Model\Category;
use App\Plugins\Categories\Model\CategoryMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends AdminController
{
    use \App\Plugins\Categories\Functions\Category;
    use General;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Categories',
                'list'         => Category::with('metaData')->paginate(20),
                'idField'      => 'name',
                'destroyName'  => 'Category',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Category()]);
    }

    public function store(Request $request, $id = false)
    {
        $val = $msg = [];

        foreach (languages() as $lang) {
            $val["name.{$lang->code}"] = "required";
            $msg["name.{$lang->code}.required"] = "Category Name in {$lang->name} Should Be Filled";
            $val["slug.{$lang->code}"] = [
                'required',
                Rule::unique('category_metas', 'meta_value')->where(function ($query) use ($lang, $id) {
                    $query = $query->where(['meta_name' => 'slug', 'language' => $lang->code]);
                            if ($id) {
                                $query = $query->where('owner_id', '!=', $id);
                            }
                            return $query;
                    }),
            ];
            $msg["slug.{$lang->code}.unique"] = "Slug in {$lang->name} Already Exists";
            $msg["slug.{$lang->code}.required"] = "Slug in {$lang->name} Can not be empty";
        }

        $request->validate($val, $msg);

        $metas = [
            'name',
            'slug',
            'description',
            'google_keywords',
            'google_description',
        ];

        try {
            DB::beginTransaction();

            $category = Category::updateOrCreate(['id' => $id], [
                'parent_id' => request('parent_id'),
            ]);
            $this->handleMetas($category, $metas, 'name');
            $this->handleImages($category);
            $this->handleAttributes($category);
            DB::commit();
            (new CacheController)->createCategoryCache(true);
        } catch(\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError'=> true]);
            return redirect()->back();
        }
        return redirect(route('categories.list'))->with(['message' => ['msg' => "Category Saved"]]);
    }

    public function destroy($id)
    {

        $cc = Category::findOrFail($id);

        if($cc->products_main()->count()) {
            return ['status' => 'false', "message" => 'Category is set to main in some products, can not remove Category'];
        }

        try {
            DB::beginTransaction();
            $cc->products()->detach();
            $cc->metaData()->delete();

            $cc->delete();
            DB::commit();
        } catch(\PDOException $e) {
            DB::rollBack();
            abort(500);
        }

        return ['status' => true, "message" => "Category Deleted"];
    }

    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Category::findOrFail($id)]);
    }

    public function getEditName($id)
    {
        return Category::findOrFail($id)->name;
    }
}
