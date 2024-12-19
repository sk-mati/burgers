<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedidos';
    public $timestamps = false;//Si es true, inserta una marca en la base de datos con fecha y hora de inserción

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idpedido', 'fecha', 'descripcion', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos() //Método
    {
        //Arma la query
        $sql = "SELECT 
                  idpedido,
                  fecha,
                  descripcion,
                  total
                FROM pedidos";
        //Ejecuta la query
        $lstRetorno = DB::select($sql); //Método static. Permite llamar sin instanciar. Hace todo el fetch_assoc en una línea.
        return $lstRetorno; //Devuelve array con datos.
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
                    idpedido,
                    fecha,
                    descripcion,
                    total
                FROM pedidos WHERE idpedido = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE pedidos SET
            fecha=$this->fecha,
            descripcion=$this->descripcion,
            total=$this->total
            WHERE idpedido=?"; //El signo de interrogación indica que lo busca en el parámetro (más seguro). Filtro de inyeccioón SQL.
        $affected = DB::update($sql, [$this->idpedido]); //Arma la query por parámetro
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE
            idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                    fecha,
                    descripcion,
                    total
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

}

?>