<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyCouncil extends Model
{
    protected $fillable=['faculty_id'];

    public function council(){
        return $this->morphOne(Council::class,'councilable');
    }
    public  function faculty(){
        return $this->belongsTo(Faculty::class);
    }
}
