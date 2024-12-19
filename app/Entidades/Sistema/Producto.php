<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'cantidad', 'precio', 'imagen', 'fk_idcategoria',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT 
                  idproducto,
                  nombre,
                  cantidad,
                  precio,
                  imagen
                FROM productos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idProducto)
    {
        $sql = "SELECT
                  idproducto,
                  nombre,
                  cantidad,
                  precio,
                  imagen
                FROM productos WHERE idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio = $lstRetorno[0]->precio;
            $this->imagen = $lstRetorno[0]->imagen;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE productos SET
            nombre='$this->nombre',
            cantidad='$this->cantidad',
            precio='$this->precio',
            imagen='$this->imagen',
            WHERE idproducto=?"; 
        $affected = DB::update($sql, [$this->idproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                    nombre,
                    cantidad,
                    precio,
                    imagen,
                    fk_idcategoria
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->imagen,
            $this->fk_idcategoria,
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }

}

?>