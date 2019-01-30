<?php

namespace App\Plugins\Attributes;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Attributes\Functions\Attributes;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;
use App\Plugins\Categories\Model\Category;
use App\Plugins\Products\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends AdminController
{

    use Attributes;
    use General;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Attributes',
                'list'         => Attribute::all(),
                'idField'      => 'name',
                'destroyName'  => 'Attribute',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Attribute(), 'modalId' => ['attribute' => str_random(10)]]);
    }

    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Attribute::findOrFail($id), 'modalId' => ['attribute' => str_random(10)]]);
    }

    public function store(Request $request, $id = false)
    {
        $request->validate([
            'name'   => 'required',
        ]);

        $metas = [
          'name',
          'slug'
        ];

        try {

            DB::beginTransaction();

            $attribute = Attribute::updateOrCreate(['id' => $id]);
            $this->handleMetas($attribute, $metas, 'name');
            $this->attributeValues($attribute);

            DB::commit();

            return redirect(route('attributes.list'));
        } catch (\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

    }

    public function getEditName($id)
    {
        return Attribute::findOrFail($id)->name;
    }

    public function delete($id)
    {
        $result = Attribute::findOrFail($id)->delete();

        return ['status' => $result, 'message' => ($result ? 'Attribute Deleted' : "Error deleting Attribute")];
    }

    public function storeAttributeValue() {

        $metas = ['name', 'slug'];
        try {
            DB::beginTransaction();
            $attributeValue = AttributeValue::updateOrCreate(['id' => request('id')]);
            $this->handleMetas($attributeValue, $metas, 'name');
            DB::commit();
        } catch(\PDOException $e) {
            DB::rollBack();
            abort(500);
            return false;
        }

        return ["status" => true, "result" => view('Attributes::avalue', compact('attributeValue'))->render(), 'attributeValue' => $attributeValue->id, 'message' => "Attribute Value saved"];

    }

    public function loadAttributeValue() {
        $id = request('id');

        $att = AttributeValue::findOrFail($id);

        return ['status' => true, "noMessage" => true, "result" => $att->meta, 'resultId' => $att->id];
    }

    public function destroy($id) {
        $deleteFrom = [
            "products",
            "categories",
        ];

        try {
            DB::beginTransaction();
            $attribute = Attribute::findOrFail($id);

            foreach ($deleteFrom as $deleteClass) {
                $attribute->$deleteClass()->detach();
            }

            foreach($attribute->values as $values) {
                $values->product()->detach();
                $values->metaData()->delete();
            }
            $attribute->metaData()->delete();
            $attribute->values()->delete();
            $attribute->delete();
            DB::commit();

            return ['status' => true, 'message' => "Attribute Deleted, detached from products, attribute values and categories"];
        } catch(\PDOException $e) {
            DB::rollBack();
            abort(500);
        }
    }
}