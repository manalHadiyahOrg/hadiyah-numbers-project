<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $fillable=['name','description'];
    public $timestamps=false;

    public function superviser(){
      return $this ->hasOne('App\Superviser');
    }
  

    public function service(){
      return $this ->hasMany('App\Service','services','program_id');
    }
    public function table_code(){
      return $this ->hasMany('App\Table_Code','table_codes','program_id');
    }
    public function form(){
      return $this ->hasMany('App\Form');
    }

}
