<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
   protected $fillable = ['name','councilable_id','councilable_type'];

    public function councilable(){
        return $this->morphTo();
    }
    public function decisions(){
        return $this->belongsToMany(Decision::class,'council_decision');
    }

    public function sessions(){
        return $this->hasMany(Session::class);
    }
}
