<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

use Session;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCarrito = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorId($idCarrito);

        return view("web.carrito", compact('aSucursales', 'aCarritos'));
    }
}