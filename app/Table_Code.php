<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Code extends Model
{
    //
    public $incrementing=false;
    protected $fillable=['table_name','program_id'];
    public $timestamps=false;

    public function program_table(){
        return $this ->hasOne('App\Program');
      }

      public function service(){
        return $this ->hasMany('App\Service','services','table_no');
      }

}
