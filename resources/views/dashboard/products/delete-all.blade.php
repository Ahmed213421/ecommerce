<!-- Modal -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$product->id}}">{{ trans('dashboard.delete_confirm') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products.destroy', 0) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        {{-- {{ trans('My_Classes_trans.Warning_Grade') }} --}}
                        <input type="hidden" name="page" value="2">
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-danger deletebtn">{{ trans('dashboard.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
