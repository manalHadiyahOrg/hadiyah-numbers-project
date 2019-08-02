<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services_materials extends Model
{
    //
    public $incrementing=false;
    public $timestamps=false;
    protected $primarykey=['material_id','service_id'];



}
