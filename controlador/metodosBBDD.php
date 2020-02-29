<?php

namespace controlador;

use modelo\Alumno;
use modelo\Empresa;
use modelo\Institucion;
use modelo\Socio;
use PDOException;

require_once '../modelo/socios.php';

function cargarBBDD(): \PDO
{
    $c = leer_config(dirname(__FILE__) . "/../config/configuracion.xml", dirname(__FILE__) . "/../config/configuracion.xsd");
    $bd = new \PDO($c[0], $c[1], $c[2]);
    return $bd;
}

function leer_config($nombre, $esquema)
{
    $config = new \DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === false) {
        throw new \InvalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $ip = $datos->xpath("//ip");
    $nombre = $datos->xpath("//nombre");
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
    $resul = [];
    $resul[] = $cad;
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}

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
        echo $ex->getMessage();
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
        echo $ex->getMessage();
        return false;
    } finally {

        $bd = null;
    }
}

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
        echo $ex->getMessage();
        return false;
    } finally {
        $stmt = null;
        $bd = null;
    }
}


function alta_responsable($email, $nombre, $telefono, $bd)
{
    try {

        $sql = "insert into responsables (email,nombre_completo,telefono) values (?,?,?)";
        $stmt = $bd->prepare($sql);


        $array_datos = array($email, $nombre, $telefono);
        if ($stmt->execute($array_datos)) {
            return $bd->lastInsertId();
        } else {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
}
function alta_empresa(Empresa $empresa, $email_resp, $nombre_resp, $tel_resp)
{

    try {

        $bd = cargarBBDD();
        $bd->beginTransaction();
        $id_responsable = alta_responsable($email_resp, $nombre_resp, $tel_resp, $bd);
        if ($id_responsable == false) {
            throw new \PDOException("Ha ocurrido algun error creando el responsable");
        }


        $sql = 'insert into empresas'
            . '(Responsable,Cargo_Responsable,Vat,Nombre,Email,Telefono,Codigo_Postal,Direccion,Web,Descripcion,Fecha_Alta,Pais,Socio,Tipo,Fecha_Mod)'
            . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($empresa->vat == "") {
            $empresa->setVat(null);
        }
        $fecha_alta = new \DateTime();
        $empresa->setFecha_alta($fecha_alta->format('Y-m-d H:i:s'));
        $empresa->setFecha_mod($fecha_alta->format('Y-m-d H:i:s'));
        $empresa->setId_responsable($id_responsable);

        $array_datos = array($empresa->id_responsable, $empresa->cargo_responsable, $empresa->vat, $empresa->nombre, $empresa->email, $empresa->telefono, $empresa->codigo_postal, $empresa->direccion, $empresa->web, $empresa->descripcion, $empresa->fecha_alta, $empresa->id_pais, $empresa->id_socio, $empresa->id_tipo, $empresa->fecha_mod);
        if ($stmt->execute($array_datos)) {
            $id_empresa = $bd->lastInsertId();
            $bd->commit();

            return $id_empresa; //devuelve el id de la empresa insertada
        } else {
            throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        $bd->rollBack();
        return false;
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function borrar_empresa($id_empresa)
{

    try {
        $bd = cargarBBDD();

        $sql = 'update empresas set Fecha_Baja="' . date('d/m/Y') . '" where Id_Empresa=' . $id_empresa;

        if (!$bd->exec($sql)) {
            print_r($bd->errorInfo());
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {

        $bd = null;
    }
}

function borrar_socio($id_socio)
{

    try {
        $bd = cargarBBDD();

        $sql = 'update socios set Fecha_Baja="' . date('d/m/Y') . '" where Id_Socio=' . $id_socio;

        if (!$bd->exec($sql)) {
            print_r($bd->errorInfo());
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {

        $bd = null;
    }
}

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
        echo $ex->getMessage();
    } finally {
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
        echo $ex->getMessage();
    } finally {
        $bd = null;
    }
}


function cargar_tipo_empresa()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from tipos_empresa';
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
        echo $ex->getMessage();
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
            print_r($bd->errorInfo());
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



function add_especialidad_alumno($id_alumno, $array_especialidades)
{
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


function add_especialidad_institucion($id_institucion, $array_especialidades)
{
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


function add_especialidad_empresa($id_empresa, $array_especialidades)
{
    if ($array_especialidades != null) {
        try {
            $bd = cargarBBDD();


            $sql = "insert into empresas_especialidades (empresa,especialidad) values ('$id_empresa',?)";
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
