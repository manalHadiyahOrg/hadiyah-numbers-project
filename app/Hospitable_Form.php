<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitable_Form extends Model
{
    //
    protected $fillable=['date','day','evaluation','nu_service_providers','number_of_beneficiaries','observe_id','service_id','location_id','observation'];
    protected  $primarykey='form_id';
    public $timestamps=false;

    public function observe_hospitable_form(){
      return $this ->hasOne('App\Observer');
    }

    public function service(){
      return $this ->hasOne('App\Service');
    }

    public function material(){
      return $this ->belongsToMany('App\Material');
    }
}
