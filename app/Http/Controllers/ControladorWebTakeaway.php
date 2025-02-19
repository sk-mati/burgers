<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Categoria;
use App\Entidades\Carrito;
use Illuminate\Http\Request;

require app_path().'/start/constants.php';

use Session;

class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.takeaway", compact('aSucursales', 'aProductos', 'aCategorias', 'aCarritos'));
    }

    public function insertar(Request $request)
    {
        $idCliente = Session::get("idCliente");

        $idProducto = $request->input("txtProducto");
        $cantidad = $request->input("txtCantidad");

        if(isset($idCliente) && $idCliente > 0) {

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();

            $producto = new Producto();
            $aProductos = $producto->obtenerTodos();

            $categoria = new Categoria();
            $aCategorias = $categoria->obtenerTodos();

            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            if(isset($cantidad) && $cantidad > 0) {

                $carrito = new Carrito();
                $carrito->fk_idcliente = $idCliente;
                $carrito->fk_idproducto = $idProducto;
                $carrito->cantidad = $cantidad;
                $carrito->insertar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = "El producto se ha agregado al carrito.";
                return view('web.takeaway', compact('aSucursales', 'aProductos', 'aCategorias', 'aCarritos', 'msg'));
            } else {

                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "No agregó ningún producto al carrito.";
                return view('web.takeaway', compact('aSucursales', 'aProductos', 'aCategorias', 'aCarritos', 'msg'));
            }

        } else {

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();

            $producto = new Producto();
            $aProductos = $producto->obtenerTodos();

            $categoria = new Categoria();
            $aCategorias = $categoria->obtenerTodos();

            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Debe iniciar sesión para realizar un pedido.";
            return view('web.takeaway', compact('aSucursales', 'aProductos', 'aCategorias', 'aCarritos', 'msg')); 
        }
    }
}