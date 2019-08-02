
@extends('templates.hadiyah')
@section('title')
هدية الحاج والمعتمر - مشرف البرنامج
تعديل بيانات
@endsection
@section('content')
<script>
$(document).ready(function(){
  $('.city_class').change(function(){
     if($(this).val()!=''){
       var select=$(this).attr("id");
       var value=$(this).val();
       var dependent=$(this).data('location_id');
       var _token="{{csrf_token()}}";
       $.ajax({
         url:"{{url('observerlocation')}}",
         type:"POST",
         data:{select:select ,value:value,_token:_token,dependent:dependent},
         success:function(result){
           console.log(result);
           $('#location_id').html(result);
         }
       })
     }
  });
  $('.program').change(function(){
     if($(this).val()!=''){
       var value=$(this).val();
       var _token="{{csrf_token()}}";
       $.ajax({
         url:"{{url('superviserprogram')}}",
         type:"POST",
         data:{value:value,_token:_token},
         success:function(result){
          if(result['f_name']!==undefined)
           $('#sup').html(result['f_name']+ " "+result['s_name']+ " "+result['l_name']);
           else
           $('#sup').html("لم يتم تعين رئيس برنامج ");
         }
       })
     }
  });
  $('.programsupe').change(function(){

     if($(this).val()!=''){
       var value=$(this).val();
       var _token="{{csrf_token()}}";
       $.ajax({
         url:"{{url('getsup')}}",
         type:"POST",
         data:{value:value,_token:_token},
         success:function(result){
           if(result['f_name']!==undefined)
           $('#changeprogramsupe').html("رئيس هذا البرنامج حاليا هو "+result['f_name']+ " "+result['s_name']+ " "+result['l_name']+" "+"اذا قمت بالحفظ سيتم تغير رئيس البرنامج ");
           else
           $('#changeprogramsupe').html("");
         }
       })
     }
    });
 });
</script>
 <div class="container" style="text-align: right;">
    <div dir="rtl">
      </br>
      <center>
        <h1>   تعديل البيانات  </h1>
          </br>
          <form method="post" id="send_form" action="update">
             {{csrf_field()}}
             <label> الاسم:</label>
             <label>{{$employee->f_name}} {{$employee->s_name}} {{$employee->l_name}}</label></br>
             <label>الايميل :</label>
             <label>{{$employee->email}}</label><br/>
             @if(isset($superviser_emp))
             <label>البرنامج </label>
<br/>
  <select id='program' name='program' class='programsupe' required>
  @if(isset($program->id))
    <option value="{{$program->id}}">{{$program->name}}</option>
  @else
    <option value=""></option>
  @endif
  @foreach($programs as $prog)
    @if($program!==null)
      @if($prog->id!==$program->id)
        <option value="{{$prog->id}}">{{$prog->name}}</option>
      @endif
      @else
        <option value="{{$prog->id}}">{{$prog->name}}</option>
    @endif
  @endforeach
  </select>
  <div id='changeprogramsupe'>
      </div>
@else
  @if(isset($programs))
  <label>البرنامج </label>
    <br/>
     <select id='program'  class="program" name='program' required>
     @if(isset($program->id))
        <option value="{{$program->id}}">{{$program->name}}</option>
     @else
        <option value=""></option>
     @endif
     @foreach($programs as $prog)
       @if($program!==null)
          @if($prog->id!==$program->id)
            <option value="{{$prog->id}}">{{$prog->name}}</option>
          @endif
        @else
          <option value="{{$prog->id}}">{{$prog->name}}</option>
        @endif
      @endforeach
      </select>

      <br/>
      <br/>
      <label>اسم ريئس البرنامج </label>
       <br/>
       @if(isset($superviser->id))
       <label id="sup"> رئيس البرنامج {{$superviser->f_name}} {{$superviser->s_name}} {{$superviser->l_name}}</label>
      @else
        <label id="sup"></label>
      @endif
  @else
  <label >الخدمة</label>
    <br>
    <select id='servies' name='servies' required>
    @if(isset($service->id))
      <option value="{{$service->id}}">{{$service->name}}</option>
    @else
      <option value=""></option>
    @endif
    @foreach($services as $ser)
      @if($service!==null)
        @if($ser->id!==$service->id)
          <option value="{{$ser->id}}">{{$ser->name}}</option>
        @endif
        @else
          <option value="{{$ser->id}}">{{$ser->name}}</option>
      @endif
    @endforeach
    </select>
    <br/>
    <label>المدينة</label>
    <br/>
    <select id='city' name='city' required class='city_class' data-dependet='location_id'>
    @if(isset($location->id))
      <option value="{{$location->id}}">{{$location->location}}</option>
    @else
    <option value=''> اختار من القائمة</option>
    @endif
    @foreach($citys as $city)
      @if($location!==null)
        @if($city->id!==$location->id)
          <option value="{{$city->id}}">{{$city->location}}</option>
        @endif
        @else
          <option value="{{$city->id}}">{{$city->location}}</option>
      @endif
    @endforeach
    </select><br>
    </select>
    <br/>
    <label>نقطة الاتصال</label>
    <br/>
    <select id='location_id' name='location_id' required>
    @if(isset($location->id))
      <option value="{{$location->id}}">{{$location->connection_point}}</option>
    @else
    <option value=''> اختار من القائمة</option>
    @endif
    @if(isset($locations))
    @foreach($locations as $loc)
      @if($location!==null)
        @if($loc->id!==$location->id)
          <option value="{{$loc->id}}">{{$loc->connection_point}}</option>
        @endif
        @else
          <option value="{{$loc->id}}">{{$loc->connection_point}}</option>
      @endif
    @endforeach
    @endif
    </select><br>
  @endif
@endif
<br/>
<input type="hidden" name="employee_id" value='{{$employee->id}}'>

<button type="submit"  > حفظ </button>

</form>
         </center>

   <br/>
   <br>
</div>
</div>
 </div>
</center>
@endsection
