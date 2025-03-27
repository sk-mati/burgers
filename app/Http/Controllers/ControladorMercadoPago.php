<?php 

namespace App\Http\Controllers;


use App\Services\ServicioMercadoPago;

class ControladorMercadoPago extends Controller
{
      private $servicioMercadoPago;

      public function __construct(ServicioMercadoPago $servicioMercadoPago)
      {
      $this->servicioMercadoPago = $servicioMercadoPago;
      }
}