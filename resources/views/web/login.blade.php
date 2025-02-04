@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Ingresar al sistema
        </h2>
      </div>
      @if(isset($mensaje))
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-danger" role="alert">
            {{ $mensaje }}
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <label for="">Correo</label>
                <input type="text" class="form-control" placeholder="Ingresar correo" id="txtCorreo" name="txtCorreo"/>
              </div>
              <div>
                <label for="">Contraseña</label>
                <input type="password" class="form-control" placeholder="Ingresar clave" id="txtClave" name="txtClave"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary" name="btnIngresar">Ingresar</button>
              </div>
              <br>
              <a href="/recuperar-clave">Olvidé la clave</a>
              <br>
              <a href="/registrarse">¿No tenés cuenta? Registrate</a>
            </div>
        </div>
    </div>
</section>
@endsection