<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
    public $fillable = ['name','department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function user()
    {
        return $this->hasMany(User::class, "department_id", "id");
    }
}
