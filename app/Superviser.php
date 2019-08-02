<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superviser extends Authenticatable
{
    
    use Notifiable;
    protected $guard = 'superviser';
    public $incrementing=false;
    protected $fillable=['id','f_name','s_name','l_name','email'];
    protected $hidden = ['password'];
    public $timestamps=false;
    public function admin(){
      return $this ->hasOne('App\Admin');
    }
    public function sup_program(){
      return $this ->hasOne('App\Program','id','program_id');
    }

}
