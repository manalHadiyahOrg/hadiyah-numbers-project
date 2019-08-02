<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood_Of_Algebrat_Form extends Model
{
    //
    protected $fillable=['count','date','day','observe_id','service_id','count_of_agencies'];
    protected  $primarykey='form_id';

    public $timestamps=false;
    public function observe_Blood(){
      return $this ->hasOne('App\Observer');
    }

    public function service(){
      return $this ->hasOne('App\Service');
    }

    public function institution(){
      return $this ->belongsToMany('App\Institution');
    }
    public function adoption_Of_the_committee(){
      return $this ->hasMany('App\Adoption_Of_The_Committee');
    }
    public function blood__of__algebrat__forms(){
      return $this ->hasMany('App\Blood_Of_Algebrat_Form_Institution','form_id','form_id');
    }
}
