<?php namespace controlador;


use  \modelo\Empresa;

//fichero para almacenar los métodos relacionados con las empresas

/**
 * Funcion para dar de alta un responsable en su correspondiente tabla en la base de datos
 *
 * @param string $email el email del responsable
 * @param string $nombre su nombre
 * @param string  $telefono su telefono
 * @param pdo $bd un objeto de conexion a base de datos
 * @return void
 */
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

/**
 * Funcion para dar de alta una empresa en la base de datos
 *
 * @param Empresa $empresa objeto de la clase Empresa con sus datos
 * @param string $email_resp el email del responsable de la empresa
 * @param string $nombre_resp el nombre de dicho responsable
 * @param string $tel_resp su telefono
 * @return void
 */
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

/**
 * Funcion para dar de baja una empresa
 *
 * @param integer $id_empresa el id de la empresa a dar de baja
 * @return void
 */
function borrar_empresa($id_empresa)
{

    try {
        $bd = cargarBBDD();
        $fecha_baja = new \DateTime();
        $fecha_baja=$fecha_baja->format('Y-m-d H:i:s');

        $sql = "update empresas set fecha_baja='$fecha_baja' where id_empresa='$id_empresa'";


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


/**
 * Funcion que devuelve los posibles tipos de empresa disponibles en la base de datos
 *
 * @return array contiene los datos de los tipos de empresas
 */
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

/**
 * Funcion que para añadir especialidades a una determinada empresa
 *
 * @param integer $id_empresa el id de dicha empresa
 * @param array $array_especialidades contiene los ids de las especialidades a añadir
 * @return void
 */
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

/**
 * Función que busca todas las empresas activas en las base de datos
 *
 * @return array contiene los datos de dichas empresas
 */
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

/**
 * Función que busca una empresa en concreto a partir de su identificador
 *
 * @param integer $id_empresa el id de dicha empresa
 * @return array contiene los datos de la empresa a buscar
 */
function buscar_empresa_por_id($id_empresa)
{
    try {
        $bd = cargarBBDD();
        $sql = "select * from empresas where fecha_baja is null and id_empresa='$id_empresa'";
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
 * Función que las especialidades de una determinada empresa
 *
 * @param integer $id_empresa el id de dicha empresa
 * @return array contiene los datos de las especialidades
 */
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

/**
 * Funcion que busca un determinado tipo de empresa a partir de su identificador
 *
 * @param integer $id_tipo_empresa el id de dicho tipo de empresa
 * @return array contiene el nombre del tipo de empresa
 */
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

/**
 * Funcion que devuelve el nombre de un responsable a partir de su identificador
 *
 * @param integer $id_responsable el id de dicho responsable 
 * @return array contiene el nombre del responsable
 */
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

/**
 * Función que se encarga de dar de alta una movilidad entre un determinado alumno y una empresa
 *
 * @param integer $id_alumno el id de dicho alumno
 * @param integer $id_empresa el id de dicha empresa
 * @param date  $fecha_inicio fecha de inicio de la movilidad
 * @param date $fecha_fin fecha estimada de fin de la movilidad
 * @param boolean $alojamiento indica si el socio ayudó en el alojmiento
 * @param integer $id_socio el id del socio que registra la movilidad
 * @return void
 */
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


/**
 * Función para actualizar los datos de una determinada empresa
 *
 * @param integer $id_empresa el id de dicha empresa
 * @param array $array_datos contiene los nuevos datos de la empresa
 * @return void
 */
function update_empresa($id_empresa, $array_datos){
    try {
        $bd = cargarBBDD();
        
        $sql="UPDATE empresas set vat=?, nombre=?,email=?, telefono=?,codigo_postal=?,direccion=?,web=?,descripcion=?,pais=?,tipo=?,fecha_mod=? where id_empresa='$id_empresa'";
        $stmt = $bd->prepare($sql);
        $fecha = new \DateTime();
        $fecha_mod=$fecha->format('Y-m-d H:i:s');
        $array_datos['fecha_mod']=$fecha_mod;
       

        if ($array_datos['vat'] == "") {
            $array_datos['vat']=null;
        }

        $stmt->bindParam(1,$array_datos['vat_emp']);
        $stmt->bindParam(2,$array_datos['nombre_emp']);
        $stmt->bindParam(3,$array_datos['email_emp']);
        $stmt->bindParam(4,$array_datos['telefono_emp']);
        $stmt->bindParam(5,$array_datos['codigo_postal_emp']);
        $stmt->bindParam(6,$array_datos['direccion_emp']);
        $stmt->bindParam(7,$array_datos['web_emp']);
        $stmt->bindParam(8,$array_datos['descripcion_emp']);
        $stmt->bindParam(9,$array_datos['pais_emp']);
        $stmt->bindParam(10,$array_datos['tipo_emp']);
        $stmt->bindParam(11,$array_datos['fecha_mod']);



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
