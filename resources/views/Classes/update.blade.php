@extends('layouts.master')
@section('title')
    Danh sách Lớp
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cập nhập</h4>
                @foreach ($classes as $classes )

                @endforeach
                <form action="{{route('classes.update', $classes->id) }}" class="forms-sample" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputClassesname">Tên lớp <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $classes->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
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
                </form>
            </div>
        </div>
    </div>
@endsection
