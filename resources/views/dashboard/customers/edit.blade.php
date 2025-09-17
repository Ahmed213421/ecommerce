<!-- Modal -->
<div class="modal fade" id="modaledit{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.customers.update',$customer->id) }}" method="POST">
                @method('PUT')
                @csrf

                <input type="hidden" name="email" value="{{$customer->email}}">
                <div class="form-group my-3">
                    <label for="custom-select">{{ trans('dashboard.edit') }} {{trans('general.status')}}</label>
                    <select class="custom-select" id="categoryselect" name="status">
                        <option value="" disabled>{{ trans('dashboard.sel.status') }}</option>
                        <option value="active">{{ trans('dashboard.active') }}</option>
                        <option value="blocked">{{trans('dashboard.blocked')}}</option>

                    </select>
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
