<?php

namespace App\Plugins\Products;

use App\Languages;
use App\Plugins\Products\Model\Categories\Category;
use App\Plugins\Products\Model\Categories\CategoryName;
use App\Plugins\Products\Model\Categories\CategorySlug;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use \App\Plugins\Products\Functions\Category;

    public function index() {
        $c = Category::all();
        return view('admin.elements.table', ['tableHeaders' => $this->getList(), 'header' => 'Categories', 'list' => Category::paginate(20), 'idField' => 'name', 'destroyName' => 'Category']);
    }

    public function add() {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Category()]);
    }

    public function store(Request $request, $id=false) {

        $val = $msg = [];

        foreach(Languages::all() as $lang) {
            $val["name.{$lang->code}"] = "required";
            $msg["name.{$lang->code}.required"] = "Category Name in {$lang->name} Should Be Filled";
        }

        $request->validate($val, $msg);
        dd('done');

        if(!$id) {
            $category = Category::create([
               'parent_id' => request('parent_id')
            ]);
            $category->name = request('name');
            $category->slug = request('name');
        } else {
            $category = Category::findOrFail($id);
            $category->parent_id = request('parent_id');
            $category->save();
            $category->name = request('name');
            $category->slug = request('name');
        }
        $this->handleImages($category, request()->all());

        return redirect(route('categories.list'))->with(['message' => ['msg' => "Category Saved"]]);
    }

    public function destroy($id) {
        $cc = Category::findOrFail($id);

        $cc->delete();

        CategorySlug::where('category_id', $cc->id)->delete();
        CategoryName::where('category_id', $cc->id)->delete();

        return ['status' => true, "message" => "Category Deleted"];
    }

    public function edit($id) {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Category::findOrFail($id)]);
    }
}
