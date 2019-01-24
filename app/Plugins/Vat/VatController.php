<?php

namespace App\Plugins\Vat;


use App\Plugins\Admin\AdminController;
use App\Plugins\Vat\Model\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VatController extends AdminController
{
    use \App\Plugins\Vat\Functions\Vat;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Vat',
                'list'         => Vat::all(),
                'idField'      => 'name',
                'destroyName'  => 'Vat',
            ]);
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => new Vat()]);
    }

    public function edit($id)
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => Vat::findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {
        $request->validate([
            'name'   => 'required',
            'amount' => 'required',
        ]);
        try {

            DB::beginTransaction();

            Vat::updateOrCreate(['id' => $id], [
                'name'   => request('name'),
                'amount' => request('amount'),
            ]);

            DB::commit();

            return redirect(route('vat'));
        } catch (\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

    }

    public function getEditName($id)
    {
        return Vat::findOrFail($id)->name;
    }

    public function delete($id)
    {
        $result = Vat::findOrFail($id)->delete();

        return ['status' => $result, 'message' => ($result ? 'Vat Deleted' : "Error deleting VAT")];
    }
}