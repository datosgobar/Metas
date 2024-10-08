<div id="footer" class="bg-light">
  <div class="container">
    <div class="row text-smaller text-center text-lg-left">
      <div class="col-lg-4 mb-2 mb-lg-0">
        <img src="{{asset(app_setting('app_logo_footer','img/default-logo-color.svg'))}}" class="footer-logo" alt="">
        <p class="">
        {!! nl2br(e(app_setting('app_footer_description'))) !!}
        </p>
      </div>
      <div class="col-lg-4 mb-2 mb-lg-0">
        <p class="mb-1 mb-lg-2"><b>Más información</b></p>
        <p class="mb-1"><a href="{{route('about.general')}}">Acerca de</a></p>
        <p class="mb-1"><a href="{{route('about.faq')}}">Preguntas frecuentes</a></p>
        <p class="mb-1"><a href="{{route('about.legal')}}#términos">Legales</a></p>
      </div>
      <div class="col-lg-4 mb-2 mb-lg-0">
        <p class="mb-lg-2"><b>Contactenos</b></p>
        <p>{!! nl2br(e(app_setting('app_footer_contact_info'))) !!}</p>
      </div>
      {{-- <div class="col-lg-2 mb-0">
        <a href="https://democraciaenred.org" target="_blank"><img src="{{asset('img/der-black.svg')}}" class="footer-logo" alt="Democracia en Red"></a>
        <br>Desarrollado con <i class="far fa-heart text-danger"></i> por Democracia en Red
      </div> --}}
    </div>
  </div>
</div>
<div class="bg-argentina">
  <div id="post-footer" class="container">
    <div class="row py-4">
      <div class="col-12">
        <img src="{{asset('img/primerolagente.svg')}}" class="footer-logo" alt="Democracia en Red">
      </div>
    </div>
  </div>
</div>