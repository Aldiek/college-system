<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name'];

    public function faculty_council()
    {
        return $this->hasOne(FacultyCouncil::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
