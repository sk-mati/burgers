<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{

    protected $table = 'nominas';
    public $timestamps = false;

    protected $fillable = [ 
        'idnomina', 'empleado', 'sueldo', 'bonificacion', 'deduccion'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idnomina = $request->input('id') != "0" ? $request->input('id') : $this->idnomina;
        $this->empleado = $request->input('txtEmpleado');
        $this->sueldo = $request->input('txtSueldo');
        $this->bonificacion = $request->input('txtBonificacion');
        $this->deduccion = $request->input('txtDeduccion');
    }

    public function obtenerTodos() 
    {
        $sql = "SELECT 
                  idnomina,
                  empleado,
                  sueldo,
                  bonificacion,
                  deduccion
                FROM nominas ORDER BY empleado";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idNomina)
    {
        $sql = "SELECT
                  idnomina,
                  empleado,
                  sueldo,
                  bonificacion,
                  deduccion
                FROM nominas WHERE idnomina = $idNomina";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idnomina = $lstRetorno[0]->idnomina;
            $this->empleado = $lstRetorno[0]->empleado;
            $this->sueldo = $lstRetorno[0]->sueldo;
            $this->bonificacion = $lstRetorno[0]->bonificacion;
            $this->deduccion = $lstRetorno[0]->deduccion;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE nominas SET
            empleado='$this->empleado',
            sueldo=$this->sueldo,
            bonificacion=$this->bonificacion,
            deduccion=$this->deduccion
            WHERE idnomina=?";
        $affected = DB::update($sql, [$this->idnomina]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM nominas WHERE
            idnomina=?";
        $affected = DB::delete($sql, [$this->idnomina]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO nominas (
                  empleado,
                  sueldo,
                  bonificacion,
                  deduccion
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->empleado,
            $this->sueldo,
            $this->bonificacion,
            $this->deduccion,
        ]);
        return $this->idnomina = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'empleado',
            1 => 'sueldo',
            2 => 'bonificacion',
            3 => 'deduccion',
        );
        $sql = "SELECT DISTINCT
                        idnomina,
                        empleado,
                        sueldo,
                        bonificacion,
                        deduccion
                    FROM nominas
                    WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( empleado LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR sueldo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR bonificacion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR deduccion LIKE '%" . $request['search']['value'] . "%' ";

        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}

?>