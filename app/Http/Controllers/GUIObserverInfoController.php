<?php

namespace App\Http\Controllers;
use Illuminate\support\Facades\input;

use Illuminate\Http\Request;
use App\Observer ;
use App\location ;
use App\service ;
use App\ Superviser;
use App\Program;
use Session;
use DB;

class GUIObserverInfoController extends Controller
{

public function index(){
  $locations=[];
    $services=[];
    $supervisers=[];
  if(strcasecmp( session()->get('jop'),"رئيس برامج")==0){
     $observers = Observer::orderBy('superviser_id')->get();}
  else if(strcasecmp( session()->get('jop'),"رئيس برنامج")==0){
    $observers=Observer::where('superviser_id','=',session()->get('id'))
                        ->orderBy('service_id')->get();
  }
     if(isset($observers)){
       foreach($observers as $observer1 ){
          if( $observer1->location_id!==null){
             $locationid = $observer1->location_id;
             $locations[$observer1->id] = location::where('id','=',$locationid)->first();}
          else {
             $locations[$observer1->id] =null;
          }
          if( $observer1->service_id!==null){
            $servicename = $observer1->service_id;
            $services[$observer1->id] = service::where('id','=',$servicename)->first();
            $programs[$observer1->id]=$services[$observer1->id]->program;}
          else{
            $programs[$observer1->id]=null;
            $services[$observer1->id] =null;}
          if($observer1->superviser_id!==null){
             $supervisers[$observer1->id]=Superviser::find($observer1->superviser_id);}
          else $supervisers[$observer1->id]=null;
     }
       return view('GUIObserverInfo',compact('observers','locations','services','supervisers'));
    }
     else
       return view ('GUIObserverInfo')->withMessage('لايوجد مشرفين ميدانين مسجلين!');
}

public function create(){
  return view('observers.create');
}

public function filter($filter,$id){
  if($filter==1){
    if($id!==null){
      $observers = Observer::where('id','LIKE','%'.$id.'%')
                            ->orwhere('f_name','LIKE','%'.$id.'%')
                            ->orwhere('s_name','LIKE','%'.$id.'%')
                            ->orwhere('l_name','LIKE','%'.$id.'%')
                            ->orwhere('service_id','LIKE','%'.$id.'%')
                            ->orwhere('superviser_id','LIKE','%'.$id.'%')
                            ->orwhere('location_id','LIKE','%'.$id.'%')
                            ->orderBy('superviser_id')->get();
     return   $observers ;}
    return null;}
  else if($filter==2){
    if($id!==null){
      $services=service::where('id','LIKE','%'.$id.'%')
                ->orwhere('name','LIKE','%'.$id.'%')
                ->orwhere('program_id','LIKE','%'.$id.'%')
                ->get();
      if(!empty($services[0])){
        foreach($services as $service){
          $observers=Observer::where('service_id','=',$service->id)
                              ->orderBy('superviser_id')->get();
           }
        return $observers ;}
      else{return null;}
    }
    else{
      $observers=Observer::where('service_id','=',null)
                          ->orderBy('superviser_id')->get();
      return $observers;}}
  else if($filter==3){
    if($id!=null){
      $locations=location::where('id','LIKE','%'.$id.'%')
                          ->orwhere('location','LIKE','%'.$id.'%')
                          ->orwhere('connection_point','LIKE','%'.$id.'%')
                          ->get();
      if(!empty($locations[0])){
        $observers=[];
        $i=0;
        foreach($locations as $location){
          $observer=Observer::where('location_id','=',$location->id)
                             ->orderBy('superviser_id')->get();
          if(!empty($observer[0])){
           foreach($observer as $observe){
            $observers[$i]=$observe;
            $i++;
        } }}
        return  $observers ;}
      else{
        return null;}}
    else{
      $observers=Observer::where('location_id','=',null)
                          ->orderBy('superviser_id')->get();
      return $observers;}}
  else if($filter==4){
    if($id!=null){
      $programs=Program::where('id','LIKE','%'.$id.'%')
      ->orwhere('name','LIKE','%'.$id.'%')
      ->get();

      if(!empty($programs[0])){
        foreach($programs as $program){
          $observers=[];
          $i=0;
           $superviser=Superviser::where('program_id','=',$program->id)->first();
           if($superviser!==null){
              $observer=Observer::where('superviser_id','=',$superviser->id)
                                 ->orderBy('superviser_id')->get();
              foreach($observer as $observe){
                $observers[$i]=$observe;
                $i++;
            } }
            else {
               $services=service::where('program_id','=',$program->id)->get();
               if(!empty($services[0])){
                foreach($services as $service){
                  $observer=Observer::where('service_id','=',$service->id)
                                     ->orderBy('superviser_id')->get();
                  if(!empty($observer[0])){
                  foreach($observer as $observe){
                    $observers[$i]=$observe;
                    $i++;}
                  } }}}}
        return  $observers ;}
      else {
        return null; } }
    else {
          $observers=Observer::where('service_id','=',null)
                              ->orderBy('superviser_id')->get();
          return $observers;}}
   else if($filter==5){
    if($id!==null){

      $supervisers=Superviser::where('id','LIKE','%'.$id.'%')
                           ->orwhere('f_name','LIKE','%'.$id.'%')
                           ->orwhere('s_name','LIKE','%'.$id.'%')
                           ->orwhere('l_name','LIKE','%'.$id.'%')->get();
      if(!empty($supervisers[0])){
        $observers=[];
        $i=0;
        foreach($supervisers as $superviser){
          $observer=Observer::where('superviser_id','=',$superviser->id)
                            ->orderBy('superviser_id')->get();
          if(!empty($observer[0])){
          foreach($observer as $observe){
            $observers[$i]=$observe;
            $i++;
          }  }
        }
        return $observers;
      } return null;}
    else {
      $observers=Observer::where('superviser_id','=',null)->get();
      return $observers;
    }

  }

}
public function superviserfilter($filter,$id){
  if($filter==1){
    if($id!==null){
      $observers = Observer::where('superviser_id','=', session()->get('id'))
                            ->where(function ($query) {
                              $query->orwhere('id','LIKE','%'.$id.'%')
                                    ->orwhere('f_name','LIKE','%'.$id.'%')
                                    ->orwhere('s_name','LIKE','%'.$id.'%')
                                    ->orwhere('l_name','LIKE','%'.$id.'%')
                                    ->orwhere('service_id','LIKE','%'.$id.'%')
                                    ->orwhere('location_id','LIKE','%'.$id.'%');
                          })->get();
     return $observers;}
    return null;}
  else if($filter==2){
    if($id!==null){
      $services=service::where('id','LIKE','%'.$id.'%')
                ->orwhere('name','LIKE','%'.$id.'%')
                ->orwhere('program_id','LIKE','%'.$id.'%')
                ->get();
      if(!empty($services[0])){
        foreach($services as $service){
          $observers=Observer::where('service_id','=',$service->id)
                              ->where('superviser_id','=', session()->get('id'))
                              ->orderBy('service_id')->get();
           }
        return $observers ;}
      else{return null;}
    }
    else{
      $observers=Observer::where('service_id','=',null)
                          ->where('superviser_id','=', session()->get('id'))
                          ->get();
      return $observers;}}
  else if($filter==3){
    if($id!=null){
      $locations=location::where('id','LIKE','%'.$id.'%')
                          ->orwhere('location','LIKE','%'.$id.'%')
                          ->orwhere('connection_point','LIKE','%'.$id.'%')
                          ->get();
      if(!empty($locations[0])){
        $observers=[];
        $i=0;
        foreach($locations as $location){
          $observer=Observer::where('location_id','=',$location->id)
                             ->where('superviser_id','=', session()->get('id'))
                             ->orderBy('location_id')->get();
          if(!empty($observer[0])){
           foreach($observer as $observe){
            $observers[$i]=$observe;
            $i++;
        } }}
        return  $observers ;}
      else{
        return null;}}
    else{
      $observers=Observer::where('location_id','=',null)
                          ->where('superviser_id','=', session()->get('id'))
                          ->get();
      return $observers;}}
}
public function searchid( Request $request){
  if(strcasecmp( session()->get('jop'),"رئيس برامج")==0){
  $observers =GUIObserverInfoController::filter($request->filter,$request->id);}
  else if(strcasecmp( session()->get('jop'),"رئيس برنامج")==0){

    $observers= GUIObserverInfoController::superviserfilter($request->filter,$request->id);
  }
    if(!empty($observers[0])){
      $output ='';
      foreach($observers as $observer1 ){
          $output .='<tr>   <td> <form action="/edit" method="post">
           '. csrf_field().'
           <button type="submit" name="observer_id" value='.$observer1->id.'> تعديل  </button>
           </form>  </td>';
            if( $observer1->location_id!==null){
              $locationid = $observer1->location_id;
              $locations[$observer1->id] = location::where('id','=',$locationid)->first();
              $output .='<td></span>'.$locations[$observer1->id]->connection_point.'<span class="status text-success">&nbsp;&bull;</td>
              <td>'.$locations[$observer1->id]->location.'<span class="status text-success">&nbsp;&bull;</span></td>
             ';}
            else {
             $output .='<td></td><td></td>';
          }
            if( $observer1->service_id!==null){
               $servicename = $observer1->service_id;
               $services[$observer1->id] = service::where('id','=',$servicename)->first();
               $output .='<td>'.$services[$observer1->id]->name.'</td>';
            }
            else{
              $output .='<td></td>';
            }
            if(strcasecmp( session()->get('jop'),"رئيس برامج")==0){
           if($observer1->superviser_id!==null){
               $supervisers[$observer1->id]=Superviser::find($observer1->superviser_id);
               $output .='<td>'.$supervisers[$observer1->id]->f_name.' '.$supervisers[$observer1->id]->l_name .'</td>';
           }
           else $output .='<td></td>';}
           $output .='<td>'.$observer1->f_name.' '.$observer1->s_name.' '.$observer1->l_name.'</td> <td>'.$observer1->id.'</td> </tr>';
       }
       echo $output;
   }
  else{
    echo $output='';
  }


   }




  public static function show($id) {
     $employee =Observer::find($id);
    if((strcasecmp( session()->get('jop'),"رئيس برامج")==0))
    { if($employee->superviser_id!==null){
        $superviser=$employee->superviser;
        $program=Program::where('id','=',$superviser->program_id)->first();
       }else {$program =null;
        $superviser=null;}
       $programs=Program::all();
       return view('GUEdit',compact('employee','program','programs','superviser')); }
  else if((strcasecmp( session()->get('jop'),"رئيس برنامج")==0)){
   if($employee->service_id!==null){
      $service=service::find($employee->service_id);
      $services=service::where('program_id','=',$service->program_id)->get();}

   else{
       $superviser=$employee->superviser;
       $service=null;
       $services=service::where('program_id','=',$superviser->program_id)->get(); // تعديل لازم ناخذ بيانات مشرف البرنامج
    }
    if($employee->location_id!==null){
    $location=location::find($employee->location_id);
  }
    else{
        $location=null;
       }
       $locations=location::all();
       $citys=location::all()->unique('location');
       return view('GUEdit',compact('employee','location','service','locations','services','citys'));
      }
      $error="خطاء في جلب المعلومات ";
      return view('GUEdit',compact('error'));
 }
 public function observerlocation(Request $request){
       $select = $request->get('select');
       $value = $request->get('value');
       $location=location::find($value);
       $dependent = $request->get('dependent');
       $data = location::where('location','LIKE', $location->location)->get();
       $output = '<option value="">اختار  '.ucfirst($dependent).'</option>';
       foreach($data as $row){
       $output .= '<option value="'.$row->id.'">'.$row->connection_point.'</option>'; }
       echo $output;

}

  public static function update(Request $request){

        $observer =Observer::find($request->employee_id);
        if((strcasecmp( session()->get('jop'),"رئيس برامج")==0)){
          $superviser=Superviser::where('program_id','=',$request->program)->first();
          if (isset($superviser)){
            if ($observer->service_id!==null){
              $service=service::find($observer->service_id)->first();
              $program=$service->program;
              if( $request->program!==$program->id){
                   $observer->service_id=null;
                   $observer->location_id=null;
                   $superviser=Superviser::where('program_id','=',$request->program)->first();
                    $observer->superviser_id=$superviser->id;

              }
            }
            else if($observer->superviser_id!==null){
                    $superviser==Superviser::find($observer->superviser_id)->first();
                    $program=$superviser->sup_program;
                   if($request->program!==$program->id){
                      $superviser=Superviser::where('program_id','=',$request->program)->first();
                      $observer->superviser_id=$superviser->id;
                      $observer->location_id=null;}
           }
           else {
                  $superviser =Superviser::where('program_id','=',$request->program)->first();
                  $observer->superviser_id=$superviser->id;
                  $observer->location_id=null;}
                }
        else { Session::flash('message','ايمكن اجر العلية بسبب عدم تعين رئيس برنامج ');
                Session::flash('alert-class', 'alert-danger');
              return   back();
          //with('error', 'لايمكن اجر العلية بسبب عدم تعين رئيس برنامج ');
        }
      }
        else if ((strcasecmp( session()->get('jop'),"رئيس برنامج")==0)){
          $observer->service_id=$request->servies;
          $observer->location_id=$request->location_id;

        }

        $observer->save();
        return redirect('/GUIObserverInfo')->with('success', ' تم الحفظ');
    }


}
