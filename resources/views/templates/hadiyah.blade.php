<!DOCTYPE html>
<html>

<head>
  <!-- observerINFO-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--end observerINFO-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/slide.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Theme Style -->
  <link rel="stylesheet" href="/css/projectStyle.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script type = "text/javascript" src = "js/projectStyle.js" ></script>
  <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="https://static.wixstatic.com/media/3b6b39_bb987794acef40cb9fcab1bc18e04d33%7Emv2_d_1292_1453_s_2.png/v1/fill/w_32%2Ch_32%2Clg_1%2Cusm_0.66_1.00_0.01/3b6b39_bb987794acef40cb9fcab1bc18e04d33%7Emv2_d_1292_1453_s_2.png" type="image/png"/>
<title>@yield('title')</title>
</head>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<header>
<!--header top-->
<div class="menu">
    <a class="aHome" style="margin: 0.5% 2% 0 0;" href="{{url('/')}}" alt="الرئيسية"><img src="/images/شعار-هدية-دقة-عالية-1.png" width="120" /></a>
    <div class="container-fluid">

      <center>
        <ul class="nav">
          <li><a href="{{url('/GUIStatistics/0')}}" alt="الاحصائيات">الاحصائيات</a></li>
          <li><a href="{{url('/')}}" alt="الرئيسية">الرئيسية</a></li>
          <li><?php
            if(Session::has('page')){
              $url=Session::get('page');
          ?>
            <a href="<?php echo $url; ?>" alt="">صفحتي</a>
            <?php } ?>
          </li>
  </ul>
        <li style="float:left;  margin-tob: 1% ; font-size:20px; color:white;">
          <?php if(Session::has('id')){ ?>
            <a href="{{url('/logout')}}">
              <span class="glyphicon glyphicon-log-out"></span>
            </a>
      <?php }
      else{ ?>
          <span style="cursor:pointer;font-size:40px; margin-top:10px;" onclick="document.getElementById('id01').style.display='block'"><embed type="image/svg+xml" src="/images/log-in.svg" /></span>
      <?php }?>
      </li>

      </center>

  </div>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="document.getElementById('mySidenav').style.display='none;'">&times;</a><br>
        <a href="#" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">تعديل كلمة المرور</a>
        <a href="{{url('/logout')}}">تسجيل الخروج</a>
      </div>
</div>

<!--LOGIN-->
<div id="id01" class="modal">
  <form class="modal-content animate" method='post' action="/signin">

     {{csrf_field()}}
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/images/avatar.png" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <label for="uname"><b> الرقم الوظيفي</b></label>
      <input type="text" placeholder=" الرقم الوظيفي" name="userid" required>
      <label for="psw"><b>كلمة المرور</b></label>
      <input type="password" placeholder="كلمة المرور" name="userpass" required>
      <button type="submit">موافق</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> تذكّرني لاحقًا
      </label>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">إلغاء</button>
      <span class="psw" href="" onclick="document.getElementById('id02').style.display='block'">نسيت كلمة المرور؟</span>
    </div>
  </form>
  @if(isset($msg))
 {{$msg}}
 @endif
</div>
<!--LOGIN END-->
<!-- edit window-->
<div id="id02" class="modal">
  <form class="modal-content animate" action="/action_page.php">
    <div class="container">
      <label for="psw"><b>كلمة المرور القديمة</b></label>
      <input type="password" placeholder="كلمة المرور القديمة" name="psw" required>
      <label for="npsw"><b>كلمة المرور الجديدة</b></label>
      <input type="password" placeholder="كلمة المرور الجديدة" name="npsw" required>
 <label for="npsw"><b>تأكيد كلمة المرور الجديدة</b></label>
      <input type="password" placeholder="تأكيد كلمة المرور الجديدة" name="npsw" required>
 <center>
      <button type="submit">موافق</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">إلغاء</button>
    </div>
  </form>
</div>
<!-- end edit window-->
<!--end Header-->
</header>

<div class="pagesContent">
  <br/>
  <br/>
@if(Session::has('id'))
<?php echo displayPersonalInfo()?>
@endif
  <br/><br/>
  <center><h2  class=' font-italic' >@yield('pageTitle')</h2></center>
    <div class="contentPanel">
  <!--PROFILE-->
      @yield('content')
    </div>
</div>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<footer>
 <div class="container">
   <div class="row">
   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
               <ul class="social">
                          <span>التواصل الاجتماعي </span>
                           <li>
                                <a href="https://www.facebook.com/hajigift.org"><i class="fa fa-facebook fa-2x"></i></a>
                           </li>
                           <li>
                                <a href="#"><i class="fa fa-github fa-2x"></i></a>
                           </li>
                           <li>
                                <a href="https://twitter.com/hajigift"><i class="fa fa-twitter fa-2x"></i></a>
                           </li>
                           <li>
                                <a href="https://www.youtube.com/user/hajigift"><i class="fa fa-youtube fa-2x"></i></a>
                           </li>
                 </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <ul class="contact">
                     <span> شاركنا العطاء </span>
                      <li>
                         <a href="tel:+966 500 399 888">+966 500 399 888</a>
                      </li>
                      <li>
                        <a href="tel:+966 508 508 111">+966 508 508 111</a>
                      </li>
                      <li>
                         <a href="tel:+966 530 187 777">+966 530 187 777</a>
                      </li>
                </ul>
            </div>
       <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                <ul class="adress">
                     <span>تمنياتنا</span>
                     <li>
                        <p>نرجو أن نكون خبراً سعيداً . . . تنقله لمن حولك</p>
                      </li>
                      <li>
                        <p>في هدية نسعد بالتواصل معكم دائما وتلقى آرائكم ومقترحاتكم حول برامج وخدمات الجمعية كما نسعد باستقبال مساهمتكم المالية</p>
                      </li>
                 </ul>
            </div>
       </div>
    </div>
</footer>
</body>
</html>
<?php
 function displayPersonalInfo(){
  $info="
  <div class='boxInfo' ><h3  class='text-monospace font-italic'> :  المعلومات الشخصية &nbsp;  </h3>
    <table>
    <tr>
    <th  class='font-italic'>  &nbsp; &nbsp; المسمى الوظيفي : ".session()->get('jop')."</th>
    <th  class='font-italic'>   الاسم : ".session()->get('name')." </th>

    </tr>
    <tr>";
    if(session()->has('location')){

      $info.="<th  class='font-italic'> &nbsp; &nbsp; الموقع :  ".session()->get('location')."</th>";

  } else  if(session()->has('program_name')){

    $info.="<th class='font-italic'> &nbsp; &nbsp; البرنامج :  ".session()->get('program_name')."</th>";

}
    $info.="<th  class='font-italic'>".session()->get('email')." : البريد الالكتروني</th></tr>";

    $info.="</table> </div>";

  return $info;
 }
