<!-- Modal -->
<div class="modal fade" id="exampleModal{{$item['quantity']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('dashboard.edit') }} {{ trans('dashboard.quantity') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.cart.update', 'test') }}" method="POST" id="myForm">
                    @csrf
                    @method('PUT')

                    @if(auth::check())

                    <input type="hidden" value="{{$item->product->id}}" name="product_id">
                    <input type="number" value="{{$item->quantity}}" name="quantity" min="1" max="100">

                    @else
                    <input type="hidden" value="{{$item['product_id']}}" name="product_id">

                    <input type="number" value="{{ $item['quantity'] }}" name="quantity" min="1" max="100">
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
