<?php namespace controlador;

use \modelo\Alumno;

//fichero para almacenar los métodos relacionados con los alumnos


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
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {

            $bd = null;
        }
    }
}



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