<?php

namespace controlador;

use modelo\Socio;
use modelo\Alumno;
use modelo\Empresa;
use modelo\Institucion;

include '../modelo/socios.php';

function cargarBBDD(): \PDO {
    $c = leer_config(dirname(__FILE__) . "/../config/configuracion.xml", dirname(__FILE__) . "/../config/configuracion.xsd");
    $bd = new \PDO($c[0], $c[1], $c[2]);
    return $bd;
}

function leer_config($nombre, $esquema) {
    $config = new \DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise fichero de configuración");
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

function alta_socio(Socio $socio) {

    try {
        $bd = cargarBBDD();
        $sql = 'insert into socios'
                . '(vat, Password,Usuario,Nombre_Completo,Email,Telefono,Fecha_Alta,Cargo,Departamento,R_Alojamiento,Puntuacion,Rol,Pais)'
                . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($socio->vat == "") {
            $vat = null;
        } else {
            $vat = $socio->vat;
        }
        $array_datos = array($vat, $socio->password, $socio->usuario, $socio->nombre_completo, $socio->email, $socio->telefono, $socio->fecha_alta, $socio->cargo, $socio->departamento, $socio->r_alojamiento, $socio->puntuacion, $socio->id_rol, $socio->id_pais);

        if ($stmt->execute($array_datos)) {
            return $bd->lastInsertId();
        } else {

            return false;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function alta_institucion(Institucion $inst) {

    try {
        $bd = cargarBBDD();
        $sql = 'insert into instituciones'
                . '(vat, nombre,email,telefono,codigo_postal,direccion,web,fecha_alta,pais,socio,tipo,descripcion)'
                . ' values (?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($inst->vat == "") {
            $vat = null;
        } else {
            $vat = $socio->vat;
        }
        $array_datos = array($vat, $inst->nombre, $inst->email, $inst->telefono, $inst->codigo_postal, $inst->direccion, $inst->web, $inst->fecha_alta, $inst->id_pais, $inst->id_socio, $inst->id_tipo, $inst->descripcion);

        if ($stmt->execute($array_datos)) {
            if (añadir_institucion_socio($bd->lastInsertId(), $inst->id_socio) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            print_r($bd->errorInfo());
            return false;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function añadir_institucion_socio($id_inst, $id_socio) {
    try {
        echo $id_inst, $id_socio;
        $bd = cargarBBDD();
        $sql = "UPDATE socios"
                . " SET institucion='$id_inst'"
                . " where ID_SOCIO='$id_socio'";

        return $bd->exec($sql);
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function alta_alumno(Alumno $alumno) {

    try {
        $bd = cargarBBDD();
        $sql = 'insert into alumnos'
                . '(vat,Nombre_Completo,Genero,Fecha_Nacimiento,Fecha_Alta,Socio)'
                . ' values (?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        if ($alumno->vat == "") {
            $vat = null;
        } else {
            $vat = $alumno->vat;
        }
        $array_datos = array($vat, $alumno->nombre_completo, $alumno->genero, $alumno->fecha_nacimiento, $alumno->fecha_alta, $alumno->id_socio);
        if ($stmt->execute($array_datos)) {
            return true;
        } else {
            return false;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function alta_empresa(Empresa $empresa) {

    try {
        $bd = cargarBBDD();
        $sql = 'insert into empresas'
                . '(Responsable,Cargo_Responsable,Vat,Nombre,Email,Telefono,Codigo_Postal,Direccion,Web,Descripcion,Fecha_Alta,Pais,Socio,Tipo)'
                . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $bd->prepare($sql);
        $array_datos = array($empresa->id_responsable, $empresa->cargo_responsable, $empresa->vat, $empresa->nombre, $empresa->email, $empresa->telefono, $empresa->codigo_postal, $empresa->direccion, $empresa->web, $empresa->descripcion, $empresa->fecha_alta, $empresa->id_pais, $empresa->id_socio, $empresa->id_tipo);
        $stmt->execute($array_datos);
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $stmt = null;
        $bd = null;
    }
}

function borrar_empresa($id_empresa) {

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

function borrar_socio($id_socio) {

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

function cargar_paises() {
    try {
        $bd = cargarBBDD();
        $sql = 'select * from paises ';
        $resul = $bd->query($sql);
        if (!$resul) {
            print_r($bd->errorInfo());
            throw new \PDOException();
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

function cargar_tipo_institucion() {
    try {
        $bd = cargarBBDD();
        $sql = 'select * from tipos_institucion';
        $resul = $bd->query($sql);
        if (!$resul) {
            print_r($bd->errorInfo());
            throw new \PDOException();
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

function cargar_rol_user($nombre_rol) {
    try {
        $bd = cargarBBDD();
        $sql = "select ID_ROL from rol_usuarios where TIPO='$nombre_rol'";
        $resul = $bd->query($sql);
        if (!$resul) {
            print_r($bd->errorInfo());
            throw new \PDOException();
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

function comprobar_usuario($usuario, $clave) {
    try {
        $bd = cargarBBDD();
        $hash = cargarPass($usuario, $bd);

        if (password_verify($clave, $hash)) {
            $sql = "select id_socio,usuario from socios where usuario = '$usuario' ";

            $resul = $bd->query($sql);
            if ($resul->rowCount() === 1) {
                return $resul->fetch();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {
        $bd = null;
    }
}

function cargarPass($usuario, $bd) {
    $sql = "select password from socios where usuario='$usuario'";
    if ($resul = $bd->query($sql)) {
        return $resul->fetch()['password'];
    }
}

function update_puntuacion_socio($id_socio, $id_tipo_puntuacion) {
    try {
        $bd = cargarBBDD();
        $sql = "select valor from tipos_puntuacion where id_tipo_puntuacion='$id_tipo_puntuacion'";
        $resul = $bd->query($sql);
        if (!$resul) {
            print_r($bd->errorInfo());
            throw new \PDOException();
        } else if ($resul->rowCount() == 0) {
            throw new \PDOException();
        } else {
            $puntos = $resul->fetch()['valor'];
            $sql = "update socios set puntuacion = puntuacion + $puntos where id_socio=$id_socio";
            if (!$bd->exec($sql)) {
                
                throw new \PDOException();
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

function nuevo_registro_historial_puntuaciones($id_tipo_puntuacion, $id_socio) {
    try {
        $bd = cargarBBDD();
        $fecha = new \DateTime();
        $fecha = $fecha->format('Y-m-d H:i:s');
        $sql = "insert into historico_puntuaciones (fecha,tipo_puntuacion,socio) values ('$fecha','$id_tipo_puntuacion','$id_socio')";
        if (!$bd->exec($sql)) {
            print_r($bd->errorInfo());
            throw new \PDOException();
        }
        else{
            return true;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    } finally {

        $bd = null;
    }
}
