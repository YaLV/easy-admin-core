<?php

namespace App\Plugins\Deliveries;

use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Deliveries\Functions\Deliveries;
use App\Plugins\Deliveries\Model\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends AdminController
{

    use Deliveries;
    use General;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Deliveries',
                'list'         => Delivery::withTrashed()->with('metaData')->paginate(20),
                'idField'      => 'name',
                'destroyName'  => 'Delivery',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => new Delivery]);
    }


    public function edit($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => Delivery::withTrashed()->findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {

        $metas = [
            'name',
            'description',
            'address',
        ];

        $maxSeq = Delivery::orderBy('sequence', "desc")->first();

        try {
            DB::beginTransaction();
            /** @var Delivery $delivery */
            $delivery = Delivery::updateOrCreate(['id' => $id], [
                'deliveryTime' => request()->get('deliveryTime'),
                'price'        => request()->get('price'),
                'vat_id'       => request()->get('vat_id'),
                'freeAbove'    => request()->get('freeAbove'),
                'type'         => request()->get('type'),
                'sequence'     => ++$maxSeq->sequence,
            ]);

            $delivery->marketDays()->sync(request('marketDays'));

            $this->handleMetas($delivery, $metas);
            DB::commit();
            $delivery->forgetMeta();
        } catch (\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back();
        }

        return redirect(route('deliveries.list'))->with(['message' => ['msg' => "Delivery Saved"]]);
    }

    public function changeState($id)
    {
        /** @var Delivery $md */
        if ($md = Delivery::find($id)) {
            $md->delete();

            return ['status' => true, 'newState' => true, "message" => 'Delivery Disabled'];
        }

        if ($md = Delivery::onlyTrashed()->findOrFail($id)) {
            $md->restore();

            return ['status' => true, 'newState' => true, "message" => 'Delivery Enabled'];
        }
    }

    public function destroy($id)
    {
        $result = Delivery::findOrFail($id)->forceDelete();

        $result = ['status' => $result, "message" => $result ? "Delivery Deleted" : "Error Deleting Delivery"];

        return $result;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getEditName($id)
    {
        return __("deliveries.name.$id");
    }

    public function setOrder()
    {
        (new Delivery)->withTrashed()->update(['sequence' => 1]);
        foreach (explode(",", request('sequence')) as $orderId => $sequenceItem) {
            /** @var Delivery $delivery */
            $delivery = Delivery::withTrashed()->where('id', $sequenceItem)->increment('sequence', $orderId);
        }

        return ['status' => true, 'sequence' => Delivery::withTrashed()->get()->pluck('sequence', 'id'), 'message' => 'Items Reordered'];
    }
}