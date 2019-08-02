
@extends('templates.hadiyah')
@section('title')
تعبئة نموذج
@endsection
@section('content')
<style>
.btn {
  background-color: #cr650h;
}
</style>

<script>
  var count;
  var member;
function countUp(){
  var Val = document.getElementById("countUpNum").innerHTML;
  Val++;
  document.getElementById("countUpNum").innerHTML = Val;
}


 function creat_new_field( array,table_no ) {
  console.log (count);
  if(table_no==2||table_no==3){
  dynamic_field_institution(array,count,table_no);}
  else{
    dynamic_field_materials(array,count,table_no);
  }
  count++;
}
function creat_new_field_maber(){
  html=' <label>اسماء الاعضاء</label><br>';
  html+=' <input type="text"  name="member['+member+'][name]" ><br>';
  html+=' <label>ملاجظات ان وجدت</label><br>';
  html+=' <input type="text" name="member['+member+'][observation]" ><br>';
  $('.member').append(html);
  member++;
  }
function dynamic_field_materials(materials,count,table_no){

 html='<label>البيان</label><br>';
  html+='<select id="materials_info['+count+']" name="materials_info['+count+'][material_id]" >';
  html+='</select>' ;
  html+='   <div><label>العدد</label><br>';
  html+='<input type="number" name="materials_info['+count+'][count]" placeholder="90" ><br> </div>';
  if(table_no==1){
  html+=' <div> <label>فائض اليوم</label><br><input type="number" name="materials_info['+count+'][surplus]" placeholder="10" ><br></div><div><label>احتياج الغد</label><br>';
  html+='<input type="number" name="materials_info['+count+'][needs_of_tomorro]" placeholder="80" >';}
  else if(table_no==6){
      html+='<div><label>اللغة</label><br/>';
      html+='<input type="text" name="materials_info['+count+'][language]" placeholder="العربية" ><br/> </div>';
    }
  html+='<br>  </div>';
  $('.material').append(html);
  var select = document.getElementById('materials_info['+count+']');
  for ( material of materials) {
  select.options[select.options.length] = new Option(material["name"], material["id"]); }
  }




  function dynamic_field_institution(institution,count,table_no){
    html='<label>البيان</label><br>';
    html+='<select id="institution['+count+']" name="institution['+count+'][institution_id]" >';
    html+='</select>' ;
  if(table_no==3){
      html+='  <div><label>عدد الذبائح</label><br>';
      html+='<input type="number" name="institution['+count+'][number_of_carcasses]" placeholder="90" ><br> </div>';
      html+=' <div> <label> النوع</label><br><input type="text" name="institution['+count+'][type]" placeholder="" ><br></div><div><label> المستلم</label><br>';
      html+='<input type="text" name="institution['+count+'][name_of_delegate]" placeholder="" >';
     }
  else if(table_no==2){
      html+='  <div><label>عدد </label><br>';
      html+='<input type="number" name="institution['+count+'][count]" placeholder="90" ><br> </div>';
      html+='</div><div><label> المستلم</label><br>';
      html+='<input type="text" name="institution['+count+'][recipient]" placeholder="" >';
  }
  html+='<br>  </div>';
  $('.institution').append(html);
  var select = document.getElementById('institution['+count+']');
  for (  inst of  institution) {
  select.options[select.options.length] = new Option(inst["name"], inst["id"]); }
  }
$(document).ready(function(){
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  document.getElementById("datePicker").value = today;
  count=1;
  member=1;
  $('.datePicker').change(function() {
        date = new Date(document.getElementById("datePicker").value);
        var weekdays = new Array(7);
        weekdays[0] = "الأحد";
        weekdays[1] = "الإثنين";
        weekdays[2] = "الثلاثاء";
        weekdays[3] = "الأربعاء";
        weekdays[4] = "الخميس";
        weekdays[5] = "الجمعة";
        weekdays[6] = "السبت";
        var r = weekdays[date.getDay()];
        document.getElementById("day").value = r;
    });

  $('.city_class').change(function(){
     if($(this).val()!=''){
       var select=$(this).attr("id");
       var value=$(this).val();
       var dependent=$(this).data('location_id');
       var _token="{{csrf_token()}}";
       $.ajax({
         url:"{{url('indexlocation')}}",
         type:"POST",
         data:{select:select ,value:value,_token:_token,dependent:dependent},
         success:function(result){
           console.log(result);
           $('#location_id').html(result);
         }
       })
     }
  });
  $('#send_form').on('submit',function(event){
    event.preventDefault();
    $.ajax({
         url:"{{url('sevedata')}}",
         type:"POST",
         data:$(this).serialize(),
         success:function(result){
           console.log(result);
             if(!result.error){
              $('#result').html('<div class="alert alert-success">'+result.success+'</div>');
             }else
             {$('#result').html('<div class="alert alert-error">'+result.error+'</div>');
               console.log(result);}


         }
       })
  }); });

