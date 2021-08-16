<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DepartmentSecretary extends Model
{
    protected $fillable=['department_id'];

    public function user(){
        return $this->morphOne(User::class,'userable');
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}