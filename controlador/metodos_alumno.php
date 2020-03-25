<?php

namespace controlador;

use \modelo\Alumno;

//fichero para almacenar los métodos relacionados con los alumnos

/**
 * Función que se encarga de dar de alta un nuevo alumno en la base de datos
 *
 * @param Alumno $alumno objeto de clase Alumno con sus datos
 * @return void
 */
function alta_alumno(Alumno $alumno)
{

    try {
        $bd = cargarBBDD();
        $sql = 'insert into alumnos'
            . '(vat,Nombre_Completo,Genero,Fecha_Nacimiento,Fecha_Alta,Socio,Fecha_Mod)'
            . ' values (?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($alumno->vat == "") {
            $alumno->setVat(null);
        }
        $fecha_alta = new \DateTime();
        $alumno->setFecha_alta($fecha_alta->format('Y-m-d H:i:s'));
        $alumno->setFecha_mod($fecha_alta->format('Y-m-d H:i:s'));

        $array_datos = array($alumno->vat, $alumno->nombre_completo, $alumno->genero, $alumno->fecha_nacimiento, $alumno->fecha_alta, $alumno->id_socio, $alumno->fecha_mod);
        if ($stmt->execute($array_datos)) {
            return $bd->lastInsertId();
        } else {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        }
    } catch (\PDOException $ex) {

        return false;
    } finally {
        $stmt = null;
        $bd = null;
    }
}


/**
 * Función que se encarga de registrar las especialidades de un alumno en la tabla alumnos_especialidades
 *
 * @param integer $id_alumno el id del alumno al que se le registran las especialidades
 * @param array  un array con los id's de las especialidades
 * @return void
 */
function add_especialidad_alumno($id_alumno, $array_especialidades)
{
    if ($array_especialidades != null) {
        try {
            $bd = cargarBBDD();


            $sql = "insert into alumnos_especialidades (alumno,especialidad) values ('$id_alumno',?)";
            $stmt = $bd->prepare($sql);
            foreach ($array_especialidades as $especialidad) {

                $stmt->bindParam(1, $especialidad);
                if (!$stmt->execute()) {
                    throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
                }
            }
            return true;
        } catch (\PDOException $ex) {
            return false;
        } finally {

            $bd = null;
        }
    }
}


/**
 * Función que busca todas las especialides de un determinado alumno
 *
 * @param integer $id_alumno el id del alumno en cuestión
 * @return array  contiene los datos de las especialidades de ese alumno
 */
