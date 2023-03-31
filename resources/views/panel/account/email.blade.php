@extends('panel.master')

@section('panelContent')

<section>
<h3 class="is-700">Cambiar mi email</h3>
<p class="lead">Si querés modificar tu dirección de email, podés hacerlo completando los siguientes campos:</p>
<hr>
   @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
  @endif
  <div class="row">
    @if(!Auth::user()->isOidcUser())
    <div class="col col-md-8">
      <form action="{{ route('panel.account.email.form') }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label><b>Ingrese el email actual</b></label>
          <input type="email" class="form-control" name="old_email">
          <small class="form-text text-muted">Este es el email que usa actualmente para iniciar sesión, y que dejará de usar.</small>
        </div>
        <div class="form-group">
          <label><b>Ingrese su nuevo email</b></label>
          <input type="email" class="form-control" name="new_email">
          <small class="form-text text-muted">El nuevo email que usará para iniciar sesión. Asi mismo, debera verificar este email.</small>
        </div>
        <div class="form-group">
          <label><b>Ingrese su contraseña</b><span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password">
          <small class="form-text text-muted">Complete con su contraseña</small>
        </div>
        <button class="btn btn-primary">Guardar</button>
       </form>
    </div>
    @else
    <div class="col">
      <p>Estas iniciando sesión utilizando miArgentina, por lo que para hacerlo, tenes que hacerlo desde el sitio de miArgentina.</p>
      <p>Una vez que hayas cambiado tu email en miArgentina, el cambio se verá reflejado la proxima vez que inicies sesión.</p>
      <p>Tu email actual es: <b>{{ Auth::user()->email }}</b></p>
      <p>Para hacerlo, ingresá a <a href="https://mi.argentina.gob.ar" target="_black" class="text-dark"><b>mi<span class="text-argentina">Argentina</span></b></a></p>
      <p>Preguntas frecuentes: hace <a href="https://www.argentina.gob.ar/miargentina/preguntasfrecuentes" target="_blank">click acá</a></p>
      </p>
    </div>
    @endif
  </div>
</section>

@endsection