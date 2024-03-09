<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Studenti : CodiSchool.it</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="{{ asset('assets/css/my-login.css') }}" rel="stylesheet">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="{{ asset('assets/img/logo.jpg') }}" alt="CodiSchool.it">
					</div>
<div class="card fat" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,.5);">
	<div class="card-body">

							<h4 class="card-title">Portale per lo studente</h4>
						@if (session('error'))
							<div class="alert alert-danger">
									{{ session('error') }}
									{{ Session::forget('error') }}
							</div>
						@endif


							<form method="POST" class="my-login-validation"  action="{{ route('login.student') }}">
								@csrf

								<div class="form-group">
									<label for="email">Email</label>
									<input id="number" type="text" class="form-control" name="email"
									 required placeholder="{{ session('email') }}">
									 @if (session('email'))
									 {{ Session::forget('email') }}
						@endif

								<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										{{-- <a href="forgot.html" class="float-right">
											Password dimenticata?
										</a> --}}
									</label>
									<input id="password" type="password" class="form-control" name="password" required >
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>
								<br><br>

								<div class="form-group m-0">
								<input type="submit" class="btn btn-primary btn-block" value="Send">
										
									</input>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
					Copyright &copy; 2024 CodiSchool.it
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
</html>
