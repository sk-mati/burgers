<?php

namespace App\Entidades;

use DB;//Es como el mysqli anteriormente utilizado
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'clientes';
    public $timestamps = false;//Si es true, inserta una marca en la base de datos con fecha y hora de inserción

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idcliente', 'nombre', 'apellido', 'correo', 'dni', 'celular', 'clave',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->telefono = $request->input('txtTelefono');
        $this->direccion = $request->input('txtDireccion');
        $this->dni = $request->input('txtDni');
        $this->correo = $request->input('txtCorreo');
        $this->clave = $request->input('txtClave');
    }

    public function obtenerTodos() //Método
    {
        //Arma la query
        $sql = "SELECT 
                  idcliente,
                  nombre,
                  telefono,
                  direccion,
                  dni,
                  correo,
                  clave
                FROM clientes ORDER BY nombre";
        //Ejecuta la query
        $lstRetorno = DB::select($sql); //Método static. Permite llamar sin instanciar. Hace todo el fetch_assoc en una línea.
        return $lstRetorno; //Devuelve array con datos.
    }

    public function obtenerPorId($idCliente)
    {
        $sql = "SELECT
                    idcliente,
                    nombre,
                    telefono,
                    direccion,
                    dni,
                    correo,
                    clave
                FROM clientes WHERE idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->dni = $lstRetorno[0]->dni;
            $this->correo = $lstRetorno[0]->correo;
            $this->clave = $lstRetorno[0]->clave;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            telefono='$this->telefono',
            direccion='$this->direccion',
            dni='$this->dni',
            correo='$this->correo',
            clave='$this->clave'
            WHERE idcliente=?"; //El signo de interrogación indica que lo busca en el parámetro (más seguro). Filtro de inyeccioón SQL.
        $affected = DB::update($sql, [$this->idcliente]); //Arma la query por parámetro
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                    nombre,
                    telefono,
                    direccion,
                    dni,
                    correo,
                    clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->telefono,
            $this->direccion,
            $this->dni,
            $this->correo,
            $this->clave,
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

}

?>