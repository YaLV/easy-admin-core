<?php

namespace App\Plugins\Suppliers;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Suppliers\Functions\Suppliers;
use App\Plugins\Suppliers\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SupplierController extends AdminController
{
    use General;
    use Suppliers;

    public function index()
    {

        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Products',
                'list'         => Supplier::with('metaData')->paginate(20),
                'idField'      => 'name',
                'destroyName'  => 'Supplier',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Supplier()]);
    }

    public function destroy($id)
    {

        $cc = Supplier::findOrFail($id);

        if($cc->products()->count()) {
            return ['status' => false, 'message' => 'This Supplier has products, can not remove Supplier'];
        }
        $cc->delete();

        return ['status' => true, "message" => "Supplier Deleted"];
    }

    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Supplier::findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {
        if ($id) {
            $unique = ",$id";
        }

        $val = [
            'custom_id' => 'required|unique:suppliers,custom_id' . ($unique ?? ""),
            'email'     => 'required|email',
            'location'  => 'required',
        ];

        $msg = [
            'custom_id.required' => 'ID can not be empty',
            'email.required'     => 'Email can not be empty',
            'location.required'  => 'Location can not be empty',
            'email.email'        => 'Email Should be in Email Format',
        ];

        foreach (languages() as $lang) {
            $val["name.{$lang->code}"] = "required";
            $msg["name.{$lang->code}.required"] = "Supplier Name in {$lang->name} Should Be Filled";
            $val["slug.{$lang->code}"] = [
                'required',
                Rule::unique('supplier_metas', 'meta_value')->where(function ($query) use ($lang, $id) {
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
            'jur_name',
            'description',
            'name_product',
            'description_product',
            'google_keywords',
            'google_description',
            'og_title',
            'og_description',
            'twiter_title',
            'twitter_description',
        ];

        try {
            DB::beginTransaction();
            $supplier = Supplier::updateOrCreate(['id' => $id], [
                'custom_id' => request('custom_id'),
                'email'     => request('email'),
                'location'  => request('location'),
                'coords'    => request('coords'),
                'farmer'    => $this->switch(request('farmer')),
                'craftsman' => $this->switch(request('craftsman')),
                'featured'  => $this->switch(request('featured')),
            ]);
            $this->handleMetas($supplier, $metas, 'name');
            $this->handleImages($supplier);
            DB::commit();

            return redirect(route('suppliers.list'));
        } catch (\PDOException $e) {
            DB::rollBack();

            session()->flash("message", ['msg' => $e->getMessage(), 'isError'=> true]);
            return redirect()->back();
        }
    }

}