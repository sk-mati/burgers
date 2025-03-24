<?php 

namespace App\Http\Controllers;
use App\Entidades\Nomina;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
require app_path().'/start/constants.php';

class ControladorNomina extends Controller 
{

      public function nuevo()
      {
            $titulo = "Nueva nómina";

            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("NOMINAALTA")) {
                    $codigo = "NOMINAALTA";
                    $mensaje = "No tiene permisos para la operación.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $nomina = new Nomina();
                    return view("sistema.nomina-nuevo", compact("titulo", "nomina"));
                }
            } else {
                return redirect('admin/login');
            }
      }

      public function index()
      {
        $titulo = "Listado de nóminas";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("NOMINACONSULTA")) {
                $codigo = "NOMINACONSULTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("sistema.nomina-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
      }

      public function guardar(Request $request) {
            try {
                $titulo = "Guardar nómina";
                $entidad = new Nomina();
                $entidad->cargarDesdeRequest($request);
    
                if ($entidad->empleado == "" || $entidad->sueldo == "" || $entidad->bonificacion == "" || $entidad->deduccion == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {

                        $entidad->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {

                        $entidad->insertar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }

                    $_POST["id"] = $entidad->idnomina;
                    return view('sistema.nomina-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
    
            $id = $entidad->idnomina;
            $nomina = new Nomina();
            $nomina->obtenerPorId($id);

            return view('sistema.nomina-nuevo', compact('msg', 'nomina', 'titulo')) . '?id=' . $nomina->idnomina;
    
      }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Nomina();
        $aNominas = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aNominas) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/nomina/' . $aNominas[$i]->idnomina . '">' . $aNominas[$i]->empleado . '</a>';
            $row[] = $aNominas[$i]->sueldo;
            $row[] = $aNominas[$i]->bonificacion;
            $row[] = $aNominas[$i]->deduccion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aNominas), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aNominas), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($idNomina){
        $titulo = "Edición de nómina";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("NOMINAEDITAR")) {
                $codigo = "NOMINAEDITAR";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $nomina = new Nomina();
                $nomina->obtenerPorId($idNomina);
                return view("sistema.nomina-nuevo", compact("titulo", "nomina"));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request){

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("NOMINABAJA")) {
                $resultado["err"] = EXIT_FAILURE;
                $resultado["mensaje"] = "No tiene permisos para la operación.";
            } else {
                $idNomina = $request->input("id");
                $nomina = new Nomina();

                $nomina->idnomina = $idNomina;
                $nomina->eliminar();
                $resultado["err"] = EXIT_SUCCESS;
                $resultado["mensaje"] = "Registro eliminado exitosamente.";
                }
            } else {
            $resultado["err"] = EXIT_FAILURE;
            $resultado["mensaje"] = "Usuario no autenticado";
        }
        return json_encode($resultado);
    }
}