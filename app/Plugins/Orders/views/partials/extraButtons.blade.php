<div class="btn-group">
    <label for="importOrderUpload" style="margin:0px;" class="btn btn-warning btn-xs importOrders"><i class="fas fa-upload"></i></label>
    <form method="post" style="display:none;">
        <input type="file" name="importFile" accept=".zip,.rar" id="importOrderUpload">
        <input type="hidden" name="controller" value="OrderController" />
        <input type="hidden" name="plugin" value="Orders" />
        <input type="hidden" name="method" value="importOrders" />
    </form>

    <label for="importOrderSend" style="margin:0px;" class="btn btn-warning btn-xs importOrderSend"><i class="fas fa-file-pdf"></i></label>
    <form method="post" style="display:none;">
        <input type="file" name="importFile" accept=".zip,.rar" id="importOrderSend">
        <input type="hidden" name="controller" value="OrderController" />
        <input type="hidden" name="plugin" value="Orders" />
        <input type="hidden" name="method" value="sendEmails" />
    </form>

    <a href="{{ route('orders.sendEmails') }}" class="btn btn-success btn-xs isAjax post ask" data-question="{{ __('translations.SureToSend') }}"><i class="fas fa-envelope"></i></a>
    <a href="{{ route('orders.exportOrders') }}" class="btn btn-warning btn-xs isAjax post" title="Export"><i class="fas fa-download"></i></a>
    <a href="{{ route('orders.summary') }}" class="btn btn-info btn-xs isAjax post" title="Order Summary"><i class="fas fa-book"></i></a>

</div>