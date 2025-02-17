@extends("web.plantilla")
@section("contenido")
<section class="carrito layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Mi carrito
                  </h2>
            </div>
            @if(isset($mensaje))
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div class="alert alert-success" role="alert">
                      {{ $mensaje }}
                    </div>
                  </div>
                </div>
            @endif
            <div class="row">
                  @if($aCarritos)
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
                                                      <th>Acciones</th>
                                                      <th>Subtotal</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                $total = 0;
                                                ?>
                                                @foreach($aCarritos AS $carrito)
                                                <?php
                                                $subtotal = $carrito->precio * $carrito->cantidad;
                                                $total += $subtotal;
                                                ?>
                                                <tr>
                                                      <form action="" method="POST">
                                                            <td style="width: 10px; height: 10px;">
                                                                  <img src="/files/{{ $carrito->imagen }}" alt="" class="img-thumbnail">
                                                            </td>
                                                            <td>{{ $carrito->producto }}</td>
                                                            <td style="width: 0px;">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                                <input type="hidden" id="txtCarrito" name="txtCarrito" class="form-control" min="1" value="{{ $carrito->idcarrito }}">
                                                            </td>
                                                            <td>{{ $carrito->precio}}</td>
                                                            <td style="width: 10px;">
                                                                <input type="hidden" id="txtProducto" name="txtProducto" class="form-control" value="{{ $carrito->fk_idproducto}}">
                                                                <input type="number" id="txtCantidad" name="txtCantidad" class="form-control" min="1" value="{{ $carrito->cantidad}}">
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="submit" id="btnActualizar" name="btnActualizar" class="btn btn-info">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                                                        </svg>
                                                                    </button>
                                                                    <button type="submit" id="btnEliminar" name="btnEliminar" class="btn btn-danger">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td>$ {{ number_format($subtotal, 2, ",", ".") }}</td>
                                                      </form>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" style="text-align: right;">¿Te faltó algún producto?</td>
                                                    <td colspan="2" style="text-align: right;"><a href="/takeaway" class="btn btn-primary">Continuar pedido</a></td>
                                                </tr>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                    <div class="row mt-2 p-2">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>TOTAL: $ {{ number_format($total, 2, ",", ".") }}</th>
                                    </tr>
                                </thead>
                                <form action="" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="">Sucursal donde retirar el pedido: *</label>
                                                    <select name="lstSucursal" id="lstSucursal" class="form-select selectpicker" required>
                                                          <option value="" disabled selected>Seleccionar</option>
                                                          @foreach($aSucursales as $sucursal)
                                                                      <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                                                          @endforeach
                                                    </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">Método de pago: *</label>
                                                <select name="lstPago" id="lstPago" class="form-select selectpicker" required>
                                                    <option value="" disabled selected>Seleccionar</option>
                                                    <option value="Mercadopago">Mercado Pago</option>
                                                    <option value="Efectivo">Efectivo</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><button type="submit" class="btn btn-success" id="btnFinalizar" name="btnFinalizar">Finalizar pedido</button></td>
                                        </tr>
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                  </div>
                  @else
                  <div class="col-md-12">
                        <br>
                        <h4>No hay productos seleccionados.</h4>
                        <br>
                        <a href="/takeaway" class="btn btn-primary">Continuar pedido</a>
                        <a href="/mi-cuenta" class="btn btn-primary">Ir a mi cuenta</a>
                  </div>
                  @endif
            </div>
      </div>
</section>
@endsection