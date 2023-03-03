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
				<div class="card-body">
					<div class="text-center">
						<h4 class=""><b>Ingresá con mi<span class="text-argentina">Argentina</span></b></h4>
						<h5 class="text-muted">Ingresá facilmente usando Mi Argentina</h5>
						<a href="{{ route('auth.miargentina') }}" class="">
						<div class="my-5 card shadow-sm d-inline-block">
							<div class="card-body py-4 px-5">
								<img src="{{asset('img/logo-miArgentina.png')}}" class="img-fluid" alt="Mi Argentina">
							</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<br>
			<div class="card shadow-sm">
				<div class="card-body text-center">
					<p class="text-muted">O podes ingresar utilizando otro método</p>
					<!-- button to route login -->
						<a href="{{ route('login') }}" class="btn btn-sm"><i class="far fa-envelope"></i>&nbsp;&nbsp;Ingresar con email</a>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection