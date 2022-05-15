<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ClassesRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Classes\ClassesRepositoryInterface;


class ClassesController extends Controller
{
    function __construct(ClassesRepositoryInterface $classes, DepartmentRepositoryInterface $department)
    {
        $this->classes = $classes;
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $departments = $this->department->getAll();
        $classes = $this->classes->getAllClasses();

        return view('classes.list', compact('classes', 'departments'));
    }

    public function create()
        {
            if (Gate::allows(config('const.ROLE.ADMIN'))) {
                $departments = $this->department->getAll();
                return view('classes.create', compact('departments'));
            } else {
                abort(403);
            }
        }

    public function store(ClassesRequest $request)
    {
        $data = $request->except('_token');

        $this->classes->store($data);

        return redirect()->route('classes.index')->with('success', 'Tạo lớp thành công!');
    }

    public function edit($id)
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            $departments = $this->department->getAll();
            $classes = $this->classes->getById($id);
            return view('classes.update', compact('classes', 'departments'));
        } else {
            abort(403);
        }
    }

    public function update(ClassesRequest $request, $id)
    {
        $data = $request->except("_token");
        $this->classes->update($data, $id);
        return redirect()->route('classes.index')->with('success', 'Sửa lớp thành công!');
    }

    public function destroy($id)
    {
        $this->classes->destroy($id);
        return redirect()->route('classes.index')->with('success', 'Xoá lớp thành công!');
    }
}

