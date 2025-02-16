<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.contacto", compact('aSucursales'));
    }

    public function enviar(Request $request)
    {
        $titulo = "Contacto";
        $nombre = $request->input("txtNombre");
        $correo = $request->input("txtCorreo");
        $celular = $request->input("txtCelular");
        $mensaje = $request->input("txtMensaje");

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        if ($nombre && $correo && $celular && $mensaje) {

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
                $mail->Subject = "Gracias por contactarte.";
                $mail->Body = "Los datos del formulario son:
                Nombre: $nombre<br>
                Correo: $correo<br>
                Celular: $celular<br>
                Mensaje: $mensaje<br>
                ";

                //$mail->send(); //No se puede enviar por estar en un servidor de desarrollo local
                return view('web.contacto-gracias', compact('aSucursales'));
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Hubo un error al enviar el correo.";
                return view('web.contacto', compact('aSucursales', 'msg'));
            } 

        } else {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos.";
            return view('web.contacto', compact('aSucursales', 'msg'));
        }
    }
}