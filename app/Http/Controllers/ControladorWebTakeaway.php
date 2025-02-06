<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use Illuminate\Http\Request;
require app_path() . '/start/constants.php';

use Session;


class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        return view("web.takeaway", compact('producto', 'aProductos'));
    }
}