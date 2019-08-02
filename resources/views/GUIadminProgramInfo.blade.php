@extends('templates.hadiyah')
@section('title')
رئيس البرامج-البرنامج
@endsection
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="4"></li>
  </ul>
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/hadiyah2.png" alt="هدية في صور" width="1100px" height="250px">
    </div>
    <div class="carousel-item">
      <img src="images/hadiyah1.png" alt="هدية في صور" width="1100px" height="250px">
    </div>
    <div class="carousel-item">
      <img src="images/hadiyah4.png" alt="هدية في صور" width="1100px" height="250px">
    </div>
    <div class="carousel-item">
      <img src="images/hadiyah3.png" alt="هدية في صور" width="1100px" height="250px">
    </div>
  </div>
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<table style="width:100%">
  <tr class="programInfo">
    <td><a href="" alt="اقرا المزيد"><embed type="image/svg+xml" src="images/arrow-left.svg" /><a/></td>
    <td><p>يرتكز نشاط البرنامج على تعليم اركان الاسلام وتحسين تلاوة الفاتحة وقصار السور.</p></td>
    <td><img src="images/غذاء-الروح1.png"></td>
  </tr>
  <tr class="programInfo">
    <td><a href="" alt="اقرا المزيد"><embed type="image/svg+xml" src="images/arrow-left.svg" /><a/></td>
    <td><p>يعد برنامج غذاء البدن من اوسع برامج الجمعية تفرعًا ويراعي البرنامج  في جميع جوانبه احتياجات الفئة المستفيدة</p></td>
    <td><img src="images/غذاء-البدن1.png"></td>
  </tr>
  <tr class="programInfo">
    <td><a href="" alt="اقرا المزيد"><embed type="image/svg+xml" src="images/arrow-left.svg" /><a/></td>
    <td><p>تضم جانبًا يتعلق بتقديم هدايا أو خدمات تتيح للحجاج والمعتمرين والزوار سهولة وتيسيرًا أثناء اداء المناسك</p></td>
    <td><img src="images/العناية1.png"></td>
  </tr>
  <tr class="programInfo">
    <td><a href="" alt="اقرا المزيد"><embed type="image/svg+xml" src="images/arrow-left.svg" /><a/></td>
    <td><p>استقبال الحجاج والمعتمرين والزوار وتقديم الضيافة والوجبات والسقيا والهدايا لهم</p></td>
    <td><img src="images/1مضياف.png"></td>
  </tr>
  <tr class="programInfo">
    <td><a href="" alt="اقرا المزيد"><embed type="image/svg+xml" src="images/arrow-left.svg" /><a/></td>
    <td><p>لم يستطيع تنفيذ النسك فهناك الوكالات المقرة شرعا بإخراج الكفارات أو بإناية من يستطيع تنفيذ النسك عنه </p></td>
    <td><img src="images/1الوكالات.png"></td>
  </tr>
</table>

@endsection
