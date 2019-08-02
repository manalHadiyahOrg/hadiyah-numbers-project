<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Redirect;
use App\Observer;
use App\Service;
use App\Blood_Of_Algebrat_Form;
use App\Institution;
use App\Blood_Of_Algebrat_Form_Institution;
use App\Adoption_Of_The_Committee;
use App\Atonement_And_Zakaat_Form;
use App\Zakaat_Form_Institution;
use App\Material;
use App\location;
use App\servies_materias;
use App\Body_Food_Form;
use App\Body_Food_Forms_Material;
use App\Care_Form;
use App\Care_Form_Material;
use App\Hospitable_Form;
use App\Hospitable_Form_Material;
use App\Soul_Food_Form;
use App\Soul_Food_Forms_Material;
use App\Delegation;
use DB;

class StatisticalController extends Controller
{
// تحديث التاريخ
public function update(Request $request){
  $datefrom=$request->get('from');
  $dateto=$request->get('to');
  // الإحصائيات العامة
  if($request->get('program_id')==0){
    $data= StatisticalController::statiscalTotalBeneficiaries($datefrom,$dateto);
    return ['name' =>$data[0], 'data' =>$data[1],'total'=>$data[2],'program_name'=>"جميع البرامج",'program_id'=>0];}
  // إحصائيات على حسب البرنامج
  else{
    $program=Program::find($request->get('program_id'));
    // غذاء الروح
    if($program->id==1){
        $total_beneficiaries=StatisticalController::count_beneficiaries_soul__food__forms($datefrom,$dateto);
        $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_soul__food__forms($datefrom,$dateto);
        $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_soul__food__forms($datefrom,$dateto);
        $sum_materials=StatisticalController::Sum_soul__food__forms__materials($datefrom,$dateto);
        $sum_materials_by_id=StatisticalController::Sum_soul__food__forms__materials_materials_by_id($datefrom,$dateto);

        return ['total_beneficiaries' =>$total_beneficiaries,
       'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
       'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
       'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
       'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id];
    }
    // غذاء البدن
    elseif($program->id==2){
        $total_beneficiaries=StatisticalController::count_beneficiaries_body_food($datefrom,$dateto);
        $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_body__food__forms($datefrom,$dateto);
        $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_body__food__forms($datefrom,$dateto);
        $sum_materials=StatisticalController::Sum_body_food_materials($datefrom,$dateto);
        $sum_materials_by_id=StatisticalController::Sum_body_food_materials_by_id($datefrom,$dateto);

        return ['total_beneficiaries' =>$total_beneficiaries,
        'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
        'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
        'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
        'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id];
     }
     // عناية
     elseif($program->id==5){
         $total_beneficiaries=StatisticalController::count_beneficiaries_care_forms($datefrom,$dateto);
         $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_care_forms($datefrom,$dateto);
         $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_care_forms($datefrom,$dateto);
         $sum_materials=StatisticalController::Sum_care_forms_materials($datefrom,$dateto);
         $sum_materials_by_id=StatisticalController::Sum_care_forms_materials_by_id($datefrom,$dateto);

         return ['total_beneficiaries' =>$total_beneficiaries,
         'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
         'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
         'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
         'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id];
     }
     // مضياف
     elseif($program->id==4){
         $total_beneficiaries=StatisticalController::count_beneficiaries_hospitable__forms($datefrom,$dateto);
         $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_hospitable__forms($datefrom,$dateto);
         $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_hospitable__forms($datefrom,$dateto);
         $sum_materials=StatisticalController::Sum_hospitable__forms_materials($datefrom,$dateto);
         $sum_materials_by_id=StatisticalController::Sum_hospitable__forms_materials_by_id($datefrom,$dateto);
         $sum_delegations=StatisticalController::Sum_delegations($datefrom,$dateto);
         $sum_nationality=StatisticalController::Sum_delegations_by_nationality($datefrom,$dateto);

         return ['
         ' =>$total_beneficiaries,
         'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
         'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
         'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
         'materials_number'=>$sum_materials_by_id[1],
         'delegations_name'=>$sum_delegations[0],
         'delegationss_number'=>$sum_delegations[1],
         'nationality_name'=>$sum_nationality[0],
         'nationality_number'=>$sum_nationality[1],
         'total'=>$sum_nationality[2],
         'program_name'=>$program->name,'program_id'=>$program->id];
     }
     // الوكالات
     elseif($program->id==3){
       $charts1 = StatisticalController::draw_charts($datefrom,$dateto);
       $charts2 = StatisticalController::institutionsServChart($datefrom,$dateto);
       $charts3 = StatisticalController::countChart($datefrom,$dateto);

       return ['name1' => $charts1['name1'],'data1' => $charts1['data1'],  'total1' => $charts1['total1'],
       'name2' => $charts2['name2'],'data2' => $charts2['data2'],  'total2' => $charts2['total2'],
       'name3' => $charts3['name3'],'data3' => $charts3['data3'], 'total3' => $charts3['total3'],'program_name'=>$program->name,'program_id'=>$program->id];
  

     }
    }
    return redirect('/');
}

// تشغيل الصفحة
public function create($id) {

  // تاريخ السنة الحالية
  $datefrom=date('Y')."-01-01";
  $dateto=date('Y-m-d');
  // إحصائيات عامة
  if(strcasecmp($id,'عامة')==0){
      $data= StatisticalController::statiscalTotalBeneficiaries($datefrom,$dateto);
      return view('GUIStatisticsthree',['name' =>$data[0], 'data' =>$data[1],'total'=>$data[2],'program_name'=>"جميع البرامج",'program_id'=>0]);}
  else{
       $program =Program::query()->where('name',$id)->first();
       if(isset($program)){
        // غذاء الروح
        if($program->id==1){
            $total_beneficiaries=StatisticalController::count_beneficiaries_soul__food__forms($datefrom,$dateto);
            $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_soul__food__forms($datefrom,$dateto);
            $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_soul__food__forms($datefrom,$dateto);
            $sum_materials=StatisticalController::Sum_soul__food__forms__materials($datefrom,$dateto);
            $sum_materials_by_id=StatisticalController::Sum_soul__food__forms__materials_materials_by_id($datefrom,$dateto);

            return view('GUIStatisticsone',['total_beneficiaries' =>$total_beneficiaries,
            'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
            'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
            'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
            'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id]);
        }
        // غذاء البدن
        elseif($program->id==2){
            $total_beneficiaries=StatisticalController::count_beneficiaries_body_food($datefrom,$dateto);
            $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_body__food__forms($datefrom,$dateto);
            $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_body__food__forms($datefrom,$dateto);
            $sum_materials=StatisticalController::Sum_body_food_materials($datefrom,$dateto);
            $sum_materials_by_id=StatisticalController::Sum_body_food_materials_by_id($datefrom,$dateto);

            return view('GUIStatisticsone',['total_beneficiaries' =>$total_beneficiaries,
            'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
            'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
            'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
            'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id]);
        }
        // عناية
        elseif($program->id==5){
            $total_beneficiaries=StatisticalController::count_beneficiaries_care_forms($datefrom,$dateto);
            $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_care_forms($datefrom,$dateto);
            $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_care_forms($datefrom,$dateto);
            $sum_materials=StatisticalController::Sum_care_forms_materials($datefrom,$dateto);
            $sum_materials_by_id=StatisticalController::Sum_care_forms_materials_by_id($datefrom,$dateto);

            return view('GUIStatisticsone',['total_beneficiaries' =>$total_beneficiaries,
            'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
            'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
            'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
            'materials_number'=>$sum_materials_by_id[1],'program_name'=>$program->name,'program_id'=>$program->id]);
        }
        // مضياف
        elseif($program->id==4){
            $total_beneficiaries=StatisticalController::count_beneficiaries_hospitable__forms($datefrom,$dateto);
            $count_beneficiariesbylocation=StatisticalController::count_beneficiaries_by_location_hospitable__forms($datefrom,$dateto);
            $count_beneficiariesbyconectionpoint=StatisticalController::count_beneficiaries_by_conectionpoint_hospitable__forms($datefrom,$dateto);
            $sum_materials=StatisticalController::Sum_hospitable__forms_materials($datefrom,$dateto);
            $sum_materials_by_id=StatisticalController::Sum_hospitable__forms_materials_by_id($datefrom,$dateto);
            $sum_delegations=StatisticalController::Sum_delegations($datefrom,$dateto);
            $sum_nationality=StatisticalController::Sum_delegations_by_nationality($datefrom,$dateto);

            return view('GUIStatisticstow',['total_beneficiaries' =>$total_beneficiaries,
            'location_name' =>$count_beneficiariesbylocation[0],'beneficiaries_number'=>$count_beneficiariesbylocation[1],
            'conectionpoint_name' =>$count_beneficiariesbyconectionpoint[0],'beneficiariesbycon_number'=>$count_beneficiariesbyconectionpoint[1],
            'sum_materials' =>$sum_materials,'materials_name'=>$sum_materials_by_id[0],
            'materials_number'=>$sum_materials_by_id[1],
            'delegations_name'=>$sum_delegations[0],
            'delegationss_number'=>$sum_delegations[1],
            'nationality_name'=>$sum_nationality[0],
            'nationality_number'=>$sum_nationality[1],
            'total'=>$sum_nationality[2],
            'program_name'=>$program->name,'program_id'=>$program->id]);
        }
        // الوكالات
        elseif($program->id==3){
            $charts1 = StatisticalController::draw_charts($datefrom,$dateto);
            $charts2 = StatisticalController::institutionsServChart($datefrom,$dateto);
            $charts3 = StatisticalController::countChart($datefrom,$dateto);

            return view('GUIStatisticsfor', ['name1' => $charts1['name1'],'data1' => $charts1['data1'],  'total1' => $charts1['total1'],
            'name2' => $charts2['name2'],'data2' => $charts2['data2'],  'total2' => $charts2['total2'],
            'name3' => $charts3['name3'],'data3' => $charts3['data3'], 'total3' => $charts3['total3'],'program_name'=>$program->name,'program_id'=>$program->id]);}
        }
        else  return redirect('/');
      }
      return redirect('/');
}

// إجمالي المستفيدين لجميع البرامج
public function statiscalTotalBeneficiaries ($from ,$to){
        $program=Program::orderBy('id')->pluck('name');
        $care__forms_beneficiaries=0+Care_Form::whereBetween('date',[$from,$to])
        ->sum('number_of_beneficiaries');
        $body__food__forms_beneficiaries=0+Body_Food_Form::whereBetween('date',[$from,$to])->sum('number_of_beneficiaries');
        $soul__food__form_beneficiaries=0+Soul_Food_Form::whereBetween('date',[$from,$to])->sum('number_of_beneficiaries');
        $hospitable__forms_beneficiaries=0+Hospitable_Form::whereBetween('date',[$from,$to])->sum('number_of_beneficiaries')
        +Delegation::whereBetween('date',[$from,$to])->sum('number_of_women')
        +Delegation::whereBetween('date',[$from,$to])->sum('number_of_children')+Delegation::whereBetween('date',[$from,$to])->sum('number_of_men');
        $Agenices__Zakaat_beneficiaries=Blood_Of_Algebrat_Form_Institution::
        join('blood__of__algebrat__forms','blood__of__algebrat__forms.form_id','=','blood__of__algebrat__form__institutions.form_id')
        ->whereBetween('date',[$from,$to])->sum('number_of_carcasses')+Zakaat_Form_Institution::
        join('atonement__and__zakaat__forms','atonement__and__zakaat__forms.form_id',
        '=','zakaat__form__institutions.form_id')
        ->whereBetween('date',[$from,$to])->sum('zakaat__form__institutions.count');
        $beneficiaries=[ $care__forms_beneficiaries,$body__food__forms_beneficiaries,$soul__food__form_beneficiaries,$hospitable__forms_beneficiaries,$Agenices__Zakaat_beneficiaries];
        $totalBeneficiaries=$care__forms_beneficiaries+$body__food__forms_beneficiaries+$hospitable__forms_beneficiaries+ $Agenices__Zakaat_beneficiaries;
        return [$program,$beneficiaries,$totalBeneficiaries];
}


/************************* غـــــــذاء الــــــــروح *************************/
// إجمالي المستفيدين
public static function count_beneficiaries_soul__food__forms($from ,$to){
  $count_beneficiaries = DB::table('soul__food__forms')
                       ->whereBetween('date',[$from,$to])->SUM('number_of_beneficiaries');
  return $count_beneficiaries;
}
// المستفيدين حسب المنطقة
public static function count_beneficiaries_by_location_soul__food__forms($from ,$to){
  $beneficiaries = DB::table('soul__food__forms')
                ->join('location', 'soul__food__forms.location_id', '=', 'location.id')
                ->whereBetween('date',[$from,$to])
                ->select(DB::raw('location'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                ->groupBy('location')->get();
  $location=[];
  $beneficiariesnumber=[];
  foreach( $beneficiaries as $beneficiari ){
    $location[]=$beneficiari->location;
    $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
  }
  return [$location,$beneficiariesnumber];
}
// المستفيدين حسب نقطة الاتصال
public static function count_beneficiaries_by_conectionpoint_soul__food__forms($from ,$to){
  $beneficiaries = DB::table('soul__food__forms')
                ->join('location', 'soul__food__forms.location_id', '=', 'location.id')
                ->whereBetween('date',[$from,$to])
                ->select(DB::raw('location_id'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                ->groupBy(DB::raw('location_id'))->get();
  $connection_point=[];
  $beneficiariesnumber=[];
  foreach( $beneficiaries as $beneficiari ){
    $connection_point[]=location::where('id','=',$beneficiari->location_id)->pluck('connection_point');
    $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
  }
  return [$connection_point,$beneficiariesnumber];
}
// إجمالي المواد المستخدمة
public static function Sum_soul__food__forms__materials ($from,$to){
  $materials = DB::table('soul__food__forms__materials')
          ->join('materials', 'soul__food__forms__materials.material_id', '=', 'materials.id')
          ->join('soul__food__forms','soul__food__forms__materials.form_id','=','soul__food__forms.form_id')
          ->whereBetween('date',[$from,$to])
                      ->SUM('count');
                      return $materials;
}
// المواد المستخدمة حسب النوع
public static function Sum_soul__food__forms__materials_materials_by_id ($from,$to){
  $materials = DB::table('soul__food__forms__materials')
            ->join('materials', 'soul__food__forms__materials.material_id', '=', 'materials.id')
            ->join('soul__food__forms','soul__food__forms__materials.form_id','=','soul__food__forms.form_id')
            ->whereBetween('date',[$from,$to])
            ->select(DB::raw('material_id'),DB::raw('SUM(count) as count'))
            ->groupBy(DB::raw('material_id'))->get();
  $materials_name=[];
  $materialsnumber=[];
  foreach($materials as $materia){
    $materials_name[]=Material::where('id','=',$materia->material_id)->pluck('name');
    $materialsnumber[]=0+$materia->count;
  }
 return [$materials_name,$materialsnumber];
}


/************************* غـــــــذاء الــــــــبدن *************************/
// إجمالي المستفيدين
public static function count_beneficiaries_body_food($from ,$to){
    $total__beneficiaries = 0+DB::table('body__food__forms')->whereBetween('date',[$from,$to])->SUM('number_of_beneficiaries');
    return $total__beneficiaries;
}
// المستفيدين حسب المنطقة
public static function count_beneficiaries_by_location_body__food__forms($from ,$to){
  $beneficiaries = DB::table('body__food__forms')
                      ->join('location', 'body__food__forms.location_id', '=', 'location.id')
                      ->whereBetween('date',[$from,$to])
                      ->select(DB::raw('location'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                      ->groupBy('location')->get();
  $location=[];
  $beneficiariesnumber=[];
  foreach($beneficiaries as $beneficiari ){
    $location[]=$beneficiari->location;
    $beneficiariesnumber[]= 0+$beneficiari->number_of_beneficiaries;
  }
  return  [$location,$beneficiariesnumber];
}
// المستفيدين حسب نقطة الاتصال
// يحتاج تعديل يا نعرضة في جدول ونجيب كل بييانات الموقع او نمرر له نتغير باسم المنطقة يلي نبغها
public static function count_beneficiaries_by_conectionpoint_body__food__forms($from ,$to){
  $beneficiaries = DB::table('body__food__forms')
                  ->join('location', 'body__food__forms.location_id', '=', 'location.id')
                  ->whereBetween('date',[$from,$to])
                  ->select(DB::raw('location_id'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                  ->groupBy(DB::raw('location_id'))->get();
  $connection_point=[];
  $beneficiariesnumber=[];
  foreach($beneficiaries as $beneficiari ){
    $connection_point[]=location::where('id','=',$beneficiari->location_id)->pluck('connection_point');
    $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
  }
  return [$connection_point,$beneficiariesnumber];
}
// إجمالي المواد المستخدمة
public static function Sum_body_food_materials ($from ,$to){
    $materials = 0+DB::table('body__food__forms__materials')
                ->join('materials', 'body__food__forms__materials.material_id', '=', 'materials.id')
                ->join('body__food__forms','body__food__forms__materials.form_id','=','body__food__forms.form_id')
                ->whereBetween('date',[$from,$to])
                ->SUM('count');
    return $materials;
}
// المواد المستخدمة حسب النوع
//ممكن اضافة شرط لمعرفه المواد المستخدمه بنسبة لخدمة وحدة
public static function Sum_body_food_materials_by_id ($from ,$to){
    $materials = DB::table('body__food__forms__materials')
    ->join('materials', 'body__food__forms__materials.material_id', '=', 'materials.id')
    ->join('body__food__forms','body__food__forms__materials.form_id','=','body__food__forms.form_id')
    ->whereBetween('date',[$from,$to])
    ->select(DB::raw('material_id'),DB::raw('SUM(count) as count'))
                      ->groupBy(DB::raw('material_id'))
                      ->get();
    $materials_name=[];
    $materialsnumber=[];
    foreach($materials as $materia){
      $materials_name[]=Material::where('id','=',$materia->material_id)->pluck('name');
      $materialsnumber[]=0+$materia->count;
    }
    return [$materials_name,$materialsnumber];
}


/************************* عــــــــــــــــنـايـــة *************************/
// إجمالي المستفيدين
public static function count_beneficiaries_care_forms($from ,$to){
  $total_beneficiaries = 0+DB::table('care__forms')
                      ->whereBetween('date',[$from,$to])->SUM('number_of_beneficiaries');
  return $total_beneficiaries;
}
// المستفيدين حسب المنطقة
public static function count_beneficiaries_by_location_care_forms($from ,$to){
    $beneficiaries = DB::table('care__forms')
                    ->join('location', 'care__forms.location_id', '=', 'location.id')
                    ->whereBetween('date',[$from,$to])
                    ->select(DB::raw('location'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                    ->groupBy('location')
                    ->get();
    $location=[];
    $beneficiariesnumber=[];
    foreach( $beneficiaries as $beneficiari ){
      $location[]=$beneficiari->location;
      $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
    }
    return [$location,$beneficiariesnumber];
}
// المستفيدين حسب نقطة الاتصال
public static function count_beneficiaries_by_conectionpoint_care_forms($from ,$to){
  $beneficiaries = DB::table('care__forms')
                ->join('location', 'care__forms.location_id', '=', 'location.id')
                ->whereBetween('date',[$from,$to])
                ->select(DB::raw('location_id'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                ->groupBy(DB::raw('location_id'))
                ->get();
  $connection_point=[];
  $beneficiariesnumber=[];
  foreach( $beneficiaries as $beneficiari ){
      $connection_point[]=location::where('id','=',$beneficiari->location_id)->pluck('connection_point');
      $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
  }
  return [$connection_point,$beneficiariesnumber];
}
// إجمالي المواد المستخدمة
public static function Sum_care_forms_materials ($from,$to){
  $materials = 0+DB::table('care__form__materials')
            ->join('materials', 'care__form__materials.material_id', '=', 'materials.id')
            ->join('care__forms','care__form__materials.form_id','=','care__forms.form_id')
            ->whereBetween('date',[$from,$to])->SUM('count');
  return $materials;
}
// المواد المستخدمة حسب النوع
public static function Sum_care_forms_materials_by_id ($from,$to){
 $materials = DB::table('care__form__materials')
            ->join('materials', 'care__form__materials.material_id', '=', 'materials.id')
            ->join('care__forms','care__form__materials.form_id','=','care__forms.form_id')
            ->whereBetween('date',[$from,$to])
            ->select(DB::raw('material_id'),DB::raw('SUM(count) as count'))
            ->groupBy(DB::raw('material_id'))->get();
 $materials_name=[];
 $materialsnumber=[];
 foreach($materials as $materia){
    $materials_name[]=Material::where('id','=',$materia->material_id)->pluck('name');
    $materialsnumber[]=0+$materia->count;
  }
  return [$materials_name,$materialsnumber];
}


/************************* مــــــــــــضــــــيــاف *************************/
// إجمالي المستفيدين
public static function count_beneficiaries_hospitable__forms($from ,$to){
    $hospitable__forms_beneficiaries = 0+Hospitable_Form::whereBetween('date',[$from,$to])->sum('number_of_beneficiaries')
    +Delegation::whereBetween('date',[$from,$to])->sum('number_of_women')
    +Delegation::whereBetween('date',[$from,$to])->sum('number_of_children')+Delegation::whereBetween('date',[$from,$to])->sum('number_of_men');
    return $hospitable__forms_beneficiaries;
}
// المستفيدين حسب المنطقة
public static function count_beneficiaries_by_location_hospitable__forms($from ,$to){
  $beneficiaries = DB::table('hospitable__forms')
                 ->join('location', 'hospitable__forms.location_id', '=', 'location.id')
                 ->whereBetween('date',[$from,$to])
                 ->select(DB::raw('location'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                  ->groupBy('location')->get();
  $location=[];
  $beneficiariesnumber=[];
  foreach( $beneficiaries as $beneficiari ){
    $location[]=$beneficiari->location;
    $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries; }
    $location[]= ['غير محددة'];
    $beneficiariesnumber[]=0+Delegation::whereBetween('date',[$from,$to])->sum('number_of_women')
    +Delegation::whereBetween('date',[$from,$to])->sum('number_of_children')+Delegation::whereBetween('date',[$from,$to])->sum('number_of_men');

  return [$location,$beneficiariesnumber];}

// المستفيدين حسب نقطة الاتصال
public static function count_beneficiaries_by_conectionpoint_hospitable__forms($from ,$to){
  $beneficiaries = DB::table('hospitable__forms')
                 ->join('location', 'hospitable__forms.location_id', '=', 'location.id')
                 ->whereBetween('date',[$from,$to])
                 ->select(DB::raw('location_id'),DB::raw('SUM(number_of_beneficiaries) as number_of_beneficiaries'))
                 ->groupBy(DB::raw('location_id'))->get();
  $connection_point=[];
  $beneficiariesnumber=[];
  foreach( $beneficiaries as $beneficiari ){
    $connection_point[]=location::where('id','=',$beneficiari->location_id)->pluck('connection_point');
    $beneficiariesnumber[]=0+$beneficiari->number_of_beneficiaries;
  }
  return [$connection_point,$beneficiariesnumber];
}
// إجمالي المواد المستخدمة
public static function Sum_hospitable__forms_materials ($from,$to){
    $materials = DB::table('hospitable__form__materials')
                ->join('materials', 'hospitable__form__materials.material_id', '=', 'materials.id')
                ->join('hospitable__forms','hospitable__form__materials.form_id','=','hospitable__forms.form_id')
                ->whereBetween('date',[$from,$to])
                ->SUM('count');
    return $materials;
}
// المواد المستخدمة حسب النوع
public static function Sum_hospitable__forms_materials_by_id($from,$to){
  $materials = DB::table('hospitable__form__materials')
             ->join('materials', 'hospitable__form__materials.material_id', '=', 'materials.id')
             ->join('hospitable__forms','hospitable__form__materials.form_id','=','hospitable__forms.form_id')
             ->whereBetween('date',[$from,$to])
             ->select(DB::raw('material_id'),DB::raw('SUM(count) as count'))
             ->groupBy(DB::raw('material_id'))->get();
  $materials_name=[];
  $materialsnumber=[];
  foreach($materials as $materia){
    $materials_name[]=Material::where('id','=',$materia->material_id)->pluck('name');
    $materialsnumber[]=0+$materia->count;
  }
  return [$materials_name,$materialsnumber];
}


/************************* استقبــــال الـــوفود *************************/
// المستفيدين حسب الفئات
// يحتاج تحسبن
public static function Sum_delegations ($from,$to){
    // من هنا اطبعي كل واحد لحاله بشكل عام عن طريق المتغيرات الاساسيه
    $delegations =DB::table('delegations')
                 ->whereBetween('date',[$from,$to])->get(array(
                 DB::raw('SUM(number_of_children) as number_of_children'),
                 DB::raw('SUM(number_of_women) as number_of_women'),
                 DB::raw('SUM(number_of_men) as number_of_men') ));
  $dele=[];
  foreach( $delegations as $delegat){
      $dele[]=$delegat->number_of_children;
      $dele[]=$delegat->number_of_women;
      $dele[]=$delegat->number_of_men;
  }
  $name=['أطفال','نساء','رجال'];
  return [$name,$dele];
}
// المستفيدين حسب الجنسيات
public static function Sum_delegations_by_nationality ($from,$to){
  $delegations =DB::table('delegations')
               ->whereBetween('date',[$from,$to])
               ->groupBy(DB::raw('nationality'))
               ->get( array (DB::raw('nationality'),DB::raw('SUM(number_of_children) as number_of_children'),
                             DB::raw('SUM(number_of_women) as number_of_women'),
                             DB::raw('SUM(number_of_men) as number_of_men')));
  $nationality=[];
  $delegationsnumber=[];
  $total=0;
  foreach($delegations as $delega){
    $nationality[]= $delega->nationality;
    $total=$delega->number_of_children+$delega->number_of_men+$delega->number_of_women;
    $delegationsnumber[]=$total;
  }
  return [$nationality,$delegationsnumber,$total];
}


/************************* الـــــــوكــــــــــــالات *************************/
// الرسم البياني لإجمالي أعداد الذبائح لكل جهة مستفيدة من الوكالات - نموذج دم الجبران والعقائق
public function draw_charts($from,$to){
  $in_name=[];
  $data = [];
  $i = 0;
  $total = 0;
  $number_of_inst = Blood_Of_Algebrat_Form_Institution::all()->unique('institution_id')->pluck('institution_id');
  foreach($number_of_inst as $id){
    $data[] = 0+Blood_Of_Algebrat_Form_Institution::
    join('blood__of__algebrat__forms','blood__of__algebrat__forms.form_id',
    '=','blood__of__algebrat__form__institutions.form_id')->whereBetween('date',[$from,$to])
    ->where('institution_id','=',$id)->sum('number_of_carcasses');
    $total += $data[$i]; // إجمالي عدد الذبائح
    $i++;
  }
  foreach($number_of_inst as $id) {
   $in_name[] = Institution::where('id','=', $id)->pluck('name');
  }
  $all_in = Institution::whereNotIn('name',$in_name)->pluck('name');
  foreach ($all_in as $institution) {
       $in_name[] = [$institution];
       $data[] = 0;
  }
  return view('/GUIStatisticsthree', ['name1' => $in_name, 'data1' => $data, 'total1' => $total]);
}
// الرسم البياني لإجمالي عدد الوكالات في كل خدمة - نموذج دم الجبران والعقائق
public function institutionsServChart($from,$to){
  $serv_name=[];
  $data = [];
  $i = 0;
  $total = 0;
  $number_of_serv = Blood_Of_Algebrat_Form::all()->unique('service_id')->pluck('service_id');
  foreach($number_of_serv as $id){
    $data[] = 0+Blood_Of_Algebrat_Form::
    whereBetween('date',[$from,$to])->where('service_id','=',$id)->sum('count_of_agencies');
    $total += $data[$i]; // إجمالي عدد الوكالات
    $i++;
  }
  foreach($number_of_serv as $id) {
   $serv_name[] = Service::where('id','=', $id)->pluck('name');
  }
  $all_in = Service::whereNotIn('name',$serv_name)->where('table_no','=','3')->pluck('name');
  foreach ($all_in as $service) {
       $serv_name[] = [$service];
       $data[] = 0;
  }
  return view('/GUIStatisticsthree', ['name2' => $serv_name, 'data2' => $data, 'total2' => $total]);
}
// الرسم البياني لإجمالي عدد الكفارات / زكاة الفطر لكل جهة مستفيدة - نموذج كفارات / زكاة الفطر
 public function countChart($from,$to){
   $name=[];
   $data = [];
   $i = 0;
   $total = 0;
   $number_of_inst =Zakaat_Form_Institution::all()->unique('institution_id')->pluck('institution_id');
   foreach($number_of_inst as $id){
    $data[] = 0+Zakaat_Form_Institution::
    join('atonement__and__zakaat__forms','atonement__and__zakaat__forms.form_id',
    '=','zakaat__form__institutions.form_id')->whereBetween('date',[$from,$to])
    ->where('institution_id','=',$id)->sum('zakaat__form__institutions.count');
    $total += $data[$i]; // إجمالي عدد الكفارات / زكاة الفطر
    $i++;
   }
    foreach($number_of_inst as $id) {
      $name[] = Institution::where('id','=', $id)->pluck('name');
    }
    $all_in = Institution::whereNotIn('name',$name)->pluck('name');
    foreach ($all_in as $institution) {
         $name[] = [$institution];
         $data[] = 0;
    }
   return view('/GUIStatisticsthree', ['name3' => $name, 'data3' => $data, 'total3' => $total]);
 }

}
