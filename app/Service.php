<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable=['name','description','table_no'];
    public $timestamps=false;

    public function program(){
      return $this ->belongsTO('App\Program');
    }

    public function table(){
      return $this ->belongsTO('App\Table_Codes');
    }
    public function observer(){
      return $this ->hasMany('App\Observer','observer','service_id');
    }
    public function material_services(){
      return $this ->belongsToMany('App\Material','services_materials','service_id', 'material_id');
    }


}
