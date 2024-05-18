<?php

namespace App\Http\Controllers;
;

use App\Mail\AdministratorLogin;
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
    else{
        Session::put('error', 'Credenziali non valide');
        Session::put('username', $request->username);
        return redirect()->route('login.admin_get')->withInput();
    }


    
}
public function dashboard(){
if(!Auth::guard('admin')->check()){
    return redirect()->route('login.admin_get');
}

return redirect()->route('admin.opt');
}


public function logout(){
    Auth::guard('admin')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();;
    return redirect()->route('login.admin_get');
}


public function opt(){
    if(!Auth::guard('admin')->check()){
        return redirect()->route('login.admin_get');
    }
    $codice_otp = rand(10000,99999);
    $admin=Auth::guard('admin')->user();
    //update the code in the database
    DB::table('ADMIN')
    ->where('username', $admin->username)
    ->update(['code' => $codice_otp]);
    $data = [
        'code' => $admin->username,
        'otp' => $codice_otp,
    ];
    Mail::to('pavelfilingeri.2@proton.me')->send(new AdministratorLogin($data));
    return view('administrator.otp');


}
public function admin_dashboard_final(Request $request){
    if(!Auth::guard('admin')->check()){
        return redirect()->route('login.admin_get');
    }
    $admin=Auth::guard('admin')->user();
    $codice_otp = $admin->code;
    $opt=$request->otp;
    if($codice_otp == $opt){
        $classi=DB::table('CLASSI')->get();
        $studenti=DB::table('STUDENTI')->get();
        $professori=DB::table('PROFESSORI')->get();
        
        return view('administrator.dashboard', ['admin' => $admin, 'classi' => $classi, 'studenti' => $studenti, 'professori' => $professori]);
    }
    else{
        Session::put('error', 'OTP non valido');
        return redirect()->route('login.admin_get');
    }
}



public function getStudentMarks($studentId)
{
    if(!Auth::guard('admin')->check()){
        $message="Non sei autorizzato a visualizzare questa pagina";
        return response()->json($message);
    }
    $marks = DB::table('VOTI')->where('ID_STUDENTE', $studentId)->get();

    // Return the marks in JSON format
    return response()->json($marks);
}



public function getStudentsByClass($classId)
{
    if(!Auth::guard('admin')->check()){
        $message="Non sei autorizzato a visualizzare questa pagina";
        return response()->json($message);
    }
    $students = DB::table('STUDENTI')->where('ID_CLASSE', $classId)->get();

    // Return the students in JSON format
    return response()->json($students);

}

public function getTeachers($teacherId)
{
    if(!Auth::guard('admin')->check()){
        $message="Non sei autorizzato a visualizzare questa pagina";
        return response()->json($message);
    }
    $teacher = DB::table('PROFESSORI')->where('ID', $teacherId)->get();
    return response()->json($teacher);

}

}

