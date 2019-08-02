<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $fillable=['id','f_name','s_name','l-name','email'];
    protected $hidden = ['password'];
     public $timestamps=false;
}
