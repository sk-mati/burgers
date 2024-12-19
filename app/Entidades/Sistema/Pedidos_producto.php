<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Pedidos_producto extends Model
{

    protected $table = 'pedidos_productos';
    public $timestamps = false;//Si es true, inserta una marca en la base de datos con fecha y hora de inserción

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idpedidoproducto', 'fk_idpedido', 'fk_idproducto', 'cantidad', 'precio_unitario', 'total',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos() //Método
    {
        //Arma la query
        $sql = "SELECT 
                  idpedidoproducto,
                  fk_idpedido,
                  fk_idproducto,
                  cantidad,
                  precio_unitario,
                  total
                FROM pedidos_productos";
        //Ejecuta la query
        $lstRetorno = DB::select($sql); //Método static. Permite llamar sin instanciar. Hace todo el fetch_assoc en una línea.
        return $lstRetorno; //Devuelve array con datos.
    }

    public function obtenerPorId($idPedidoproducto)
    {
        $sql = "SELECT
                  idpedidoproducto,
                  fk_idpedido,
                  fk_idproducto,
                  cantidad,
                  precio_unitario,
                  total
                FROM pedidos_productos WHERE idpedidoproducto = $idPedidoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
            $this->total = $lstRetorno[0]->total;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE pedidos_productos SET
            cantidad=$this->cantidad,
            precio_unitario=$this->precio_unitario,
            total=$this->total
            WHERE idpedidoproducto=?"; //El signo de interrogación indica que lo busca en el parámetro (más seguro). Filtro de inyeccioón SQL.
        $affected = DB::update($sql, [$this->idpedidoproducto]); //Arma la query por parámetro
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos_productos WHERE
            idpedidoproducto=?";
        $affected = DB::delete($sql, [$this->idpedidoproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos_productos (
                  idpedidoproducto,
                  fk_idpedido,
                  fk_idproducto,
                  cantidad,
                  precio_unitario,
                  total
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->idpedidoproducto,
            $this->fk_idpedido,
            $this->fk_idproducto,
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

}

?>