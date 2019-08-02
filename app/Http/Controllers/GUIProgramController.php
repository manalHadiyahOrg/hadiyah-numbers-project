<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Service;
use Session;
class GUIProgramController extends Controller
{
    //
    public function index($id)
    {

         $program =Program::query()->where('name',$id)->first();

       if(isset($program)){
         $ser=Service::query()->where('program_id',$program->id)->get();
         return  view('GUIProgram',compact('program','ser'));}
        elseif(Session::has('page')){
           $url=Session::get('page');
           return redirect('/'.$url);
        }

         else  return redirect('/');
    }
}
