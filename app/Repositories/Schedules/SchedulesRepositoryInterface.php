<?php

namespace App\Repositories\Schedules;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface SchedulesRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllSchedules();
}
