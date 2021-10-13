<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'tel', 'password', 'id_role', 'id_district', 'address', 'status'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'id_role' => Role::CUSTOMER
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id_district', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_customer', 'id');
    }

    public function hasPermission(Permission $permission)
    {
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }

    public function isAdmin()
    {
        return $this->role->id == Role::ADMIN;
    }
}
