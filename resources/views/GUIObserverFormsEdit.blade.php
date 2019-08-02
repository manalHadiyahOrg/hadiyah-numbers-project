
@extends('templates.hadiyah')
@section('title')
تعبئة نموذج
@endsection
@section('content')
<style>
.btn {
  background-color: #cr650h;
}
select:disabled {
  background:#dddddd;
}
label:disabled {
  background:#dddddd;
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
  count=1;
  member=1;

 });

</script>
<div class='formModel'>
  <center>

  <form  action ="/updateF"   method = "post"  " >
  <span id="result"></span>
           {{csrf_field()}}
           <input type="hidden" name="service_id"  value='{{$ser->id}}' >
           <input type="hidden" name="observer_id" value='{{$observer->id}}'>
           <input type="hidden" name="table_nox" value='{{$ser->table_no}}'>
           
      <fieldset>
      <?php
      $form_id=0;
      if($ser->table_no==1){
           $form_id=$bodyfood->form_id ;
          echo displayForm1($program,$ser,$materials,$location,$bodyfood ,$bodyfoodM );
      }
     elseif ($ser->table_no==4){
        echo displayForm2($program,$ser,$materials,$location ,$hospitable,$hospitableM);
          $form_id =$hospitable->form_id;}
     elseif ($ser->table_no==5)
        {echo displayForm3($program,$ser,$materials,$location,$careF,$careM);
        $form_id= $careF->form_id;}
      elseif ($ser->table_no==2)
           {echo displayAgenciesForm1($program,$ser,$institution,$zakaat,$zakaatI);
            $form_id=$zakaat->form_id ;}
      elseif ($ser->table_no==3){
        echo displayAgenciesForm2($program,$ser,$institution ,$algebrat,$algebratI);
        $form_id=$algebrat->form_id;}
    elseif ($ser->table_no==6){
       echo displaySoulForm($program,$ser,$materials,$location,$soulF,$soulM);
          $form_id=$soulF->form_id ;}
    elseif ($ser->table_no==7){
      echo displayReceptionOfDelegationsForm($program,$ser ,$delega);
              $form_id=$delega->id;}
       ?>
        <br><br>
        <button type="submit" name="form_id" value="{{$form_id}}">ارسال</button>
      </fieldset>
    </form>
  </center>
</div>
@endsection

