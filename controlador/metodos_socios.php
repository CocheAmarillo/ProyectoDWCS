<?php

namespace controlador;

use \modelo\Socio;

//fichero para almacenar los métodos relacionados con los socios.


/**
 * Función que se encarga de dar de alta a un socio.
 *
 * @param Socio $socio un objeto de la clase socio.
 * @return void
 */
function alta_socio(Socio $socio)
{

    try {
        $bd = cargarBBDD("conexion");
        $sql = 'insert into socios'
            . '(vat, Password,Usuario,Nombre_Completo,Email,Telefono,Fecha_Alta,Cargo,Departamento,R_Alojamiento,Puntuacion,Rol,Pais,Fecha_Mod)'
            . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        $fecha = new \DateTime();
        $socio->setFecha_mod($fecha->format('Y-m-d H:i:s'));
        $socio->setFecha_alta($fecha->format('Y-m-d H:i:s'));
        $socio->setPassword(password_hash($socio->password, PASSWORD_BCRYPT));
        $socio->setId_rol(cargar_rol_user('REGISTERED')['ID_ROL']);
        if (!filter_var($socio->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        


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
        echo $ex->getMessage();
        return false;
    } finally {
        $stmt = null;
        $bd = null;
    }
}

/**
 * Función que añade a un socio una institución.
 */
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

/**
 * Función que borra un socio determinado.
 *
 * @param integer $id_socio
 * @return void
 */
function borrar_socio($id_socio)
{

    try {
        $bd = cargarBBDD();
        $fecha_baja = new \DateTime();
        $fecha_baja = $fecha_baja->format('Y-m-d H:i:s');

        $sql = "update socios set fecha_baja='$fecha_baja' where id_socio='$id_socio'";


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
 * Función que comprueba si los datos metidos del usuario coinciden con los de la base de datos.
 *
 * @param string $usuario usuario.
 * @param string $clave contraseña del usuario.
 * @return void
 */
function comprobar_usuario($usuario, $clave)
{
    try {
        $bd = cargarBBDD("conexion");
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
        return false;
    } finally {
        $bd = null;
    }
}
/**
 * Función que se encarga de recoger la contraseña del usuario. 
 *
 * @param string $usuario usuario
 * @param pdo $bd es un objeto de conexión a base de datos.
 * @return void
 */
function cargarPass($usuario, $bd)
{
    $sql = "select password from socios where usuario='$usuario'";
    if ($resul = $bd->query($sql)) {
        return $resul->fetch()['password'];
    }
}



/**
 * Función que se encarga de acrualizar las puntuaciones del socio.
 *
 * @param integer $id_socio identificador del socio.
 * @param integer $id_tipo_puntuacion identificador de qué tipo de puntuación es.
 * @return void
 */
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

/**
 * Función que se encarga de registrar las puntuaciones en la base de datos.
 *
 * @param integer $id_tipo_puntuacion identificador de qué tipo de puntuación es.
 * @param integer $id_socio identificador del socio.
 * @return void
 */
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


/**
 * Función que se encarga de buscar el nombre del socio mediante su identificador.
 *
 * @param integer $id_socio identificador del socio.
 * @return void
 */
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

/**
 * Función que se encarga de buscar el email del socio mediante su identificador.
 *
 * @param integer $id_socio identificador del socio.
 * @return void
 */
function buscar_email_socio($id_socio)
{
    try {
        $bd = cargarBBDD();
        $sql = "select email as email from socios where id_socio='$id_socio'";
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
 * Función que busca el id y email de los socios que sean administradores.
 *
 * @return void
 */
function buscar_admin()
{
    try {
        $bd = cargarBBDD();
        $sql = "select id_socio,email  from socios where rol='1'";
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
 * Función que recoge los puntos totales del socio.
 *
 * @param integer $id_socio identificador del socio.
 * @return void
 */
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

/**
 * Función que recoge el rol del socio.
 *
 * @param integer $id_socio identificador del socio.
 * @return void
 */
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

/**
 * Funcion para actualizar los datos de un socio
 *
 * @param integer $id_socio el id de dicho socio
 * @param array $array_datos contiene los nuevos datos del socio
 * @return void
 */
function update_socio($id_socio, $array_datos)
{
    try {
        $bd = cargarBBDD();

        $sql = "UPDATE socios set usuario=?, password=?,nombre_completo=?, vat=?,email=?,telefono=?,cargo=?,departamento=?,pais=?,fecha_mod=? where id_socio='$id_socio'";
        $stmt = $bd->prepare($sql);
        $fecha = new \DateTime();
        $fecha_mod = $fecha->format('Y-m-d H:i:s');
        $array_datos['fecha_mod'] = $fecha_mod;
        $array_datos['password_soc'] = password_hash($array_datos['password_soc'], PASSWORD_BCRYPT);

        if ($array_datos['vat_soc'] == "") {
            $array_datos['vat_soc'] = null;
        }

        $stmt->bindParam(1, $array_datos['usuario_soc']);
        $stmt->bindParam(2, $array_datos['password_soc']);
        $stmt->bindParam(3, $array_datos['nombre_soc']);
        $stmt->bindParam(4, $array_datos['vat_soc']);
        $stmt->bindParam(5, $array_datos['email_soc']);
        $stmt->bindParam(6, $array_datos['telefono_soc']);
        $stmt->bindParam(7, $array_datos['cargo_soc']);
        $stmt->bindParam(8, $array_datos['departamento_soc']);
        $stmt->bindParam(9, $array_datos['pais_soc']);
        $stmt->bindParam(10, $array_datos['fecha_mod']);



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
 * Función que busca todas los socios activos en las base de datos
 *
 * @return array contiene los datos de dichos socios
 */
function buscar_socios($fecha1, $fecha2)
{
    try {
        $bd = cargarBBDD();
        $sql = "select * from socios where fecha_baja is null and fecha_alta BETWEEN '$fecha1' and '$fecha2' order by fecha_alta";
        //SELECT * FROM Orders WHERE OrderDate BETWEEN '1996-07-01' AND '1996-07-31';
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
 * Funcion que devuelve los datos de un socio con determinado id
 *
 * @param int $id_socio
 * @return array con los datos del socio
 */
function buscar_socio($id_socio)
{
    try {
        $bd = cargarBBDD();
        $sql = "select * from socios where id_socio='$id_socio'";
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

