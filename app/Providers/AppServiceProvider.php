<?php

namespace App\Providers;
use App\Controller\SessionController;
use Illuminate\Support\ServiceProvider;
use Blade;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      /*
      Blade::directive('logInWindow', function(){
        $window="<div id='id01' class='modal'>
            <form class='modal-content animate' action='/action_page.php'>
              <div class='imgcontainer'>
                <span onclick='document.getElementById('id01').style.display='none'' class='close' title='Close Modal'>&times;</span>
                <img src='images\avatar.png' alt='Avatar' class='avatar'>
              </div>
              <div class='container'>
                <label for='uname'><b>البريد الالكتروني</b></label>
                <input type='text' placeholder=''البريد الالكتروني' name='uname' required>
                <label for='psw'><b>كلمة المرور</b></label>
                <input type='password' placeholder='كلمة المرور' name='psw' required>
                <button type='submit'>موافق</button>
                <label>
                  <input type='checkbox' checked='checked' name='remember'> تذكّرني لاحقًا
                </label>
              </div>
              <div class='container' style='background-color:#f1f1f1'>
                <button type='button' onclick='document.getElementById('id01').style.display='none'' class='cancelbtn'>إلغاء</button>
                <span class='psw'>نسيت <a href='#''>كلمة المرور؟</a></span>
              </div>
            </form>
          </div>";
          return $window;
      });
      */
      //مبدئيا من غير اي دي للفنكشن لكن بعدين لازم نمرر الاي دي عشان نجيب المعلومات
        Blade::directive('displayPersonalInfo', function(){
          ######## PERSONAL INFORMATIONS ########-->
          	$info="
            	<div class='boxInfo'><h3>المعلومات الشخصية</h3>
            	  <table>
            		<tr><th>:المسمى الوظيفي</th><th>".session()->get('name').":الاسم</th></tr>
            		<tr><th>:الموقع</th><th>:البريد الالكتروني</th></tr></table>
              </div>";
          
              return $info;
        
          ######## END PERSONAL INFORMATIONS ########-->
        });

        Blade::directive('selectForm',function ()
        {
          $usedMaterialBodyFood=array('coffee'=>'تمر','date'=>'قهوة','water'=>'ماء','iftarMail'=>'وجبة افطار');
          $languagesSoulFood=array('العربية','الانجليزيه','الهندية','الكردية','الباكستانية');
          $x=array('كتيبات','منشورات');
          $id=0;
          $Reception_Of_Delegations_Form="
          <div class='formModel'>
            <center>
              <h3>   تعبئة نموذج  </h3>
              <form method='post' action=''>
                <fieldset>
  	               <legend>نموذج استقبال الوفود</legend>
                   <label>الجنسية</lable></br>
                   <select id='country' name='country' class='form-control'>
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
                  </select></br>
                   <label>تاريخ الوصول</lable></br>
                   <input type='date'></br>
                   <label>وقت الوصول</lable></br>
                   <input type='time'></br>
                   <label>عنوان السكن في مكة </lable></br>
                   <input type='text'></br>
                   <label>عنوان السكن في المدينة </lable></br>
                   <input type='text'></br>
                   <label>تاريخ الزيارة </lable></br>
                   <input type='date'></br>
                   <label>وقت الزيارة</lable></br>
                   <input type='time'></br>
                   <label>تاريخ المغادرة </lable></br>
                   <input type='date'></br>
                   <label>وقت الزيارة </lable></br>
                   <input type='time'></br>
                   <label>منسق الوفد</lable></br>
                   <input type='text'></br>
                   <label>رقم التواصل</lable></br>
                   <input type='phone'></br>
                   <label>عدد الرجال</lable></br>
                   <input type='number'></br>
                   <label>عدد النساء</lable></br>
                   <input type='number'></br>
                   <label>عدد الاطفال</lable></br>
                   <input type='number'></br>
                   <input type='submit' value='send' name='submitForm'/>
                 </fieldset>
              </form>
            </center>
          </div>";

          $Body_Food_Form="
          <div class='formModel'>
            <center>
              <form method='post' action=''>
                <fieldset>
  	               <legend>تعبئة نموذج</legend>
                   <label>المدينة</lable></br>
                   <select id='city' name='city'>
                    <option value='مكة'>مكة</option>
                    <option value='المدينة'>المدينة</option>
                    <option value='جدة'>جدة</option>
                    <option value='Cameroon'>Cameroon</option>
                    <option value='Canada'>Canada</option>
                    <option value='Cape Verde'>Cape Verde</option>
                  </select>
                  <br/>
                  <label>الموقع</label><br/>
                  <input type='text' name='location'/><br/>
                   <label>اجمالي المواد المستخدمة</lable></br>
                   <input type='number' name='usedMaterial'></br>";
                   //الايدي راح يكون على حسب اي دي الخدمة مبدئيا لاختبار العرض حطيت 1 و 0
                   if($id==1){
                     foreach ($x as $key => $value) {
                        $Body_Food_Form.="<label>".$value."</label><br>
                        <input type='number' name=".$key."></br>
                        <select id='language' name='languagesSoulFood'>";
                       foreach ($languagesSoulFood as $keyL => $valueL) {
                         $Body_Food_Form.="
                          <option value=".$valueL.">".$valueL."</option>";
                       }
                       $Body_Food_Form.="</select><br/>";

                     }
                   }
                   elseif ($id==0) {
                     foreach ($usedMaterialBodyFood as $key => $value) {
                       $Body_Food_Form.="<label>".$value."</label><br>
                       <input type='number' name=".$key."></br>";
                     }
                   }
                   else{
                     $Body_Food_Form.="
                     <label>مواد مستخدمة</lable></br>
                     <textarea name='materials'>
                     </textarea></br>";
                   }
                   $Body_Food_Form.="
                   <label>فائض اليوم</lable></br>
                   <textarea name='surplusToday'>
                   </textarea></br>
                   <br/>
                   <label>احتياج الغد </lable></br>
                   <textarea name='tomorrowNeeds'>
                   </textarea>
                   </br>
                   </br>
                   <input type='submit' value='send' name='submitForm'/>
                 </fieldset>
              </form>
            </center>
          </div>";
//numberOfAgencies=عدد الوكالات
//statment بيان الجهه
//numberOfCarcasses عدد الذبائح
//carcassesType النوع
//delegateName
          $booldOfALgebrat="
          <div class='formModel'>
            <center>
              <form method='post' action=''>
                <fieldset>
                   <legend>تعبئة نموذج</legend>
                    <label>اجمالي الوكالات</label><br/>
                    <input type='number' name='numberOfAgencies'><br/>
                    <label>الجهات المستفيدة من الوكالات:</label><br/>
                    <label>بيان الجهة</label><br/>
                    <input type='text' name='statment'><br/>
                    <label>عدد الذبائح</label><br/>
                    <input type='number' name='numberOfCarcasses'><br/>
                    <label>النوع</label><br/>
                    <input type='text' name='carcassesType'><br/>
                    <label>اسم المندوب</label><br/>
                    <input type='text' name='delegateName'><br/>
                    <label>اجمالي الذبائح</label><br/>
                    <input type='number' name='sumCarcasses'><br/>
                    <label>اعتماد اللجنة الشرعية</label><br/>
                    <label>اسماء الاعضاء</label><br/>
                    <input type='text' name='membersName'><br/>
                    <label>ملاجظات ان وجدت</label><br/>
                    <input type='text' name='notes'><br/>
                    <input type='submit' value='send' name='submitForm'/>
                  </fieldset>
               </form>
             </center>
           </div>";
          $allForms=$booldOfALgebrat.$Body_Food_Form.$Reception_Of_Delegations_Form;
          return $allForms;
          // code...
        });
    }
}
?>
