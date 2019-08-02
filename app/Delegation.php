<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{
    //
    public $timestamps=false;

    protected $fillable=[
      'nationality','address_in_mecca','address_in_madinah','arrival_time','date_of_arrival',
    'date_of_Visit','visit_time','date_of_departure','departure_time','coordinator','contact_number',
    'number_of_women','number_of_children','number_of_men','date','day','observe_id','service_id','observation'];

  public function observe_delegation(){
    return $this ->hasOne('App\Observer');
  }

  public function service(){
    return $this ->hasOne('App\Service');
  }
  public function delegation(){
    return $this ->hasOne('App\Delegation');
  }

}
