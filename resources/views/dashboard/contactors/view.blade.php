<!-- Modal -->
<div class="modal fade" id="modalview{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$user->id}}"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{$user->message}}
            </div>
        </div>
    </div>
</div>
