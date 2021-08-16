<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UnionRepresentative extends Model
{
    protected $fillable = ['scientific_affairs_council_id'];
    public function user(){
        return $this->morphOne(User::class,'userable');
    }
}
