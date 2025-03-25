<?php 

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Services\ServicioMercadoPago;

require app_path().'/start/constants.php';

class ControladorMercadoPago extends Controller
{
      public function aprobar($mercadoPago)
      {
            
      }

      public function pendiente($mercadoPago)
      {
      
      }

      public function error($mercadoPago)
      {
      
      }
}