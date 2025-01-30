<?php 

namespace App\Http\Controllers;
use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Estado;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
require app_path().'/start/constants.php';

class ControladorPedido extends Controller 
{

      public function nuevo()
      {
            $titulo = "Nuevo pedido";

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PEDIDOALTA")) {
                    $codigo = "PEDIDOALTA";
                    $mensaje = "No tiene permisos para la operación.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $pedido = new Pedido();
                    $sucursal = new Sucursal();
                    $aSucursales = $sucursal->obtenerTodos();
                    $cliente = new Cliente();
                    $aClientes = $cliente->obtenerTodos();
                    $estado = new Estado();
                    $aEstados = $estado->obtenerTodos();
                    return view("sistema.pedido-nuevo", compact("titulo", "pedido", "aSucursales", "aClientes", "aEstados"));
                }
            } else {
                return redirect('admin/login');
            }
      }

      public function index()
      {
        $titulo = "Listado de pedidos";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PEDIDOCONSULTA")) {
                $codigo = "PEDIDOCONSULTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("sistema.pedido-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
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
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            $cliente = new Cliente();
            $aClientes = $cliente->obtenerTodos();
            $estado = new Estado();
            $aEstados = $estado->obtenerTodos();

            return view('sistema.pedido-nuevo', compact('msg', 'pedido', 'titulo', 'aSucursales', 'aClientes', 'aEstados')) . '?id=' . $pedido->idpedido;
    
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
            $row[] = '<a href="/admin/pedido/' . $aPedidos[$i]->idpedido . '">' . date_format(date_create($aPedidos[$i]->fecha), 'd/m/Y') . '</a>';
            $row[] = $aPedidos[$i]->descripcion;
            $row[] = number_format($aPedidos[$i]->total, 2, ",", ".");
            $row[] = $aPedidos[$i]->sucursal;
            $row[] = $aPedidos[$i]->cliente;
            $row[] = $aPedidos[$i]->estado;
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

        public function editar($idPedido){
            $titulo = "Edición de pedido";

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("PEDIDOEDITAR")) {
                    $codigo = "PEDIDOEDITAR";
                    $mensaje = "No tiene permisos para la operación.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $pedido = new Pedido();
                    $pedido->obtenerPorId($idPedido);
                    $sucursal = new Sucursal();
                    $aSucursales = $sucursal->obtenerTodos();
                    $cliente = new Cliente();
                    $aClientes = $cliente->obtenerTodos();
                    $estado = new Estado();
                    $aEstados = $estado->obtenerTodos();
                    return view("sistema.pedido-nuevo", compact("titulo", "pedido", "aSucursales", "aClientes", "aEstados"));
                }
            } else {
                return redirect('admin/login');
            }
        }

        public function eliminar(Request $request){

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("SUCURSALBAJA")) {
                    $resultado["err"] = EXIT_FAILURE;
                    $resultado["mensaje"] = "No tiene permisos para la operación.";
                } else {
                    $idPedido = $request->input("id");
                    $pedido = new Pedido();
                        
                    $pedido->idpedido = $idPedido;
                    $pedido->eliminar();
                    $resultado["err"] = EXIT_SUCCESS;
                    $resultado["mensaje"] = "Registro eliminado exitosamente.";
                    }
                } else {
                $resultado["err"] = EXIT_FAILURE;
                $resultado["mensaje"] = "Usuario no autenticado";
            }
             return json_encode($resultado);
        }
}