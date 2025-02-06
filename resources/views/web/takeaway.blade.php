@extends("web.plantilla")
@section("contenido")

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Nuestro Menú
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".fk_idcategoria">Burger</li>
        <li data-filter=".fk_idcategoria">Pizza</li>
        <li data-filter=".fk_idcategoria">Pasta</li>
        <li data-filter=".fk_idcategoria">Fries</li>
      </ul>

      <div class="filters-content">
      
        <div class="row grid">
        @foreach($aProductos AS $producto)
          <div class="col-sm-6 col-lg-4 d-block all {{ $producto->fk_idcategoria }}">
          
            <div class="box">
            
              <div>
                <div class="img-box">
                  <img src="web/images/f1.png" alt="">
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
                      ${{ $producto->precio }}
                    </h6>
                    <a href=""></a>
        
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          @endforeach
      <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

@endsection