<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Proveedor;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\Patente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControladorProveedor extends Controller 
{
      public function nuevo()
      {
            $titulo = "Nuevo proveedor";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PROVEEDORALTA")) {
                    $codigo = "PROVEEDORALTA";
                    $mensaje = "No tiene permisos para la operación.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $proveedor = new Proveedor();
                    return view("sistema.proveedor-nuevo", compact("titulo", "proveedor"));
                }
            } else {
                return redirect('admin/login');
            }
      }

      public function index()
      {
      $proveedores = DB::table('proveedores')->get();
      }

      public function cargarGrilla()
      {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aClientes = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/cliente/' . $aClientes[$i]->idcliente . '">' . $aClientes[$i]->nombre . '</a>';
            $row[] = $aClientes[$i]->apellido;
            $row[] = $aClientes[$i]->correo;
            $row[] = $aClientes[$i]->dni;
            $row[] = $aClientes[$i]->celular;
            $row[] = $aClientes[$i]->clave;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}