<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    use HasFactory;

    protected $table = 'department_user';

    protected $fillable = ['user_id', 'department_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'department_user', 'department_id', 'user_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_user', 'user_id', 'department_id');
    }

}
