<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    public function council_member(){
        return $this->belongsTo(CouncilMember::class);
    }
}
