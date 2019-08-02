<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Session;
class templateController extends Controller
{
    //
    public function index()
    {
        $programs=Program::all();
        return view('hadiyah',compact('programs'));
    }
}
