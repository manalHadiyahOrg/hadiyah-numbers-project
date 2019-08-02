<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    //
    protected $fillable=['name'];
    public $timestamps=false;

    public function atonement_and_zakaat_form(){
      return $this ->belongsToMany('App\Atonement_And_Zakaat_Form',);
    }

    public function blood_of_algebrat_form (){
      return $this ->belongsToMany('App\Blood_Of_Algebrat_Form' );
    }
}
