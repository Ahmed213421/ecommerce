<!-- Modal -->
<div class="modal fade" id="modaledit{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.review.update',$review->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $review->name}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.phone') }}</label>
                    <input type="text" class="form-control" id="name" name="phone" value="{{ $review->phone}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.email') }}</label>
                    <input type="email" class="form-control" id="name" name="email" value="{{ $review->email}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.subject') }}</label>
                    <input type="text" class="form-control" id="name" name="subject" value="{{ $review->subject}}">
                </div>
                <div class="form-group">
                    <label for="message">{{ trans('general.message') }}</label>
                    <textarea type="text" class="form-control" id="message" name="message">{{ $review->message}}</textarea>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
