<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CouncilSecretary extends Model
{
    protected $fillable = ['council_id'];
    public function user(){
        return $this->morphOne(User::class,'userable');
    }
}
