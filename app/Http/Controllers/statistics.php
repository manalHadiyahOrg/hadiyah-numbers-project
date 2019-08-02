<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Service;
use App\Observer;
use DB;
use App\Quotation;
class statistics extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $programs=Program::all();
      return view('statistics',compact('programs'));
    }

}
