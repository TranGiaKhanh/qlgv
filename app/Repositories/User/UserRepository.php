<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
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
        // if(isset($data['work_status']))
        // {
        //     $query = $query->where('work_status', $data['work_status']);
        // }
        if(isset($data['role_id']))
        {
            $query = $query->where('role_id', $data['role_id']);
        }
        if(isset($data['sort_by']))
        {
            if(!isset($data['sort_type'])){
                $data['sort_type'] = 'DESC';
            }
            $query = $query->OrderBy($data['sort_by'], $data['sort_type']);
        }
        return $query->paginate(10);
    }

    public function findManager($department_id)
    {
        $result = $this->model->where('department_id', '=', $department_id)
                              ->where('role_id', '=', config('const.ROLE_MANAGER'))
                              ->first();
        return $result;
    }
}

