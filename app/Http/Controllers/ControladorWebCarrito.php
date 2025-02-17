<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;
use App\Entidades\Pedido;
use App\Entidades\Pedido_producto;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

use Session;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.carrito", compact('aSucursales', 'aCarritos'));
    }

    public function procesar(Request $request) 
    {
        if (isset($_POST["btnEliminar"])) {
           return $this->eliminar($request);
        } else if (isset($_POST["btnActualizar"])) {
           return $this->actualizar($request);
        } else if (isset($_POST["btnFinalizar"])) {
           return $this->insertarPedido($request);
        }
    }

    public function actualizar(Request $request) 
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
    
        $carrito = new Carrito();

        $cantidad = $request->input("txtCantidad");
        $idProducto = $request->input("txtProducto");
        $idCarrito = $request->input("txtCarrito");
        
        $carrito->idcarrito = $idCarrito;
        $carrito->cantidad = $cantidad;
        $carrito->fk_idcliente = $idCliente;
        $carrito->fk_idproducto = $idProducto;
        $carrito->guardar();
        $mensaje = "Producto actualizado exitosamente.";
        return view("web.carrito", compact('mensaje', 'aSucursales', 'aCarritos'));
    }

    public function eliminar(Request $request) 
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $idCarrito = $request->input("txtCarrito");
        $carrito = new Carrito();
        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $mensaje = "Producto eliminado exitosamente.";
        return view("web.carrito", compact('mensaje', 'aSucursales', 'aCarritos'));
    }

    public function insertarPedido(Request $request)
    {
        $idCliente = Session::get("idCliente");
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");

        if($pago == "Mercadopago"){
            $this->procesarMercadopago($request);
        } else {
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();

            $total = 0;
            foreach ($aCarritos AS $item) {
                $total += $item->cantidad * $item->precio;
            }

            $fecha = date("Y-m-d");

            $pedido = new Pedido();
            $pedido->fk_idsucursal = $idSucursal;
            $pedido->fk_idcliente = $idCliente;
            $pedido->fk_idestado = 1;
            $pedido->fecha = $fecha;
            $pedido->total = $total;
            $pedido->pago = $pago;
            $pedido->insertar();

            $pedidoProducto = new Pedido_producto();
            foreach ($aCarritos AS $item) {
                $pedidoProducto->fk_idproducto = $item->fk_idproducto;
                $pedidoProducto->fk_idpedido = $pedido->idpedido;
                $pedidoProducto->cantidad = $item->cantidad;
                $pedidoProducto->insertar();
            }

            $carrito->eliminarPorCliente($idCliente);

            $mensaje = "El pedido se ha confirmado correctamente.";
            return view("web.carrito", compact('mensaje', 'aSucursales', 'aCarritos'));
        }

    }

    public function procesarMercadopago(Request $request)
    {
        $access_token = "";
        SDK::setClientId(config("payment-methods.mercadopago.client"));
        SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
        SDK::setAccessToken($access_token);

        $idCliente = Session::get("idCliente");
        $cliente = new Cliente();
        $cliente->obtenerPorId($idCliente);
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $total = 0;
        foreach ($aCarritos AS $item) {
            $total += $item->cantidad * $item->precio;
        }

        $fecha = date("Y-m-d");

        $item = new Item();
        $item->id = "1234";
        $item->title = "Compra Web Burgers SRL";
        $item->category_id = "products";
        $item->quantity = 1;
        $item->unit_price = $total;
        $item->currency_id = "ARS";

        $preference = new Preference();
        $preference->items = array($item);

        $payer = new Payer();
        $payer->name = $cliente->nombre;
        $payer->surname = $cliente->apellido;
        $payer->email = $cliente->correo;
        $payer->date_created = date('Y-m-d H:m:s');
        $payer->identification = array(
            "type" => "DNI",
            "number" => $cliente->dni,
        );
        $preference->payer = $payer;

        $pedido = new Pedido();
        $pedido->fk_idsucursal = $idSucursal;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestado = 5;
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->pago = $pago;
        $pedido->insertar();

        $pedidoProducto = new Pedido_producto();
        foreach ($aCarritos AS $item) {
            $pedidoProducto->fk_idproducto = $item->fk_idproducto;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->cantidad = $item->cantidad;
            $pedidoProducto->insertar();
        }

        $carrito->eliminarPorCliente($idCliente);

        $preference->back_urls = [
            "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
            "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
            "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
        ];

        $preference->payment_methods = array("installments" => 6);
        $preference->auto_return = "all";
        $preference->notification_url = '';
        $preference->save();

    }
}