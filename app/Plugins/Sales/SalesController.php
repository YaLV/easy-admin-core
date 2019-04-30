<?php

namespace App\Plugins\Sales;


use App\Plugins\Admin\AdminController;
use App\Plugins\Sales\Functions\Sales;
use App\Plugins\Sales\Model\Sale;
use App\Plugins\UserGroups\Model\UserGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SalesController extends AdminController
{

    use Sales;

    public function index($search = false)
    {
        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[1] ?? false) == 'search') {
            return redirect()->route($cr[0] . ".list");
        }

        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Discount Codes',
                'list'         => $this->getFeatured(),
                'idField'      => 'code',
                'destroyName'  => 'Discount Code',
            ]);
    }

    public function getFeatured()
    {
        return Sale::all();
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => []]);
    }


    public function edit($id)
    {

//        dd(DiscountCode::find($id));
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => Sale::findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {
        $request->validate([
            'name'            => 'required',
            'amount'          => 'numeric|required|between:0,99.99',
            'discount_to'     => 'required',
            'discount_target' => 'required',
        ]);
        $plugin = ucfirst(str_plural(request('discount_to')));
        $pluginSingle = str_singular($plugin);
        $class = "\\App\\Plugins\\$plugin\\Model\\$pluginSingle" . "Meta";

        $target_names = array_map(function ($val) {
            return trim($val);
        }, explode(",", request('discount_target')));
        $usergroup_names = array_map(function ($val) {
            return trim($val);
        }, explode(",", request('group')));

        request()->merge([
            'discount_target' => $class::where('meta_name', 'name')->whereIn('meta_value', $target_names)->get()->pluck('owner_id')->toArray(),
            'user_group'      => UserGroup::whereIn('name', $usergroup_names)->get()->pluck('id')->toArray(),
            'valid_from'      => Carbon::createFromFormat('m/d/Y', request('valid_from')),
            'valid_to'        => Carbon::createFromFormat('m/d/Y', request('valid_to')),
        ]);

        try {
            DB::beginTransaction();

            Sale::updateOrCreate(['id' => $id], request(['name', 'amount', 'discount_to', 'discount_target', 'user_group', 'valid_from', 'valid_to']));
            DB::commit();


        } catch (\PDOException $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Error Saving to DB']);
        }

        return redirect()->route('promotions.list');
    }

    public function getEditName($id) {
        return Sale::find($id)->name??"error";
    }

}