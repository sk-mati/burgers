<?php

namespace App\Http\Controllers;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Pedido;
use Illuminate\Http\Request;

use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        if($idCliente != ""){

        $cliente = new Cliente();
        $cliente->obtenerPorId($idCliente);

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPedidosPorCliente($idCliente);

        return view("web.mi-cuenta", compact("cliente", "aSucursales", "aPedidos"));
        } else {
            return redirect("/login");
        }
    }

    public function guardar(Request $request)
    {
        $cliente = new Cliente();
        $cliente->idcliente = Session::get("idCliente");
        $cliente->nombre = $request->input("txtNombre");
        $cliente->apellido = $request->input("txtApellido");
        $cliente->celular = $request->input("txtCelular");
        $cliente->correo = $request->input("txtCorreo");
    }
}