function cargar_alumno_especialidad($id_alumno)
{
    try {
        $bd = cargarBBDD();
        $sql = "select (select tipo from tipos_especialidad where id_especialidad=AP.especialidad) as especialidad from alumnos_especialidades as AP WHERE AP.alumno='$id_alumno'";
        $resul = $bd->query($sql);
        if (!$resul) {

            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll();
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $bd = null;
    }
}


/**
 * Función que busca un alumno a partir del socio que lo registró
 *
 * @param integer $id_socio_responsable id del socio 
 * @return array  contiene los datos del alumno
 */
function buscar_alumno($id_socio_responsable)
{

    try {
        $bd = cargarBBDD();
        $sql = "select * from alumnos where socio='$id_socio_responsable' and fecha_baja is null";
        $resul = $bd->query($sql);
        if (!$resul) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll();
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return null;
    } finally {
        $bd = null;
    }
}

/**
 * Función que busca un alumno a partir del socio que lo registró
 *
 * @param integer $id_socio_responsable id del socio 
 * @return array  contiene los datos del alumno
 */
function buscar_alumno_por_id($id_alumno)
{

    try {
        $bd = cargarBBDD();
        $sql = "select * from alumnos where id_alumno='$id_alumno'";
        $resul = $bd->query($sql);
        if (!$resul) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetch();
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return null;
    } finally {
        $bd = null;
    }
}


/**
 * Funcíon que se encarga de devolver los datos de las movilidades de los alumnos con diferentes empresas, solo se recogen los alumnos registrados por el usuario con sesión activa
 *
 * @param integer $id_socio el id del socio que registró
 * @return array  contiene los datos de las movilidades
 */
function buscar_movilidades_empresas($id_socio)
{
    try {
        $bd = cargarBBDD();
        $sql = "SELECT a.nombre_completo as nombre_alumno, e.nombre as nombre_empresa,mv.fecha_fin_estimado, mv.fecha_inicio, mv.fecha_alta FROM alumnos as A inner join movilidades_empresas as mv ON mv.alumno=a.ID_ALUMNO inner join empresas as e on e.id_empresa=mv.empresa  where a.socio='$id_socio'";

        $resul = $bd->query($sql);
        if (!$resul) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll(\PDO::FETCH_ASSOC);;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return null;
    } finally {
        $bd = null;
    }
}


/**
 * Funcion que busca movilidades realizadas en instituciones
 *
 * @param integer $id_socio el id del socio con sesion iniciada
 * @return array un array con las movilidades
 */
function buscar_movilidades_institucion($id_socio)
{
    try {
        $bd = cargarBBDD();
        $sql = "SELECT a.nombre_completo as nombre_alumno, e.nombre as nombre_empresa,mv.fecha_fin_estimado, mv.fecha_inicio, mv.fecha_alta FROM alumnos as A inner join movilidades_instituciones as mv ON mv.alumno=a.ID_ALUMNO inner join instituciones as e on e.id_institucion=mv.institucion where a.socio='$id_socio'";

        $resul = $bd->query($sql);
        if (!$resul) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll(\PDO::FETCH_ASSOC);;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return null;
    } finally {
        $bd = null;
    }
}

/**
 * Función que se encarga de dar de baja un alumno 
 *
 * @param integer $id_alumno el id del alumno a dar de baja
 * @return void
 */
function borrar_alumno($id_alumno)
{

    try {
        $bd = cargarBBDD();
        $fecha_baja = new \DateTime();
        $fecha_baja = $fecha_baja->format('Y-m-d H:i:s');

        $sql = "update alumnos set fecha_baja='$fecha_baja' where id_alumno='$id_alumno'";


        if (!$bd->exec($sql)) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else {
            return true;
        }
    } catch (\PDOException $ex) {
        return false;
    } finally {

        $bd = null;
    }
}


/**
 * Funcion para actualizar los datos de un determinado alumno
 *
 * @param integer $id_alumno el id de dicho alumno
 * @param array $array_datos contiene los nuevos datos de dicho alumno
 * @return void
 */
function update_alumno($array_datos)
{
    try {
        $bd = cargarBBDD();

        $sql = "UPDATE alumnos set vat=?, nombre_completo=?,genero=?, fecha_nacimiento=?,fecha_mod=? where id_alumno='" . $_POST['id_alumno'] . "'";
        $stmt = $bd->prepare($sql);
        $fecha = new \DateTime();
        $fecha_mod = $fecha->format('Y-m-d H:i:s');
        $array_datos['fecha_mod'] = $fecha_mod;


        if ($array_datos['vat_al'] == "") {
            $array_datos['vat_al'] = null;
        }

        $stmt->bindParam(1, $array_datos['vat_al']);
        $stmt->bindParam(2, $array_datos['nombre_al']);
        $stmt->bindParam(3, $array_datos['genero_al']);
        $stmt->bindParam(4, $array_datos['fecha_nac_al']);
        $stmt->bindParam(5, $array_datos['fecha_mod']);



        if ($stmt->execute()) {
            return true;
        } else {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        }
    } catch (\PDOException $ex) {

        return false;
    } finally {
        $stmt = null;
        $bd = null;
    }
}

/**
 * Funcion que borra las especialidades de un alumno para su modificacion
 *
 * @param int $id_alumno
 * @return void
 */
function borrar_especialidad_alumno($id_alumno)
{
    try {
        $bd = cargarBBDD();

        $sql = "delete from alumnos_especialidades where alumno='$id_alumno'";


        if (!$bd->exec($sql)) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else {
            return true;
        }
    } catch (\PDOException $ex) {
        return false;
    } finally {

        $bd = null;
    }
}
