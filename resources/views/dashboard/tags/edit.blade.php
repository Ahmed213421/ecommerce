<!-- Modal -->
<div class="modal fade" id="modaledit{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ trans('dashboard.edit') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.tags.update',$tag->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.tag') }} {{ trans('dashboard.ineng') }}</label>
                    <input type="text" class="form-control" id="name" name="name_en" value="{{ $tag->getTranslation('name','en')}}">
                </div>


                <div class="form-group">
                    <label for="name">{{ trans('dashboard.tag') }} {{ trans('dashboard.inarabic') }}</label>
                    <input type="text" class="form-control" id="name" name="name_ar" value="{{ $tag->getTranslation('name','ar')}}">
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
