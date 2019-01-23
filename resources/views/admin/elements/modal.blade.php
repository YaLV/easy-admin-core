<div class="modal fade" id="modalWin{{$modalId??false}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalId??false}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modalId??false}}Label">
                    @yield("modal_title")
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="post{{$modalId??false}}" action="">
                @yield("modal_body")
                </form>
            </div>
            <div class="modal-footer">
                @yield("modal_footer")
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>