<?php

namespace App\Http\Controllers;

use App\Mail\LoginTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    public function login(Request $request){
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'cod_login' => 'required|string|numeric|digits:4',
            'password' => 'required|string|min:6',
        ]);
    
        // If validation fails, return to the previous page with errors
        if ($validator->fails()) {
            Session::put('error', 'Inserisci correttamente le credenziali!');
            return redirect()->route('login.teacher_get')
                ->withInput();
        }
    
        // Attempting to authenticate the user
        if(Auth::guard('teacher')->attempt($request->only('cod_login','password'))){
            $teacher=Auth::guard('teacher')->user();
            $email=$teacher->EMAIL;
        #send email to the teacher with the advice that he has logged in

            $data = [
                'nome' => $teacher->NOME,
                'cognome' => $teacher->COGNOME,
                'email' => $email,
                'codice' => $teacher->cod_login,
];

            Mail::to($email)->send(new LoginTeacher($data));
            return redirect()->route('teacher.dashboard');
        }
    
        // If credentials don't match, return to login with input data
        Session::put('error', 'Credenziali non valide');
        Session::put('cod_login', $request->cod_login);
        return redirect()->route('login.teacher_get')->withInput();
    }

    public function dashboard(){
if(!Auth::guard('teacher')->check()){
            return redirect()->route('login.teacher_get');
}

$teacher = Auth::guard('teacher')->user();
#execute this query SELECT * FROM STUDENTI inner join INSEGNAMENTI on INSEGNAMENTI.ID_CLASSE=STUDENTI.ID_CLASSE inner join PROFESSORI on PROFESSORI.ID=INSEGNAMENTI.ID_PROFESSORE where PROFESSORI.ID=1;
#execute this query SELECT STUDENTI.NOME,STUDENTI.COGNOME,VOTI.VALUTAZIONE FROM VOTI,INSEGNAMENTI,PROFESSORI,STUDENTI,CLASSI where VOTI.ID_STUDENTE=STUDENTI.ID and STUDENTI.ID_CLASSE=CLASSI.ID and INSEGNAMENTI.ID_CLASSE=CLASSI.ID and INSEGNAMENTI.ID_PROFESSORE=PROFESSORI.ID and VOTI.ID_INSEGNAMENTO=INSEGNAMENTI.ID and PROFESSORI.ID=1 ORDER BY STUDENTI.COGNOME

$students = DB::table('STUDENTI')
        ->select('STUDENTI.*')
        ->distinct()  
        ->join('INSEGNAMENTI', 'INSEGNAMENTI.ID_CLASSE', '=', 'STUDENTI.ID_CLASSE')
        ->join('PROFESSORI', 'PROFESSORI.ID', '=', 'INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID', '=', $teacher->ID)
        ->orderBy('STUDENTI.COGNOME')
        ->get();
        $id_insegnamento=DB::table('INSEGNAMENTI')
        ->select('INSEGNAMENTI.ID')
        ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID','=',$teacher->ID)
        ->get();
        #distinct is used to avoid duplicates
        $classe=DB::table('CLASSI')
        ->select('CLASSI.*')
        ->distinct()
        ->join('INSEGNAMENTI','INSEGNAMENTI.ID_CLASSE','=','CLASSI.ID')
        ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID','=',$teacher->ID)
        ->get();

return view('teacher.teacher_dashboard', compact('teacher', 'students','classe'));

    }

    public function logout(){
        Auth::guard('teacher')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login.teacher_get');
    }

    public function mark(Request $request)
    {
        if(!Auth::guard('teacher')->check()){
            return redirect()->route('login.teacher_get');
        }
        $validator = Validator::make($request->all(), [
            'mark' => 'required|numeric|min:1|max:10',
            'student' => 'required|numeric',
            'tipo' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('teacher.dashboard')
                ->withInput()
                ->withErrors($validator);
        }


        $mark = request('mark');
        $student = request('student');
        $tipo = request('tipo');
        $classe=request('classe');
        $teacher = Auth::guard('teacher')->user();

        $id_insegnamento=DB::table('INSEGNAMENTI')
        ->select('INSEGNAMENTI.ID')
        ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID','=',$teacher->ID)
        ->get();

        DB::table('VOTI')->insert([
            'ID_STUDENTE' => $student,
            'ID_INSEGNAMENTO' => $id_insegnamento[0]->ID,
            'VALUTAZIONE' => $mark,
            'DATA' => now(),
            'TIPO' => $tipo,
            'DESCRIZIONE' => 'Voto assegnato da '.$teacher->NOME.' '.$teacher->COGNOME
        ]);

        //the method used by teacher.dashboard_class is POST, so we need to redirect to the previous page with the parameter student,teacher and classe
        return redirect()->route('teacher.dashboard_class_x', $classe)->withInput();
        
    }
    public function insert_homework(Request $request)
    {
      //validating the request data
      if(!Auth::guard('teacher')->check()){
            return redirect()->route('login.teacher_get');
        }
        $validator = Validator::make($request->all(), [
            'compito' => 'required|string',
            'materia' => 'required|string',
            'classe' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('teacher.dashboard')
                ->withInput()
                ->withErrors($validator);
        }

        $homework = $request->input('compito');
        $classe = $request->input('classe');
        $materia = $request->input('materia');

        $classeid=DB::table('CLASSI')
        ->select('CLASSI.ID')
        ->where('CLASSI.NOME','=',$classe)
        ->get();

        DB::table('COMPITI')->insert([
            'title' => $materia,
            'description' => $homework,
            'start'=> now(),
            'end'=> now(),
            'classe' => $classeid[0]->ID,
        ]);

        return redirect()->route('teacher.dashboard_class_x', $classe)->withInput();
    }

    public function dashboard_class(Request $request){
        if(!Auth::guard('teacher')->check()){
            return redirect()->route('login.teacher_get');
        }
        $classe=$request->input('classe');
        return redirect()->route('teacher.dashboard_class_x',$classe)->withInput();
        
        
    }

    public function dashboard_class_x($id){
        if(!Auth::guard('teacher')->check()){
            return redirect()->route('login.teacher_get');
        }
        $teacher = Auth::guard('teacher')->user();
        $classe=$id;
        $students = DB::table('STUDENTI')
        ->select('STUDENTI.*')
        ->distinct()
        ->join('INSEGNAMENTI', 'INSEGNAMENTI.ID_CLASSE', '=', 'STUDENTI.ID_CLASSE')
        ->join('PROFESSORI', 'PROFESSORI.ID', '=', 'INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID', '=', $teacher->ID)
        ->where('STUDENTI.ID_CLASSE','=',$classe)
        ->orderBy('STUDENTI.COGNOME')
        ->get();
        $id_insegnamento=DB::table('INSEGNAMENTI')
        ->select('INSEGNAMENTI.ID')
        ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
        ->where('PROFESSORI.ID','=',$teacher->ID)
        ->get();   
        $marks=DB::table('STUDENTI')
        ->select('STUDENTI.NOME','STUDENTI.COGNOME','VOTI.VALUTAZIONE','VOTI.DATA','VOTI.TIPO','CLASSI.ID as ID_CLASSE')
        ->distinct()
        ->join('CLASSI','CLASSI.ID','=','STUDENTI.ID_CLASSE')
        ->join('INSEGNAMENTI','INSEGNAMENTI.ID_CLASSE','=','CLASSI.ID')
        ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
        ->join('VOTI','VOTI.ID_STUDENTE','=','STUDENTI.ID')
        ->where('PROFESSORI.ID','=',$teacher->ID)
        ->where('CLASSI.ID','=',$classe)
        ->where('VOTI.ID_INSEGNAMENTO','=',$id_insegnamento[0]->ID)
        ->orderBy('STUDENTI.COGNOME')
        ->get();
        $materie=DB::table('INSEGNAMENTI')
        #SELECT MATERIE.NOME FROM `INSEGNAMENTI` inner join MATERIE on MATERIE.ID=INSEGNAMENTI.ID_MATERIA where ID_PROFESSORE=1
        ->select('MATERIE.NOME')
        ->join('MATERIE','MATERIE.ID','=','INSEGNAMENTI.ID_MATERIA')
        ->where('INSEGNAMENTI.ID_PROFESSORE','=',$teacher->ID)
        ->get();
        return view('teacher.dashboard_final', compact('teacher', 'students','classe','marks','materie'));
    }
}
