<?php

namespace App;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable
{
    // protected static function booted()
    // {
    //     static::addGlobalScope('role_id', function (Builder $builder) {
    //         $builder->where('role_id', '!=', 1);
    //     });
    // }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','parent_id','company_id','avatar','email', 'password','role_id','remember_token'
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

     public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function companyDetail()
    {
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function RoleUser()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
    public function employeesDetail()
    {
        return $this->belongsTo(User::class,'parent_id','id');
    }

    public function scopeCompanies($query){
        return $query->where('role_id',2);
    }


}
