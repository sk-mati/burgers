@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Recuperar la clave
        </h2>
        <p>
            ¿Olvidaste la clave?
            Ingresa la dirección de correo electrónico con la que te registraste y
            te enviaremos las instrucciones para cambiar de clave.
        </p>
      </div>
    <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="text" class="form-control" placeholder="Dirección de correo eléctronico"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Recuperar</button>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection