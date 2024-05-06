
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Codi-School (Teachers)</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="{{ asset('assets/css/teacher/style.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">	
			<form class="login" action="{{ route('login.teacher') }}" method="POST">
				@csrf
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="number" class="login__input" placeholder="Codice Utente" name="cod_login" required>
					@if (session('cod_login'))
						{{ Session::forget('cod_login') }}
					@endif
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password" required>
				</div>
				<button class="button login__submit" name="bottone_invio">
					<span class="button__text">Accedi</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			<div class="social-login">
				<h3>Codi-School</h3>
				<h7>Owned by Pavel.F</h7>
				<br></br>
				<strong><h8>Portale-Docenti</h8></strong>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
<script>
@if (session('error'))
	alert("{{ session('error') }}");
	{{ Session::forget('error') }}
@endif
</script>
</body>
</html>
