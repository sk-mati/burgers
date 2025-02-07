<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;

class ControladorWebHome extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.index", compact('sucursal', 'aSucursales'));
    }
}