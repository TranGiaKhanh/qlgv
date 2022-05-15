@extends('layouts.master')
@section('title')
    Thêm
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm khoa</h4>
                <form action="{{ route('departments.store') }}" class="forms-sample" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputDepartmentname">Tên khoa <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" >
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDepartmentmanager">Trưởng khoa </label>
                        <input type="text" name="manager" class="form-control" >
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Đang hoạt động">
                        <label class="form-check-label" for="inlineRadiostatus">Đạng hoạt động</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Tạm ngưng">
                        <label class="form-check-label" for="inlineRadiostatus">Tạm ngưng</label>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="button" onclick="window.location.href='{{ route('departments.index') }}'"
                        class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
