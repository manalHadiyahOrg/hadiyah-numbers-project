<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zakaat_Form_Institution extends Model
{
    //
    protected $fillable=['form_id','institution_id','count','recipient'];
    protected  $primarykey=['form_id','institution_id'];
      public $incrementing=false;
      public $timestamps=false;
      public function atonement__and__zakaat__forms(){
        return $this ->hasOne('App\Atonement_And_Zakaat_Form','form_id','form_id');
      }
}
