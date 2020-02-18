<?php

namespace modelo;

class Institucion
{
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
    private $fecha_mod;

    function __construct($vat, $nombre, $email, $telefono, $codigo_postal, $direccion, $web, $fecha_alta, $id_pais, $id_socio, $id_tipo, $descripcion, $fecha_mod)
    {
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
        $this->fecha_mod = $fecha_mod;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }



    /**
     * Set the value of vat
     *
     * @return  self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Set the value of fecha_alta
     *
     * @return  self
     */
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * Set the value of fecha_mod
     *
     * @return  self
     */
    public function setFecha_mod($fecha_mod)
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }
}
