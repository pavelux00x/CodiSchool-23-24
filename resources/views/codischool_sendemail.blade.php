<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

*, body {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
}

html, body {
    height: 100%;
    background-color: #152733;
    display: inline !important;
}


.form-holder {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 100vh;
}

.form-holder .form-content {
    position: relative;
    text-align: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-align-items: center;
    align-items: center;
    padding: 60px;
}

.form-content .form-items {
    border: 3px solid #fff;
    padding: 40px;
    width: 100%;
    min-width: 540px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    text-align: left;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

.form-content h3 {
    color: #fff;
    text-align: left;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 5px;
}

.form-content h3.form-title {
    margin-bottom: 30px;
}

.form-content p {
    color: #fff;
    text-align: left;
    font-size: 17px;
    font-weight: 300;
    line-height: 20px;
    margin-bottom: 30px;
}


.form-content label, .was-validated .form-check-input:invalid~.form-check-label, .was-validated .form-check-input:valid~.form-check-label{
    color: #fff;
}

.form-content input[type=text], .form-content input[type=password], .form-content input[type=email], .form-content select {
    width: 100%;
    padding: 9px 20px;
    text-align: left;
    border: 0;
    outline: 0;
    border-radius: 6px;
    background-color: #fff;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    margin-top: 16px;
}


.btn-primary{
    background-color: #6C757D;
    outline: none;
    border: 0px;
     box-shadow: none;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active{
    background-color: #495056;
    outline: none !important;
    border: none !important;
     box-shadow: none;
}

.form-content textarea {
    position: static !important;
    width: 100%;
    padding: 8px 20px;
    border-radius: 6px;
    text-align: left;
    background-color: #fff;
    border: 0;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    outline: none;
    resize: none;
    height: 120px;
    -webkit-transition: none;
    transition: none;
    margin-bottom: 14px;
}

.form-content textarea:hover, .form-content textarea:focus {
    border: 0;
    background-color: #ebeff8;
    color: #8D8D8D;
}

.mv-up{
    margin-top: -9px !important;
    margin-bottom: 8px !important;
}

.invalid-feedback{
    color: #ff606e;
}

.valid-feedback{
   color: #2acc80;
}
  </style>
  </head>
  <body>
   <!-- @dump(session()->all()) -->



    <div class="form-body">
      <div class="row">
          <div class="form-holder">
              <div class="form-content">
                  <div class="form-items">
                      <h3>Contatto Veloce</h3>
                      <p>Professore: {{ $nomeProf }} {{ $cognomeProf }}</p>
                      <form class="requires-validation" novalidate method="POST" action="{{ route('send.mail_teacher_due') }}">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            {{ Session::forget('success') }}
                            <script>
                              setTimeout(function() {
                                  window.location.href = "/student/dashboard";
                              }, 2000);
                          </script>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @csrf
                          <div class="col-md-12">
                            <label for="name">Nome Studente: </label>
                             <input class="form-control" type="text" name="nome_studente" placeholder="{{ $nomeStudente }} {{$cognomeStudente  }}" required readonly value="{{ $nomeStudente }} {{ $cognomeStudente }}">
                          </div>
                          <br>
                          <div class="col-md-12">
                            <label for="email">Email Studente: </label>
                              <input class="form-control" type="email" name="email_studente" placeholder="{{ $emailStudente }}" required readonly value="{{ $emailStudente }}">
                          </div>
                          <br>
                         <div class="col-md-12">
                          <label for="position">Email Professore: </label>
                            <input class="form-control" type="text" name="email_professore" placeholder="{{ $emailProf }}" required readonly value="{{ $emailProf }}">
                         </div>

                         <br>
                         <div class="col-md-12">
                          <label for="message">Messaggio: </label>
                            
                          <textarea class="form-control" id="message" name="messaggio_da_inviare" placeholder="Messaggio" required></textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
                

                          <div class="form-button mt-3">
                              <button id="submit" type="submit" class="btn btn-success" disabled >Invio</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      //disabilita il pulsante di invio
        const messageInput = document.getElementById("message");
        const submitButton = document.getElementById("submit");

        // Aggiungi un gestore di eventi per controllare la lunghezza del messaggio
        messageInput.addEventListener("input", function() {
            // Controlla se il numero di caratteri è maggiore di 10
            if (messageInput.value.length >= 10) {
                submitButton.removeAttribute("disabled"); // Abilita il pulsante
            } else {
                submitButton.setAttribute("disabled", "disabled"); // Disabilita il pulsante
            }
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>