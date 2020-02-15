<?php

namespace modelo;

class Empresa {

    private $id_responsable;
    private $cargo_responsable;
    private $vat;
    private $nombre;
    private $email;
    private $telefono;
    private $codigo_postal;
    private $direccion;
    private $web;
    private $descripcion;
    private $fecha_alta;
    private $id_pais;
    private $id_socio;
    private $id_tipo;
    private $fecha_baja;
    
    function __construct($id_responsable, $cargo_responsable, $vat, $nombre, $email, $telefono, $codigo_postal, $direccion, $fecha_alta, $id_pais, $id_socio, $id_tipo, $web=null, $descripcion="") {
        $this->id_responsable = $id_responsable;
        $this->cargo_responsable = $cargo_responsable;
        $this->vat = $vat;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->codigo_postal = $codigo_postal;
        $this->direccion = $direccion;
        $this->web = $web;
        $this->descripcion = $descripcion;
        $this->fecha_alta = $fecha_alta;
        $this->id_pais = $id_pais;
        $this->id_socio = $id_socio;
        $this->id_tipo = $id_tipo;
    }

      

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}
