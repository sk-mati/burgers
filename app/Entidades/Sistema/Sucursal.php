<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{

    protected $table = 'sucursales';
    public $timestamps = false;//Si es true, inserta una marca en la base de datos con fecha y hora de inserción

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idsucursal', 'telefono', 'direccion', 'linkmapa',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos() //Método
    {
        //Arma la query
        $sql = "SELECT 
                  idsucursal,
                  telefono,
                  direccion,
                  linkmapa
                FROM sucursales";
        //Ejecuta la query
        $lstRetorno = DB::select($sql); //Método static. Permite llamar sin instanciar. Hace todo el fetch_assoc en una línea.
        return $lstRetorno; //Devuelve array con datos.
    }

    public function obtenerPorId($idSucursal)
    {
        $sql = "SELECT
                    idsucursal,
                    telefono,
                    direccion,
                    linkmapa
                FROM sucursales WHERE idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmapa = $lstRetorno[0]->linkmapa;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE sucursales SET
            telefono='$this->telefono',
            direccion='$this->direccion',
            linkmapa='$this->linkmapa'
            WHERE idsucursal=?"; //El signo de interrogación indica que lo busca en el parámetro (más seguro). Filtro de inyeccioón SQL.
        $affected = DB::update($sql, [$this->idsucursal]); //Arma la query por parámetro
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sucursales WHERE
            idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sucursales (
                  telefono,
                  direccion,
                  linkmapa
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmapa,
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }

}

?>