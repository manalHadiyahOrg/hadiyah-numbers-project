<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atonement_And_Zakaat_Form extends Model
{
    //
    protected $fillable=['count','date','day','observe_id','service_id'];
    protected  $primarykey='form_id';
    public $timestamps=false;

    public function observe_z(){
      return $this ->hasOne('App\Observer');
    }

    public function service_z(){
      return $this ->hasOne('App\Service');
    }

    public function institution(){
      return $this ->belongsToMany('App\Institution');
    }
    public function atonement__and__zakaat__forms(){
      return $this ->hasMany('App\Zakaat_Form_Institution','form_id','form_id');
    }

}
