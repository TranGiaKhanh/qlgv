@extends('layouts.master')
@section('title')
   Thời khóa biểu
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card background-color-grey">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thời khóa biểu</h4>
                <p class="card-description">
                </p>
                @if (session()->has('success'))
                    <h3 class="alert alert-success">
                        {{ session()->get('success') }}
                    </h3>
                @endif
                <table class="table table-striped" style="text-align:center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tên lớp</th>
                            <th>Thời gian</th>
                            <th>Bài giảng</th>
                            <th>số tiết</th>
                            <th>Giảng viên</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($schedule))
                            @foreach ($schedule as $key => $schedule)
                                <tr>
                                    <td class="py-1">
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $schedule->class }}
                                    </td>
                                    <td>
                                        {{ $schedule->date }}
                                    </td>
                                    <td>
                                        {{ $schedule->lesson}}
                                    </td>
                                    <td>
                                        {{ $schedule->value }}
                                    </td>
                                    <td>
                                        {{ $schedule->teacher }}
                                    </td>
                                    </td>
                                    @can(config('const.ROLE.ADMIN'))
                                    <td>
                                        <a class="btn btn-danger" href="#" data-toggle="modal"
                                            data-target="#ModalDelete{{ $schedule->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <form id="delete_form_{{ $schedule->id }}" method="get"
                                            action="{{ route('schedules.delete', $schedule->id) }}"
                                            style="display:none">
                                            @csrf
                                        </form>
                                    </td>
                                    @endcan
                                    @include('modals.delete-schedules')
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
