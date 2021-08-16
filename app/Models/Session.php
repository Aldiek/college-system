<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable=['session_number','date','council_id'];

    public function decisions(){
        return $this->belongsToMany(Decision::class,'session_decision');
    }

    public function council(){
        return $this->belongsTo(Council::class);
    }
}
