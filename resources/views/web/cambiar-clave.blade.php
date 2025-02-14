@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Cambio de clave
        </h2>
      </div>
    <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="password" class="form-control" placeholder="Nueva clave" id="txtClave" name="txtClave"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Repetir la nueva clave" id="txtClave" name="txtClave"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Aceptar</button>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection