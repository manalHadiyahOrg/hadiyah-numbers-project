<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
      protected $fillable=['name'];
      public $timestamps=false;
       public $incrementing=false;

      public function body_food_form(){
        return $this ->belongsToMany('App\Body_Food_Form');
      }
      public function care_form (){
        return $this ->belongsToMany('App\Care_Form ');
      }
      public function hospitable_form (){
        return $this ->belongsToMany('App\Hospitable_Form ');
      }
      public function soul_food_form(){
        return $this ->belongsToMany('App\Soul_Food_Form');
      }
      public function material_services(){
        return $this ->belongsToMany('App\Service','services_materials','material_id','service_id');
      }

}
