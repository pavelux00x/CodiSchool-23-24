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
    <p>Ora: {{ date('H:i') }}</p>
    <p> Ip Login: </p>
    <p id="ip"></p>
    <p>Codice utente: {{ $data['code'] }}</p>
    <p>Opt: {{ $data['otp'] }}</p>


    <script>
        fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                document.getElementById('ip').textContent = data.ip;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
    <br>
</body>
</html>