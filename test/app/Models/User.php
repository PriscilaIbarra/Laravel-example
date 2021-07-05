<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol','users_roles','user_id','rol_id');
    }
    
    public function users()
    {
        return $this->hasMany('App\Models\User','created_by','id');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function hasRol(string $description)
    {
        try
        {
            return $this->roles->contains(Rol::where('description','=',$description)->get()->first());
        }
        catch(\Exception $e)
        {
            return false;
        }
    }
}
