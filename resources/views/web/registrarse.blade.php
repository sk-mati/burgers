@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Registrarse
        </h2>
      </div>
      @if(isset($msg))
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-{{ $msg['ESTADO'] }}" role="alert">
            {{ $msg['MSG'] }}
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
                <input type="text" class="form-control" placeholder="Nombre" id="txtNombre" name="txtNombre"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Apellido" id="txtApellido" name="txtApellido"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo" id="txtCorreo" name="txtCorreo"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Celular" id="txtCelular" name="txtCelular"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Clave" id="txtClave" name="txtClave"/>
              </div>
              <div class="">
                <button type="submit" class="btn btn-primary">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection