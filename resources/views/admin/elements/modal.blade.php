<div class="modal fade" id="modalWin{{$modalID??false}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalID??false}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modalID??false}}Label">
                    @yield("modal_title_$modalID")
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="post{{$modalID??false}}" action="">
                @yield("modal_body_$modalID")
                </form>
            </div>
            <div class="modal-footer">
                @yield("modal_footer_$modalID")
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>