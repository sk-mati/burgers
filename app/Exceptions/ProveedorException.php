<?php

namespace App\Exceptions;

use Exception;

class ProveedorException extends Exception 
{
      public function __construct(
            string $message = "Error al guardar", 
            int $code = 500, 
            ?Throwable $previous = null
      ) 
      {
      parent::__construct($message, $code, $previous);
      }
}