</script>
<div class='formModel'>

  <center>

  <form  method="POST"  id="send_form"action="sevedata">
  <span id="result"></span>
           {{csrf_field()}}
           <input type="hidden" value="{{$ser->id}}" name="service_id">
      <fieldset>
      <?php
      if($ser->table_no==1||$ser->table_no==4||$ser->table_no==5)
          echo displayForm($program,$ser,$materials,$location,$city);
      elseif ($ser->table_no==2||$ser->table_no==3)
            echo displayAgenciesForm($program,$ser,$institution);
      elseif ($ser->table_no==6)
           echo displaySoulForm($program,$ser,$materials,$location,$city);
      elseif($ser->table_no==7)
             echo displayReceptionOfDelegationsForm($program,$ser);
       ?>
        <br>
        <input type="submit" name=sendInfo value="ارسال"/>
        <br/>
      </fieldset>
    </form>
  </center>
</div>
@endsection

<?php
function displayForm($program,$ser,$materials,$location,$city){
  $Form="
                  <legend >".$program->name."</legend>
                  <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                  <select name='day' id='day' required>";
                 $day=date("l");
                 $days= dayfunction($day);
                 foreach($days as $da){
$Form.="                   <option value=".$da."> ".$da."</option> ";
                 }
$Form.="                 </select><br>
                <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                <input type='date' id='datePicker' class='datePicker' name='date' required><br>
               <label>المدينة</label><br>
               <select id='city' name='city' required class='city_class' data-dependet='location_id'>
                <option value=''> اختار من القائمة</option> ";
                if(isset($city)){
                foreach($city as $citys){
                      $Form.="<option value=".$citys->id.">".$citys->location."</option>";
                  }}
                  $Form.="</select>
                    <br>
                    <label>نقطة اتصال</label><br>
                    <select id='location_id' name='location_id' required>
                    <option value=''> اختار من القائمة</option> ";
                    if(isset($location)){
                    foreach($location as $location){
                      $Form.="<option name='location_id' value=".$location['id'].">".$location['connection_point']."</option>";
                  }}
                  $Form.="</select>
                    <br>
                    <div class='material' id='material'>
                    <label>البيان</label><br>
                    <select id='materials_info[0]' name='materials_info[0][material_id]' required>
                    ";
                    if(isset($materials)){
                    foreach($materials as $material){
                      $Form.="<option  value=".$material['id'].">".$material['name']."</option>";
                  }}
                  $Form.=" </select>

                  <div><label>العدد</label><br>
                    <input type='number' name='materials_info[0][count]' placeholder='90' required><br></div><br> ";
                    if($ser->table_no==1){
                    $Form.="<div> <label>فائض اليوم</label><br><input type='number' name='materials_info[0][surplus]' placeholder='10' required><br></div><div><label>احتياج الغد</label><br>
                    <input type='number' name='materials_info[0][needs_of_tomorro]' placeholder='80' required><br> </div> ";
                  }
                  $Form.=" </div>
                  <br>
                    <label id='css-irow' class='btn' onclick='creat_new_field($materials,$ser->table_no);'>+  إضافة</label><br>
                    <label>عدد المستفيدين</label><br>
                    <input type='number' name='number_of_beneficiaries' placeholder='90' required><br>
                    <label>عدد مقدمي الخدمة</label><br>
                    <input type='number' name='nu_service_providers' placeholder='90' required><br>
                    <label>تقييم الخدمة </label><br><br/>
                    <select id='con' name='evaluation' required>
                       <option value='ممتاز'>ممتاز</option>
                       <option value='جيد جدا'>جيد جدا</option>
                       <option value='جيد'>جيد</option>
                       <option value='ضعيف'>ضعيف</option>
                     </select><br><br/>
                     <label>الملاحظات</label><br>
                    <input type='text' name='observation' placeholder='ادخل ملاحظاتك' ><br>";
                           return $Form;

}
function displayReceptionOfDelegationsForm($program,$ser){

  $Reception_Of_Delegations_Form="
                                 <legend>نموذج استقبال الوفود</legend>
                                 <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                                  <select name='day' id='day' required>
                                  ";
                                  $day=date("l");
                                  $days= dayfunction($day);
                                  foreach($days as $da){
 $Reception_Of_Delegations_Form.=" <option value=".$da."> ".$da."</option> ";
                                  }
  $Reception_Of_Delegations_Form.="
                                   </select><br>
                                   <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                                    <input type='date' id='datePicker' class='datePicker' name='date' required><br>
                                 <label>الجنسية</lable></br>
                 <select id='nationality' name='nationality' class='form-control'>
                 <option value='سعودية'>سعودية</option>
                 <option value='هندية'>هندية</option>
                 <option value='افغانستانيه'>افغانستانيه</option>
                 <option value='امريكية'>امريكية</option>
                 <option value='اندنوسيه'>اندنوسيه</option>
                 <option value='باكستانيه'>باكستانيه</option>
                 <option value='تركية'>تركية</option>
                 <option value='امارتية'>امارتية</option>
                 <option value='بحرينيه'>بحرينيه</option>
                 <option value='قطريه'>قطريه</option>
                 <option value='كويتيه'>كويتيه</option>
                 <option value='يمنية'>يمنية</option>
                 <option value='عمانية'>عمانية</option>
                 <option value='ارنية'>اردنية</option>
                 <option value='سوريه'>سوريه</option>
                 <option value='لبنانية'>لبنانية</option>
                 <option value='عراقية'>عراقية</option>
                 <option value='ايرانية'>ايرانية</option>
                 <option value='ماليزيه'>ماليزيه</option>
                 <option value='Barbados'>Barbados</option>
                 <option value='Belarus'>Belarus</option>
                 <option value='Belgium'>Belgium</option>
                 <option value='Belize'>Belize</option>
                 <option value='Benin'>Benin</option>
                 <option value='Bermuda'>Bermuda</option>
                 <option value='Bhutan'>Bhutan</option>
                 <option value='Bolivia'>Bolivia</option>
                 <option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>
                 <option value='Botswana'>Botswana</option>
                 <option value='Bouvet Island'>Bouvet Island</option>
                 <option value='Brazil'>Brazil</option>
                 <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
                 <option value='Brunei Darussalam'>Brunei Darussalam</option>
                 <option value='Bulgaria'>Bulgaria</option>
                 <option value='Burkina Faso'>Burkina Faso</option>
                 <option value='Burundi'>Burundi</option>
                 <option value='Cambodia'>Cambodia</option>
                 <option value='Cameroon'>Cameroon</option>
                 <option value='Canada'>Canada</option>
                 <option value='Cape Verde'>Cape Verde</option>
               </select><br>

                <label>عنوان السكن في مكة </lable></br>
                <input type='text' name='address_in_mecca'></br>
                <label>عنوان السكن في المدينة </lable></br>
                <input type='text' name='address_in_madinah'></br>

                 <label>تاريخ الوصول</lable></br>
                 <input type='date' name='date_of_arrival'></br>
                 <label>وقت الوصول</lable></br>
                 <input type='time' name='arrival_time'></br>

               <label>تاريخ المغادرة </lable></br>
               <input type='date' name='date_of_departure'></br>
                 <label>وقت المغادرة </lable></br>
                 <input type='time' name='departure_time'></br>

                 <label>عدد الرجال</lable></br>
                 <input type='number' name='number_of_men'></br>
                 <label>عدد النساء</lable></br>
                 <input type='number' name='number_of_women'></br>
                 <label>عدد الاطفال</lable></br>
                 <input type='number' name='number_of_children'></br>

                 <label>تاريخ الزيارة </lable></br>
                 <input type='date' name='date_of_Visit'></br>
                 <label>وقت الزيارة</lable></br>
                 <input type='time' name='visit_time'></br>

                 <label>منسق الوفد</lable></br>
                 <input type='text' name='coordinator'></br>
                 <label>رقم التواصل</lable></br>
                 <input type='phone' name='contact_number'></br>

                 <label>ملاحظات</lable></br>
                 <input type='text' name='observation'></br>";
                                 return  $Reception_Of_Delegations_Form;

}
function displayAgenciesForm($program,$ser,$institution){

  $AgenciesForm="        <legend >".$program->name."</legend>
                         <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                         <select name='day' id='day' required>
                         ";
                         $day=date("l");
                         $days= dayfunction($day);
                         foreach($days as $da){
$AgenciesForm.=" <option value=".$da."> ".$da."</option> ";
                         }
$AgenciesForm.="
                            </select><br>
                            <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                           <input type='date' id='datePicker' class='datePicker' name='date' required><br>
                           <label>اجمالي الوكالات</label><br>";
                           if($ser->table_no==3){
$AgenciesForm.=            "<input type='number' name='count_of_agencies' required><br>";
                            }
                           else {
 $AgenciesForm.=           " <input type='number' name='count' required><br>";
                           }
$AgenciesForm.=           " <label>الجهات المستفيدة من الوكالات:</label><br><br>
                            <div class='institution' id='institution'>
                            <label>البيان</label><br>
                            <select id='institution[0]' name='institution[0][institution_id]' required>";
                         if(isset($institution)){
                            foreach($institution as $inst){
$AgenciesForm.=              "<option  value=".$inst['id'].">".$inst['name']."</option>";
                          }}
$AgenciesForm.=           " </select> ";
                        if($ser->table_no==3){
$AgenciesForm.=            "<div><label>عدد الذبائح</label><br>
                            <input type='number' name='institution[0][number_of_carcasses]' placeholder='90' required><br></div><br>
                           <div> <label> النوع</label><br>
                           <input type='text' name='institution[0][type]'  required><br></div><div>
                           <label> اسم المندوب</label><br>
                           <input type='text' name='institution[0][name_of_delegate]'  required><br> </div> ";
                        }
                        else {
$AgenciesForm.=         "<div><label>عدد </label><br>
                        <input type='number' name='institution[0][count]' placeholder='90' required><br></div><br>
                        <div> <label> المستلم</label><br>
                        <input type='text' name='institution[0][recipient]' placeholder='10' required><br></div>";
                      }

$AgenciesForm.=          " </div><br>
                          <label id='css-irow' class='btn' onclick='creat_new_field($institution,$ser->table_no);'>+  إضافة</label><br>";

                        if($ser->table_no==3){
$AgenciesForm.=             "<label>اعتماد اللجنة الشرعية</label><br>
                             <div class='member'>
                             <label>اسماء الاعضاء</label><br>
                             <input type='text' name='member[0][name]' required><br>
                             <label>ملاجظات ان وجدت</label><br>
                            <input type='text' name='member[0][observation]' ><br>
                            </div>
                            <label id='css-irow' class='btn' onclick='creat_new_field_maber();'>+  إضافة</label><br>";
                          }
                          $AgenciesForm.= "";
                           return  $AgenciesForm;

}
function displaySoulForm($program,$ser,$materials,$location,$city){
$soul="<legend>غذاء الروح</legend>
        <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
        <select name='day' id='day' required> ";
          $day=date("l");
          $days= dayfunction($day);
          foreach($days as $da){
$soul.=" <option value=".$da."> ".$da."</option> ";}
$soul.=" </select><br>
        <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
        <input type='date' id='datePicker' class='datePicker' name='date' required><br>
        <label>المدينة</label><br>
        <select id='city' name='city' class='city_class' data-dependet='location_id' required>
        <option value=''> اختار من القائمة</option> ";
        if(isset($city)){
        foreach($city as $citys){
              $soul.="<option value=".$citys->id.">".$citys->location."</option>";
          }}
          $soul.="</select>
            <br>
            <label>نقطة اتصال</label><br>
            <select id='location_id' name='location_id' required>
            <option value=''> اختار من القائمة</option> ";
            if(isset($location)){
            foreach($location as $location){
              $soul.="<option name='location_id' value=".$location['id'].">".$location['connection_point']."</option>";
          }}
$soul .= "</select>
        <br><br>
       <label>إجمالي المواد المستخدمة</label><br>
       <input type='number' name='usedMaterial' required><br>
       <label id='countUpNum' class='special'>1</label><br><br>
      <div class='material'>
       <label>البيان</label><br>
      <select id='materials_info[0]' name='materials_info[0][material_id]' required>";
    if(isset($materials )){
       foreach($materials as $material){
         $soul .= "<option  value=".$material['id'].">".$material['name']."</option>";
       }}
    $soul .= " </select>
    <br><br>
      <div><label>العدد</label><br>
      <input type='number' name='materials_info[0][count]' placeholder='90' required><br></div>
      <div><label>اللغة</label><br/>
      <input type='text' name='materials_info[0][language]' placeholder='العربية' required><br/></div>
  <br></div>
  <label id='css-irow' class='btn' onclick='creat_new_field( $materials,$ser->table_no ); countUp();'>+  إضافة</label>

  <br><br>

  <label>إجمالي المضيفين مقدمي الخدمة</label><br>
  <input type='number' name='nu_service_providers' required><br>
  <label>إجمالي المستفيدين</label><br>
  <input type='number' name='number_of_beneficiaries' required><br>
  <label>تقييم تقديم الخدمة</label><br>
  <select id='info' name='evaluation' required>
  <option value='ممتاز'>ممتاز</option>
  <option value='جيد جدا'>جيد جدا</option>
  <option value='جيد'>جيد</option>
  <option value='ضعيف'>ضعيف</option>
  </select>
  <br>
  <label> ملاحظات</label><br>
  <input type='text' name='observation' ><br>
  <br><br>
    ";
    return $soul;

}

function dayfunction($today){
  $days = array( 'Sunday'=>'الأحد', 'Monday'=>'الإثنين','Tuesday'=>'الثلاثاء','Wednesday'=>'الأربعاء','Thursday'=>'الخميس','Friday'=>'الجمعة','Saturday'=>'السبت');
  $day_form;
  foreach( $days as $kay=>$day ){
       if($today==$kay){
           $day_form[] =$day;
        foreach($days as $da )
     {if($day!==$da) $day_form[] =$da; }
       return  $day_form;
       }}

}
?>
