<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;

class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.cambiar-clave", compact('aSucursales'));
    }
}