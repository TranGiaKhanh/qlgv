<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                    aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Giảng viên</span>

                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Danh sách </a></li>
                        @can(config('const.ROLE.ADMIN'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Thêm giảng viên</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Khoa</span>

                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('departments.index') }}">Danh sách khoa</a></li>
                        @can(config('const.ROLE.ADMIN'))
                        <li class="nav-item"> <a class="nav-link" href="{{route('departments.create')}}">Thêm khoa</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui" aria-expanded="false"
                    aria-controls="ui">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Lớp</span>
                </a>
                <div class="collapse" id="ui">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('classes.index') }}">Danh sách lớp</a></li>
                        @can(config('const.ROLE.ADMIN'))
                        <li class="nav-item"> <a class="nav-link" href="{{route('classes.create')}}">Thêm lớp</a></li>
                        @endcan
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-2" aria-expanded="false"
                    aria-controls="ui-2">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Quản lý giảng dạy</span>

                </a>
                <div class="collapse" id="ui-2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('schedule.index') }}">Thời khóa biểu</a></li>
                    </ul>
                </div>
            </li>
        </ul>
</nav>
