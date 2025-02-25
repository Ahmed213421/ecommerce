<!-- Modal -->
<div class="modal fade" id="modalview{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$order->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$order->id}}">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Order Information -->
                <div class="mb-4">
                    <h6><strong>Order ID:</strong> <span class="text-primary">{{$order->id}}</span></h6>
                    <h6><strong>Status:</strong>
                        <span class="badge {{ $order->payment_status == 'visa' ? 'badge-success' : 'badge-warning' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </h6>
                    <h6><strong>Created At:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</h6>
                </div>

                <!-- Products and Details -->
                <div class="products-list">
                    @foreach($order->orderDetails as $item)
                    <div class="product-item border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1"><strong>{{ trans('products.product') }}:</strong> {{ $item->product->name }}</h6>
                                <p class="mb-1"><strong>{{ trans('dashboard.quantity') }}:</strong> {{ $item->quantity }}</p>
                                <p class="mb-0"><strong>{{ trans('dashboard.price') }}:</strong> ${{ number_format($item->product->price_after_discount, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <h6 class="mb-0 text-success"><strong>{{ trans('general.total') }}:</strong> ${{ number_format($item->quantity * $item->product->price_after_discount, 2) }}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Total -->
                <div class="mt-4">
                    <h5 class="text-right"><strong>Order Total:</strong> <span class="text-success">
                        ${{$total = $order->orderDetails->map(function ($item) {
                            return $item->product->price_after_discount * $item->quantity;
                        })->sum()}}
                    </span></h5>
                </div>
            </div>
        </div>
    </div>
</div>
