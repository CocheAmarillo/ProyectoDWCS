<?php

namespace controlador;

use \modelo\Institucion;

/**
 * Fichero para almacenar los métodos relacionados con las instituciones
 */

/**
 * Funcion que inserta en la base de datos la institucion que registra el usuario al registrarse en la web
 *
 * @param Institucion $inst que va a ser registrada
 * @return void
 */
function alta_institucion(Institucion $inst)
{

    try {
        $bd = cargarBBDD();
        $sql = 'insert into instituciones'
            . '(vat, nombre,email,telefono,codigo_postal,direccion,web,fecha_alta,pais,socio,tipo,descripcion,fecha_mod)'
            . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($inst->vat == "") {
            $inst->setVat(null);
        }
        $fecha = new \DateTime();
        $inst->setFecha_alta($fecha->format('Y-m-d H:i:s'));
        $inst->setFecha_mod($fecha->format('Y-m-d H:i:s'));

        $array_datos = array($inst->vat, $inst->nombre, $inst->email, $inst->telefono, $inst->codigo_postal, $inst->direccion, $inst->web, $inst->fecha_alta, $inst->id_pais, $inst->id_socio, $inst->id_tipo, $inst->descripcion, $inst->fecha_mod);

        if ($stmt->execute($array_datos)) {
            $id_institucion = $bd->lastInsertId();
            if (añadir_institucion_socio($id_institucion, $inst->id_socio) > 0) {
                return $id_institucion;
            } else {
                throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
            }
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
 * Funcion que recoge de la base de datos los tipos de instituciones
 *
 * @return array con toda la informacion de los tipos de institucioens
 */
function cargar_tipo_institucion()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from tipos_institucion';
        $resul = $bd->query($sql);
        if (!$resul) {

            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll();
        }
    } catch (\PDOException $ex) {
        return null;
    } finally {
        $bd = null;
    }
}

/**
 * Funcion que registra en la base de datos
 *
 * @param array $array con el tipo y la descripcion del nuevo tipo de descripcion
 * @return void
 */
function add_tipo_institucion($array)
{
    if ($array != null) {
        try {
            $bd = cargarBBDD();

            $sql = "insert into tipos_institucion (tipo, descripcion) values (?,?)";
            $stmt = $bd->prepare($sql);
            if (!$stmt->execute($array)) {
                throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
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
 * Funcion que registra en la base de datos las especialidades de una institucion
 *
 * @param integer $id_institucion el id de la institucion
 * @param array $array_especialidades array que contiene las especialidades de la institucion
 * @return void
 */
function add_especialidad_institucion($id_institucion, $array_especialidades)
{
    if ($array_especialidades != null) {
        try {
            $bd = cargarBBDD();


            $sql = "insert into instituciones_especialidades (institucion,especialidad) values ('$id_institucion',?)";
            $stmt = $bd->prepare($sql);
            foreach ($array_especialidades as $especialidad) {

                $stmt->bindParam(1, $especialidad);
                if (!$stmt->execute()) {
                    throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
                }
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {

            $bd = null;
        }
    }
}

/**
 * Funcion que devuelve todas las instituciones de la base de datos que no han sido dadas de baja
 *
 * @return array con todos los datos de las instituciones
 */
function buscar_institucion()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from instituciones where fecha_baja is null';
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
 * Funcion que devuelve toda la informacion de la institucion cuyo id corresponda con el solicitado
 *
 * @param integer $id_institucion el id de la institucion a buscar
 * @return array con los todos los datos de la institucion seleccionada
 */
function buscar_institucion_por_id($id_institucion)
{
    try {
        $bd = cargarBBDD();
        $sql = "select * from instituciones where fecha_baja is null and id_institucion='$id_institucion'";
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
 * Funcion que devuelve las especialidades de la institucion solicitada
 *
 * @param integer $id_institucion id de la institucion solicitada
 * @return array con las especialidades
 */
function cargar_institucion_especialidad($id_institucion)
{
    try {
        $bd = cargarBBDD();
        $sql = "select (select tipo from tipos_especialidad where id_especialidad=IP.especialidad) as especialidad from instituciones_especialidades as IP WHERE IP.institucion='$id_institucion'";
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
 * Funcion que devuelve el tipo de institucion al que pertenece la institucion seleccionada
 *
 * @param integer $id_tipo_institucion id de la institucion
 * @return string con el tipo de la institucion
 */
function buscar_tipo_institucion($id_tipo_institucion)
{
    try {
        $bd = cargarBBDD();
        $sql = "select tipo from tipos_institucion where id_tipo_institucion='$id_tipo_institucion'";
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
    } finally {
        $bd = null;
    }
}

/**
 * Funcion que registra una nueva movilidad de un alumno en una empresa
 *
 * @param integer $id_alumno Identificador del alumno que va a realizar la movilidad
 * @param integer $id_institucion Identificador de la empresa donde el alumno va a realizar la movilidad
 * @param date $fecha_inicio Fecha de inicio de la movilidad
 * @param date $fecha_fin Fecha teorica del fin de la movilidad
 * @param boolean $alojamiento Indica si el socio ha ayudado al alumno a buscar alojamiento de modo que el socio es remunerado
 * @param integer $id_socio Identificador del socio que registra la movilidad
 * @return void
 */
function add_movilidad_institucion($id_alumno, $id_institucion, $fecha_inicio, $fecha_fin, $alojamiento, $id_socio)
{
    try {
        $bd = cargarBBDD();
        $puntos = intval(cargar_puntos($id_socio)['puntuacion']);
        echo $puntos;
        $min_puntos = intval(cargar_min_puntos()['valor']);
        echo $min_puntos;
        if ($puntos < $min_puntos) {
            return false;
        } else {
            $bd->beginTransaction();
            $sql = "insert into movilidades_instituciones(fecha_inicio, fecha_fin_estimado,fecha_alta,institucion,alumno) values (?,?,?,?,?)";
            $stmt = $bd->prepare($sql);
            $fecha = new \DateTime();
            $fecha_alta = $fecha->format('Y-m-d H:i:s');
            $array = array($fecha_inicio, $fecha_fin, $fecha_alta, $id_institucion, $id_alumno);
            if (!$stmt->execute($array)) {
                throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
            } else {
                update_puntuacion_socio($id_socio, 5);

                if ($alojamiento == "on") {

                    update_puntuacion_socio($id_socio, 4);
                }
            }
        }

        $bd->commit();
        return true;
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        $bd->rollBack();
        return false;
    } finally {
        $bd = null;
    }

}


function borrar_institucion($id_institucion)
{

    try {
        $bd = cargarBBDD();
        $fecha_baja = new \DateTime();
        $fecha_baja=$fecha_baja->format('Y-m-d H:i:s');

        $sql = "update instituciones set fecha_baja='$fecha_baja' where id_institucion='$id_institucion'";


        if (!$bd->exec($sql)) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        }
        else{
          return true;
        }
    } catch (\PDOException $ex) {
        return false;

    } finally {

        $bd = null;
    }
}
