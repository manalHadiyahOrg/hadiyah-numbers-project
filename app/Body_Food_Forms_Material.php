<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body_Food_Forms_Material extends Model
{
    //
    protected $fillable=['form_id','material_id','count','surplus','needs_of_tomorro'];
    protected  $primarykey=['form_id','material_id'];
      public $incrementing=false;
      public $timestamps=false;
}
