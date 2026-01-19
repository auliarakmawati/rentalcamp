<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = true;
    protected $guarded = [];


    protected $fillable = [
    'nama',
    'email',
    'password',
    'alamat',
    'no_hp',
    'role',
];


    protected $hidden = [
        'password',
    ];

    public function getRouteKeyName()
    {
        return 'id_user';
    }
}
