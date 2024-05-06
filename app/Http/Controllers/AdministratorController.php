<?php

namespace App\Http\Controllers;
;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdministratorController extends Controller
{
    public function fafa(Request $request){
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:1',
        ]);
        // If validation fails, return to the previous page with errors

        if ($validator->fails()) {
            Session::put('error', 'Inserisci correttamente le credenziali!');
            return redirect()->route('login.admin_get')
                ->withInput();
        }
        // Attempting to authenticate the user
        if(Auth::guard('admin')->attempt($request->only('username','password'))){
            $admin=Auth::guard('admin')->user();
            return redirect()->route('admin.dashboard');
        }


    
}
public function dashboard(){
if(!Auth::guard('admin')->check()){
    return redirect()->route('login.admin_get');
}
$admin = Auth::guard('admin')->user();
return view('administrator.dashboard',compact('admin'));
}


public function logout(){
    Auth::guard('admin')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();;
    return redirect()->route('login.admin_get');
}
}

