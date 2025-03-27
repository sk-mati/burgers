<div class="panel-body">
      <form id="form1" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="row">
                  <div class="form-group col-6">
                        <label>{{ $label1 }}</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $proveedor->nombre }}" required>
                  </div>
                  <div class="form-group col-6">
                        <label>{{ $label2 }}</label>
                        <input type="text" id="txtModelo" name="txtModelo" class="form-control" value="{{ $proveedor->modelo }}" required>
                  </div>
            </div>
            <div class="row">
                  <div class="form-group col-6">
                        <label>{{ $label3 }}</label>
                        <input type="text" id="txtUbicacion" name="txtUbicacion" class="form-control" value="{{ $proveedor->ubicacion }}" required>
                  </div>
                  <div class="form-group col-6">
                        <label>{{ $label4 }}</label>
                        <input type="text" id="txtTipoProducto" name="txtTipoProducto" class="form-control" value="{{ $proveedor->tipoproducto }}" required>
                  </div>
            </div>
            <div class="row">
                  <div class="form-group col-6">
                        <label>{{ $label5 }}</label>
                        <input type="text" id="txtRelacion" name="txtRelacion" class="form-control" value="{{ $proveedor->relacion }}" required>
                  </div>
                  <div class="form-group col-6">
                        <label>{{ $label6 }}</label>
                        <input type="text" id="txtRegularidad" name="txtRegularidad" class="form-control" value="{{ $proveedor->regularidad }}" required>
                  </div>
            </div>
      </form>
</div>