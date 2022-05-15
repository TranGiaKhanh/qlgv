<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password</title>
    <base href="{{ asset('') }}template/">
    @section('css')
        <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="css/vertical-layout-light/style.css">
        <link rel="shortcut icon" href="images/favicon.png" />
    @show
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4>Đổi mật khẩu</h4>
                            <form class="pt-3" method="post" action="{{ route('homes.changePassword') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Mật khẩu cũ <span class="text-danger">*</span></label>
                                    <input type="password" name="currentPassword" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Current Password">
                                    @error('currentPassword')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                                    <input type="password" name="newPassword" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="New Password">
                                    @error('newPassword')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Nhập lại mật khấu mới <span class="text-danger">*</span></label>
                                    <input type="password" name="confirmPassword" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Confirm Password">
                                    @error('confirmPassword')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        Đổi mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/template.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
    @show
</body>

</html>
