<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ScientificCouncilMember extends Model
{
    protected $fillable = ['faculty_id','scientific_affairs_council_id'];
    public function user(){
        return $this->morphOne(User::class,'userable');
    }
}
