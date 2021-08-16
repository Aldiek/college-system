<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministativeAffairsCouncil extends Model
{
    public function council(){
        return $this->morphOne(Council::class,'councilable');
    }
}
