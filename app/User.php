<?php

namespace Furbook;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * @return array
     */
    public function scopeGmail($query)
    {
        $query->where('email', 'like', '%gmail%');
    }

    /**
     * @return array
     */
    public function scopeEmail($query, $mail)
    {
        $query->where('email', 'like', "%$mail%");
    }

    public function roles()
    {
        return $this->belongsToMany('Furbook\Role');
    }
}
