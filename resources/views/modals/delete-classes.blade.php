<form method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="ModalDelete{{ $classes->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn xóa lớp <b>{{ $classes->name }}</b>  ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" class="btn btn-danger"
                        onclick="event.preventDefault();document.getElementById('delete_form_{{ $classes->id }}').submit()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
