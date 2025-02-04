<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.registrarse", compact("aSucursales"));
    }

    public function registrarse(Request $request)
    {
        $entidad = new Cliente();
        $entidad->nombre = $request->input("txtNombre");
        $entidad->apellido = $request->input("txtApellido");
        $entidad->correo = $request->input("txtCorreo");
        $entidad->celular = $request->input("txtCelular");
        $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->correo == "" || $entidad->celular == "" || $entidad->clave == "") {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos";
            return view("web.registrarse", compact('titulo', 'msg', 'aSucursales'));
        } else {
            $entidad->insertar();
            return redirect("/login");
        }  
    }
}