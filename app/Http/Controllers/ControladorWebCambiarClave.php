<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Carrito;
use Illuminate\Http\Request;

use Session;

require app_path() . '/start/constants.php';

class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.cambiar-clave", compact('aSucursales', 'aCarritos'));
    }

    public function cambiar(Request $request)
    {
        $titulo = "Cambiar clave";
        $idCliente = Session::get("idCliente");
        $cliente = new Cliente();
        $clave1 = $request->input("txtClave1");
        $clave2 = $request->input("txtClave2");

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        if ($clave1 != "" && $clave1 == $clave2) {
            $cliente->obtenerPorId($idCliente);
            $cliente->clave = password_hash($clave1, PASSWORD_DEFAULT);
            $cliente->guardar();
            $msg["ESTADO"] = MSG_SUCCESS;
            $msg["MSG"] = "Cambiado correctamente.";
            return view('web.cambiar-clave', compact('msg', 'aSucursales', 'aCarritos'));
        } else {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Las contraseñas no coinciden.";
            return view('web.cambiar-clave', compact('msg', 'aSucursales', 'aCarritos'));
        }
    }
}