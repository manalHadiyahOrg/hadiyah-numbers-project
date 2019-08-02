@extends('templates.hadiyah')
@section('title')
الاحصائيات
@endsection
@section('content')
<center>
  <div>
    <form action="{{url('/GUIStatistics/{id}')}}">
      <label>اختيار الاحصائية</label><br/>
      <select id='con' name='idOfStatics' required>
        @foreach($programs as $prog)
         <option value='{{$prog->name}}'>{{$prog->name}}</option>
         @endforeach
       </select><br/>
       <button>
   </form>
  </div>
  <br/>
  <div>

  </div>
</center>
@endsection
