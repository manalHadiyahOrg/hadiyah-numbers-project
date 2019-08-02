@extends('templates.hadiyah')
@section('title')
رئيس البرامج
@endsection
@section('pageTitle')
{{"خدمات برنامج ".$program->name}}
@endsection
@section('content')
 <!-- '$program','$ser' استخدي ذي المتغيرت لربط مع قاعدة البيانات-->
  <div id="demo" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="4"></li>
    </ul>
    <!-- The slideshow -->
    <Center>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/images/hadiyah2.png" alt="هدية في صور" >
      </div>
      <div class="carousel-item">
        <img src="/images/hadiyah1.png" alt="هدية في صور" >
      </div>
      <div class="carousel-item">
        <img src="/images/hadiyah4.png" alt="هدية في صور" >
      </div>
      <div class="carousel-item">
        <img src="/images/hadiyah3.png" alt="هدية في صور">
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
    </Center>
  <table style="width:100%">
    @foreach ($ser as $service)
      <tr class="programInfo">
        <td><p><b> {{$service->name}} </b> {{$service->description}} .<p></td>
        <td><img src="{{$program->image}}" width="150"></td>
      </tr>
    @endforeach
  </table>
  <center>
    <br>
    <a href="{{url('GUIStatistics/'.$program->name)}}"><button>احصائيات البرنامج</button></a>
    <br/>
    <br>
    <br>
  </center>
@endsection
