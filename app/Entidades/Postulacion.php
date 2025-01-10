<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{

    protected $table = 'postulaciones';
    public $timestamps = false;//Si es true, inserta una marca en la base de datos con fecha y hora de inserción

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idpostulacion', 'nombre', 'apellido', 'celular', 'correo', 'curriculum',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos() //Método
    {
        //Arma la query
        $sql = "SELECT 
                  idpostulacion,
                  nombre,
                  apellido,
                  celular,
                  correo,
                  curriculum
                FROM postulaciones ORDER BY nombre";
        //Ejecuta la query
        $lstRetorno = DB::select($sql); //Método static. Permite llamar sin instanciar. Hace todo el fetch_assoc en una línea.
        return $lstRetorno; //Devuelve array con datos.
    }

    public function obtenerPorId($idPostulacion)
    {
        $sql = "SELECT
                  idpostulacion,
                  nombre,
                  apellido,
                  celular,
                  correo,
                  curriculum
                FROM postulaciones WHERE idpostulacion = $idPostulacion";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->celular = $lstRetorno[0]->celular;
            $this->correo = $lstRetorno[0]->correo;
            $this->curriculum = $lstRetorno[0]->curriculum;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE postulaciones SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            celular='$this->celular',
            correo='$this->correo',
            curriculum='$this->curriculum'
            WHERE idpostulacion=?"; //El signo de interrogación indica que lo busca en el parámetro (más seguro). Filtro de inyeccioón SQL.
        $affected = DB::update($sql, [$this->idpostulacion]); //Arma la query por parámetro
    }

    public function eliminar()
    {
        $sql = "DELETE FROM postulaciones WHERE
            idpostulacion=?";
        $affected = DB::delete($sql, [$this->idpostulacion]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO postulaciones (
                  nombre,
                  apellido,
                  celular,
                  correo,
                  curriculum
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum,
        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

}

?>