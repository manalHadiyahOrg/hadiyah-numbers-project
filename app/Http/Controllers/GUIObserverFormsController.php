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
use App\Atonement_And_Zakaat_Form;use App\Zakaat_Form_Institution;
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
use Session;

class GUIObserverFormsController extends Controller
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
   /// basma 9/7 عرض النموذج المناسب مع  عنوان الخدمة والبرنامج
    public function index(Request $request) {

        $ser=Service::find($request->service_id);
        $program=Program::find($ser->program_id);
        $city=location::all()->unique('location');
        $location=location::all();

        if(($ser->table_no==1)||($ser->table_no==4)||($ser->table_no==5)||($ser->table_no==6))
            {
                 $materials=$ser->material_services;
            return  view('GUIObserverForms',compact('program','ser','materials','location','city'));
            }
        elseif($ser->table_no==7)
              {return view('GUIObserverForms',compact('program','ser'));}
        elseif($ser->table_no==2||$ser->table_no==3)
              {$institution=Institution::all();
               return view('GUIObserverForms',compact('program','ser','institution'));}
        else
        return view('GUIObserver') ;
    }

    /// basma 9/7 حفظ معلومات القادمة من صفحة النموذج
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

    //  ادخال البدن
    public function store_body_forms(Request $request){
        $form=Body_Food_Form::create($request->all()+['observe_id'=>Session::get('id')]);
            foreach($request->materials_info as $material){
                if(isset($material['count'])){
               $body_mater=Body_Food_Forms_Material::create([
                'surplus'=>$material['surplus'],
               'needs_of_tomorro'=>$material['needs_of_tomorro'],
               'count'=>$material['count'],
               'form_id'=>$form['id'],
               'material_id'=> $material['material_id']]);
                $body_mater->save();   }
               }return "تم حفظ البيانات بنجاح";
    }

    //  ادخال عناية
    public function store_care_Form(Request $request){
        $form=Care_Form::create($request->all()+['observe_id'=>Session::get('id')]);

            foreach($request->materials_info as $material){
                if(isset($material['count'])){
               $care_form=Care_Form_Material::create([
               'count'=>$material['count'],
               'form_id'=>$form['id'],
               'material_id'=> $material['material_id']]);
                $care_form->save();   }
               }return "تم حفظ البيانات بنجاح";
    }
    // ادخال مضياف
    public function store_hospitable_form(Request $request){
        $form=Hospitable_Form::create($request->all()+['observe_id'=>Session::get('id')]);
            foreach($request->materials_info as $material){
                if(isset($material['count'])){
               $hospitable_material=Hospitable_Form_Material::create([
               'count'=>$material['count'],
               'form_id'=>$form['id'],
               'material_id'=> $material['material_id']]);
               $hospitable_material->save();}
               }
               return "تم حفظ البيانات بنجاح";
    }
    // الروح
    public function store_soul_Form(Request $request){
        $form=Soul_Food_Form::create($request->all()+['observe_id'=>Session::get('id')]);
            foreach($request->materials_info as $material){
                if(isset($material['count'])){
               $soul_material=Soul_Food_Forms_Material::create([
               'count'=>$material['count'],
               'language'=>$material['language'],
               'form_id'=>$form['id'],
               'material_id'=> $material['material_id']]);
               $soul_material->save();}
               }
               return "تم حفظ البيانات بنجاح";
    }
    public function indexlocation(Request $request){
        $select = $request->get('select');
        $value = $request->get('value');
        $location=location::find($value);
        $dependent = $request->get('dependent');
        $data = location::where('location','LIKE', $location->location)->get();
        $output = '<option value="">اختار  '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->connection_point.'</option>';
        }
        echo $output;

     }
    public function store_delegations_Form (Request $req){
        $Delegation=new Delegation();
        $Delegation->day = $req->input('day');
        $Delegation->date = $req->input('date');
        $Delegation->nationality = $req->input('nationality');
        $Delegation->address_in_mecca = $req->input('address_in_mecca');
        $Delegation->address_in_madinah = $req->input('address_in_madinah');

        $Delegation->date_of_arrival = $req->input('date_of_arrival');
        $Delegation->arrival_time = $req->input('arrival_time');

        $Delegation->date_of_departure = $req->input('date_of_departure');
        $Delegation->departure_time = $req->input('departure_time');

        $Delegation->number_of_men = $req->input('number_of_men');
        $Delegation->number_of_women = $req->input('number_of_women');
        $Delegation->number_of_children= $req->input('number_of_children');

        $Delegation->date_of_Visit = $req->input('date_of_Visit');
        $Delegation->visit_time = $req->input('visit_time');

        $Delegation->coordinator = $req->input('coordinator');
        $Delegation->contact_number = $req->input('contact_number');
        $Delegation->service_id   = $req->input('service_id');
        $Delegation->observe_id   = Session::get('id');
        if($req->input('observation')!==null)
        {$Delegation->observation = $req->input('observation');}
        $Delegation->save();
        return "تم إضافة النموذج بنجاح";
        }

    //ادخال وكالات
    public function store_algebrat(Request $request){
        $form=Blood_Of_Algebrat_Form::create($request->all()+['observe_id'=>Session::get('id')]);
        GUIObserverFormsController::store_adoption_of_the_committees($request,$form);
        foreach($request->institution as $inst){
            if(isset($inst['type'])){
            $blood_of_algebrat_form_institution= Blood_Of_Algebrat_Form_Institution::create([ 'number_of_carcasses'=>$inst['number_of_carcasses'],
            'type'=>$inst['type'],
            'name_of_delegate'=>$inst['name_of_delegate'],
            'form_id'=>$form['id'],
            'institution_id'=> $inst['institution_id']]);
             $blood_of_algebrat_form_institution->save();}

        }return "تم حفظ البيانات بنجاح";
    }
    // حفظ الاعضاء اللجنة
    public function store_adoption_of_the_committees(Request $request,$form){
        foreach($request->member as $member){
            if(isset($member['name'])){
             $adoption_of_the_committees=Adoption_Of_The_Committee::create([
                 'form_id'=>$form['id'],
                 'name'=>$member['name'],
                 'observation'=>$member['observation']
             ]);}$adoption_of_the_committees->save();
        }return "تم حفظ البيانات بنجاح";
    }

   //الكفارات
    public function store_Zakaat_Form(Request $request){

        $form=Atonement_And_Zakaat_Form::create($request->all()+['observe_id'=>Session::get('id')]);

        foreach($request->institution as $inst){
            if(isset($inst['count']))
           { $zakaat_form_institution= Zakaat_Form_Institution::create(
                [ 'count'=>$inst['count'],
                'recipient'=>$inst['recipient'],
                'form_id'=>$form['id'],
                'institution_id'=> $inst['institution_id']]);
                 $zakaat_form_institution->save();
        }}return "تم حفظ البيانات بنجاح";

     }



    }
