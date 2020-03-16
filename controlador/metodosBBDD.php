<?php namespace controlador;

use modelo\Alumno;
use modelo\Empresa;
use modelo\Institucion;
use modelo\Socio;
use PDOException;


//este es el fichero general para todos los métodos, los cuáles son importados de otros ficheros para mantenerlos organizados de forma sencilla.

require 'metodos_socios.php';
require 'metodos_institucion.php';
require 'metodos_alumno.php';
require 'metodos_empresa.php';
require 'metodos_aux.php';

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


