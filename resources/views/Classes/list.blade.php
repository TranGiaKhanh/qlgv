@extends('layouts.master')
@section('title')
    Dánh sách lớp
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card background-color-grey">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dánh sách lớp</h4>
                <p class="card-description">
                </p>
                @if (session()->has('success'))
                    <h3 class="alert alert-success">
                        {{ session()->get('success') }}
                    </h3>
                @endif
                <ul class="mr-lg-2">
                        <li class="d-none d-lg-block">
                            <input type="text" id="exportData" value="{{ route('export') }}" hidden>
                            <form id="submit" action="" method="get">
                                <div class="d-flex flex-row">
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
                            <th>Tên lớp</th>
                            <th>Khoa</th>
                            <th>Create at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($classes))
                            @foreach ($classes as $key => $classes)
                                <tr>
                                    <td class="py-1">
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $classes->name }}
                                    </td>
                                    <td>
                                        {{ $classes->department->name }}
                                    </td>
                                    <td>
                                        {{ $classes->created_at->format("d/m/Y") }}
                                    </td>
                                    <td>
                                        {{ $classes->updated_at->format("d/m/Y") }}
                                    </td>
                                    <td>
                                        <a href="{{ route('classes.edit', $classes->id) }}"
                                            class="btn btn-primary mr-2">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-danger" href="#" data-toggle="modal"
                                            data-target="#ModalDelete{{ $classes->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <form id="delete_form_{{ $classes->id }}" method="get"
                                            action="{{ route('classes.destroy', $classes->id) }}"
                                            style="display:none">
                                            @csrf
                                        </form>
                                    </td>
                                    @include('modals.delete-classes')
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="12">Không tìm thấy trang</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
