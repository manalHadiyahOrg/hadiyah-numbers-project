
@extends('templates.hadiyah')
@section('title')
observer informaiton
@endsection
@section('content')

<script>
$(document).ready(function(){
 window.history.pushState(null, "", window.location.href);
 window.onpopstate = function() {
    location.replace(document.getElementById("page").value);
}
  $('#send_form').on('submit',function(event){
    event.preventDefault();
    //alert("ss");
    var _token="{{csrf_token()}}";
    $.ajax({
       url:"{{url('search')}}",
       type:"POST",
       data:$(this).serialize(),
       success:function(result){
        $('#datatable').html(result); } })});

  $('.programsupe').change(function(){
   if($(this).val()!=''){
     var value=$(this).val();
     $.ajax({
        url:"{{url('getsup')}}",
        type:"POST",
        data:$(this).serialize(),
        success:function(result){
          if(result['f_name']!==undefined)
              $('#changeprogramsupe').html("رئيس هذا البرنامج حاليا هو "+result['f_name']+ " "+result['s_name']+ " "+result['l_name']+" "+"اذا قمت بالحفظ سيتم تغير رئيس البرنامج ");
          else
           $('#changeprogramsupe').html("");}})}});
});
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
<div class="container" >
 <div class="table-wrapper">
   <div class="table-title">
      <div class="row">
        <div class="col-sm-4">
          <h3>بيانات  <b>المشرفين الميدانيين </b></h3>
        </div>
     </div>
   </div>
   <div class="table-filter">
     <div class="row">
       <div class="col-sm-3">
       </div>
        <div class="col-sm-9">
          <form action="/search" id="send_form" method="POST" role="search">
             {{ csrf_field() }}
             <label class="filter-group">
               <input type="text" class="form-control" name="id">
                <label> بحث </label>
               <select name="filter">
                 <option value="1">معلومات شخصية</option>
                 <option value="2">الخدمات</option>
                 <option value="3">الموقع</option>
                 @if(strcasecmp(session()->get('jop'),"رئيس برامج")==0)
                    <option value="4"> البرنامج</option>
                    <option value="5">رئيس برنامج</option>
                  @endif
                </select>
                <label> حدد مجال البحث </label>
                  @if(strcasecmp(session()->get('jop'),"رئيس برامج")==0)
                   <button type="submit" id="page" value="/GUIAdmin" class="btn btn-primary"><i class="fa fa-search"></i></button>
                  @else
                    <button type="submit" id="page" value="/GUISupervisor" class="btn btn-primary"><i class="fa fa-search"></i></button>
                  @endif
            </label>
          </form>
        </div>
      </div>
    </div>
    <div id="obtable">
        <table class="table table-striped table-hover" >
            <thead>
             <tr>
               <th>تعديل </th>
               <th>نقطة الاتصال </th>
                <th>الموقع </th>
                <th>الخدمة </th>
                @if(strcasecmp(session()->get('jop'),"رئيس برامج")==0)
                  <th>  رئيس البرنامج </th>
                @endif
                <th>اسم المشرف الميداني </th>
                <th> الرقم التعريفي  </th>
              </tr>
            </thead>
       @if(isset($observers))
           <tbody id="datatable">
             @foreach ($observers as $observer)
              <tr>
                <td>
                  <form action='/edit' method='post'>
                    {{ csrf_field() }}
                    <button type="submit" name="observer_id" value='{{$observer->id}}'> تعديل  </button>
                  </form>
                </td>
              @if(isset($locations[$observer->id]))
                <td></span>{{$locations[$observer->id]->connection_point}}<span class="status text-success">&nbsp;&bull;</td>
                <td>{{$locations[$observer->id]->location}}<span class="status text-success">&nbsp;&bull;</span></td>
              @else
                <td></td>
                <td></td>
              @endif
              @if(isset($services[$observer->id]))
                <td>{{$services[$observer->id]->name}}</td>
              @else
                <td></td>
              @endif
            @if(strcasecmp(session()->get('jop'),"رئيس برامج")==0)
              @if(isset($supervisers[$observer->id]))
                <td>{{$supervisers[$observer->id]->f_name}} {{$supervisers[$observer->id]->l_name}}</td>
              @else
                <td></td>
              @endif
            @endif
                <td>{{$observer->f_name}} {{$observer->s_name}} {{$observer->l_name}}</td>
                 <td>{{$observer->id}}</td>
              </tr>
             @endforeach
          </tbody>
        @endif
        </table>
    </div>
  </div>

@endsection
<script>
</script>
