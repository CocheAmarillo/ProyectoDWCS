<?php namespace controlador;


use  \modelo\Empresa;

//fichero para almacenar los métodos relacionados con las empresas


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
       return null;
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


function buscar_empresa()
{
    try {
        $bd = cargarBBDD();
        $sql = 'select * from empresas where fecha_baja is null';
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



function cargar_empresa_especialidad($id_empresa)
{
    try {
        $bd = cargarBBDD();
        $sql = "select (select tipo from tipos_especialidad where id_especialidad=EP.especialidad) as especialidad from empresas_especialidades as EP WHERE EP.empresa='$id_empresa'";
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


function buscar_tipo_empresa($id_tipo_empresa)
{
    try {
        $bd = cargarBBDD();
        $sql = "select tipo from tipos_empresa where id_tipo_empresa='$id_tipo_empresa'";
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


function buscar_nombre_responsable($id_responsable)
{
    try {
        $bd = cargarBBDD();
        $sql = "select nombre_completo as nombre from responsables where id_responsable='$id_responsable'";
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


function add_movilidad_empresa($id_alumno, $id_empresa, $fecha_inicio, $fecha_fin, $alojamiento, $id_socio)
{
    try {
        $bd = cargarBBDD();

        $puntos = intval(cargar_puntos($id_socio)['puntuacion']);
      
        $min_puntos = intval(cargar_min_puntos()['valor']);
        
        if ($puntos < $min_puntos) {
            return false;
        } else {
            $bd->beginTransaction();
            $sql = "insert into movilidades_empresas (fecha_inicio, fecha_fin_estimado,fecha_alta,empresa,alumno) values (?,?,?,?,?)";
            $stmt = $bd->prepare($sql);
            $fecha = new \DateTime();
            $fecha_alta = $fecha->format('Y-m-d H:i:s');
            $array = array($fecha_inicio, $fecha_fin, $fecha_alta, $id_empresa, $id_alumno);
            if (!$stmt->execute($array)) {
                throw new \PDOException("Ha ocurrido algun error: " . $bd->errorInfo()[2]);
            } else {

                update_puntuacion_socio($id_socio, 5);

                if ($alojamiento == "on") {

                    update_puntuacion_socio($id_socio, 4);
                }
            }
            $bd->commit();
            return true;
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
        $bd->rollBack();
        return false;
    } finally {
        $bd = null;
    }
}
