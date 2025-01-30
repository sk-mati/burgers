@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Ingresar al sistema
        </h2>
      </div>
    <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="text" class="form-control" placeholder="Usuario"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Clave"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection