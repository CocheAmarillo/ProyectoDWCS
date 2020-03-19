<?php namespace controlador;
use \modelo\Socio;

//fichero para almacenar los métodos relacionados con los socios

function alta_socio(Socio $socio)
{

    try {
        $bd = cargarBBDD();
        $sql = 'insert into socios'
            . '(vat, Password,Usuario,Nombre_Completo,Email,Telefono,Fecha_Alta,Cargo,Departamento,R_Alojamiento,Puntuacion,Rol,Pais,Fecha_Mod)'
            . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        $fecha = new \DateTime();
        $socio->setFecha_mod($fecha->format('Y-m-d H:i:s'));
        $socio->setFecha_alta($fecha->format('Y-m-d H:i:s'));
        $socio->setPassword(password_hash($socio->password, PASSWORD_BCRYPT));
        $socio->setId_rol(cargar_rol_user('REGISTERED')['ID_ROL']);


        if ($socio->vat == "") {
            $socio->setVat(null);
        }

        $array_datos = array($socio->vat, $socio->password, $socio->usuario, $socio->nombre_completo, $socio->email, $socio->telefono, $socio->fecha_alta, $socio->cargo, $socio->departamento, $socio->r_alojamiento, $socio->puntuacion, $socio->id_rol, $socio->id_pais, $socio->fecha_mod);

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

function añadir_institucion_socio($id_inst, $id_socio)
{
    try {
        echo $id_inst, $id_socio;
        $bd = cargarBBDD();
        $sql = "UPDATE socios"
            . " SET institucion='$id_inst'"
            . " where ID_SOCIO='$id_socio'";

        return $bd->exec($sql);
    } catch (\PDOException $ex) {
        
        return false;
    } finally {

        $bd = null;
    }
}


function borrar_socio($id_socio)
{

    try {
        $bd = cargarBBDD();
        $fecha_baja = new \DateTime();
        $fecha_baja=$fecha_baja->format('Y-m-d H:i:s');

        $sql = "update socios set fecha_baja='$fecha_baja' where id_socio='$id_socio'";


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





function comprobar_usuario($usuario, $clave)
{
    try {
        $bd = cargarBBDD();
        $hash = cargarPass($usuario, $bd);

        if (password_verify($clave, $hash)) {
            $sql = "select id_socio,usuario from socios where usuario = '$usuario' ";

            $resul = $bd->query($sql);
            if ($resul->rowCount() === 1) {
                return $resul->fetch();
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $bd = null;
    }
}

function cargarPass($usuario, $bd)
{
    $sql = "select password from socios where usuario='$usuario'";
    if ($resul = $bd->query($sql)) {
        return $resul->fetch()['password'];
    }
}




function update_puntuacion_socio($id_socio, $id_tipo_puntuacion)
{
    try {
        $bd = cargarBBDD();
        $sql = "select valor from tipos_puntuacion where id_tipo_puntuacion='$id_tipo_puntuacion'";
        $resul = $bd->query($sql);
        if (!$resul) {

            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else {
            $puntos = $resul->fetch()['valor'];
            $sql = "update socios set puntuacion = puntuacion + $puntos where id_socio=$id_socio";
            if (!$bd->exec($sql)) {

                throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
            } else {
                nuevo_registro_historial_puntuaciones($id_tipo_puntuacion, $id_socio);
                return true;
            }
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return false;
    } finally {
        $bd = null;
    }
}


function nuevo_registro_historial_puntuaciones($id_tipo_puntuacion, $id_socio)
{
    try {
        $bd = cargarBBDD();
        $fecha = new \DateTime();
        $fecha = $fecha->format('Y-m-d H:i:s');
        $sql = "insert into historico_puntuaciones (fecha,tipo_puntuacion,socio) values ('$fecha','$id_tipo_puntuacion','$id_socio')";
        if (!$bd->exec($sql)) {
            print_r($bd->errorInfo());
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else {
            return true;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {

        $bd = null;
    }
}



function buscar_nombre_socio($id_socio)
{
    try {
        $bd = cargarBBDD();
        $sql = "select nombre_completo as nombre from socios where id_socio='$id_socio'";
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



function cargar_puntos($id_socio)
{


    try {
        $bd = cargarBBDD();
        $sql = "select puntuacion from socios where id_socio='$id_socio'";
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


function cargar_rol($id_socio)
{


    try {
        $bd = cargarBBDD();
        $sql = "select rol from socios where id_socio='$id_socio'";
        $resul = $bd->query($sql);
        if (!$resul) {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetch()['rol'];
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return null;
    } finally {
        $bd = null;
    }
}