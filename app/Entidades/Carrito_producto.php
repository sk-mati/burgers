<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito_producto extends Model
{

    protected $table = 'carrito_productos';
    public $timestamps = false;

    protected $fillable = [
        'idcliente_producto', 'fk_idproducto', 'fk_idcarrito', 'cantidad',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT 
                  idcliente_producto,
                  cantidad,
                FROM carrito_productos ORDER BY cantidad";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idCliente_producto)
    {
        $sql = "SELECT
                  idcliente_producto,
                  cantidad
                FROM carrito_productos WHERE idcliente_producto = $idCliente_producto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente_producto = $lstRetorno[0]->idcliente_producto;
            $this->cantidad = $lstRetorno[0]->cantidad;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE carrito_productos SET
            cantidad=$this->cantidad,
            WHERE idcliente_producto=?"; 
        $affected = DB::update($sql, [$this->idcliente_producto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE
            idcliente_producto=?";
        $affected = DB::delete($sql, [$this->idcliente_producto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO carrito_productos (
                    fk_idproducto, 
                    fk_idcarrito,
                    cantidad
            ) VALUES (?,?,?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad,
        ]);
        return $this->idcliente_producto = DB::getPdo()->lastInsertId();
    }

}

?>