@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Datos del usuario
        </h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form_container">
            <form action="" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre" value="{{ $cliente->nombre }}"/>
                  </div>
                  <div class="col-md-6">
                    <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido" value="{{ $cliente->apellido }}"/>
                  </div>
                  <div class="col-md-6">
                    <input type="text" id="txtCelular" name="txtCelular" class="form-control" placeholder="Celular" value="{{ $cliente->celular }}"/>
                  </div>
                  <div class="col-md-6">
                    <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Correo" value="{{ $cliente->correo }}"/>
                  </div>
                </div>
              <div class="btn_box text-center">
                <button>
                  Guardar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="heading_container">
        <h2>
          Pedidos activos
        </h2>
      </div>
      <div class="row">
        <div class="col 12">
            <table class="table table-hover">
                <tr>
                    <th>Sucursal</th>
                    <th>Estado</th>
                </tr>
            </table>
        </div>
      </div>
    </div>
  </section>
@endsection