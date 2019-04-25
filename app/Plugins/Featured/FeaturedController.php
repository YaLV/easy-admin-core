<?php

namespace App\Plugins\Featured;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Featured\Functions\Featured;
use App\Plugins\Featured\Model\FeaturedSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class FeaturedController extends AdminController
{
    use General;
    use Featured;

    public function index($search = false)
    {
        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[1] ?? false) == 'search') {
            return redirect()->route($cr[0] . ".list");
        }


        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Featured Suppliers',
                'list'         => $this->getFeatured(),
                'idField'      => 'name',
                'destroyName'  => 'Featured Supplier',
            ]);
    }

    public function getFeatured()
    {
        return FeaturedSupplier::all();
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new FeaturedSupplier()]);
    }


    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => FeaturedSupplier::find($id)]);
    }

    public function store(Request $request, $id = false)
    {

        $request->validate([
            'supplier_id' => 'required',
        ]);

        $metas = [
            'title',
            'description',
        ];

        try {
            DB::beginTransaction();
            $featuredSupplier = FeaturedSupplier::updateOrCreate(['id' => $id], [
                'supplier_id' => request()->get('supplier_id'),
            ]);
            $this->handleMetas($featuredSupplier, $metas, false);
            $this->handleImages($featuredSupplier);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

        return redirect(route('featuredsupplier.list'))->with(['message' => ['msg' => "Featured Supplier Saved"]]);
    }

    public function destroy($id)
    {
        $fs = FeaturedSupplier::findOrFail($id);
        $result = $fs->delete();
        $fs->metaData()->delete();

        $result = ['status' => $result, "message" => $result ? "Featured Supplier Removed" : "Error Removing featured Supplier"];

        return $result;
    }
}