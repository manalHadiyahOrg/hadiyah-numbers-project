<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class IT extends Authenticatable
{
    use Notifiable;

    protected $guard = 'it';

    
    public $incrementing=false;
    public $timestamps=false;
    protected $fillable=['id','f_name','s_name','l_name','email'];
    protected $hidden = ['password'];


}
