<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
class EmployeeLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
      $this->middleware('guest:observer', ['except' => ['logout']]);
      $this->middleware('guest:superviser', ['except' => ['logout']]);
      $this->middleware('guest:it', ['except' => ['logout']]);
    }


    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'userid'   => 'required',
        'userpass' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['id' => $request->userid, 'password' => $request->userpass])) {
        // if successful, then redirect to their intended location
        return  redirect()->intended(route('admin.dashboard'));
      }
      else if(Auth::guard('observer')->attempt(['id' => $request->userid, 'password' => $request->userpass] )){
        return redirect()->intended(route('observer.dashboard'));
      }
      else if(Auth::guard('superviser')->attempt(['id' => $request->userid, 'password' => $request->userpass])){
        return redirect()->intended(route('superviser.dashboard'));
      }
      else if(Auth::guard('it')->attempt(['id' => $request->userid, 'password' => $request->userpass])){
        return redirect()->intended(route('it.dashboard'));
      }
      else{
        redirect()->back()->with('success','الرقم السري او الرقم التعريفي خاطئة !');
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('id', 'remember'));
    }

    public function logout()
    {

     if(strcasecmp( session()->get('jop'),"رئيس برامج")==0){
         session()->flush();
         Auth::guard('admin')->logout();
         return redirect('/');
     }
      else if(strcasecmp( session()->get('jop'),"رئيس برنامج")==0){
         session()->flush();
         Auth::guard('superviser')->logout();
         return redirect('/'); }
     else if(strcasecmp( session()->get('jop'),"مشرف ميداني")==0){
        session()->flush();
        Auth::guard('observer')->logout();
        return redirect('/');
      }
      else if(strcasecmp( session()->get('jop')," إدارة تقنية المعلومات")==0){
        session()->flush();
       Auth::guard('it')->logout();
       return redirect('/');
      }
        session()->flush();
        return redirect('/'); 
    }
}