<?php
function displayForm1($program,$ser,$materials,$location,$bodyfood ,$bodyfoodM){
   $Form=            " <legend >".$program->name."</legend>
                    <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                    <select name='day' id='day' disabled>
                    <option value=".$bodyfood->day.">".$bodyfood->day."</option> 
                    </select><br>
                    <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                   <input type='date' id='datePicker' class='datePicker' name='date' value='$bodyfood->date' disabled><br><br>
                    <label>المدينة</label><br>
                   <select id='city' name='city'  required class='city_class' data-dependet='location_id' disabled>
                    <option value=".$location->id.">".$location->location."</option>";
  $Form.=           "</select> <br>
                    <label>نقطة اتصال</label><br>
                    <select id='location_id' name='location_id' disabled>
                  <option name='location_id' value=".$location->id.">".$location['connection_point']."</option>";
  $Form.=          "</select><br>
                    <div class='material' id='material'>";
                 if(isset($materials)){
                    $i=0;
                 foreach($bodyfoodM as $bodyfoodm){
 $Form.=           "<label>البيان</label><br>
                  <select id='materials_info[$i]' name='materials_info[$i][material_id]' disabled>
                  <option  value=".$bodyfoodm->material_id.">".$materials[$i][0]."</option>
                   </select>
                   <input type='hidden' name='materials_info[$i][material_id]' value='$bodyfoodm->material_id'>
                  <div><label>العدد</label><br>
                  <input value ='$bodyfoodm->count'  type='number' name='materials_info[$i][count]' placeholder='90' required><br></div><br>  
                  <div> <label>فائض اليوم</label><br><input value ='$bodyfoodm->surplus'type='number' name='materials_info[$i][surplus]'  placeholder='10' required><br></div><div><label>احتياج الغد</label><br>
                    <input value =".$bodyfoodm->needs_of_tomorro." type='number' name='materials_info[$i][needs_of_tomorro]' placeholder='80' required><br> </div> 
                 ";
                $i++;}}
                  $Form.=" </div><br>
                    <label id='css-irow' class='btn' onclick='' disabled>+  إضافة</label><br>
                    <label>عدد المستفيدين</label><br>
                    <input value ='$bodyfood->number_of_beneficiaries' type='number' name='number_of_beneficiaries' placeholder='90' required><br>

                <label>عدد مقدمي الخدمة</label><br>
                <input value ='$bodyfood->nu_service_providers' type='number' name='nu_service_providers' placeholder='90' required><br>
                <label>تقييم تقديم الخدمة</label><br>
                <select id='info' name='evaluation' required disabled>
                <option value='$bodyfood->evaluation'>$bodyfood->evaluation</option>
              
                </select>
                <br>
                <label>الملاحظات</label><br>
                <input  value =' $bodyfood->observation ' type='text' name='observation' placeholder='ادخل ملاحظاتك' >
                <input type='hidden' name='form_id' value='$bodyfood->form_id' >
                <br>
                <br>";
                           return $Form;

}
function displayForm2($program,$ser,$materials,$location ,$hospitable,$hospitableM){
  $Form=            " <legend >".$program->name."</legend>
                    <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                    <select name='day' id='day' disabled>
                    <option value=".$hospitable->day.">".$hospitable->day."</option> 
                    </select><br>
                    <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                   <input type='date' id='datePicker' class='datePicker' name='date' value='$hospitable->date' disabled><br><br>
                    <label>المدينة</label><br>
                   <select id='city' name='city'  required class='city_class' data-dependet='location_id' disabled>
                    <option value=".$location->id.">".$location->location."</option>";
  $Form.=           "</select> <br>
                    <label>نقطة اتصال</label><br>
                    <select id='location_id' name='location_id' disabled>
                    <option name='location_id' value=".$location->id.">".$location['connection_point']."</option>";
  $Form.=           "</select><br>
                    <div class='material' id='material'>";
                 if(isset($materials)){
                    $i=0;
                 foreach($hospitableM as $hospitablem){
 $Form.=           "<label>البيان</label><br>
                  <select id='materials_info['$i']' name='materials_info['$i'][material_id]' disabled>
                  <option  value=".$hospitablem->material_id.">".$materials[$i][0]."</option>
                   </select>
                  <div><label>العدد</label><br>
                  <input type='hidden' name='materials_info[$i][material_id]' value='$hospitablem->material_id'>
                  <input value ='$hospitablem->count'  type='number' name='materials_info[$i][count]' placeholder='90' required><br></div><br>  ";
                     }}
                  
  $Form.="  <label>عدد المستفيدين</label><br>
                    <input value ='$hospitable->number_of_beneficiaries' type='number' name='number_of_beneficiaries' placeholder='90' required><br>

                <label>عدد مقدمي الخدمة</label><br>
                <input value ='$hospitable->nu_service_providers' type='number' name='nu_service_providers' placeholder='90' required><br>
               
                <label>تقييم تقديم الخدمة</label><br>
                <select id='info' name='evaluation' required disabled>
                <option value='$hospitable->evaluation'>$hospitable->evaluation</option>
                </select>
                <br>
                <label>الملاحظات</label><br>
                <input  value =' $hospitable->observation ' type='text' name='observation' placeholder='ادخل ملاحظاتك' >
                <input type='hidden' name='form_id' value='$hospitable->form_id' >
                <br>
                <br>";
                           return $Form;

}
function displayForm3($program,$ser,$materials,$location,$careF,$careM){
  $Form="
                  <legend >".$program->name."</legend>
                  <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                  <select name='day' id='day' disabled>
                  <option value=".$careF->day.">".$careF->day."</option> 
                  </select><br>
                  <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                 <input type='date' id='datePicker' class='datePicker' name='date' value='$careF->date' disabled><br><br>
               <label>المدينة</label><br>
               <select id='city' name='city'  required class='city_class' data-dependet='location_id' disabled>

          
              
                    <option value=".$location->id.">".$location->location."</option>";
                  $Form.="</select>
                    <br>
                    <label>نقطة اتصال</label><br>
                    <select id='location_id' name='location_id' disabled>
                   
                  <option name='location_id' value=".$location->id.">".$location['connection_point']."</option>";
                  $Form.="</select>
                    <br>
                    <div class='material' id='material'>";
                    if(isset($materials)){
                      $i=0;
                    foreach($careM as $carem){
               $Form.="<label>البيان</label><br>
                     <select id='materials_info['$i']' name='materials_info['$i'][material_id]' disabled>
                     <option  >".$materials[$i][0]."</option>
                </select>
               <div><label>العدد</label><br>
               <input type='hidden' name='materials_info[$i][material_id]' value='$carem->material_id'>
               <input value ='$carem->count'  type='number' name='materials_info[$i][count]' placeholder='90' required><br></div><br>
                    ";$i++;
                  } }
                  $Form.=" </div><br>
                    <label id='css-irow' class='btn' onclick='creat_new_field();' disabled>+  إضافة</label><br>
                    <label>عدد المستفيدين</label><br>
                    <input value ='$careF->number_of_beneficiaries' type='number' name='number_of_beneficiaries' placeholder='90' required><br>

                <label>عدد مقدمي الخدمة</label><br>
                <input value ='$careF->nu_service_providers' type='number' name='nu_service_providers' placeholder='90' required><br>
                
                <label>تقييم تقديم الخدمة</label><br>
                <select id='info' name='evaluation' required disabled>
                <option value='$careF->evaluation'>$careF->evaluation</option>
                </select>
  <br>
                <label>الملاحظات</label><br>
                <input  value ='$careF->observation' type='text' name='observation' placeholder='ادخل ملاحظاتك' >
                <input type='hidden' name='form_id' value='$careF->form_id' >
                <br>
                <br>";
                           return $Form;

}
function displayReceptionOfDelegationsForm($program,$ser,$delega){

  $Reception_Of_Delegations_Form="
                                 <legend>نموذج استقبال الوفود</legend>
                                 <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                                  <select name='day' id='day' disabled>
                               <option value=".$delega->day.">".$delega->day."</option> 
                               ";
                                  
  $Reception_Of_Delegations_Form.="
                                   </select><br>
                                   <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                                    <input type='date' id='datePicker' class='datePicker' name='date' value='$delega->date' disabled><br>
                                 <label>الجنسية</lable></br>
                 <select id='nationality' name='nationality' class='form-control' disabled>
                 <option value=".$delega->nationality.">".$delega->nationality."</option>
               </select><br>

                <label>عنوان السكن في مكة </lable></br>
                <input value='$delega->address_in_mecca' type='text' name='address_in_mecca'></br>
                <label>عنوان السكن في المدينة </lable></br>
                <input value='$delega->address_in_madinah' type='text' name='address_in_madinah'></br>

                 <label>تاريخ الوصول</lable></br>
                 <input disabled value='$delega->date_of_arrival' type='date' name='date_of_arrival'></br>
                 <label>وقت الوصول</lable></br>
                 <input disabled type='time' value='$delega->arrival_time' name='arrival_time'></br>

               <label>تاريخ المغادرة </lable></br>
               <input disabled  value='$delega->date_of_departure' type='date' name='date_of_departure'></br>
                 <label>وقت المغادرة </lable></br>
                 <input disabled   value='$delega->departure_time' type='time' name='departure_time'></br>

                 <label>عدد الرجال</lable></br>
                 <input  value='$delega->number_of_men' type='number' name='number_of_men'></br>
                 <label>عدد النساء</lable></br>
                 <input value='$delega->number_of_women' type='number' name='number_of_women'></br>
                 <label>عدد الاطفال</lable></br>
                 <input  value='$delega->number_of_children' type='number' name='number_of_children'></br>

                 <label>تاريخ الزيارة </lable></br>
                 <input  value='$delega->date_of_Visit' type='date' name='date_of_Visit'></br>
                 <label>وقت الزيارة</lable></br>
                 <input  value='$delega->visit_time' type='time' name='visit_time'></br>

                 <label>منسق الوفد</lable></br>
                 <input  disabled type='text' name='coordinator' value='$delega->coordinator'></br>
                 <label>رقم التواصل</lable></br>
                 <input value='$delega->contact_number' type='phone' name='contact_number'></br>

                 <label>ملاحظات</lable></br>
                 <input  value='$delega->observation' type='text' name='observation'>

                 </br>";
                                 return  $Reception_Of_Delegations_Form;

}
function displayAgenciesForm1($program,$ser,$institution,$zakaat,$zakaatI){

  $AgenciesForm=             " <legend >".$program->name."</legend>
                            <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                            <select name='day' id='day' disabled>
                            <option value=".$zakaat->day.">".$zakaat->day."</option> 
                            </select><br>
                            <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                           <input type='date' id='datePicker' class='datePicker' name='date' value='$zakaat->date' disabled><br><br>
                           <label>اجمالي الوكالات</label><br>";
$AgenciesForm.=            "<input type='number' name='countz' value='$zakaat->count'  required><br>
                            
 
                            <label>الجهات المستفيدة من الوكالات:</label><br><br>
                            <div class='institution' id='institution'>";
                            if(isset($institution)){
                             $i=0;
                             foreach($zakaatI as $zakaati){
$AgenciesForm.=             " <label>البيان</label><br>
                            <select id='institution[0]' name='institution[$i][institution_id]' disabled>";
$AgenciesForm.=              "<option  value='$zakaati->institution_id'>".$institution[$i][0]."</option>
                               </select>
                              <input type='hidden' name='institution[$i][institution_id]' value='$zakaati->institution_id'>
                        <div><label>عدد </label><br>
                        <input type='number' name='institution[$i][count]' value='$zakaati->count' placeholder='90' required><br></div><br>
                               <div> <label> المستلم</label><br>
                          <input type='text' name='institution[$i][recipient]'   value='$zakaati->recipient' required><br></div><div>
                             <input type='hidden' name='form_id' value='$zakaat->form_id' >
                           <br> </div>
 ";
                             $i++; } }
                      

$AgenciesForm.=          " </div><br>
                          <label id='css-irow' class='btn' disabled>+  إضافة</label><br>";
                          $AgenciesForm.= "";
                           return  $AgenciesForm;}


