<?php

namespace App\Repositories\Schedules;

use App\Models\Schedules;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BaseRepository\BaseRepository;

class SchedulesRepository extends BaseRepository implements SchedulesRepositoryInterface
{
    public function getModel()
    {
        return Schedules::class;
    }
    public function getAllSchedules()
    {
        return $this->model->paginate(10);
    }
}
