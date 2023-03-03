@extends('panel.master')

@section('panelContent')

<section>
  <h3 class="is-700">Cambiar contraseña</h3>
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
      <form action="{{ route('panel.account.access.form') }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="current_password"><b>Contraseña actual</b><span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="current_password" id="current_password">
        </div>
        <div class="form-group">
          <label for="new_password"><b>Nueva contraseña</b><span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="new_password" id="new_password">
        </div>
        <div class="form-group">
          <label for="repeat_password"><b>Repita la nueva contraseña</b><span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="repeat_password" id="repeat_password">
        </div>
        <button class="btn btn-primary">Guardar</button>
       </form>
    </div>
    @else
    <div class="col">
      <p>Estas iniciando sesión utilizando <a href="https://mi.argentina.gob.ar" target="_black" class="text-dark"><b>mi<span class="text-argentina">Argentina</span></b></a>.</p>
      <p>Si tu intención es cambiar la contraseña de miArgentina, ingresá a portal: <a href="https://mi.argentina.gob.ar" target="_black" class="text-dark"><b>mi<span class="text-argentina">Argentina</span></b></a></p>
      <p>Preguntas frecuentes: hace <a href="https://www.argentina.gob.ar/miargentina/preguntasfrecuentes" target="_blank">click acá</a></p>
      </p>
    </div>
    @endif
  </div>
</section>

@endsection