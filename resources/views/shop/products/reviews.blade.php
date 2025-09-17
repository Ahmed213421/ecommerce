<div class="row justify-content-center">
    <div class="col-lg-8">
        <h4 class="mb-4">التعليقات</h4>

        @forelse ($reviews as $review)
            <div class="d-flex mb-4 border-bottom pb-3">
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ $review->name }}
                        <small class="text-muted">— {{ $review->subject }}</small>
                    </h6>
                    <p class="mb-1 text-muted" style="white-space: pre-line;">
                        {{ $review->message }}
                    </p>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        {{ $review->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد تعليقات بعد.</p>
        @endforelse

        <div class="mt-4 d-flex justify-content-center">
            {{ $reviews->links('pagination::bootstrap-4') }}
        </div>  
    </div>
</div>
