<form action="{{ route('reset-password') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="id" value="{{ $user->id}}" hidden>
    <div class="modal fade" id="modal-reset{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Reset Password') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Do you sure reset password <b>{{$user->name}}</b> ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
    </div>
</form>
