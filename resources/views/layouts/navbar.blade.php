<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('users.index') }}">
            {{-- <img src="images/logo.svg" class="mr-2" alt="logo" /> --}}
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu">
            </span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <span>Xin chào <b>{{ Auth::user()->name }}
                        @if (Auth::user()->is_admin)
                            (Admin)
                        @endif
                    </b></span>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if (isset(Auth::user()->image))
                        <img src="{{ asset('images/' . Auth::user()->image) }}" alt="profile" />
                    @else
                        <img src="{{ asset('uploads/' . 'avatar.png') }}" alt="">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="ti-eye text-primary"></i>
                        Thông tin
                    </a>
                    <a href="{{ route('homes.showFormChangePassword') }}" class="dropdown-item">
                        <i class="ti-key text-primary"></i>
                        Đổi mật khẩu
                    </a>
                    <a href="{{ route('homes.logout') }}" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Đăng xuất
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
