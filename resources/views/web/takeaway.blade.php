@extends("web.plantilla")
@section("contenido")
<section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Nuestro Menú
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">Todos</li>
        @foreach($aCategorias AS $categoria)
        <li data-filter=".burger">{{ $categoria->nombre}}</li>
        @endforeach
      </ul>

      <div class="filters-content">
        <div class="row grid">
          <div class="col-sm-6 col-lg-4 all {{ $producto->categoria }}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="/files/{{ $producto->imagen }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    {{ $producto->nombre }}
                  </h5>
                  <p>
                    Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque
                  </p>
                  <div class="options">
                    <h6>
                      ${{ number_format($producto->precio, 0, ",", ".") }}
                    </h6>
                    <form action="" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <input type="hidden" id="txtProducto" name="txtProducto" class="form-control" style="width: 50px;" value="{{ $producto->idproducto }}" required>
                      <input type="text" id="txtCantidad" name="txtCantidad" class="form-control" style="width: 50px;" value="{{ $producto->cantidad }}" required>
                    </form>
                    <button type="submit">Agregar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

@endsection