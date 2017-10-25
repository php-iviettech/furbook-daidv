<?php

namespace Furbook;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Furbook\Cat;

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

    protected $casts = [
        'is_admin' => 'boolean',
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

    /**
     * @return array
     */
    public function orderitems()
    {
        return $this->hasManyThrough('Furbook\OrderItem', 'Furbook\Order');
    }

    public function owns(Cat $cat){
        return $this->id == $cat->user_id;
    }

    public function canEdit(Cat $cat){
        return $this->is_admin || $this->owns($cat);
    }

    public function isAdministrator(){
        return $this->getAttribute('is_admin');
    }

}
