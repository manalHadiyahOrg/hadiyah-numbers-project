<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use App\Superviser;
use App\Service ;
use App\Program;
use App\Observer ;
use Session;


class GUIAdminController extends Controller
{
public function __construct(){
  $this->middleware('auth:admin');
}
public function index() {
  $jop="رئيس برامج";
  SessionController::Session($jop);
  return  view('GUIAdmin');
}
public function get_superviser(){
       $supervisers=Superviser::orderBy('program_id')->get();
       foreach ($supervisers as $superviser) {
            $programs[$superviser->id]=$superviser->sup_program;}
        return GUIAdminController::get_superviser_table($programs,$supervisers);}
public function get_superviser_table($programs,$supervisers){
        return view('GUISuperviserInfo',compact('programs','supervisers'));}

public function searchid(Request $request){
      if($request->filter==1){
        $supervisers=Superviser::where('id','LIKE','%'.$request->id.'%')
        ->orwhere('f_name','LIKE','%'.$request->id.'%')
        ->orwhere('s_name','LIKE','%'.$request->id.'%')
        ->orwhere('l_name','LIKE','%'.$request->id.'%')
        ->orderBy('program_id')->get();
        if(!empty($supervisers[0])){
        foreach ($supervisers as $superviser) {
          $programs[$superviser->id]=$superviser->sup_program;
          } return GUIAdminController::get_superviser_table($programs,$supervisers);
        }else {
          $programs=null;
          $supervisers=null;
          return GUIAdminController::get_superviser_table($programs,$supervisers);
        }


      }else if($request->filter==2){
        if($request->id!==null){
        $progr=Program::where('id','LIKE','%'.$request->id.'%')
        ->orwhere('name','LIKE','%'.$request->id.'%')->get();
        $supervisers=[];
        $i=0;
        if(!empty($progr[0])){
          foreach($progr as $program){
            $superviser=Superviser::where('program_id','=',$program->id)->get();
            if(!empty($superviser[0])){
            foreach($superviser as $supervise){
              $supervisers[$i]=$supervise;
              $programs[$supervise->id]=$program;
              $i++;
            }  }else{ $programs=null;
                      $supervisers=null;
                     return GUIAdminController::get_superviser_table($programs,$supervisers);}
          }
          return GUIAdminController::get_superviser_table($programs,$supervisers);
        }else{  $programs=null;
                $supervisers=null;
               return GUIAdminController::get_superviser_table($programs,$supervisers);}
      }else{ $supervisers=Superviser::where('program_id','=',null)->orderBy('program_id')->get();
             $programs=null;
              return GUIAdminController::get_superviser_table($programs,$supervisers);
      }} }
public static function show($id) {
        $employee=Superviser::find($id);
        $superviser_emp=true;
       if($employee->program_id!==null){
          $program=Program::find($employee->program_id);
     }
       else{
           $program=null;
        }
        $programs=Program::all();
        return view('GUEdit',compact('employee','program','programs','superviser_emp'));
     }

public  static function update(Request $request){
      $superviser =Superviser::find($request->employee_id);
      $oldobservers=Observer::where('superviser_id','=',$superviser->id)->get();
      if(isset($oldobservers))
      {foreach($oldobservers as $observer){
        $observer->superviser_id=null;
        $observer->save();
      }}
      $oldsuperviser=Superviser::where('program_id','=',$request->program)->first();
      if(isset($oldsuperviser)){
      $observers=Observer::where('superviser_id','=',$oldsuperviser->id)->get();
      foreach($observers as $observer){
          $observer->superviser_id=$request->employee_id;
           $observer->save();
     }$oldsuperviser->program_id=null;
      $oldsuperviser->save();}
      else{
        $services=Service::where('program_id','=',$request->program)->get();
        foreach( $services as $service){
            $observers=Observer::where('service_id','=',$service->id)->get();
             foreach($observers as $observer){
               $observer->superviser_id=$request->employee_id;
               $observer->save();}
        }
      }
      $superviser->program_id=$request->program;
      $superviser->save();
      return redirect('/GUIAdmin')->with('success', ' تم الحفظ');
  }}
