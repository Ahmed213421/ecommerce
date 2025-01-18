<!-- Modal -->
<div class="modal fade" id="editsub{{ $subcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                        <input type="text" class="form-control" id="name" name="name_en"
                            value="{{ $subcategory->getTranslation('name', 'en') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                        <input type="text" class="form-control" id="name" name="name_ar" required
                            value="{{ $subcategory->getTranslation('name', 'ar') }}">
                    </div>

                    <select class="custom-select" id="custom-select" name="category_id">
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{$category->id == $subcategory->category_id ? 'selected':"" }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="image">{{ trans('dashboard.photo') }}</label>
                        <input type="file" class="form-control" id="image" name="simage" accept="image/*">
                        <img src="{{ asset($subcategory->filepath) }}" width="100px" alt="" srcset="">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
