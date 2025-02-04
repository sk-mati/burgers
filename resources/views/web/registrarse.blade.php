@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Registrarse
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
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
                <button type="submit" class="btn btn-hover">
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