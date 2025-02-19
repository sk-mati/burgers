<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Postulacion;

use Illuminate\Http\Request;

use Session;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.nosotros", compact('aSucursales', 'aCarritos'));
    }

    public function insertarPostulacion(Request $request)
    {
        $postulacion = new Postulacion();
        $postulacion->nombre = $request->input("txtNombre");
        $postulacion->apellido = $request->input("txtApellido");
        $postulacion->celular = $request->input("txtCelular");
        $postulacion->correo = $request->input("txtCorreo");
        $postulacion->curriculum = $request->input("archivo");

        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
             $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
             $nombre = date("Ymdhmsi") . ".$extension";
             $archivo = $_FILES["archivo"]["tmp_name"];
             if($extension == "doc" || $extension == "docx" || $extension == "pdf") {
             move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //Guarda el archivo
             } else {
                return "";
             }
             $postulacion->curriculum = $nombre;
        }

        $postulacion->insertar();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.postulacion-gracias", compact('aSucursales', 'aCarritos'));
    }
}