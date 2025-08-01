@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.min.js') }}"></script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
    <li class="breadcrumb-item active">Proveedores</a></li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/proveedor/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Recargar" href="#" class="fa fa-refresh" aria-hidden="true" onclick='window.location.replace("/admin/proveedores");'><span>Recargar</span></a></li>
</ol>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div id = "msg"></div>
<table id="grilla" class="display">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Ubicación</th>
            <th>Tipo de producto</th>
            <th>Relación</th>
            <th>Regularidad</th>
        </tr>
    </thead>
</table> 
<script>
	var dataTable = $('#grilla').DataTable({
	      "processing": true,
            "serverSide": true,
	      "bFilter": true,
	      "bInfo": true,
	      "bSearchable": true,
            "pageLength": 25,
            "order": [[ 0, "asc" ]],
	      "ajax": "{{ route('proveedor.cargarGrilla') }}"
	});
</script>
@endsection