<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DepartmentRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Department\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    function __construct(DepartmentRepositoryInterface $department, UserRepositoryInterface $users)
    {
        $this->department = $department;
    }

    public function index()
    {
        $departments = $this->department->getAllDepartments();
        return view('departments.list', compact("departments"));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->except('_token');
        $this->department->store($data);
        return redirect()->route('departments.index')->with('success', 'Tạo khoa thành công!');
    }

    public function edit($id)
    {
        $departments = $this->department->getById($id);
        return view('departments.suakhoa', compact('departments'));
    }

    public function update(DepartmentRequest $request, $id)
    {
        $data = $request->except("_token");
        $this->department->update($data, $id);
        return redirect()->route('departments.index')->with('success', 'Sửa khoa thành công!');
    }

    public function destroy($id)
    {
        $this->department->destroy($id);
        return redirect()->route('departments.index')->with('success', 'Xoá khoa thành công!');
    }
}
