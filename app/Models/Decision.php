<?php

namespace App\Models;

use App\CouncilDecision;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{

    public function councils(){
        return $this->belongsToMany(Council::class,'council_decision');
    }

    public function sessions(){
        return $this->belongsToMany(Session::class,'session_decision');
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function image(){
        return $this->hasOne(DecisionImage::class);
    }
}
