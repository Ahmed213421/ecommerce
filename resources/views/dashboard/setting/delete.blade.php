<!-- Modal -->
<div class="modal fade" id="del{{$setting->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$setting->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$setting->id}}">{{ trans('dashboard.delete_confirm') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.setting.destroy', $setting->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.del.item') }}</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('dashboard.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
