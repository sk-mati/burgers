<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;

use Session;

class ControladorWebLogin extends Controller
{
    public function index(Request $request)
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.login", compact('aSucursales', 'aCarritos'));
    }

    public function ingresar(Request $request)
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();
        $correo = $request->input("txtCorreo");
        $clave = $request->input("txtClave");

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        if($cliente->correo != ""){
            if(password_verify($clave, $cliente->clave)) {
                Session::put("idCliente", $cliente->idcliente);
                return redirect('/');
            } else {
                $mensaje =  "Credenciales incorrectas.";
                return view('web.login', compact('aSucursales', 'aCarritos', 'mensaje'));
            }
        }
    }

    public function logout(){
        Session::put("idCliente", "");
        return redirect("/");
    }
}