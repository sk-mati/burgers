@extends("web.plantilla")
@section("contenido")
  <!-- food section -->
  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Nuestro Menú
        </h2>
        <br>
      </div>
      @if(isset($msg))
        <div class="row">
          <div class="col-12 text-center">
            <div class="alert alert-{{ $msg['ESTADO'] }}" role="alert">
              {{ $msg["MSG"] }}
            </div>
          </div>
        </div>
      @endif

      <ul class="filters_menu">
        <li class="active" data-filter="*">Todos</li>
        @foreach($aCategorias AS $categoria)
        <li data-filter=".{{ $categoria->idcategoria }}">{{ $categoria->nombre }}</li>
        @endforeach
      </ul>

  <div class="filters-content">
    <div class="row grid">
      @foreach($aProductos AS $producto)
      <div class="col-sm-6 col-lg-4 all {{ $producto->fk_idcategoria }}">
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
                {{ $producto->descripcion }}
              </p>
              <div class="options">
                <h6>
                  $ {{ number_format($producto->precio, 0, ",", ".") }}
                </h6>
                <form action="" method="POST">
                  <div class="row">
                    <div class="col-12">
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                          <input type="hidden" id="txtProducto" name="txtProducto" class="form-control" style="width: 125px;" min="1" value="{{ $producto->idproducto }}" required>
                          <input type="number" id="txtCantidad" name="txtCantidad" class="form-control" style="width: 125px;" placeholder="Cantidad" min="1" value="">
                        </div>
                        <div class="col-4">
                          <button type="submit" class="btn btn-carrito">
                            <a href="" class="cart_link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                              </svg>
                            </a>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
    <div class="btn-box">
        <a href="/carrito">
          Ir al carrito
        </a>
      </div>
  </section>
  @endsection