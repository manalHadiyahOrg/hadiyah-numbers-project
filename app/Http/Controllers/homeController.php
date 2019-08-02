<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Session;
class homeController extends Controller
{
    //
    public function index()
    {
        $programs=Program::all();
        return view('welcome',compact('programs'));
    }
}
