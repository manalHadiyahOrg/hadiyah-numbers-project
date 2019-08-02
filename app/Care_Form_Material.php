<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Care_Form_Material extends Model
{
    //
    protected $fillable=['form_id','material_id','count','language'];
    protected  $primarykey=['form_id','material_id'];
      public $incrementing=false;
      public $timestamps=false;
}