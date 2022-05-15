@extends('layouts.master')
@section('title')
    Thêm
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm Lớp</h4>
                <form action="{{ route('classes.store') }}" class="forms-sample" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputClassesname">Tên <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" >
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    <div class="form-group">
                        <label for="exampleInputStatus">Khoa</label>
                            <select class="form-control" name="department_id">
                                <option>--Chọn khoa--</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                            </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="button" onclick="window.location.href='{{ route('classes.index') }}'"
                        class="btn btn-light">Cancel</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
