<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

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
        $lstRetorno = FacadesDB::table('proveedores')
                                ->orderBy('nombre')
                                ->get();
        return $lstRetorno;
    }

    public function obtenerPorId($idProveedor)
    {
        $lstRetorno = FacadesDB::table("proveedores")
                                ->select('idproveedor', 'nombre', 'modelo', 'ubicacion', 'tipoproducto', 'relacion', 'regularidad')
                                ->where('idproveedor', "=", $idProveedor)
                                ->get();

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
        $affected = FacadesDB::table('proveedores')
                        ->where('idproveedor', '=', $this->idproveedor)
                        ->update([  'nombre' => $this->nombre, 
                                    'modelo' => $this->modelo,
                                    'ubicacion' => $this->ubicacion,
                                    'tipoproducto' => $this->tipoproducto, 
                                    'relacion' => $this->relacion,
                                    'regularidad' => $this->regularidad]);
    }

    public function eliminar()
    {
        $deleted = FacadesDB::table('proveedores')->where('idproveedor', '=', $this->idproveedor)->delete();
    }

    public function insertar()
    {
        FacadesDB::table('proveedores')->insert([
            'nombre' => $this->nombre,
            'modelo' => $this->modelo,
            'ubicacion' => $this->ubicacion,
            'tipoproducto' => $this->tipoproducto,
            'relacion' => $this->relacion,
            'regularidad' => $this->regularidad
        ]);
    }

    public function obtenerFiltrado()
    {
        $lstRetorno = FacadesDB::table('proveedores')->get();
        return $lstRetorno;
    }

}

?>