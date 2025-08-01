@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          ¿Olvidaste la clave?
        </h2>
        <p>
          Ingresa la dirección de correo electrónico con la que te registraste y
          te enviaremos las instrucciones para cambiar de clave.
        </p>
      </div>
    <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            @if(isset($mensaje))
              <div class="alert alert-secondary text-center" role="alert">
                {{ $mensaje }}
              </div>
            @endif
              <div>
                <input type="text" class="form-control" placeholder="Dirección de correo eléctronico" id="txtMail" name="txtMail"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Recuperar</button>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection