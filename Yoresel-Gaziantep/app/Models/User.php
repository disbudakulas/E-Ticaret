<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    protected $fillable=[
        'name','surname','email','updated_at','created_at','password', 'token','authority'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
