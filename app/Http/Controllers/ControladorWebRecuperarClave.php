<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Session;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.recuperar-clave", compact('aSucursales', 'aCarritos'));
    }

    public function recuperar(Request $request)
    {
        $titulo = "Recuperar clave";
        $correo = $request->input("txtMail");
        $clave = rand(1000, 9999);

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        $cliente->clave = password_hash($clave, PASSWORD_DEFAULT);
        $cliente->guardar();
        if ($cliente->correo =! "") {

            $data = "Instrucciones";

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = env('MAIL_HOST');
                $mail->SMTPAuth = true;
                $mail->Username = env('MAIL_USERNAME');
                $mail->Password = env("MAIL_PASSWORD");
                $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                $mail->Port = env('MAIL_PORT');

                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->addAddress($correo);

                $mail->isHTML(true);
                $mail->Subject = "Recupero de clave";
                $mail->Body = "Los datos de acceso son:
                Usuario: $cliente->correo
                Clave: $clave";

                //$mail->send(); No se puede enviar por estar en un servidor de desarrollo local
                $mensaje = "La nueva clave es $clave y te la hemos enviado al correo.";
                
                
                return view('web.recuperar-clave', compact('titulo', 'mensaje', 'aSucursales', 'aCarritos'));
            } catch (Exception $e) {
                $mensaje = "Hubo un error al enviar el correo.";
                return view('web.recuperar-clave', compact('titulo', 'mensaje', 'aSucursales', 'aCarritos'));
            } 

        } else {
            $mensaje = "El email ingresado no existe.";
            return view('web.recuperar-clave', compact('titulo', 'mensaje', 'aSucursales', 'aCarritos'));
        }
    }
}