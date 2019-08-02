@extends('templates.hadiyah')
@section('title')
مشرف ميداني.
@endsection
@section('pageTitle')
:خدماتي
</br>
@if(isset($ser))
{{ $ser->name}}
@else
لم يتم تعيين خدمة
@endif
@endsection
@section('content')
<center>
  @if(Session::has('message'))
   <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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
 <div class="observerMenu">
<ul>
<li>
@if(isset($ser))
<form method="post" action="\GUIObserverForm">
{{csrf_field()}}
<input type="hidden" value="{{$ser->id}}" name="id">

<button class="btn"type="submit" value="{{$ser->id}}" name="service_id" onclick="" >تعبئة النموذج</button>
</form>
</li>
<li>
 <button class="btn" onclick="document.getElementById('prevForms').style.display='block'">استعراض النماذج المعبأه</button>
</li>

@endif
</ul>
</div>
</br>

<center id="prevForms">

@if(isset($ser))
@if($ser->table_no!=null)
@if(isset($forms))
<table width="50%" class="prevForms">
<thead>
<th>
<th>
تعديل
</th>
<th>
تاريخ التعبئة
</th>
<th>
اسم النموذج
</th>
</tr>
</thead>
<tbody>
@foreach($forms as $form )
<tr>
<form method="post" action="\GUIObserverFormsEdit">
    {{csrf_field()}}
 <input type="hidden" value="{{$ser->id}}" name="service_id">
 @if($ser->table_no!=7)
<input type="hidden" value="{{$form->form_id}}" name="form_id">
@else
<input type="hidden" value="{{$form->id}}" name="form_id">
@endif
<td colspan="2">
<button class="btn" type="submit"  >تعديل</button>
</td>
</form>
<td>
{{$form->date}}
</td>
<td>
{{$tableno->table_name}}
</td>
</tr>
@endforeach
</tbody>
</table>
@else
لا يوجد نماذج معبأة مسبقا
@endif
@endif
@endif
</center>

</br>
@endsection
