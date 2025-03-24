<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = 'proveedores';
    public $timestamps = false;

    protected $fillable = [ 
        'idproveedor', 'nombre', 'modelo', 'ubicacion', 'tipoproducto', 'relacion', 'regularidad'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idproveedor = $request->input('id') != "0" ? $request->input('id') : $this->idproveedor;
        $this->nombre = $request->input('txtNombre');
        $this->modelo = $request->input('txtModelo');
        $this->ubicacion = $request->input('txtUbicacion');
        $this->tipoproducto = $request->input('txtTipoProducto');
        $this->relacion = $request->input('txtRelacion');
        $this->regularidad = $request->input('txtRegularidad');
    }

    public function obtenerTodos() 
    {
        $sql = "SELECT 
                  idproveedor,
                  nombre,
                  modelo,
                  ubicacion,
                  tipoproducto,
                  relacion,
                  regularidad
                FROM proveedores ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idProveedor)
    {
        $sql = "SELECT
                  idproveedor,
                  nombre,
                  modelo,
                  ubicacion,
                  tipoproducto,
                  relacion,
                  regularidad
                FROM proveedores WHERE idproveedor = $idProveedor";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproveedor = $lstRetorno[0]->idproveedor;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->modelo = $lstRetorno[0]->modelo;
            $this->ubicacion = $lstRetorno[0]->ubicacion;
            $this->tipoproducto = $lstRetorno[0]->tipoproducto;
            $this->relacion = $lstRetorno[0]->relacion;
            $this->regularidad = $lstRetorno[0]->regularidad;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE proveedores SET
            nombre='$this->nombre',
            modelo='$this->modelo',
            ubicacion='$this->ubicacion',
            tipoproducto='$this->tipoproducto',
            relacion='$this->relacion',
            regularidad='$this->regularidad'
            WHERE idproveedor=?";
        $affected = DB::update($sql, [$this->idproveedor]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM proveedores WHERE
            idproveedor=?";
        $affected = DB::delete($sql, [$this->idproveedor]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO proveedores (
                  nombre,
                  modelo,
                  ubicacion,
                  tipoproducto,
                  relacion,
                  regularidad
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->modelo,
            $this->ubicacion,
            $this->tipoproducto,
            $this->relacion,
            $this->regularidad
        ]);
        return $this->idproveedor = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'modelo',
            2 => 'ubicacion',
            3 => 'tipoproducto',
            4 => 'relacion',
            5 => 'regularidad',
        );
        $sql = "SELECT DISTINCT
                        idproveedor,
                        nombre,
                        modelo,
                        ubicacion,
                        tipoproducto,
                        relacion,
                        regularidad
                    FROM proveedores
                    WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR modelo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR ubicacion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR tipoproducto LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR relacion LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR regularidad LIKE '%" . $request['search']['value'] . "%' )";

        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}

?>