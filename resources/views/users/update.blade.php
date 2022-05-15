@extends('layouts.master')
@section('title', 'Update User')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cập nhập</h4>
                @if (session()->has('error'))
                    <h6 class="alert alert-danger">
                        {{ session()->get('error') }}
                    </h6>
                @endif
                <form action="{{ route('users.update', $user->id) }}" class="form-sample" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value={{ $user->id }}>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Họ tên <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"/>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"/>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"/>
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}"/>
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ngày sinh <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="birthday" class="form-control" value="{{ $user->birthday }}"/>
                                    @error('birthday')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chức vụ<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="role_id">
                                        <option>--Chức vụ--</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ( $role->id == $user->role_id ) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Khoa <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department_id">
                                        <option>--Chọn khoa--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" @if ( $department->id == $user->department_id ) selected @endif>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="button" onclick="window.location.href='{{ route('users.index') }}'"
                        class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
