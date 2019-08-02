<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Service;
use App\Observer;
use DB;
use App\Quotation;
class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $Observer=Observer::find(1);
       $ser=Service::all();
      return view('test',compact('ser'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $results = DB::select('select * from services where program_id = :id', ['id' => $id]);
        foreach ($results as $result) {
              echo  $result->name;

            };
      }
}
