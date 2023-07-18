@extends('layouts.admin')

@section('content')

<div class="container push-to-header">
  @if($objective->hidden)
  <div class="alert alert-info">
    <i class="fas fa-info-circle"></i>&nbsp;Nota: El objetivo se encuentra <b>oculto</b>. <a href="{{route('objectives.manage.configuration', ['objectiveId' => $objective->id]) }}">Cambiar<i class="fas fa-arrow-right fa-fw"></i></a>
  </div>
  @endif
  @isOnlyReporter($objective->id)
  <div class="alert alert-primary">
  <i class="fas fa-user-edit"></i>&nbsp;Tu rol te permite <b>Reportar</b> en metas del objetivo</a>
  </div>
  @endisOnlyReporter
  @isOnlyManager($objective->id)
  <div class="alert alert-primary">
  <i class="fas fa-user-shield"></i>&nbsp;Tu rol te pemite <b>Coordinar</b> el objetivo</a>
  </div>
  @endisOnlyManager
  <div class="row">
    <div class="col-md-4 col-lg-3">
      <div id="menu" class="card shadow-sm rounded">
        <div class="card-body">

      @include('objective.manage.goals.menu')
        </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-9">
      <div class="card shadow-sm rounded">
        <div class="card-body p-3 p-lg-5">
      @yield('panelContent')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection