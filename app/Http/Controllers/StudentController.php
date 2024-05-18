<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Dotenv\Dotenv; // At the top of your controller file
use Illuminate\Support\Facades\env; 
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Http;


class StudentController extends Controller
{
    //    


    public function logout(){
        Auth::guard('student')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        //wait 3 seconds and then redirect to the index page
        sleep(3);
        return redirect(route('index'));
    }

    public function login(Request $request){
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
    
        // If validation fails, return to the previous page with errors
        if ($validator->fails()) {
            Session::put('error', 'Inserisci correttamente le credenziali!');
            return redirect()->route('login.student_get')
                ->withInput();
        }
    
        // Attempting to authenticate the user
        if(Auth::guard('student')->attempt($request->only('email','password'))){
            return redirect()->route('student.dashboard');
        }
    
        // If credentials don't match, return to login with input data
        Session::put('error', 'Credenziali non valide');
        Session::put('email', $request->email);
        return redirect()->route('login.student_get')->withInput();
    }
    
    
    
    public function dashboard(){

        if(!Auth::guard('student')->check()){
            return redirect(route('login.student'));
        }


        //Query per ottenere i dati dello studente loggato
        $studente=Auth::guard('student')->user();


        $classe=DB::table('CLASSI')
        ->select('CLASSI.NOME')
        ->join('STUDENTI','STUDENTI.ID_CLASSE','=','CLASSI.ID')
        ->where('STUDENTI.ID','=',$studente->ID)
        ->get();

        $mediaVoti = DB::table('VOTI')
        ->join('STUDENTI', 'STUDENTI.ID', '=', 'VOTI.ID_STUDENTE')
        ->where('STUDENTI.ID', '=', $studente->ID)
        ->avg('VOTI.VALUTAZIONE');

        $professori=DB::table('PROFESSORI')
        ->select('PROFESSORI.*')
        ->join('INSEGNAMENTI','INSEGNAMENTI.ID_PROFESSORE','=','PROFESSORI.ID')
        ->join('CLASSI','CLASSI.ID','=','INSEGNAMENTI.ID_CLASSE')
        ->join('STUDENTI','STUDENTI.ID_CLASSE','=','CLASSI.ID')
        ->where('STUDENTI.ID','=',$studente->ID)
        ->get();

        $voti=DB::table('voti')
            ->select('VOTI.VALUTAZIONE', 'VOTI.DATA', 'VOTI.TIPO', 'VOTI.DESCRIZIONE', 'PROFESSORI.NOME as PROF', 'MATERIE.NOME as MATERIA','PROFESSORI.COGNOME as COGNOME')
            ->join('INSEGNAMENTI','INSEGNAMENTI.ID','=','VOTI.ID_INSEGNAMENTO')
            ->join('STUDENTI','STUDENTI.ID','=','VOTI.ID_STUDENTE')
            ->join('PROFESSORI','PROFESSORI.ID','=','INSEGNAMENTI.ID_PROFESSORE')
            ->join('MATERIE','MATERIE.ID','=','INSEGNAMENTI.ID_MATERIA')
            ->where('STUDENTI.ID','=',$studente->ID)->orderBy('VOTI.DATA','desc')
            ->get();
            if($voti->isEmpty()){
                $voti=null;
            }
        $compiti=DB::table('COMPITI')
        ->select('COMPITI.title','COMPITI.description','COMPITI.start','COMPITI.end')
        ->join('CLASSI','CLASSI.ID','=','COMPITI.CLASSE')
        ->join('STUDENTI','STUDENTI.ID_CLASSE','=','CLASSI.ID')
        ->where('STUDENTI.ID','=',$studente->ID)
        ->get();
        return view('codischool_dashboardstudent',compact('studente','classe','mediaVoti','professori','voti','compiti'));
    }



    public function generatePDF()
{
    if (!Auth::guard('student')->check()) {
        return redirect(route('login.student'));
    }

    $student = Auth::guard('student')->user();
    // ... Your logic to gather all required student data 
    $classe=DB::table('CLASSI')
    ->select('CLASSI.NOME')
    ->join('STUDENTI','STUDENTI.ID_CLASSE','=','CLASSI.ID')
    ->where('STUDENTI.ID','=',$student->ID)
    ->get();
    $mediaVoti = DB::table('VOTI')
    ->select(DB::raw('AVG(VALUTAZIONE) as media'))
    ->join('STUDENTI', 'STUDENTI.ID', '=', 'VOTI.ID_STUDENTE')
    ->where('STUDENTI.ID', '=', $student->ID)
    ->get();
    $mediaVoti = round($mediaVoti[0]->media, 2);
    $c=$classe[0]->NOME;
    $pdf = PDF::loadView('pdf.student_data', ['student' => $student, 'classe' => $c, 'mediaVoti' => $mediaVoti]);
    return $pdf->download('user_data.pdf');
}

public function sendChatMessage(Request $request)
    {
        if (!Auth::guard('student')->check()) {
            return response()->json(['error' => 'Unauthorized']);
        }
        $userMessage = $request->input('message');

        // Construct payload
        $payload = [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $userMessage,
                ],
                [
                    'role' => 'system',
                    'content' => 'Sei un bot veramente forte capace di capire tutto sopratutto i linguaggi di programmazione, il tuo compito è capire gli esercizi degli studenti e vedere dove ci sono errori, non è una domanda e non inziare mai con Si esatto',
                ]
            ],
            'max_tokens' => 800,
            'temperature' => 0.7,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'top_p' => 0.95,
            'stop' => null,
        ];
        $api_key = env('AZURE_API_KEY');
        $model=env('AZURE_ENDPOINT');
        // Make request to OpenAI API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $api_key, // Replace with your actual API key
        ])->post($model, $payload);

        // Get bot response
        $botResponse = $response->json('choices.0.message.content');

        return response()->json(['botResponse' => $botResponse]);
    }
}







