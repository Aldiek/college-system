<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CouncilMember extends Model
{
    protected $fillable = ['can_vote','council_id'];
    public function user(){
        return $this->morphOne(User::class,'userable');
    }
    public function votes(){
        return $this->hasMany(Vote::class);
    }
}
