<?php

namespace App\Plugins\Products;


use App\Http\Controllers\Controller;
use App\Plugins\Products\Functions\Products;
use App\Plugins\Products\Model\Product;

class ProductsController extends Controller
{
    use Products;

    public function index() {
        return view("admin.elements.table", ['list' => Product::paginate(), 'tableHeaders' => $this->getList()]);
    }

    public function newProductForm($id = false) {
        $content = $id ? Product::find($id) : new Product;
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => $content]);
    }

    public function getEditName($id) {
        return (object)["displayName" => Product::find($id)->name];
    }
}