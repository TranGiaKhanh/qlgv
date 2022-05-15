<?php

namespace App\Imports;

use App\Models\Schedules;
use Maatwebsite\Excel\Concerns\ToModel;

class SchedulesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Schedules([
    'class' => $row[0],
    'date' => $row[1],
    'lesson' => $row[2],
    'value' => $row[3],
    'teacher' => $row[4],
    ]);
    }
}
