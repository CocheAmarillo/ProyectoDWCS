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

function cargarBBDD($rol="estandar"): \PDO
{
    $c = leer_config(dirname(__FILE__) . "/../config/configuracion.xml", dirname(__FILE__) . "/../config/configuracion.xsd",$rol);
    $bd = new \PDO($c[0], $c[1], $c[2]);
    return $bd;
}

function leer_config($nombre, $esquema,$rol)
{
    $config = new \DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === false) {
        throw new \InvalidArgumentException("Revise fichero de configuración");
    }
    $xml = simplexml_load_file($nombre);
    
    $usuario = $xml->xpath('//nombre[../rol="' . $rol . '"]')[0];
    $pass = $xml->xpath('//password[../rol="' . $rol . '"]')[0]; 
   
    $cad = "mysql:dbname=gestionmovilidades;host=localhost";
    $resul = [];
    $resul[] = $cad;
    $resul[] = $usuario;
    $resul[] = $pass;
    return $resul;
}






