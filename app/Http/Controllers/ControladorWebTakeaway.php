<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Categoria;

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

        return view("web.takeaway", compact('sucursal', 'aSucursales', 'producto', 'aProductos', 'categoria', 'aCategorias'));
    }

    public function insertar()
    {
        
    }
}