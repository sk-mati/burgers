<?php

namespace App\Http\Controllers;
use App\Entidades\Carrito;
use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Request;
use Session;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos"));
    }

    public function procesar(Request $request)
    {
        if (isset($_POST["btnBorrar"])) {
            $this->eliminar($request);
        } else if (isset($_POST["btnActualizar"])) {
            $this->actualizar($request);
        } else if (isset($_POST["btnFinalizar"])) { 
            $this->insertarPedido($request);
        }
    }

    public function actualizar(Request $request)
    {
        $cantidad = $request->input("txtCantidad");
        $carrito = new Carrito();
        $carrito->cantidad = $cantidad;
        $carrito->guardar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Producto actualizado exitosamente.";
        return view("web.carrito", compact('resultado'));
    }

    public function eliminar(Request $request)
    {
        $idCarrito = $request->input("txtCarrito");
        $carrito = new Carrito();
        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Producto eliminado exitosamente.";
        return view("web.carrito", compact('resultado'));
    }

    public function insertarPedido(Request $request)
    {
        
    }
}