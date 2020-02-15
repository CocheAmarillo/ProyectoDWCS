<?php namespace modelo;

class Institucion{
    private $vat;
    private $nombre;
    private $email;
    private $telefono;
    private $codigo_postal;
    private $direccion;
    private $web;
    private $fecha_alta;
    private $fecha_baja;
    private $id_pais;
    private $id_socio;
    private $id_tipo;
    private $descripcion;
          
    function __construct($vat, $nombre, $email, $telefono, $codigo_postal, $direccion, $web, $fecha_alta, $id_pais, $id_socio, $id_tipo, $descripcion) {
        $this->vat = $vat;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->codigo_postal = $codigo_postal;
        $this->direccion = $direccion;
        $this->web = $web;
        $this->fecha_alta = $fecha_alta;
        $this->id_pais = $id_pais;
        $this->id_socio = $id_socio;
        $this->id_tipo = $id_tipo;
        $this->descripcion = $descripcion;
    }
    
     public function __get($name) {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }

}