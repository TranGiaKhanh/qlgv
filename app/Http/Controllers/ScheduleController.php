<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SchedulesImport;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Schedules\SchedulesRepositoryInterface;

class ScheduleController extends Controller
{
    function __construct(SchedulesRepositoryInterface $schedule, UserRepositoryInterface $users)
    {
        $this->schedule = $schedule;
    }
    public function index()
    {
        $schedule = $this->schedule->getAllSchedules();
        return view('schedules.list', compact("schedule"));
    }
    public function edit($id)
    {
        $schedule = $this->schedule->getById($id);
        return view('schedules.update', compact('schedule'));
    }
    public function destroy($id)
    {
        $this->schedule->destroy($id);
        return redirect()->route('schedules.index')->with('success', 'Xoá thành công!');
    }
}
