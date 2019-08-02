<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
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

class ServiceController extends Controller
{
  public function indexF(){

    $Oid=Session::get('id');
      return Session::get('id');
      // $Oid=13018;
      //$serviceid=4;
       $observer=DB::table('Observers')->where('id', '=', $Oid)->first();
       //Observer :: all(["id","f_name","l_name","service_id"]);



       $ser = DB::table('services')
                       ->where('id', '=',$observer->service_id)
                       ->first();
          $tableno = DB::table('table__codes')
                          ->where('id', '=',$ser->table_no)
                          ->first();

             $bodyfood=DB::table('body__food__forms')
                            ->where('observe_id', '=', $Oid)
                             ->first();

              $soulF=DB::table('soul__food__forms')
                              ->where('service_id', '=', $ser->id)
                              ->first();

              $hospitable=DB::table('hospitable__forms')
                              ->where('service_id', '=', $ser->id)
                              ->first();

              $careF=DB::table('care__forms')
                         ->where('service_id', '=', $ser->id)
                          ->first();

              $delega=DB::table('delegations')
                          ->where('service_id', '=', $ser->id)
                          ->first();
              $zakaat=DB::table('atonement__and__zakaat__forms')
                          ->where('service_id', '=', $ser->id)
                          ->first();
              $algebrat=DB::table('blood__of__algebrat__forms')
                          ->where('service_id', '=', $ser->id)
                          ->first();
       return view('GUIObserver', compact('ser','observer','tableno','Oid','bodyfood','soulF','hospitable','careF','delega','zakaat','algebrat'));


    }
    public function index(Request $request  ) {
      $Oid=Session::get('id');
      // $Oid=13018;

    // $form_id=67;
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
            {
              $bodyfood=DB::table('body__food__forms')
                               ->where('service_id', '=', $ser->id)
                                ->first();
              $bodyfoodM=DB::table('body__food__forms__materials')
                                  ->where('form_id', '=',$bodyfood->form_id)
                                  ->first();
                 $materials=$ser->material_services;
            return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','city','Oid','bodyfood','bodyfoodM' ,'observer'));
            }
        elseif(($ser->table_no==4))
              {
                $hospitable=DB::table('hospitable__forms')
                                 ->where('service_id', '=', $ser->id)
                                  ->first();
                $hospitableM=DB::table('hospitable__form__materials')
                                    ->where('form_id', '=',$hospitable->form_id)
                                    ->first();
                 $materials=$ser->material_services;
          return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','city','Oid','observer','hospitable','hospitableM'));}
              elseif(($ser->table_no==5))
                    {
                      $careF=DB::table('care__forms')
                                       ->where('service_id', '=', $ser->id)
                                        ->first();
                      $careM=DB::table('care__form__materials')
                                          ->where('form_id', '=',$careF->form_id)
                                          ->first();
                      $materials=$ser->material_services;
                return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','city','Oid','observer','careF','careM'));}
                    elseif(($ser->table_no==6))
                          {
                            $soulF=DB::table('soul__food__forms')
                                                 ->where('service_id', '=', $ser->id)
                                                 ->first();
                            $soulM=DB::table('soul__food__forms__materials')
                                                 ->where('form_id', '=', $soulF->form_id)
                                                 ->first();

                            $materials=$ser->material_services;
                      return  view('GUIObserverFormsEdit',compact('program','ser','materials','location','city','Oid' ,'observer','soulF','soulM'));}
                          elseif($ser->table_no==7)
                                {
                                  $delega=DB::table('delegations')
                                                       ->where('service_id', '=', $ser->id)
                                                       ->first();
                                  return view('GUIObserverFormsEdit',compact('program','ser','Oid','observer','delega'));}
        elseif(($ser->table_no==2))
         {
        $zakaat=DB::table('atonement__and__zakaat__forms')
                             ->where('service_id', '=', $ser->id)
                             ->first();
        $zakaatI=DB::table('zakaat__form__institutions')
                             ->where('form_id', '=', $zakaat->form_id)
                             ->first();
             $institution=Institution::all();
               return view('GUIObserverFormsEdit',compact('program','ser','institution','Oid','observer' ,'zakaat','zakaatI'));}
               elseif(($ser->table_no==3))
                     {
                       $algebrat=DB::table('blood__of__algebrat__forms')
                                            ->where('service_id', '=', $ser->id)
                                            ->first();
                       $algebratI=DB::table('blood__of__algebrat__form__institutions')
                                            ->where('form_id', '=', $algebrat->form_id)
                                            ->first();
                       $institution=Institution::all();
                      return view('GUIObserverFormsEdit',compact('program','ser','institution','Oid','observer','algebrat','algebratI'));}
        else
        return view('GUIObserverFormsEdit') ;
    }
    public function store(Request $request){
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
      $count = $request->input('count');
      $countz = $request->input('countz');
      $recipient = $request->input('recipient');
      $count_of_agencies = $request->input('count_of_agencies');

      $number_of_carcasses = $request->input('number_of_carcasses');
      $type = $request->input('type');
      $name_of_delegate = $request->input('name_of_delegate');

       $form_id = $request->input('form_id');
      $surplus = $request->input('surplus');
      $needs_of_tomorro = $request->input('needs_of_tomorro');

      $address_in_mecca = $request->input('address_in_mecca');
      $address_in_madinah = $request->input('address_in_madinah');
      $number_of_men = $request->input('number_of_men');
      $number_of_women = $request->input('number_of_women');
      $number_of_children = $request->input('number_of_children');
      $date_of_Visit = $request->input('date_of_Visit');
      $visit_time = $request->input('visit_time');
      $contact_number= $request->input('contact_number');

       DB::update('update body__food__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where observe_id = ?',[$number_of_beneficiaries,$nu_service_providers,$observation,$Oid]);
       DB::update('update body__food__forms__materials set count = ? ,surplus=?,needs_of_tomorro=? where form_id = ?',[$count,$surplus,$needs_of_tomorro,$form_id]);
       DB::update('update soul__food__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where observe_id = ?',[$number_of_beneficiaries,$nu_service_providers,$observation,$Oid]);
       DB::update('update soul__food__forms__materials set count = ?  where form_id = ?',[$count,$form_id]);
       DB::update('update care__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where observe_id = ?',[$number_of_beneficiaries,$nu_service_providers,$observation,$Oid]);
       DB::update('update care__form__materials set count = ?  where form_id = ?',[$count,$form_id]);
       DB::update('update atonement__and__zakaat__forms set count = ?  where observe_id = ?',[$countz,$Oid]);
       DB::update('update zakaat__form__institutions set count = ? , recipient=?  where form_id = ?',[$count,$recipient ,$form_id]);
       DB::update('update blood__of__algebrat__forms set count_of_agencies = ?  where observe_id = ?',[$count_of_agencies,$Oid]);
        DB::update('update blood__of__algebrat__form__institutions set number_of_carcasses = ? , type=? ,name_of_delegate=?  where form_id = ?',[$number_of_carcasses,$type ,$name_of_delegate ,$form_id]);
        DB::update('update delegations set address_in_mecca = ? , address_in_madinah=? ,number_of_men=? ,number_of_women=? ,number_of_children=? ,date_of_Visit=?,visit_time=? ,contact_number=? ,observation=? where observe_id = ?',[$address_in_mecca,$address_in_madinah,$number_of_men,$number_of_women,$number_of_children,$date_of_Visit,$visit_time,$contact_number,$observation,$Oid]);
        DB::update('update hospitable__forms set number_of_beneficiaries = ?,nu_service_providers=? ,observation=? where observe_id = ?',[$number_of_beneficiaries,$nu_service_providers,$observation,$Oid]);
        DB::update('update hospitable__form__materials set count = ?  where form_id = ?',[$count,$form_id]);
      return redirect('/GUIObserver')->with('success', 'تم التعديل');

 // return "تم تعديل البيانات بنجاح";
 // return view('GUIObserver') ;
    }
}
