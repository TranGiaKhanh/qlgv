<?php

namespace App\Repositories\Classes;

use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BaseRepository\BaseRepository;

class ClassesRepository extends BaseRepository implements ClassesRepositoryInterface
{
    public function getModel()
    {
        return Classes::class;
    }
    public function getAllClasses()
    {
        return $this->model->paginate(10);
    }
    public function getAllFilter($data)
    {
        $query = $this->model;
        if(isset($data['department_id']))
        {
            $query = $query->where('department_id', $data['department_id']);
        }
        if(isset($data['keyword']))
        {
            $query = $query->where('name', 'like', '%' . $data['keyword'] . '%');
        }
        if(isset($data['sort_by']))
        {
            if(!isset($data['sort_type'])){
                $data['sort_type'] = 'DESC';
            }
            $query = $query->OrderBy($data['sort_by'], $data['sort_type']);
        }
    }
    public function findDepartment($department_id)
    {
        $result = $this->model->where('department_id', '=', $department_id)
                              ->where('role_id', '=', config('const.ROLE_MANAGER'))
                              ->first();
        return $result;
    }
}
