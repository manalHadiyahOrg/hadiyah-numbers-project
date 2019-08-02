<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\location;
use App\Program;

class SessionController extends Controller
{
// يدخل له بيانات الدخول اي دي لحال او اري
public static function Session ($jop){

     Session::put('id',Auth::user()->id);
     Session::put('name',Auth::user()->f_name ." ". Auth::user()->s_name ." ".Auth::user()->l_name);
     Session::put('email',Auth::user()->email);
     Session::put('jop',$jop);
     if(strcasecmp($jop,"مشرف ميداني")==0){
       Session::put('page','GUIObserver');
       if(Auth::user()->location_id!=null)
       {
         $location=location::find(Auth::user()->location_id);
         if(!empty( $location)){
           Session::put('location', $location->location ." ". $location->connection_point );
         }
         else
         Session::put('location', "لايوجد");
       }
        else
        Session::put('location', "لايوجد");
     }
     else if(strcasecmp($jop,"رئيس برنامج")==0){
         Session::put('page','GUISupervisor');
         if(Auth::user()->program_id!==null){
           $program=Program::find(Auth::user()->program_id);
           if(!empty( $program)){
              Session::put('program_name', $program->name);
              Session::put('program_id', $program->id);
           }
           else{
            Session::put('program_name', "لايوجد");
            Session::put('program_id',null);}
            }
          else{
                Session::put('program_name', "لايوجد");
               Session::put('program_id', null);}
             }
     elseif (strcasecmp($jop," إدارة تقنية المعلومات")==0){
       Session::put('page','GUIit');

     }
     else{
       Session::put('page','/GUIAdmin');
     }
}
}
