@extends("web.plantilla")
@section("contenido")
<section class="carrito layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Mi carrito
                  </h2>
            </div>
            <div class="row">
                  <div class="col-md-9">
                        <div class="row mt-2 p-2">
                              <div class="col-md-12">
                                    <table class="table table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Producto</th>
                                                      <th></th>
                                                      <th></th>
                                                      <th>Precio</th>
                                                      <th style="width:15px;">Cantidad</th>
                                                      <th></th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <tr>
                                                @foreach($aCarritos AS $carrito)
                                                      <td>{{ $carrito->fk_idproducto }}</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td>{{ $carrito->fk_idcliente }}</td>
                                                @endforeach
                                                </tr>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
@endsection