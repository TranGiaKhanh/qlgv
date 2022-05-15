@extends('layouts.master')
@section('title', 'Danh sach giảng viên')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách giảng viên</h4>
                @if (session()->has('success'))
                    <h6 class="alert alert-success">
                        {{ session()->get('success') }}
                    </h6>
                @endif
                @if (session()->has('error'))
                    <h6 class="alert alert-danger">
                        {{ session()->get('error') }}
                    </h6>
                @endif

                    <ul class="mr-lg-2">
                        <li class="d-none d-lg-block">
                            <input type="text" id="exportData" value="{{ route('export') }}" hidden>
                            <form id="submit" action="" method="get">
                                <div class="d-flex flex-row">
                                    @can(config('const.ROLE.ADMIN'))
                                        <div class="mr-auto p-2 d-flex">
                                            <button type="button" class="btn btn-primary exportButton">
                                                <i class="ti-printer text-white"></i>
                                            </button>
                                        </div>
                                    @endcan
                                    <div class="p-2 d-flex flex-row">
                                        <select name="department_id" class="form-control select2">
                                            <option value="" selected disabled>--Chọn khoa--</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department-> id }}"
                                                    @if (isset($_GET['department_id']) && $_GET['department_id'] == $department->id) selected @endif>
                                                {{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ml-auto p-2 d-flex flex-row">
                                        <input class="form-control" id="navbar-search-input" name="keyword"
                                            placeholder="Search" aria-label="search" aria-describedby="search">
                                        <button type="button" class="btn btn-primary filterButton">
                                            <i class="ti-search text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                <table class="table table-striped" style="text-align:center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Năm sinh</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Khoa giảng dạy</th>
                            <th>Chức vụ</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->gender}}</td>
                                <td>{{ $user->birthday }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->department->name }}</td>
                                <td>{{ $user->role->name }}</td>
                                @can(config('const.ROLE.ADMIN'))
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                            <i class="ti-marker-alt text-white" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-danger" href="#" data-toggle="modal"
                                            data-target="#modal-delete{{ $user->id }}">
                                            <i class="ti-trash text-white" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-danger" href="#" data-toggle="modal"
                                            data-target="#modal-reset{{ $user->id }}">
                                            <i class="ti-reload text-white" aria-hidden="true"></i>
                                        </a>
                                        <form id="delete_form_{{ $user->id }}" method="post"
                                            action="{{ route('users.destroy', $user->id) }}" style="display:none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                @endcan
                                @include('modals.delete-user')
                                @include('modals.reset-password')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
