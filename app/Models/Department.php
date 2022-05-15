<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    public $fillable = [ 'name', 'status', 'manager'];

    public function user() 
    {
        return $this->hasMany(User::class, "department_id", "id");
    }

}
