<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use DB;
use App\Superviser;
use App\Observer;
use App\Admin;
use App\it;
use Session;
use Hash;


class itController extends Controller
{
  public function __construct(){
    $this->middleware('auth:it');
  }
  public function index() {
    $jop=" إدارة تقنية المعلومات";
    SessionController::Session($jop);
    return view('GUIit');
  }
  public function signup(Request $request)
  {

    $text0="تم فتح الحساب";
      if($request->jobName=="observer"){
         $olduse=Observer::where('email','=',$request->email)->first();
         $newuse;
         if(!isset($olduse)){
          $observer=new Observer();
          $observer->f_name=$request->f_name;
          $observer->s_name=$request->s_name;
          $observer->l_name=$request->l_name;
          $observer->email=$request->email;
          $observer->password=bcrypt($request->password);
          $observer->save();
          $newuse=Observer::where('email','=',$observer->email)->first();
        }
        else {
          return redirect('/GUIit')->with('error','البريد الالكتروني مسجل لمستخدم ');
          }
      }elseif($request->jobName=="supervisor"){
        $olduse=Superviser::where('email','=',$request->email)->first();
        if(!isset($olduse)){
          $Superviser=new Superviser();
          $Superviser->f_name=$request->f_name;
          $Superviser->s_name=$request->s_name;
          $Superviser->l_name=$request->l_name;
          $Superviser->email=$request->email;
          $Superviser->password=bcrypt($request->password);
          $Superviser->save();
          $newuse=Superviser::where('email','=',$Superviser->email)->first();
        }
          else {
            return redirect('/GUIit')->with('error','البريد الالكتروني مسجل لمستخدم ');
            }

        }elseif($request->jobName=="admin"){
          $olduse=Admin::where('email','=',$request->email)->first();
          if(!isset($olduse)){
            $Admin=new Admin();
            $Admin->f_name=$request->f_name;
            $Admin->s_name=$request->s_name;
            $Admin->l_name=$request->l_name;
            $Admin->email=$request->email;
            $Admin->password=bcrypt($request->password);
            $Admin->save();
            $newuse=Admin::where('email','=',$Admin->email)->first();
          }
            else {
              return redirect('/GUIit')->with('error','البريد الالكتروني مسجل لمستخدم ');
              }


        }
        else{

          return redirect('/GUIit')->with('error','لم يتم فتح الحساب');
        }
        $text0= " : الرقم الوظيفي".$newuse->id." كلمة المرور : ".$request->password;
        return redirect('/GUIit')->with(['success'=>'تم فتح حساب','text'=>$text0]);


  }


   public function showInfo(Request $req) {
         $user;
         $text='';

         if(  substr ( $req-> Search ,0,2 ) == 11 ){
              $user=Admin::find($req->Search);

        }elseif(  substr ( $req-> Search ,0,2 ) == 12 ){
          $user=Superviser::find($req->Search);

        }elseif(  substr ( $req-> Search ,0,2 ) == 13 ){
              $user=Observer::find($req->Search);

        }else{
          Session::flash('message','لا يوجد موظف يحمل هذا الرقم الوظيفي');
          Session::flash('alert-class', 'alert-danger');
          return  back();

        }

        if(!isset($user)){
          Session::flash('message','لا يوجد موظف يحمل هذا الرقم الوظيفي');
          Session::flash('alert-class', 'alert-danger');
          return   back();
          }
        else {
          return  view('GUIit',compact('user'));
        }



   }




   public function update(Request $request, $id)
  {

$text='تم';

   if(  substr ( $id ,0,2 ) == 11 ){

    $user=Admin::find($id);

     if($request->jobName=="admin"){
         $user->email = $request->email;
         if($request->password!==null){
            $user->password=bcrypt($request->password);}
     $user->save();
    }else{

      if($request->jobName=="observer"){
        $observer=new Observer();
          $observer->f_name=$user->f_name;
          $observer->s_name=$user->s_name;
          $observer->l_name=$user->l_name;
          $observer->email=$request->email;

          if($request->password!==null){
            $observer->password=bcrypt($request->password);
          }else{
            $observer->password=$user->password;}

          $observer->save();

      }elseif($request->jobName=="supervisor"){
          $Superviser=new Superviser();

          $Superviser->f_name=$user->f_name;
          $Superviser->s_name=$user->s_name;
          $Superviser->l_name=$user->l_name;
          $Superviser->email=$request->email;

          if($request->password!==null){
            $Superviser->password=bcrypt($request->password);
          }else{
             $Superviser->password=$user->password;}

          $Superviser->save();

        }
          $user->delete();

    }

   }else if(  substr ($id ,0,2 ) == 12 ){

     $user=Superviser::find($id);

     if($request->jobName=="supervisor"){
        $user->email = $request->email;
        if($request->password!==null){
          $user->password=bcrypt($request->password);}
     $user->save();
    }else{

      if($request->jobName=="observer"){
        $observer=new Observer();

          $observer->f_name=$user->f_name;
          $observer->s_name=$user->s_name;
          $observer->l_name=$user->l_name;
          $observer->email=$request->email;
          if($request->password!==null){
            $observer->password=bcrypt($request->password);
          }else{
            $observer->password=$user->password;}

          $observer->save();

      }elseif($request->jobName=="admin"){
        $Admin=new Admin();

        $Admin->f_name=$user->f_name;
        $Admin->s_name=$user->s_name;
        $Admin->l_name=$user->l_name;
        $Admin->email=$request->email;
        if($request->password!==null){
          $Admin->password=bcrypt($request->password);
        }else{
            $Admin->password=$user->password;}
        $Admin->save();

        }
          $user->delete();

    }

   }elseif ( substr ( $id ,0,2 ) == 13 ) {
     $user=Observer::find($id);

     if($request->jobName=="observer"){
       $user->email = $request->email;
       if($request->password!==null){
       $user->password=bcrypt($request->password); }
     $user->save();
    }else{

      if($request->jobName=="supervisor"){
          $Superviser=new Superviser();
          $Superviser->f_name=$user->f_name;
          $Superviser->s_name=$user->s_name;
          $Superviser->l_name=$user->l_name;
          $Superviser->email=$request->email;
          if($request->password!==null){
            $Superviser->password=bcrypt($request->password);
          }else{
            $Superviser->password=$user->password;}

          $Superviser->save();

      }elseif($request->jobName=="admin"){
        $Admin=new Admin();
        $Admin->f_name=$user->f_name;
        $Admin->s_name=$user->s_name;
        $Admin->l_name=$user->l_name;
        $Admin->email=$request->email;

        if($request->password!==null){
          $user->password=bcrypt($request->password);
        }else {
           $Admin->password=$user->password;}
        $Admin->save();

        }
          $user->delete();
    }

   }else{
    $error='لم يتم تحديث البيانات';
    return redirect('/GUIit')->with($error);

   }

   return redirect('/GUIit')->with('success', 'تم  التحديث');
   }






   public function deleteUser( $id){

     $text='done deleted';

     if(  substr ( $id ,0,2 ) == 11 ){
       $user=Admin::findOrFail($id);
       $user->delete();
     }else if(  substr ($id ,0,2 ) == 12 ){

       $user=Superviser::findOrFail($id);
        $user->delete();

     }elseif ( substr ( $id ,0,2 ) == 13 ) {
       $user=Observer::findOrFail($id);
        $user->delete();

     }else{
      $error='لم يتم حذف الحساب';
      return redirect('/GUIit')->with('error',$error);

     }

     return  redirect('/GUIit')->with('success', 'تم  حذف الحساب');

   }
}
