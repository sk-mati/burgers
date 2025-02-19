<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Illuminate\Http\Request;

use Session;

require app_path() . '/start/constants.php';

class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.registrarse", compact("aSucursales", "aCarritos"));
    }

    public function registrarse(Request $request)
    {
        $entidad = new Cliente();
        $entidad->nombre = $request->input("txtNombre");
        $entidad->apellido = $request->input("txtApellido");
        $entidad->correo = $request->input("txtCorreo");
        $entidad->dni = $request->input("txtDni");
        $entidad->celular = $request->input("txtCelular");
        $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->correo == "" || $entidad->celular == "" || $entidad->clave == "") {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos.";
        } else {
            $entidad->insertar();
            $msg["ESTADO"] = MSG_SUCCESS;
            $msg["MSG"] = "Registro exitoso.";
        }  
        return view("web.registrarse", compact('msg', 'aSucursales', 'aCarritos'));
    }
}