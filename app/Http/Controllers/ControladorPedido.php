<?php 

namespace App\Http\Controllers;
use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Estado;
use Illuminate\Http\Request;
require app_path().'/start/constants.php';

class ControladorPedido extends Controller 
{

      public function nuevo()
      {
            $titulo = "Nuevo pedido";
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            $cliente = new Cliente();
            $aClientes = $cliente->obtenerTodos();
            $estado = new Estado();
            $aEstados = $estado->obtenerTodos();
            return view("sistema.pedido-nuevo", compact("titulo", "aSucursales", "aClientes", "aEstados"));
      }

      public function index()
      {
        $titulo = "Listado de pedidos";
        return view("sistema.pedido-listar", compact("titulo"));
      }

      public function guardar(Request $request) {
            try {
                $titulo = "Modificar pedido";
                $entidad = new Pedido();
                $entidad->cargarDesdeRequest($request);
    
                if ($entidad->fecha == "" || $entidad->descripcion == "" || $entidad->total == "" || $entidad->fk_idsucursal == "" || $entidad->fk_idcliente == "" || $entidad->fk_idestado == "") {
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

                    $_POST["id"] = $entidad->idpedido;
                    return view('sistema.pedido-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
    
            $id = $entidad->idpedido;
            $pedido = new Pedido();
            $pedido->obtenerPorId($id);

            return view('sistema.pedido-nuevo', compact('msg', 'pedido', 'titulo')) . '?id=' . $pedido->idpedido;
    
      }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sistema/pedido/' . $aPedidos[$i]->idpedido . '">' . $aPedidos[$i]->fecha . '</a>';
            $row[] = $aPedidos[$i]->descripcion;
            $row[] = $aPedidos[$i]->total;
            $row[] = $aPedidos[$i]->fk_idsucursal;
            $row[] = $aPedidos[$i]->fk_idcliente;
            $row[] = $aPedidos[$i]->fk_idestado;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}