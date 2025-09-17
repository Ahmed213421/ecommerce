<!-- Modal -->
<div class="modal fade" id="modaledit{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                    <input type="text" class="form-control" id="name" name="name_en" value="{{ $category->getTranslation('name', 'en') }}">
                </div>

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                    <input type="text" class="form-control" id="name" name="name_ar" required value="{{ $category->getTranslation('name', 'ar') }}">
                </div>

                <div class="form-group">
                    <label for="description">{{ trans('dashboard.desc') }} {{ trans('dashboard.ineng') }}</label>
                    <textarea class="form-control" id="description" name="description_en" rows="4" >{{ $category->getTranslation('description', 'en') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('dashboard.desc') }} {{ trans('dashboard.inarabic') }}</label>
                    <textarea class="form-control" id="description" name="description_ar" rows="4">{{ $category->getTranslation('description', 'ar') }}</textarea>
                </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFi" name="imagepath" accept="image/*">
                        <label class="custom-file-label" for="customFile">{{ trans('dashboard.photo') }}</label>
                        <img src="{{asset($category->filepath)}}" width="100px" alt="" srcset="">
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
