<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'Lý luận cơ sở', 'status'=> 'Đang hoạt động']);
        Department::create(['name' => 'Xây dựng đảng', 'status'=> 'Đang hoạt động']);
        Department::create(['name' => 'Nhà nước và pháp luận', 'status'=> 'Tạm ngưng']);
    }
}
