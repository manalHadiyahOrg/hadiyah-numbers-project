@extends('templates.hadiyah')
@section('title')
هدية الحاج والمعتمر - مشرف البرنامج
@endsection
@section('content')
<script>
$(document).ready(function(){

     window.onpopstate = function() {
      location.replace('/');
    }
$('#password').change(function(){

    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");
  if(password.value != confirm_password.value) {
    document.getElementById("update").disabled = true;
    $('#message').html("ادخل تاكيد لكلمة المرور");
  }
});
$('#confirm_password').change(function(){
 var password = document.getElementById("password");
 var confirm_password = document.getElementById("confirm_password");
if(password.value != confirm_password.value) {
 document.getElementById("update").disabled = true;
 $('#message').html("كلمة المرور ليست متطابقة").css('color', 'red');
} else {
 document.getElementById("update").disabled = false;
 $('#message').html("").css('color', 'red');
 confirm_password.setCustomValidity('');
}
});
  });


</script>
<center>
  @if(Session::has('message'))
   <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
    </center>
    <center>
  @if(Session::has('error'))
  <div class="alert alert-danger">
        <ul><li>{{ Session::get('error') }}</li>
        </ul>
    </div>
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
  <div class="container" style="text-align: right;">
    <div dir="rtl">
      </br>
      <center>
        <h1>  فتح حساب </h1>
          </br>
          <form method="post" action="/newAccount" class='formModel'>
             {{method_field('PATCH')}}
             {{csrf_field()}}
             <label>الاسم</label></br>
             <input type="text" name="f_name" required></br>
             <label>اسم الاب</label></br>
             <input type="text" name="s_name" required></br>
             <label>اسم العائلة</label></br>
             <input type="text" name="l_name" required>
             </br>
             <label>الايميل</label></br>
             <input type="email" name="email" required>
             </br>
             <label>المسمى الوظيفي</label>
             </br>
             <input type="radio" name="jobName" value="observer" required>  مشرف ميداني</br>
             <input type="radio" name="jobName" value="supervisor"> مشرف برنامج</br>
             <input type="radio" name="jobName" value="admin"> رئيس البرامج</br>
             </br>
             <label>كلمة المرور</label>
             </br>
             <input type="password" name="password" required>
             </br>
             <input type="submit" name="">
           </form>
         </center>
@if(isset($text0))
{{$text0}}
@endif

   <br/>
   <br>
   <center>
   <h1>  البحث والتعديل على بيانات الموظفيين </h1>
   </br>
   <form method="post" action="/show" class='formModel'>
 {{csrf_field()}}
      <input type="search" id="site-search" name="Search"><br/>
           <input type="submit" name="" value="البحث">
         <br>
                 <br>
                 </form>
@if(isset($text))
{{$text}}
@endif
@if(isset($user))
<form method="post" action="/update/{{$user['id']}}" class='formModel'>
   {{method_field('PATCH')}}
{{csrf_field()}}
      <p>اسم الموظف: {{$user['f_name'].' '.$user['s_name'].' '.$user['l_name'] }} </p>
      <p> الرقم الوظيفي:{{$user['id']}} </p>
      <p>  المسمى الوظيفي: </p>
        <?php
        if(  substr ( $user['id'] ,0,2 ) == 11 ){
        ?>
        <input type="radio" name="jobName" value="observer">  مشرف ميداني
        <input type="radio" name="jobName" value="supervisor"> مشرف برنامج
        <input type="radio"  name="jobName" value="admin" checked="checked" > رئيس البرامج

      <?php
        }elseif(  substr ( $user['id'] ,0,2 ) == 12 ){
          ?>
          <input type="radio" name="jobName" value="observer">  مشرف ميداني
          <input type="radio" name="jobName" value="supervisor" checked="checked" > مشرف برنامج
          <input type="radio" name="jobName" value="admin" > رئيس البرامج
      <?php
        }elseif(  substr ( $user['id'] ,0,2 ) == 13 ){
          ?>
          <input type="radio" name="jobName" value="observer" checked="checked" >  مشرف ميداني
          <input type="radio" name="jobName" value="supervisor"> مشرف برنامج
          <input type="radio" name="jobName" value="admin" > رئيس البرامج
        <?php
        }
        ?>
     <p> الايميل: </p> <input type="email" name="email" value="{{$user['email']}}">
     <p>  كلمة المرور : </p>  <input type="password" name="password"  id="password" >
     <p> تاكيد كلمة المرور  : </p>  <input type="password" name="password2"  id="confirm_password">
     <br><span id='message'></span>

<br>
   </br>
   <input type="submit" id="update" name="update" value="التعديل" >
 </form>
</br>
 <form  method="post" action="/delete/{{$user['id']}}" class='formModel'>
   {{ method_field('PATCH') }}
   {{csrf_field()}}
   <input type="submit" name="delete" value="حذف الموظف" >
 </form>
 @endif
<br>
<br>
<br>
</div>
                 </div>
         </div>
       </center>
@endsection
