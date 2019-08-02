<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GUIObserverInfoController;
use App\Http\Controllers\GUIAdminController;
use App\Superviser;
use Session;
class EditController extends Controller
{
    //
    public function show(Request $request)
    {
       if($request->superviser_id!==null){
        return GUIAdminController::show($request->superviser_id);
       }elseif($request->observer_id!==null) {
        return GUIObserverInfoController::show($request->observer_id);
       }else{

       }
    }
    public function update(Request $request){

        if(  substr ( $request->employee_id ,0,2 ) == 12 ){
        return GUIAdminController::update($request);
        }
        else if(substr ( $request->employee_id  ,0,2 ) == 13){

         return  GUIObserverInfoController::update($request);
        } else {}

        //return $request;

    }
    public function program_sup(Request $request){
        $value = $request->get('value');
        $superviser=Superviser::where('program_id','=', $value)->first();
        return $superviser;
    }

}
