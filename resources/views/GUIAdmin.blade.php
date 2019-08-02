@extends('templates.hadiyah')
@section('title')
رئيس البرامج
@endsection
@section('pageTitle')
رئيس البرامج
@endsection
@section('content')
<script>
$(document).ready(function(){
     window.history.pushState(null, "", window.location.href);
     window.onpopstate = function() {
      location.replace('/');
    }
    document.getElementById('supervisers_section').style.display = "none";
  $('#supervisers').click(function(){

     document.getElementById('supervisers_section').style.display = "block";
    $.ajax({
     type: 'GET', //THIS NEEDS TO BE GET
     url:"{{url('SupervisersInfo')}}",
     success: function (data) {
      $('#tablesup').html(data);
         console.log(data)}
  });
})
$('#send_form').on('submit',function(event){
      event.preventDefault();
       var _token="{{csrf_token()}}";
       $.ajax({
         url:"{{url('searchsup')}}",
         type:"POST",
         data:$(this).serialize(),
         success:function(result){
            document.getElementById('supervisers_section').style.display = "block";
           $('#tablesup').html(result);
           }

         }
       )
  });
});

</script>
<center>
  @if(Session::has('message'))
   <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
    </center>
@if(Session::has('success'))
<center>
<span id="result">
   <div class="alert alert-success">
    <p>{{Session::get('success')}} </p>
</div>
</span>
</center>
  @endif

        <center>
    <div class="superVisorSection">

        <button class="btn" onclick="window.location.href ='{{url('GUIObserverInfo')}}';">استعراض المشرفيين الميدانين</button>
        </br>
        <button class="btn" id="supervisers" >استعراض رؤساء البرامج</button>


</div>

<div  id="supervisers_section">
        <div class="container" >
         <div class="table-wrapper">
           <div class="table-title">
              <div class="row">
                <div class="col-sm-4">
                  <h3>بيانات  <b> رؤساء البرامج </b></h3>
                </div>
             </div>
           </div>



    <div class="table-filter">
        <div class="row">
                    <div class="col-sm-3">
          </div>
            <div class="col-sm-9">
            <form action="/searchsup" id="send_form" method="POST" role="search">
              {{ csrf_field() }}
            <label class="filter-group">
              <input type="text" class="form-control" name="id">
              <label> بحث </label>
              <select name="filter">
               <option value="1">معلومات شخصية</option>
               <option value="2">البرنامج</option>
               </select>
               <label> حدد مجال البحث </label>
            </label>
             <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

          </form>

                    </div>
                </div>


    </div>
    </div>
        </div>
</div>
            <div id="tablesup" style="width:100%; margin-bottom:2%;">
            </div>
          </br>

@endsection
