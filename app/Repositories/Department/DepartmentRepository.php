<?php

namespace App\Repositories\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BaseRepository\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function getModel()
    {
        return Department::class;
    }
    public function getAllDepartments()
    {
        return $this->model->paginate(10);
    }
}
