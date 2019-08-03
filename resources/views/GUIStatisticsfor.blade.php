
@extends('templates.hadiyah')
@section('title')
إحصائيات الوكالات
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
              <!-- الرسم البياني لإجمالي أعداد الذبائح لكل جهة مستفيدة من الوكالات - نموذج دم الجبران والعقائق -->
              <div id="chart1"></div>
              <br/><br/><br/><hr/><br/><br/><br/>
              <!-- الرسم البياني لإجمالي عدد الوكالات في كل خدمة - نموذج دم الجبران والعقائق -->
              <div id="chart2"></div>
              <br/><br/><br/><hr/><br/><br/><br/>
              <!-- الرسم البياني لإجمالي عدد الكفارات / زكاة الفطر لكل جهة مستفيدة - نموذج كفارات / زكاة الفطر -->
              <div id="chart3"></div>
              <br/><br/><br/><hr/><br/><br/><br/>
</center>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.setOptions({
      colors: ['#7ba692', '#a67d91', '#7d91a6', '#a6877d', '#917da6', '#9ca67d']
    });

// الرسم البياني لإجمالي أعداد الذبائح لكل جهة مستفيدة من الوكالات - نموذج دم الجبران والعقائق
    var chart1 = Highcharts.chart('chart1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'إحصائيات لإجمالي أعداد الذبائح لكل جهة مستفيدة من الوكالات'
        },
        subtitle: {
            text: '{{ $total1 }} = العدد الإجمالي للذبائح'
        },
        xAxis: {
            categories: {!! json_encode($name1) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'عدد الذبائح لكل جهة'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'إجمالي الذبائح',
            data: {!! json_encode($data1) !!}
        }]
    });
// الرسم البياني لإجمالي عدد الوكالات في كل خدمة - نموذج دم الجبران والعقائق
    var chart2 = Highcharts.chart('chart2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'إحصائيات لإجمالي أعداد الوكالات في كل خدمة'
        },
        subtitle: {
            text: '{{ $total2 }} = العدد الإجمالي للوكالات'
        },
        xAxis: {
            categories: {!! json_encode($name2) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'إجمالي عدد الوكالات لكل خدمة'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'إجمالي عدد الوكالات',
            data: {!! json_encode($data2) !!}
        }]
    });
// الرسم البياني لإجمالي عدد الكفارات / زكاة الفطر لكل جهة مستفيدة - نموذج كفارات / زكاة الفطر
    var chart3 = Highcharts.chart('chart3', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'إحصائيات إجمالي عدد الكفارات/زكاة الفطر لكل جهة مستفيدة من الوكالات'
        },
        subtitle: {
            text: '{{ $total3 }} = العدد الإجمالي للكفارات / زكاة الفطر'
        },
        xAxis: {
            categories: {!! json_encode($name3) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'الجهات المستفيدة من الوكالات'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'إجمالي عدد الكفارات/زكاة الفطر',
            data: {!! json_encode($data3) !!}
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
               console.log(result.name3);
               console.log(result.data3);
               if(result.name1.length>0){
                //
                  chart1.series[0].setData(result.data1);
                  chart1.xAxis[0].setCategories(result.name1);
                  chart1.setTitle(null, { text: result.total1+' = لعدد الإجمالي للذبائح'});

               }
               else {$('#chart1').html('<div class="alert ">لايوجد بيانات </div>');}
               if(result.name2.length>0){
                   //
                   chart2.series[0].setData(result.data2);
                   chart2.xAxis[0].setCategories(result.name2);
                   chart2.setTitle(null, { text: result.total2+' =  العدد الإجمالي للوكالات '});
               }
               else {$('#chart2').html('<div class="alert ">لايوجد بيانات </div>');}
               if(result.name3.length>0){
                   //
                   chart3.series[0].setData(result.data3);
                   chart3.xAxis[0].setCategories(result.name3);// تغير
                   chart3.setTitle(null, { text: result.total3+' =  العدد الإجمالي للكفارات / زكاة الفطر' });
               }
               else {$('#chart3').html('<div class="alert ">لايوجد بيانات </div>');}
            }
           })

    }); });
</script>

@endsection
