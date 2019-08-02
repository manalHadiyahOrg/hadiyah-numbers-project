@extends('templates.hadiyah')
@section('title')
هدية الحاج والمعتمر
@endsection
@section('pageTitle')
 هدية الحاج والمتعتمر
@endsection
@section('content')

<div class="containerHome">
{{csrf_field()}}
  <center>
  @foreach($programs as $program)
  <a href="{{url('GUIProgram/'.$program->name)}}">
  <div class="programCads">
    <center>
      <p><br/><br/><b> {{$program->name}} </b>{{$program->Description}}</p>
      <img src="{{$program->image}}" width="150">
    </center>
  </div>
  </a>
  @endforeach
</div>
</center>
@endsection
