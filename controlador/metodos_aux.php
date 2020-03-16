<?php namespace controlador;

//fichero para agrupar todos los métodos que no tienen relación directa con alguno de los otros ficheros


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
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $bd = null;
        }
    }
}


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