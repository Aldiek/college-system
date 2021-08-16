<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScientificAffairsCouncil extends Model
{
    protected $fillable = ['name'];

    public function council(){
        return $this->morphOne(Council::class,'councilable');
    }
}
