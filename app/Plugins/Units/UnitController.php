<?php

namespace App\Plugins\Units;


use App\Plugins\Admin\AdminController;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Units\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends AdminController
{
    use \App\Plugins\Units\Functions\Unit;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Measurement Units',
                'list'         => Unit::all(),
                'idField'      => 'name',
                'destroyName'  => 'Measurement Unit',
            ]);
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => new Unit()]);
    }

    public function edit($id)
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => Unit::findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {
        $request->validate([
            'name' => 'required',
            'unit' => 'required',
        ]);

        try {

            DB::beginTransaction();

            Unit::updateOrCreate(['id' => $id], [
                'name' => request('name'),
                'unit' => request('unit'),
            ]);
            DB::commit();

            return redirect(route('unit'));
        } catch (\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }
    }

    public function getEditName($id)
    {
        return Unit::findOrFail($id)->name;
    }

    public function delete($id)
    {


        $cc = Unit::findOrFail($id);

        if($cc->variations()->count()) {
            return ['status' => false, 'message' => 'This Measurement Unit is in use, can not delete'];
        }


        return ['status' => $result, 'message' => ($result ? 'Unit Deleted' : "Error deleting Unit")];
    }
}