@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Contactate
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
                <input type="text" class="form-control" placeholder="Nombre" name="txtNombre" id="txtNombre" required/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo" name="txtCorreo" id="txtCorreo" required/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Celular" name="txtCelular" id="txtCelular" required/>
              </div>
              <div>
                <textarea class="form-control" name="txtMensaje" id="txtMensaje" placeholder="Mensaje" required></textarea>
              </div>
              <div class="btn_box">
                <button>
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