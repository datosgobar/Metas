@extends('layouts.app')

@section('content')
<div class="container push-to-header">
	<div class="row justify-content-center">
		<div class="col-md-10 col-lg-8">
			<div class="text-center">
				<img src="{{asset(app_setting('app_logo_white','img/default-logo-white.svg'))}}" class="img-fluid logo-home-smaller mb-5 mt-2"
					alt="{{ config('app.name', 'Laravel') }}">
			</div>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="card shadow-sm">
				<div class="card-body py-4">
					<h5 class="text-center mb-4"><b>Ingresár con email</b></h5>


					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autofocus>

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
									name="password" required>

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" name="remember" id="remember"
										{{ old('remember') ? 'checked' : '' }}>

									<label class="custom-control-label" for="remember">
										{{ __('Remember Me') }}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									<i class="fas fa-sign-in-alt"></i>&nbsp;{{ __('Login') }}
								</button>
								@if (Route::has('password.request'))
								<a class="btn btn-text btn-sm" href="{{ route('password.request') }}">
									<i class="fas fa-question-circle"></i>&nbsp;{{ __('Forgot Your Password?') }}
								</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
			<br/>
			<div class="card shadow-sm">
				<div class="card-body py-4">
					<div class="row mb-0">
						<div class="col-md-12 text-center">
							<p class="text-muted">O creá una cuenta con tú email</p>
							<a class="btn btn-outline-white text-primary" href="{{ route('register') }}">
								<i class="fas fa-user-plus fa-fw"></i>&nbsp;{{ __('Registrarse') }}
							</a>
						</div>
					</div>
				</div>
			</div>
			<br/>
			<div class="card shadow-sm">
				<div class="card-body text-center">
					<p class="text-muted">O podes ingresar utilizando otro método</p>
					<!-- button to route login -->
						<a href="{{ route('auth.miargentina') }}" class="btn btn-sm">
							<img src="{{asset('img/logo-miArgentina.png')}}" class="img-fluid" width="120" alt="Mi Argentina">
						</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection