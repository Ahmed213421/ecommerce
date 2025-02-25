<!-- Modal -->
<div class="modal fade" id="modalview{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$review->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$review->id}}"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{$review->message}}
            </div>
        </div>
    </div>
</div>
