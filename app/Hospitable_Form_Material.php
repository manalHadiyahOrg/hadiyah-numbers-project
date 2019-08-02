<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitable_Form_Material extends Model
{
    //
    protected $fillable=['form_id','material_id','count'];
    protected  $primarykey=['form_id','material_id'];
    public $incrementing=false;
    public $timestamps=false;
}
