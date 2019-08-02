<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Material;
use App\Service;
use App\services_materials;
use App\Program;
use Session;

class GUISupervisorController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:superviser');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jop="رئيس برنامج";
       SessionController::Session($jop);
        $program=Program::find(Session::get('program_id'));
        $ser=Service::where('program_id','=',Session::get('program_id'))->get();
       if(Session::get('program_id')!==3){
       $materials = Material::all();
       $services=Service::where('program_id','=',Session::get('program_id'))->get();

        return view('GUISupervisor',compact('services','materials','ser','program'));
     }
       return view('GUISupervisor',compact('ser','program'));
    }


    public function addMaterials(Request $request)
    {
            $material = Material::where('name','LIKE',$request->materials)->get();
            $success="done";


              if(count($material) > 0){
                $message=" يوجد مواد مشابهه ";
                return  back()->with('message', $message);

             }else {
                $material=new Material();
                $material->name=$request->materials;

               $material->save();
             }
             $materials = Material::all();
            $program=Program::find(Session::get('program_id'));
             $services=Service::where('program_id','=',Session::get('program_id'))->get();
             $ser=Service::where('program_id','=',Session::get('program_id'))->get();
             return back()->with('success', $success);


    }



    public function storMaterials(Request $request)
    {
        $services_materials = new services_materials;

        if (is_array( $request->material_list))
        {
            for ($i=0; $i < count( $request->material_list) ; $i++) {

                $services_materials = new services_materials;
                $services_materials->service_id = $request->serviceID;
                $services_materials->material_id =  $request->material_list[$i];
                $services_materials->save();
              }


              // $message='لم يتم الحفظ';
              // $materials = Material::all();
              // $program=Program::find(Session::get('program_id'));
              // $services=Service::where('program_id','=',Session::get('program_id'))->get();
              // $ser=Service::where('program_id','=',Session::get('program_id'))->get();
              // return  back()->with('message', $message);
              $success='تم الحفظ';
              $materials = Material::all();
              $program=Program::find(Session::get('program_id'));
              $services=Service::where('program_id','=',Session::get('program_id'))->get();
              $ser=Service::where('program_id','=',Session::get('program_id'))->get();
              return back()->with('success', $success);
          }
             return back();
    }
}
