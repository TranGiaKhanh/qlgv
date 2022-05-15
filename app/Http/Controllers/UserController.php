<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Intervention\Image\ImageManagerStatic as Image;
use App\Repositories\Department\DepartmentRepositoryInterface;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $user, DepartmentRepositoryInterface $department, RoleRepositoryInterface $role)
    {
        $this->user = $user;
        $this->department = $department;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $data = $request->only('department_id', 'keyword');
        if (Auth::user()->is_admin) {
            $users = $this->user->getAllFilter($data);
            $departments = $this->department->getAll();
        } else {
            $data['department_id'] = Auth::user()->department_id;
            $data['role_id'] = config('const.ROLE_EMPLOYEE');
            $users = $this->user->getAllFilter($data);
            $departments = $this->department->getById(Auth::user()->department_id);
        }
        return view('users.list', compact('users', 'departments'));
    }

    public function create()
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            $departments = $this->department->getAll();
            $roles = $this->role->getAll();
            return view('users.create', compact('departments', 'roles'));
        } else {
            abort(403);
        }
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($request->password);
        $checkManager = $this->user->findManager($data['department_id']);
        if (isset($checkManager) && $data['role_id'] == config('const.ROLE_MANAGER')) {
            return redirect()->back()->with('error', 'Phòng này đã có trưởng khoa !');
        }

        $data['first_login'] = config('const.FIRSTLOGIN');
        $this->user->store($data);
        return redirect()->route('users.index')->with('success', 'Thêm mới thành công !');
    }

    public function edit($id)
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            $departments = $this->department->getAll();
            $roles = $this->role->getAll();
            $user = $this->user->getById($id);
            return view('users.update', compact('user', 'departments', 'roles'));
        } else {
            abort(403);
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if (Auth::user()->id == $id && Auth::user()->role_id != $request->role_id) {
            return redirect()->route('users.edit', $id)->with('error', 'Không thể thay quyền của chính mình !');
        }
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/' . $filename));
            $data['image'] = $filename;
            if (!empty($request->old_image)) {
                Storage::delete('images/' . $request->old_image);
            }
        }
        $checkManager = $this->user->findManager($data['department_id']);
        if (isset($checkManager) && $data['role_id'] == config('const.ROLE_MANAGER') && $checkManager->id != $id) {
            return redirect()->back()->with('error', 'Phòng này đã có trưởng khoa !');
        }
        $this->user->update($data, $id);
        return redirect()->route('users.index')->with('success', 'Cập nhật thành công !');
    }

    public function destroy($id)
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            if (Auth::user()->id == (int)$id) {
                return redirect()->route('users.index')->with('success', 'Xóa thất bại!');
            } else {
                $this->user->destroy($id);
                return redirect()->route('users.index')->with('error', 'Xóa thành công! ');
            }
        } else {
            abort(403);
        }
    }

    public function showProfile()
    {
        $user = $this->user->getById(Auth::user()->id);
        return view('pages.profile', compact('user'));
    }

    public function showFormUpdateProfile($id)
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            $user = $this->user->getById(Auth::user()->id);
            return view('pages.update-profile', compact('user'));
        } else {
            abort(403);
        }
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(('images/' . $filename));
            $data['image'] = $filename;
            if (!empty($request->old_image)) {
                Storage::delete('images/' . $request->old_image);
            }
        }
        $this->user->update($data, $id);
        return redirect()->route('profile')->with('success', 'Cập nhật thành công !');
    }

    public function export(Excel $excel, Request $request)
    {
        $data = $request->all();
        $export = app()->makeWith(UserExport::class, compact('data'));
        $name =  uniqid() . '_user_information';
        return $excel->download($export, $name . '.xlsx');
    }
}
