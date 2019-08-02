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
            <div id="beneficiaries">
                <div id="beneficiaries_location_container"></div>
                <br/><br/><br/><hr/><br/><br/><br/>
                <div id="beneficiaries_conectionpoint_container"></div>
            </div>
            <br/><br/><br/><hr/><br/><br/><br/>
            <div id="materials">
                <div id="materials_container"></div>
            </div>
            <br/><br/><br/><hr/><br/><br/><br/>
            <div id="delegati">
                 <div id="delegations"></div>
                 <br/><br/><br/><hr/><br/><br/><br/>
                 <div id="nationality"></div>
            </div>
        </div>
</center>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.setOptions({
        colors: ['#7ba692', '#a67d91', '#7d91a6', '#a6877d', '#917da6', '#9ca67d']
    });
// الرسم البياني لإجمالي أعداد مستفيدي برنامج مضياف حسب المنطقة
    var chart_beneficiaries = Highcharts.chart('beneficiaries_location_container', {
        chart: {
            type: 'column'
        },
        title: {
            text:'إحصائيات لإجمالي أعداد المستفيدين حسب المنطقة'
        },
        subtitle: {
            text: '{{$total_beneficiaries}} = العدد الإجمالي لأعداد المستفيدين'
        },
        xAxis: {
            categories:{!! json_encode($location_name) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'عدد المستفيدين'
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
            name: 'إجمالي عدد المستفيدين',
            data:{!! json_encode($beneficiaries_number)!!}
        }]
    });
// الرسم البياني لإجمالي أعداد مستفيدي برنامج مضياف حسب نقطة الاتصال
    var chart_beneficiaries_conectionpoint = Highcharts.chart('beneficiaries_conectionpoint_container', {
        chart: {
            type: 'column'
        },
        title: {
            text:'إحصائيات لإجمالي أعداد المستفيدين حسب نقطة الاتصال'
        },
        subtitle: {
            text: '{{$total_beneficiaries}} = العدد الإجمالي لأعداد المستفيدين'
        },
        xAxis: {
            categories:{!! json_encode($conectionpoint_name) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'عدد المستفيدين'
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
            name: 'إجمالي عدد المستفيدين',
            data:{!! json_encode($beneficiariesbycon_number)!!}
        }]
    });
// الرسم البياني لإجمالي المواد المستخدمة في برنامج مضياف
    var name1 = {!! json_encode($materials_name) !!};
    var data1 = {!! json_encode($materials_number)!!};
    var final1 = [];
    for(var i=0; i < name1.length; i++) {
        final1.push({
            name: name1[i],
            y: data1[i]
        });
     }
    var chart_materials_container=Highcharts.chart('materials_container',{
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'إحصائيات لإجمالي المواد المستخدمة'
        },
        subtitle: {
            text: '{{$sum_materials}} = العدد الإجمالي للمواد المستخدمة'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>%{point.percentage:.1f}</b>'+
            '<br/>العدد الفعلي : <b>{point.y}</b>',
            headerFormat: '<span style="font-size:13px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                },
                showInLegend: true
            }
        },
        series: [{
            name: '<br/>إجمالي عدد المواد المستخدمة',
            colorByPoint: true,
            data: final1
        }]
    });
// الرسم البياني لإجمالي أعداد مستفيدي خدمة استقبال الوفود حسب الفئات
    var name2 = {!! json_encode($delegations_name) !!};
    var data2 = {!! json_encode($delegationss_number)!!};
    var final2 = [];
    for(var i=0; i < name2.length; i++) {
        final2.push({
            name: name2[i],
            y: data2[i]
        });
    }
    var delegations=Highcharts.chart('delegations',{
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'إحصائيات لإجمالي مستفيدي خدمة استقبال الوفود حسب الفئات'
        },
        subtitle: {
            text: '{{$total}} = العدد الإجمالي لأعداد المستفيدين'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>%{point.percentage:.1f}</b>'+
            '<br/>العدد الفعلي : <b>{point.y}</b>',
            headerFormat: '<span style="font-size:13px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                },
                showInLegend: true
            }
        },
        series: [{
            name: '<br/>إجمالي عدد المستفيدين',
            colorByPoint: true,
            data: final2
        }]
    });
// الرسم البياني لإجمالي أعداد مستفيدي خدمة استقبال الوفود حسب الجنسية
    var name3 = {!! json_encode($nationality_name) !!};
    var data3 = {!! json_encode($nationality_number)!!};
    var final3 = [];
    for(var i=0; i < name3.length; i++) {
        final3.push({
            name: name3[i],
            y: data3[i]
        });
    }
    var nationalit =Highcharts.chart('nationality',{
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'إحصائيات لإجمالي مستفيدي خدمة استقبال الوفود حسب الجنسية'
        },
        subtitle: {
            text: '{{$total}} = العدد الإجمالي لأعداد المستفيدين'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>%{point.percentage:.1f}</b>'+
            '<br/>العدد الفعلي : <b>{point.y}</b>',
            headerFormat: '<span style="font-size:13px">{point.key}</span>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                },
                showInLegend: true
            }
        },
        series: [{
            name: '<br/>إجمالي عدد المستفيدين',
            colorByPoint: true,
            data: final3
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
                   console.log(result.nationality_name);
                   console.log(result.materials_number);
                   if(result.beneficiaries_number.length>=0){
                    //
                      chart_beneficiaries.series[0].setData(result.beneficiaries_number);
                      chart_beneficiaries.xAxis[0].setCategories(result.location_name);
                      chart_beneficiaries.setTitle(null, { text: result.total_beneficiaries+' = العدد الإجمالي لأعداد المستفيدين'});
                    //
                      chart_beneficiaries_conectionpoint.series[0].setData(result.beneficiariesbycon_number);
                      chart_beneficiaries_conectionpoint.xAxis[0].setCategories(result.conectionpoint_name);
                      chart_beneficiaries_conectionpoint.setTitle(null, { text: result.total_beneficiaries+' = العدد الإجمالي لأعداد المستفيدين'});
                   }
                   else {$('#beneficiaries').html('<div class="alert ">لايوجد بيانات </div>');}
                   if(result.materials_number.length>=0){
                    var final3 = [];
                       for(var i=0; i < result.materials_name.length; i++) {
                         final3.push({
                             name: result.materials_name[i],
                             y: result.materials_number[i] });
                       }
                       chart_materials_container.series[0].setData(final3);
                       chart_materials_container.setTitle(null, { text: result.sum_materials+' = العدد الإجمالي للمواد المستخدمة '});
                   }
                   else {$('#materials_container').html('<div class="alert ">لايوجد بيانات </div>');}
                   if(result.nationality_number.length>=0){
                       //
                       var final1 = [];
                       for(var i=0; i < result.delegations_name.length; i++) {
                         final1.push({
                             name: result.delegations_name[i],
                             y: result.delegationss_number[i] });
                       }
                       delegations.xAxis[0].setCategories(final1);
                       delegations.setTitle(null, { text: result.total+' = العدد الإجمالي لأعداد المستفيدين '});
                       var final2 = [];
                       for(var i=0; i < result.nationality_name.length; i++) {
                         final2.push({
                             name: result.nationality_name[i],
                             y: result.nationality_number[i] });
                             nationalit.series[0].setData(final2);
                             nationalit.setTitle(null, { text: result.total+' = العدد الإجمالي لأعداد المستفيدين '});
                      }
                  }
                  else {$('#delegati').html('<div class="alert ">لايوجد بيانات </div>');}
              }
           })
    }); });
</script>

@endsection
