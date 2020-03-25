<?php

namespace controlador;

use PHPMailer\PHPMailer\PHPMailer;

require "../../composer/vendor/autoload.php";

//fichero para agrupar todos los métodos que no tienen relación directa con alguno de los otros ficheros

/**
 * FUNCION PARA CARGAR EL ROL DE LOS USUARIOS
 *
 * @param string $nombre_rol es el nombre del rol en la base de datos
 * @return void
 */
function cargar_rol_user($nombre_rol)
{
    try {
        $bd = cargarBBDD();
        $sql = "select ID_ROL from rol_usuarios where TIPO='$nombre_rol'";
        $resul = $bd->query($sql);
        if (!$resul) {

            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetch();
        }
    } catch (\PDOException $ex) {
    } finally {
        $bd = null;
    }
}

/**
 * FUNCION PARA CARGAR LOS PAISES DE LA BASE DE DATOS
 *
 *
 * @return array  devuelve un array con todos los datos de cada pais
 */
function cargar_paises()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from paises ';
        $resul = $bd->query($sql);
        if (!$resul) {
            print_r($bd->errorInfo());
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        } else if ($resul->rowCount() == 0) {
            return null;
        } else {
            return $resul->fetchAll();
        }
    } catch (\PDOException $ex) {
    } finally {
        $bd = null;
    }
}

/**
 * Función que carga todas las especialidades de la base de datos
 *
 * @return array  contiene todos los datos de cada especialidad
 */
function cargar_especialidades()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from tipos_especialidad ';
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
 * Función que añade un nuevo tipo de especialidad a la base de datos
 *
 * @param array $array contiene los datos de la nueva especialidad
 * @return void
 */
function add_especialidad($array)
{
    if ($array != null) {
        try {
            $bd = cargarBBDD();

            $sql = "insert into tipos_especialidad (tipo, descripcion) values (?,?)";
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
 * Función que busca el nombre de un determinado país
 *
 * @param integer $id_pais id del país a buscar
 * @return string $nombre nombre del país
 */
function buscar_pais($id_pais)
{
    try {
        $bd = cargarBBDD();
        $sql = "select nombre from paises where id_pais='$id_pais'";
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
 * Función que devuelve el numero mínimo de puntos que un usuario necesita para dar de alta movilidades
 *
 * @return integer $puntos el valor de los puntos 
 */
function cargar_min_puntos()
{

    try {
        $bd = cargarBBDD();
        $sql = "select valor from tipos_puntuacion where tipo='DEFICIT'";
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
 * Función que se encarga del envío de emails
 *
 * @param string $destinatario el correo de la persona a la que se envía el email
 * @param string $cuerpo es el contenido del email
 * @return void
 */
function enviar_mail($destinatario, $remitente, $cuerpo, $asunto)
{
    $mail = new PHPMailer();


    $mail->IsSMTP();
    // cambiar a 0 para no ver mensajes de error
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // introducir usuario de google
    $mail->Username = 'cocheamarillodsr@gmail.com';
    // introducir clave
    $mail->Password = "cochedsr";
    $mail->SetFrom('cocheamarillodsr@gmail.com', $remitente);
    // asunto
    $mail->Subject = $asunto;
    // cuerpo
    $mail->MsgHTML($cuerpo);
    // adjuntos
    //$mail->addAttachment("empleado.xsd");
    // destinatario
    $address = $destinatario;
    $mail->AddAddress($address);
    // enviar
    $resul = $mail->Send();
    if (!$resul) {
        echo "Error" . $mail->ErrorInfo;
    } else {
        return true;
    }
}

/**
 * Funcion para actualizar la tabla historico de peticiones 
 *
 * @param string $asunto el asunto del email
 * @param string  $descripcion la descripcion y cuerpo del mail
 * @param integer  $emisor el id del socio emisor del email
 * @param integer  $receptor el id del socio receptor del email
 * @return void
 */
function update_peticiones($asunto, $descripcion, $emisor, $receptor)
{

    try {
        $bd = cargarBBDD();
        $fecha_alta = new \DateTime();
        $fecha_alta = $fecha_alta->format('Y-m-d H:i:s');
        $estado = cargar_estado('REQUESTED')['id_estado'];
        $array = array($asunto, $descripcion, $fecha_alta, $estado, $emisor, $receptor);

        $sql = "insert into historico_peticiones (asunto, descripcion, fecha,estado,socio_emisor,socio_receptor) values (?,?,?,?,?,?)";
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



/**
 * Funcion que devuelve el id deñ estado de una peticion
 *
 * @param string $tipo el tipo de estado
 * @return integer el id del estado
 */
function cargar_estado($tipo)
{

    try {
        $bd = cargarBBDD();
        $sql = "select id_estado from estados where estado='$tipo'";
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
