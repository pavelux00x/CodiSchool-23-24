<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>X</title>
</head>
<body>
    <h1>Login Effettuato: </h1>
    <p>Nome e Cognome: {{ $data['nome'] }} {{ $data['cognome'] }}</p>
    <br>
    <p>Email: {{ $data['email'] }}</p>
    <br>
    <p>Codice {{ $data['codice'] }}</p>
    <p>Ora: {{ date('H:i') }}</p>
    <br>
</body>
</html>