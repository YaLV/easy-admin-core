<div class="btn-group">
    <a href="javascript:void(0);" class="btn btn-warning btn-xs importProducts" title="Import"><i class="fas fa-upload"></i></a>
    <form method="post" action="{{ route('products.import') }}" style="display:none;">
        <input type="file" name="importFile" id="uploadfile" accept=".csv">
        <input type="hidden" name="controller" value="ProductController" />
        <input type="hidden" name="plugin" value="Products" />
    </form>
    <a href="{{ route('products.export') }}" class="btn btn-success btn-xs exportProducts" title="Export"><i class="fas fa-download"></i></a>
</div>