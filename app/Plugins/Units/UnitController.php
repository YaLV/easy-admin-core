<?php

namespace App\Plugins\Units;


use App\Plugins\Admin\AdminController;
use App\Plugins\Units\Model\Unit;
use Illuminate\Http\Request;

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
            'name'   => 'required',
            'unit' => 'required',
        ]);

        Unit::updateOrCreate(['id' => $id], [
            'name'   => request('name'),
            'unit' => request('unit'),
        ]);
        return redirect(route('unit'));
    }

    public function getEditName($id)
    {
        return Unit::findOrFail($id)->name;
    }

    public function delete($id) {
        $result = Unit::findOrFail($id)->delete();
        return ['status' => $result, 'message' => ($result?'Unit Deleted':"Error deleting Unit")];
    }
}