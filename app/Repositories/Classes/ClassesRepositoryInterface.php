<?php

namespace App\Repositories\CLasses;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface ClassesRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllClasses();
    public function getAllFilter($data);
    public function findDepartment($department_id);
}

