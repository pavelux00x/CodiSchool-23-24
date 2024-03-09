<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>X</title>
</head>
<body>
    <h1>Email Richiesta di contatto da: </h1>
    <p>Nome e Cognome: {{ $data['nome_studente'] }}</p>
    <br>
    <p>Email: {{ $data['email_studente'] }}</p>
    <br>
    <p>Motivazione: {{ $data['messaggio_da_inviare'] }} </p>
    <br>
</body>
</html>