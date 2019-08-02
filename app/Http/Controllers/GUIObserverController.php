<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Redirect;
use App\Observer;
use App\Service;
use App\Program;
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
use Session;

class GUIObserverController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:observer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $jop="مشرف ميداني";
        SessionController::Session($jop);
        $Oid=Session::get('id');
        $observer=DB::table('Observers')->where('id', '=', $Oid)->first();
         $ser = DB::table('services')
                         ->where('id', '=',$observer->service_id)
                         ->first();
                    if(isset($ser)){
                         $tableno = DB::table('table__codes')
                            ->where('id', '=',$ser->table_no)
                            ->first();
          $month=date('m');
          $datefrom=date('Y')."-01-01";
          $dateto=date('Y-m-d');
                             // احصائيات عامة
          if($ser->table_no==1){
            $forms=DB::table('body__food__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
             ->get(); }
          else if ($ser->table_no==2){
            $forms=DB::table('atonement__and__zakaat__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
            ->get();
          }
          else if($ser->table_no==3){
            $forms=DB::table('blood__of__algebrat__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
                        ->get();
          }
          else if($ser->table_no==4){
            $forms=DB::table('hospitable__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
            ->get();
          }
          else if($ser->table_no==5){
            $forms=DB::table('care__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
                      ->get();

          }
          else if($ser->table_no==6){
            $forms=DB::table('soul__food__forms')
            ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
                                ->get();
          }
            else if($ser->table_no==7){
              $forms=DB::table('delegations')
              ->where('observe_id', '=', $Oid)
            ->whereBetween('date',[$datefrom,$dateto])
              ->get();
            }
          else
          { return view('GUIObserver', compact('ser','observer','tableno','Oid'));}
          return view('GUIObserver', compact('ser','observer','tableno','Oid','forms'));}
          else return view('GUIObserver',compact('observer','Oid'));

      }
      public function indexform(Request $request  ) {
        $Oid=Session::get('id');
         $observer=DB::table('Observers')
                        ->where('id', '=', $Oid)
                         ->first();
          $Oid=Session::get('id');
          $ser=Service::find($request->service_id);
          $program=Program::find($ser->program_id);
          $city=location::all()->unique('location')->pluck('location');
          $location=location::all();
          //$bodyfood=Body_Food_Form ::find($request->service_id);


          if(($ser->table_no==1))
              { $materials=[];
                $bodyfood=DB::table('body__food__forms')
                                 ->where('form_id', '=', $request->form_id)
                                  ->first();
                $location=location::find($bodyfood->location_id);
                $bodyfoodM=DB::table('body__food__forms__materials')
                               ->where('form_id', '=', $request->form_id)
                                    ->get();
                  if(isset( $bodyfoodM)){
                  foreach ($bodyfoodM as $bodyfoodm) {
                    # code...
                    $materials[]=Material::where('id','=',$bodyfoodm->material_id)->pluck('name');
                  }}

              return   view('GUIObserverFormsEdit',compact('program','ser','materials','location','Oid','bodyfood','bodyfoodM' ,'observer'));
              }
          elseif(($ser->table_no==4))
                {  $materials=[];
                  $hospitable=DB::table('hospitable__forms')
                              ->where('form_id', '=', $request->form_id)
                                    ->first();
                  $hospitableM=DB::table('hospitable__form__materials')
                                 ->where('form_id', '=', $request->form_id)
                                      ->get();
                  $location=location::find($hospitable->location_id);
                  if(isset( $hospitableM)){
                    foreach ($hospitableM as $hospitablem) {
                      # code...
                      $materials[]=Material::where('id','=',$hospitablem->material_id)->pluck('name');
                    }}

            return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','Oid','observer','hospitable','hospitableM'));}
                elseif(($ser->table_no==5))
                      {
                        $materials=[];
                        $careF=DB::table('care__forms')
                               ->where('form_id', '=', $request->form_id)
                                          ->first();
                        $careM=DB::table('care__form__materials')
                                   ->where('form_id', '=', $request->form_id)
                                            ->get();
                        $location=location::find($careF->location_id);
                        if(isset( $careM)){
                          foreach ($careM as $carem) {
                            # code...
                            $materials[]=Material::where('id','=',$carem->material_id)->pluck('name');
                           // $materials[]=Material::find($carem->material_id)->pluck('name');
                          }}
                         // return  $materials;
                  return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','Oid','observer','careF','careM'));}
                      elseif(($ser->table_no==6))
                            { $materials=[];
                              $soulF=DB::table('soul__food__forms')
                                         ->where('form_id', '=', $request->form_id)
                                                   ->first();
                              $soulM=DB::table('soul__food__forms__materials')
                                        ->where('form_id', '=', $request->form_id)
                                                   ->get();
                               $location=location::find($soulF->location_id);
                               if(isset( $soulM)){
                                foreach ($soulM as $soulm) {
                                  # code...
                                  $materials[]=Material::where('id','=',$soulm->material_id)->pluck('name');

                                }}
                        return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','Oid' ,'observer','soulF','soulM'));}
                            elseif($ser->table_no==7)
                                  {
                                    $delega=Delegation::find($request->form_id);
                                    $location=location::find($delega->location_id);
                                    return view('GUIObserverFormsEdit',compact('program','ser','Oid','observer','delega'));}
          elseif(($ser->table_no==2))
           {
            $institution=[];
          $zakaat=DB::table('atonement__and__zakaat__forms')
                       ->where('form_id', '=', $request->form_id)
                               ->first();
          $zakaatI=DB::table('zakaat__form__institutions')
                               ->where('form_id', '=', $zakaat->form_id)
                               ->get();
                               if(isset( $zakaatI)){
                                foreach ($zakaatI as $zakaati) {
                                  # code...
                                  $institution[]=Institution::where('id','=',$zakaati->institution_id)->pluck('name');
                                }}
                 return view('GUIObserverFormsEdit',compact('program','ser','institution','Oid','observer' ,'zakaat','zakaatI'));}
                 elseif(($ser->table_no==3))
                       {
                        $institution=[];
                         $algebrat=DB::table('blood__of__algebrat__forms')
                                      ->where('form_id', '=', $request->form_id)
                                              ->first();

                         $algebratI=DB::table('blood__of__algebrat__form__institutions')
                                        ->where('form_id', '=', $algebrat->form_id)
                                              ->get();
                                              if(isset( $algebratI)){
                                                foreach ($algebratI as $algebrati) {
                                                  $institution[]=Institution::where('id','=',$algebrati->institution_id)->pluck('name');

                                                }
                                                }

                        return view('GUIObserverFormsEdit',compact('program','ser','institution','Oid','observer','algebrat','algebratI'));}
          else
          return view('GUIObserverFormsEdit') ;
      }

      public function store(Request $request){
        return  $request->form_id;
          $ser=Service::find($request->input('service_id'));
          $program=Service::find($ser->id)->program;
          $city=location::all()->unique('location')->pluck('location');
          $location=location::all();

           // نماذج البدن ومضياف والروح و عناية
          if(($ser->table_no==1)||($ser->table_no==4)||($ser->table_no==5)||($ser->table_no==6)){// خاص بالبدن والروح وعنايةومضياف
              $materials=Material::all();
              if($ser->table_no==1){
                   $success=GUIObserverFormsController::store_body_forms($request);
                   return response()->json(['success'=> $success]);
                   //return view('GUIObserverForms',compact('program','ser','materials','city','location','success'));
              }
              elseif($ser->table_no==4){
                  $success=GUIObserverFormsController::store_hospitable_form($request);
                  return response()->json(['success'=> $success]);
              }
              elseif($ser->table_no==5){
                  $success=GUIObserverFormsController::store_care_Form($request);
                  return  response()->json(['success'=> $success]);
              }
              elseif($ser->table_no==6){
                  $success=GUIObserverFormsController::store_soul_Form($request);
                  return response()->json(['success'=> $success]);

              }
          }
          elseif( $ser->table_no==2){/// و الزكاة خاص بنموذج الكفارات
              $success =GUIObserverFormsController::store_Zakaat_Form($request);
               $institution=Institution::all();
               return response()->json(['success'=> $success]);
          }

          elseif( $ser->table_no==3){ /// خاص بنموذج الوكالات
              $institution=Institution::all();
              //return GUIObserverFormsController::store_algebrat($request);
               $success=GUIObserverFormsController::store_algebrat($request);
              return response()->json(['success'=> $success]);

          }


          elseif($ser->table_no==7){//
              $success=GUIObserverFormsController::store_delegations_Form($request);
              return response()->json(['success'=> $success]);

          }else
            return view('GUIObserver');
      }
      public function updateF(Request $request){

        $number_of_beneficiaries = $request->input('number_of_beneficiaries');
        $nu_service_providers = $request->input('nu_service_providers');
        $observation = $request->input('observation');
        $Oid = $request->input('observer_id');
        //$count = $request->input('count');
        $countz = $request->input('countz');
        //$recipient = $request->input('recipient');
        $count_of_agencies = $request->input('count_of_agencies');
       // $number_of_carcasses = $request->input('number_of_carcasses');
       // $type = $request->input('type');
       // $name_of_delegate = $request->input('name_of_delegate');
        $form_id = $request->input('form_id');
        //$surplus = $request->input('surplus');
        //$needs_of_tomorro = $request->input('needs_of_tomorro');
        $address_in_mecca = $request->input('address_in_mecca');
        $address_in_madinah = $request->input('address_in_madinah');
        $number_of_men = $request->input('number_of_men');
        $number_of_women = $request->input('number_of_women');
        $number_of_children = $request->input('number_of_children');
        $date_of_Visit = $request->input('date_of_Visit');
        $visit_time = $request->input('visit_time');
        $contact_number= $request->input('contact_number');
        if($request->table_nox==1){
         DB::update('update body__food__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where form_id = ?',
         [$number_of_beneficiaries,$nu_service_providers,$observation,$request->form_id]);

         if(isset($request->materials_info)){
          foreach($request->materials_info as $materials_info){
            DB::update('update body__food__forms__materials set count = ? ,surplus=?,needs_of_tomorro=? where form_id = ? && material_id=?',
            [$materials_info['count'],$materials_info['surplus'],$materials_info['needs_of_tomorro'],$request->form_id,$materials_info['material_id']]);
          }
         }
         return redirect('/GUIObserver')->with('success', 'تم التعديل');

        }
         if($request->table_nox==6){

          DB::update('update soul__food__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where form_id = ?',
          [$number_of_beneficiaries,$nu_service_providers,$observation,$request->form_id]);

          if(isset($request->materials_info)){
            foreach($request->materials_info as $materials_info){
              DB::update('update soul__food__forms__materials set count = ?  where form_id = ? && material_id=?',
              [$materials_info['count'],$request->form_id,$materials_info['material_id']]);
            }

           }
 return redirect('/GUIObserver')->with('success', 'تم التعديل');
         }elseif($request->table_nox==5){
          DB::update('update care__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where form_id = ?',
          [$number_of_beneficiaries,$nu_service_providers,$observation,$request->form_id]);
            if(isset($request->materials_info)){
            foreach($request->materials_info as $materials_info){
              DB::update('update care__form__materials   set count = ?  where form_id = ? && material_id=?',
              [$materials_info['count'],$request->form_id,$materials_info['material_id']]);
            }
         }
 return redirect('/GUIObserver')->with('success', 'تم التعديل');
       }
         elseif($request->table_nox==4){

          DB::update('update hospitable__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=?
          where form_id = ?',[$number_of_beneficiaries,$nu_service_providers,$observation,$request->form_id]);
          if(isset($request->materials_info)){
            foreach($request->materials_info as $materials_info){
              DB::update('update hospitable__form__materials    set count = ?  where form_id = ? && material_id=?',
              [$materials_info['count'],$request->form_id,$materials_info['material_id']]);
            }
         }
 return redirect('/GUIObserver')->with('success', 'تم التعديل');
       }
         elseif($request->table_nox==2){
          DB::update('update atonement__and__zakaat__forms set count= ? where form_id = ?',[$countz,$request->form_id]);
          if(isset($request->institution)){
            foreach($request->institution as $institut){
              DB::update('update zakaat__form__institutions   set count = ? ,recipient = ? where form_id = ? && institution_id=?',
              [$institut['count'],$institut['recipient'],$request->form_id, $institut['institution_id']]);
            }
         }
 return redirect('/GUIObserver')->with('success', 'تم التعديل');
         }
         elseif($request->table_nox==3){
          DB::update('update blood__of__algebrat__forms set count_of_agencies = ?  where form_id = ?',[$count_of_agencies,$request->form_id]);
          if(isset($request->institution)){

            foreach($request->institution as $institut){
              DB::update('update blood__of__algebrat__form__institutions   set  number_of_carcasses =?  ,type=? ,name_of_delegate =? where form_id = ? && institution_id =?',
              [$institut['number_of_carcasses'],$institut['type'],$institut['name_of_delegate'],$request->form_id,$institut['institution_id']]);
            }
         }
 return redirect('/GUIObserver')->with('success', 'تم التعديل');
         }

         elseif($request->table_nox==7){
         DB::update('update delegations set address_in_mecca= ? ,address_in_madinah=?, number_of_men=?, number_of_women=?,number_of_children=?,
         date_of_Visit=?, visit_time=? , contact_number=?, observation=? where id = ?',
         [$address_in_mecca,$address_in_madinah
         ,$number_of_men,$number_of_women,$number_of_children,$date_of_Visit,$visit_time,$contact_number,$observation,$request->form_id]);

 return redirect('/GUIObserver')->with('success', 'تم التعديل');         }
         else{

         return redirect('/GUIObserver')->with('message', 'لم يتم التعديل ');
         }




   // return "تم تعديل البيانات بنجاح";
   // return view('GUIObserver') ;
      }

}