function displayAgenciesForm2($program,$ser,$institution,$algebrat,$algebratI){

$AgenciesForm=             " <legend >'$program->name'</legend>
                            <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                            <select name='day' id='day' disabled>
                            <option value='$algebrat->day'>$algebrat->day</option> 
                            </select><br>
                            <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                           <input type='date' id='datePicker' class='datePicker' name='date' value=' $algebrat->date ' disabled><br><br>
                           <label>اجمالي الوكالات</label><br>";
$AgenciesForm.=            "<input type='number' name='count_of_agencies' value='$algebrat->count_of_agencies'required><br>
                            
 
                            <label>الجهات المستفيدة من الوكالات:</label><br><br>
                            <div class='institution' id='institution'>";
                            if(isset($institution)){
                              $i=0;
                              foreach($algebratI as $algebrati){
 $AgenciesForm.=             " <label>البيان</label><br>
                             <select  name='institution[$i][institution_id]' value='$algebrati->institution_id' disabled>";
 $AgenciesForm.=              "<option >".$institution[$i][0]."</option>
                              </select>
                              <input type='hidden' name='institution[$i][institution_id]' value='$algebrati->institution_id'>
                              <div><label>عدد الذبائح</label><br>
                             <input type='number' name='institution[$i][number_of_carcasses]' value='$algebrati->number_of_carcasses' placeholder='90' required><br></div><br>
                            <div> <label> النوع</label><br>
                            <input type='text' name='institution[$i][type]'   value='$algebrati->type' required><br></div><div>
                            <label> اسم المندوب</label><br>
                            <input type='text' name='institution[$i][name_of_delegate]'  value='$algebrati->name_of_delegate' required>
                            <input type='hidden' name='form_id' value='$algebrat->form_id' >
                            <br> </div>
                              "; $i++;
                           }}          
                    
$AgenciesForm.=          " </div><br>
                          <label id='css-irow' class='btn' disabled>+  إضافة</label><br>";

$AgenciesForm.=             "<label disabled >اعتماد اللجنة الشرعية</label><br>
                             <div class='member'>
                             <label disabled>اسماء الاعضاء</label><br>
                             <input type='text' name='member[0][name]' disabled><br>
                             <label>ملاجظات ان وجدت</label><br>
                            <input type='text' name='member[0][observation]' disabled ><br>
                            </div>
                            <label id='css-irow' class='btn' onclick='creat_new_field_maber();' disabled>+  إضافة</label>

                            <br>";
                          
                           return  $AgenciesForm;

}
function displaySoulForm($program,$ser,$materials,$location,$soulF,$soulM){
  $soul=                 " <legend >".$program->name."</legend>
                         <label for='male'>&nbsp &nbsp  اليوم &nbsp &nbsp</label><br>
                         <select name='day' id='day' disabled>
                         <option value=".$soulF->day.">".$soulF->day."</option> 
                         </select><br>
                         <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label><br>
                         <input type='date' id='datePicker' class='datePicker' name='date' value='$soulF->date' disabled><br><br>
                        <label>المدينة</label><br>
                          <select id='city' name='city'  required class='city_class' data-dependet='location_id' disabled>
                          <option value=".$location->id.">".$location->location."</option></select> <br>
                         <label>نقطة اتصال</label><br>
                        <select id='location_id' name='location_id' disabled>
                        <option name='location_id' value=".$location->id.">".$location['connection_point']."</option>";
  $soul.=               "</select><br> <div class='material' id='material'>";
                       if(isset($materials)){ 
                         $i=0;
                    foreach($soulM as $soulm){
    $soul.=                    "<label>البيان</label><br>
                              <select id='materials_info['$i']' name='materials_info['$i'][material_id]' disabled>
                              <option  value='$materials[$i]'>".$materials[$i][0]."</option>
                              </select>
                              <input type='hidden' name='materials_info[$i][material_id]' value='$soulm->material_id'>
                              <div><label>العدد</label><br>
                             
                              <input value ='$soulm->count'  type='number' name='materials_info[$i][count]' placeholder='90' required><br></div><br>
                              <div><label>اللغة</label><br/>
                              <input type='text' name='materials_info['$i'][language]' placeholder='العربية' value ='$soulm->language' disabled><br/></div>
<br>";
$i++;}}

$soul.="</div><br>
<label id='css-irow' class='btn' onclick='creat_new_field();' disabled>+  إضافة</label><br>
<label>عدد المستفيدين</label><br>
<input value ='$soulF->number_of_beneficiaries' type='number' name='number_of_beneficiaries' placeholder='90' required><br>

<label>عدد مقدمي الخدمة</label><br>
<input value ='$soulF->nu_service_providers' type='number' name='nu_service_providers' placeholder='90' required><br>
<label>تقييم تقديم الخدمة</label><br>
<select id='info' name='evaluation' required disabled>
<option value='$soulF->evaluation'>$soulF->evaluation</option>
</select>
<br>
<label>الملاحظات</label><br>
<input  value ='$soulF->observation' type='text' name='observation' placeholder='ادخل ملاحظاتك' >
<input type='hidden' name='form_id' value='$soulF->form_id' >
<br>
<br>";
    return $soul;

}

?>
