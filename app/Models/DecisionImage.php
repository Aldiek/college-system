<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecisionImage extends Model
{
    protected $fillable = ['image_path','decision_id'];

    public function decision(){
        return $this->belongsTo(Decision::class);
    }
}
