<?php

namespace App\Plugins\DiscountCodes;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\DiscountCodes\Functions\DiscountCodes;
use App\Plugins\DiscountCodes\Model\DiscountCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class DiscountCodeController extends AdminController
{
    use General;
    use DiscountCodes;

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
        return DiscountCode::all();
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => new DiscountCode()]);
    }


    public function edit($id)
    {

//        dd(DiscountCode::find($id));
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => DiscountCode::find($id)]);
    }

    public function store(Request $request, $id = false)
    {

        request()->merge(['code' => strtoupper(request('code'))]);

        $rules = ['required'];
        if ($id) {
            $rules = [
                'required',
                Rule::unique('discount_codes')->ignore($id),
            ];
        }

        $request->validate([
            'unit'    => 'required',
            'applied' => 'required',
            'amount'  => 'required',
            'code'    => $rules,
        ]);

        try {
            DB::beginTransaction();
            $from = request('valid_from')?Carbon::createFromFormat('m/d/Y',request('valid_from')):null;
            $to = request('valid_to')?Carbon::createFromFormat('m/d/Y',request('valid_to')):null;

                DiscountCode::updateOrCreate(['id' => $id], array_merge(request(['unit', 'applied','amount', 'code', 'uses']), ['valid_from' => $from, 'valid_to' => $to]));
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

        return redirect(route('discountcodes.list'))->with(['message' => ['msg' => "Discount Code Saved"]]);

    }

}