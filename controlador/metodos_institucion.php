<?php namespace controlador;

use \modelo\Institucion;


//fichero para almacenar los métodos relacionados con las instituciones


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
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $bd = null;
        }
    }
}


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

