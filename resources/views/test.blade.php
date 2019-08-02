@extends('templates.hadiyah')
@section('title')
رئيس البرامج
@endsection
@section('content')
<div class="serv">
	  <h2> خدماتي </h2><br>
	  <form method="post" action="GUIObserverForm">
        {{csrf_field()}}
	  @foreach($ser as $services ) 
	  <input type="hidden" value="{{$services->id}}" name="id">
              <table class="ws-css-table">
                <tr class="ws-css-table-tr">
                  <td class="ws-css-table-td"><button class="btn" type="submit" value="{{$services->id}}" name="service_id" >تعبئة النموذج</button></td>
				  <td class="ws-css-table-td"><img src="/images/picStar.png" alt="picture" style="width:90px;height:90px;margin-right:15px;"/>
				  <br><br>{{$services->name}}<br>{{$services->description}} {{$services->id}}
				</td>
                </tr>
              </table>
	  <div>
	</div>
	<br>
	  @endforeach
	</form>

</div>	  
@endsection
