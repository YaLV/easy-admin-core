<?php

namespace App\Plugins\Orders;


use App\Plugins\Admin\AdminController;
use App\Plugins\Orders\Functions\Orders;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OrderLines;
use App\Schedules;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use function MongoDB\BSON\toJSON;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends AdminController
{

    use Orders;

    public function index($search = false)
    {
        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[1] ?? false) == 'search') {
            return redirect()->route($cr[0]);
        }

        $trashed = false;
        if ($cr[0] == 'orderHistory') {
            $trashed = true;
        }

        $orders = $this->getFilteredResult($search, $trashed);

        return view('admin.elements.table',
            [
                'tableHeaders'   => $this->getList(),
                'header'         => 'Orders',
                'list'           => $orders,
                'idField'        => 'name',
                'destroyName'    => 'Order',
                'filters'        => method_exists($this, 'getFilters') ? $this->getFilters() : [],
                'logButton'    => view('admin.partials.log', ['logTypes' => 'orderExport,orderImport,createPDF,sendOrderEmails'])->render(),
                'currentFilters' => session('order_filters'),
                'operations'     => view("Orders::partials.extraButtons")->render(),
                'js'             => [
                    'js/orderlist.js',
                ],
            ]);
    }

    public function setPaid($id)
    {
        request()->validate(['amount' => 'numeric']);
        /** @var OrderHeader $o */
        $oh = OrderHeader::find($id);
        $oh->update(['paid' => request('amount')]);

        return ['status' => true, 'message' => 'Payment registered', "amount" => $oh->paid, 'orderContent' => view('Orders::products', ['order' => $oh, 'items' => $oh->items()->get()])->render()];
    }

    public function changeState($id)
    {
        request()->validate(['newState' => 'required']);
        /** @var OrderHeader $o */
        $o = OrderHeader::find($id);
        $o->update(['state' => request('newState')]);

        return ['status' => true, 'message' => 'Order Status Changed'];
    }

    public function destroy($id = false, $action = "delete", $route = 'orders')
    {

        $id = $id ? [$id] : request('massAction');

        $forceDelete = OrderHeader::onlyTrashed()->whereIn('id', $id)->forceDelete();
        $delete = OrderHeader::whereIn('id', $id)->delete();

        if ($forceDelete) {
            OrderLines::whereIn('order_header_id', $id)->delete();
            $result = $forceDelete;
        } else {
            $result = $delete;
        }

        $trashed = false;
        if (Route::currentRouteName() == 'orderHistory') {
            $trashed = true;
        }

        /** @var array $repTable */
        $repTable = view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Orders',
                'list'         => $this->getFilteredResult(request()->get('search'), $trashed??false)->withPath(route($route)),
                'idField'      => 'name',
                'destroyName'  => 'Order',
                'js'           => [
                    'js/orderlist.js',
                ],
            ])->renderSections();

        return ['status' => $result??true, 'message' => 'Order Deleted', 'replaceTable' => $repTable['content']];
    }

    public function removeOrder($id = false)
    {
        $this->destroy($id, 'forceDelete', 'orderHistory');
    }

    public function showOriginal($order_id)
    {
        /** @var OrderHeader $oh */
        $oh = new OrderHeader();
        /** @var OrderLines $oi */
        $oi = new OrderLines();

        $originalHeaders = $oh->setTable('original_headers')->findOrFail($order_id);
        $originalItems = $oi->setTable('original_lines')->where('order_header_id', $originalHeaders->id)->get();

        return view('Orders::viewOrder', ['order' => $originalHeaders, 'items' => $originalItems, 'fields' => $this->getViewFields()]);
    }

    public function showOrder($order_id)
    {
        /** @var OrderHeader $orderHeaders */
        $orderHeaders = OrderHeader::findOrFail($order_id);
        $orderItems = $orderHeaders->items()->get();

        return view('Orders::viewOrder', ['order' => $orderHeaders, 'items' => $orderItems, 'fields' => $this->getViewFields(), 'canEdit' => "editable"]);
    }

    public function changeDelivery($id)
    {
        $oh = OrderHeader::findOrFail($id);
        $oh->update(["delivery_id" => request('delivery')]);

        $this->checkFreeDelivery($id);

        $oh = OrderHeader::findOrFail($id);

        return ['status' => true, 'message' => 'Delivery Changed', 'orderContent' => view('Orders::products', ['order' => $oh, 'items' => $oh->items()->get()])->render()];
    }

    private function checkFreeDelivery($cartId)
    {
        $cart = OrderHeader::find($cartId);
        $totalAmount = getCartTotals($cart) ?? 0;
        if ($cart->delivery_id) {
            $delivery = $cart->delivery;
            if ($totalAmount->toPay >= ($delivery->freeAbove ?? 0)) {
                $r = $cart->update(['delivery_amount' => "0"]);

                return true;
            } else {
                if ($cart->discount_target == 'all' || $cart->discount_target == 'delivery') {
                    $deliveryPrice = number_format(round($delivery->price / (1 + ($cart->discount_amount / 100)), 2), 2);
                } else {
                    $deliveryPrice = $delivery->price;
                }
                $cart->update(['delivery_amount' => $deliveryPrice]);

                return true;
            }
        }

        return false;
    }

    public function setAmount($order, $item)
    {
        /** @var OrderHeader $order */
        $order = OrderHeader::findOrFail($order);

        /** @var OrderLines $item */
        $item = $order->items()->where('id', $item)->firstOrFail();

        $item->update(['real_amount' => request('amount')]);

        return ['status' => true, 'message' => 'Amount Changed', 'orderContent' => view('Orders::products', ['order' => $order, 'items' => $order->items()->get()])->render()];
    }

    public function setFilters()
    {

        $filters = session('order_filters');

        foreach (request()->get('filter') as $filter => $filterValue) {
            $filters[$filter] = $filterValue;
        }

        session()->put('order_filters', $filters);

        session()->save();

        return ['status' => true, 'noMessage' => true];
    }

    public function clearFilters()
    {
        session()->put('order_filters', []);

        return ['status' => true, 'noMessage' => true];
    }

    public function exportOrders()
    {
        if (!session('order_filters.market_day')) {
            return ['status' => false, 'message' => 'Please select market Day'];
        }
        $orders = $this->getFilteredResult(request()->route('search'), false, true)->pluck('id')->toArray();

        Schedules::create([
            'filename' => json_encode($orders),
            'type'     => 'orderExport',
        ]);

        return ['status' => true, 'message' => 'Export Scheduled, please consult import/export log for a download link in few minutes'];
    }

    public function importOrders()
    {
        request()->validate([
            'importFile' => 'file|required',
        ]);

        $zip = new \ZipArchive();
        $file = request()->file('importFile');
        $zresult = $zip->open($file);

        if ($zresult === true) {
            $zip->extractTo(storage_path('app/imports/ordersUpdate'));
            $zip->close();
            $result = ['status' => true, 'message' => 'Order update uploaded, task scheduled'];

            Schedules::create([
                'filename'    => 'orders',
                'type'        => 'orderImport',
                'total_lines' => count(\Storage::files('imports/ordersUpdate')),
            ]);

        } else {
            $result = ['status' => false, 'message' => 'Uploaded file is not an archive'];
        }

        return $result;
    }

    public function sendEmails()
    {
        request()->validate([
            'importFile' => 'file|required',
        ]);

        $zip = new \ZipArchive();
        $file = request()->file('importFile');
        $zresult = $zip->open($file);

        if ($zresult === true) {
            $zip->extractTo(storage_path('app/imports/ordersSend'));
            $zip->close();
            $result = ['status' => true, 'message' => 'Orders uploaded, task scheduled'];

            Schedules::create([
                'filename'    => 'orders',
                'type'        => 'createPDF',
                'total_lines' => count(\Storage::files('imports/ordersSend')),
            ]);

        } else {
            $result = ['status' => false, 'message' => 'Uploaded file is not an archive'];
        }

        return $result;
    }

    public function doSendEmails()
    {
        Schedules::create([
            'filename'    => 'orders',
            'type'        => 'sendOrderEmails',
            'total_lines' => count(\Storage::files('imports/ordersSendPdf')),
        ]);

        $result = ['status' => true, 'message' => 'Orders uploaded, task scheduled'];

        return $result;
    }

}