@extends('templates.hadiyah')
@section('title')
هدية الحاج والمعتمر
@endsection
@section('content')

<center>
{{csrf_field()}}
<br/><br/><br/><br/><br/><br/>
{{csrf_field()}}
            <input type="hidden" value="{{$program_id}}" id="program_id" name="program_id">
            <input type='date' id='date2'  class='datePicker' name='date2' required>
            من&nbsp&nbsp
            <input type='date' id='date1' class='datePicker' name='date1' required> الى&nbsp&nbsp
            <label for='male'> &nbsp &nbsp التاريخ &nbsp &nbsp</label>
            <br/><br/><br/><br/><br/><br/>
            <div id="chart">
               <div id="totalbeneficiaries">{{$total}}</div>
               <div id="beneficiaries">
                 <div id="beneficiaries_container"></div>
                 <br/><br/><br/><hr/><br/><br/><br/>
                 <div id="beneficiaries_conectionpoint_container"></div>
               </div>
            </div>
</center>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.setOptions({
        colors: ['#7ba692', '#a67d91', '#7d91a6', '#a6877d', '#917da6', '#9ca67d']
    });

//
    var chart_beneficiaries=Highcharts.chart('beneficiaries_container', {
        chart: {
            type: 'column'
        },
        title: {
            text:" مستفيدين برنامج "+{!! json_encode($program_name) !!},
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories:{!! json_encode($name) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ' عدد المستفيدين'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.3,
                borderWidth: 0
            }
        },
        series: [{
            name: 'إجمالي عددالمستفدين'+{!! json_encode($program_name) !!},
            data:{!! json_encode($data)!!}
        }]
    });

    $(document).ready(function(){
      var now = new Date();
      var day = ("0" + now.getDate()).slice(-2);
      var month = ("0" + (now.getMonth() + 1)).slice(-2);
      var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
      document.getElementById("date1").value = now.getFullYear()+"-01-01";
      document.getElementById("date2").value = today;
    $('.datePicker').change(function(){
           var from=document.getElementById("date1").value
           var to=document.getElementById("date2").value
           var program_id=document.getElementById("program_id").value
           var _token="{{csrf_token()}}";
           $.ajax({
             url:"{{url('date')}}",
             type:"get",
             data:{from:from ,to:to,_token:_token,program_id:program_id},
             success:function(result){
               console.log(result.name);
               if(result.name.length>=0){
                  chart_beneficiaries.series[0].setData(result.data);
                  chart_beneficiaries.xAxis[0].setCategories(result.name);
                  chart_beneficiaries.setTitle(null, { text: result.total_beneficiaries+' = العدد الإجمالي لأعداد المستفيدين'});
                //
               }
               else {$('#beneficiaries').html('<div class="alert ">لايوجد بيانات </div>');}
               $('#totalbeneficiaries').html('<div class="alert ">'+result.total +'</div>');
             }
           })
    }); });
</script>

@endsection
