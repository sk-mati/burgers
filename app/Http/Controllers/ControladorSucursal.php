<?php 

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
require app_path().'/start/constants.php';

class ControladorSucursal extends Controller 
{

      public function nuevo()
      {
            $titulo = "Nueva sucursal";
            return view("sistema.sucursal-nuevo", compact("titulo"));
      }

      public function index()
      {
        $titulo = "Listado de sucursales";
        return view("sistema.sucursal-listar", compact("titulo"));
      }

      public function guardar(Request $request) {
            try {
                $titulo = "Modificar sucursal";
                $entidad = new Sucursal();
                $entidad->cargarDesdeRequest($request);

                if ($entidad->telefono == "" || $entidad->direccion == "" || $entidad->linkmapa == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {

                        $entidad->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {

                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }

                    $_POST["id"] = $entidad->idsucursal;
                    return view('sistema.sucursal-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
    
            $id = $entidad->idsucursal;
            $sucursal = new Sucursal();
            $sucursal->obtenerPorId($id);

            return view('sistema.sucursal-nuevo', compact('msg', 'sucursal', 'titulo')) . '?id=' . $sucursal->idsucursal;
    
      }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sistema/sucursal/' . $aSucursales[$i]->idsucursal . '">' . $aSucursales[$i]->telefono . '</a>';
            $row[] = $aSucursales[$i]->direccion . '</a>';
            $row[] = $aSucursales[$i]->linkmapa . '</a>';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}