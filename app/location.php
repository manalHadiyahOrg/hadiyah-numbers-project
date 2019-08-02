<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    //
    protected $table = 'location' ; 
    protected $fillable=['id','location','connection_point'];
    public $timestamps=false;
    public $incrementing=false;

        public function observers(){
          return $this ->belongsToMany('App\observers');
        }
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

}
