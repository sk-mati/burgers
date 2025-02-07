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

        return view("web.carrito");
    }
}