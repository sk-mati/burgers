<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;
use App\Entidades\Pedido;
use App\Entidades\Pedido_producto;
use Illuminate\Http\Request;

use Session;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.carrito", compact('aSucursales', 'aCarritos'));
    }

    public function procesar(Request $request) 
    {
        if (isset($_POST["btnEliminar"])) {
            $this->eliminar($request);
        } else if (isset($_POST["btnActualizar"])) {
            $this->actualizar($request);
        } else if (isset($_POST["btnFinalizar"])) {
            $this->insertarPedido($request);
        }
    }

    public function actualizar(Request $request) 
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
    
        $carrito = new Carrito();

        $cantidad = $request->input("txtCantidad");
        $idProducto = $request->input("txtProducto");
        $idCarrito = $request->input("txtCarrito");
        
        $carrito->idcarrito = $idCarrito;
        $carrito->cantidad = $cantidad;
        $carrito->fk_idcliente = $idCliente;
        $carrito->fk_idproducto = $idProducto;
        $carrito->guardar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Producto actualizado exitosamente.";
        return view("web.carrito", compact('resultado', 'aSucursales', 'aCarritos'));
    }

    public function eliminar(Request $request) 
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $idCarrito = $request->input("txtCarrito");
        $carrito = new Carrito();
        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Producto eliminado exitosamente.";
        return view("web.carrito", compact('resultado', 'aSucursales', 'aCarritos'));
    }

    public function insertarPedido(Request $request)
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $total = 0;
        foreach ($aCarritos AS $item) {
            $total += $item->cantidad * $item->precio;
        }

        $sucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");
        $fecha = date("Y-m-d");

        $pedido = new Pedido();
        $pedido->fk_idsucursal = $sucursal;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestado = 1;
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->pago = $pago;
        $pedido->insertar();

        $pedidoProducto = new Pedido_producto();
        foreach ($aCarritos AS $item) {
            $pedidoProducto->fk_idproducto = $item->fk_idproducto;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->insertar();
        }

        $carrito->eliminarPorCliente($idCliente);

        $msg["err"] = MSG_SUCCESS;
        $msg["mensaje"] = "El pedido se ha confirmado correctamente.";
        return view("web.carrito", compact('msg', 'aSucursales', 'aCarritos'));
    }
}