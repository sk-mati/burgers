<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;

use Session;

class ControladorWebPostulacionGracias extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.postulacion-gracias", compact('aSucursales'));
    }
}