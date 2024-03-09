<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Mail\MailStudent_Teacher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class SendEmailController extends Controller
{
    //


public function sendEmail_teacher(Request $request){
    $request->validate([
        'email_studente' => 'required|email',
        'messaggio_da_inviare' => 'required|string|min:10|max:500',
        'nome_studente' => 'required|string',
        'email_professore'=>'required|email',
        'id'=>'required',
    ]);

    $data = [
        'email_studente' => $request->email_studente,
        'messaggio_da_inviare' => $request->messaggio_da_inviare,
        'nome_studente' => $request->nome_studente,
        'email_professore' => $request->email_professore,
    ];
    $id=$request->id;
    if(Mail::to($request->email_professore)->send(new MailStudent_Teacher($data))){
        sleep(5);
        Session::put('success','Email Inviata correttamente! ');
        }else{
        sleep(2);
        Session::put('error','Email non inviata ');
    }
    return redirect()->route('send.mail_teacher',$id)->withInput();




}

public function sendEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
        'name'=>'required|string',
        'corso'=>'required',
    ]);

    $data = [
        'email' => $request->email,
        'subject' => $request->subject,
        'bodyMessage' => $request->message,
        'name' => $request->name,
        'corso' => $request->corso,
    ];

    // Invia l'email
    if (Mail::to('pavel.filingeri00@gmail.com')->send(new ContactMail($data))) {
        Session::put('success', 'Email inviata con successo!');
    } else {
        Session::put('error', 'Si è verificato un errore durante l\'invio dell\'email.');
    }

    return redirect()->route('index','#contact')->withInput();
}



    public function mail_pass(Request $request, $id)
    {
        // Fix: Import the Auth class at the top of the file
        
        //prendi il nome dello studente loggato
        if(Auth::guard('student')->check()){
            $studenteLoggato = Auth::guard('student')->user();
            $emailStudente = $studenteLoggato->EMAIL;
            $nomeStudente = $studenteLoggato->NOME;
            $cognomeStudente = $studenteLoggato->COGNOME;
        
            $professore = DB::table('PROFESSORI')
                ->select('EMAIL', 'NOME', 'COGNOME')
                ->where('ID', '=', $id)
                ->first();
        
            // Controlla se il professore è stato trovato
            if ($professore) {
                $emailProf = $professore->EMAIL;
                $nomeProf = $professore->NOME;
                $cognomeProf = $professore->COGNOME;
        
                return view('codischool_sendemail', compact('id', 'emailStudente', 'nomeStudente', 'cognomeStudente', 'emailProf', 'nomeProf', 'cognomeProf'));
            } else {
                // Gestisci il caso in cui il professore non è stato trovato
                // ad esempio, reindirizza a una pagina di error
                return redirect()->route('index');
            }
        }
        else{
            return redirect(route('login.student'));
        }
        
    }
    

}