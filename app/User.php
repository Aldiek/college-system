<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','userable_id','	userable_type','	department','	faculty',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable()
    {
        return $this->morphTo();
    }
    public function is_super_admin(){


        return ($this->is_super_admin==1) ? true : false;

    }
    public function is_secretary_council(){


        return ($this->userable_type=="App\Models\CouncilSecretary") ? true : false;

    }
    public function is_department_secretary(){
        return  ($this->userable_type=="App\Models\DepartmentSecretary")? true : false;

    }
    public function is_union_represintive(){

        return ($this->userable_type=="App\Models\UnionRepresentative")? true : false;

    }
    public function is_council_presedent(){

        return ($this->userable_type=="App\Models\CouncilPresedent") ? true : false;

    }
    public function is_council_member(){

        return ($this->userable_type=="App\Models\CouncilMember") ? true : false;

    }
    public function is_scientific_council_member(){

        return ($this->userable_type=="App\Models\ScientificCouncilMember") ? true : false;

    }
}
