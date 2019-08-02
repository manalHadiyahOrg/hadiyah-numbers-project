@extends('templates.hadiyah')
@section('title')
رئيس البرامج
@endsection
@section('content')
<script>
$(document).ready(function(){
     window.history.pushState(null, "", window.location.href);
     window.onpopstate = function() {
      location.replace('/');
    }})
</script>
<center>
    @if(Session::has('message'))
       <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
</center>
<center>
    @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block" >
       <strong>{{ $message }}</strong>
     </div>
    @endif
  </center>
  <center>
<table style="width:70%">
  @foreach ($ser as $service)
    <tr class="programInfo">
      <td><p><b> {{$service->name}} </b> {{$service->description}} .<p></td>
     <td><img src="{{$program->image}}" width="150"></td>
    </tr>
  @endforeach
  <tr>

  <td colspan="3" style="text-align:center; padding: 2%;"><button onclick="window.location.href ='{{url('GUIObserverInfo')}}';">استعراض بيانات المشرفين الميدانيين </button></td>
</tr>
</table>
</center>
@if(Session::get('program_id')!==3)
  <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
            <h3><b> اضافة مادة </b></h3>
          </div>
                </div>
            </div>
      <div class="table-filter">
        <div class="row">
                    <div class="col-sm-3">
          </div>

            <div class="col-sm-9">

            <form action="/addMaterials" method="POST">
                {{method_field('PATCH')}}
              {{ csrf_field() }}

            <div class="filter-group">

              <input type="text" class="form-control" name="materials">
                <label> اضافة مادة غير موجودة </label>
            </div>

            <button >اضافة</i></button>
            </form>
            @if(isset($text))
            {{$text}}
            @endif

                    </div>
                </div>
      </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                      <th></th>
                      <th></th>
                         <th> </th>
                         <th> </th>
                         <th> المادة </th>
                         <th> اختيار  </th>

                    </tr>
                </thead>



                @if(isset($materials))

<form action="/add-service-materials" method="post">
{{method_field('PATCH')}}
{{ csrf_field() }}
                @foreach ($materials as $material)
                <tr>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{$material->name}}</td>

                    <td><input type="checkbox" name="material_list[]" value="{{$material['id']}}"></td>

                     <td></td>
               </tr>

                @endforeach

                @endif



            </table>
<h5>    لاضافة المواد لخدمة معينة قم باختيار المواد وثم اختيار الخدمة المناسبة واضغط على اضافة*  </h5>
</br>
              <select name="serviceID">

              <option value="service">  اختيار الخدمة </option>
            @if(isset($services))

            @foreach ($services as $service)
              <option value="{{$service['id']}}">{{$service['name']}} </option>
            @endforeach

            @endif
</select>   الخدمة

<input class='btn' type="submit" name="" value="اضافة">
</br>
</br>
@if(isset($msg))
{{$msg}}
@endif

           </form>





        </div>
    </div>

@endif
</div>
</div>
<!--######## END ARCHIVE ########-->
@endsection
