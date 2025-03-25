<?php

namespace App\Services;

use App\Entidades\Pedido;

class ServicioMercadoPago {

      public function aprobar($idPedido, $mercadoPago)
      {
            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 5;
            $pedido->guardar();
            return redirect("/mi-cuenta");
      }

      public function pendiente($idPedido, $mercadoPago)
      {
            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 1;
            $pedido->guardar();
            return redirect("/mi-cuenta");
      }

      public function error($idPedido, $mercadoPago)
      {
            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 4;
            $pedido->guardar();
            return redirect("/mi-cuenta");
      }
}

?>