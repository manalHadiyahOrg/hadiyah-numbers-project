<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adoption_Of_The_Committee extends Model
{
    //
    protected $fillable=['form_id','name','observation'];
    public $incrementing=false;
    protected  $primarykey='form_id';
    public $timestamps=false;

    public function blood_of_algebrat_form(){
      return $this ->hasOne('App\Blood_Of_Algebrat_Form');
    }
}
