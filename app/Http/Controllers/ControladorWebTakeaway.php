<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Categoria;
use App\Entidades\Carrito;
use Illuminate\Http\Request;
require app_path() . '/start/constants.php';

use Session;


class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.takeaway", compact('aCategorias', 'aProductos', 'aSucursales'));
    }

    public function insertar(Request $request)
    {
        $idCliente = Session::get("idCliente");

        $idProducto = $request->input("txtProducto");
        $cantidad = $request->input("txtCantidad");

        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        if(isset($idCliente) && $idCliente > 0){
                if(isset($cantidad) && $cantidad > 0){
                    $carrito = new Carrito();
                    $carrito->fk_idcliente = $idCliente;
                    $carrito->fk_idproducto = $idProducto;
                    $carrito->cantidad = $cantidad;
                    $carrito->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = "El producto se ha agregado al carrito.";
                    return view('web.takeaway', compact('msg', 'aProductos', 'aCategorias', 'aSucursales'));
                } else {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "No agregó ningún producto al carrito.";
                    return view('web.takeaway', compact('msg', 'aProductos', 'aCategorias', 'aSucursales'));
                }
            } else {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Debe iniciar sesión para realizar un pedido.";
                return view('web.takeaway', compact('msg', 'aProductos', 'aCategorias', 'aSucursales'));
            }
    }
}