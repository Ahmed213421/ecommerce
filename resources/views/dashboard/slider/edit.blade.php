<!-- Modal -->
<div class="modal fade" id="modaledit{{$slide->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.slider.update',$slide->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }}</label>
                    <input type="text" class="form-control" id="name" name="main_title" value="{{ $slide->main_title}}" required>
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('dashboard.branch_title') }}</label>
                    <input type="text" class="form-control" id="name" name="branch_title" value="{{ $slide->branch_title}}" required>
                </div>


                <div class="form-group">
                    <label for="image">{{ trans('dashboard.photo') }}</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <img src="{{asset($slide->imagepath)}}" class="mt-2" width="100px" alt="" srcset="">
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
