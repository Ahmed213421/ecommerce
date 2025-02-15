<!-- Modal -->
<div class="modal fade" id="modalview{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$product->id}}"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($product->images as $item)
                    <img src="{{asset($item->imagepath)}}" class="img-fluid w-25" alt="">
                @endforeach
            </div>
        </div>
    </div>
</div>
