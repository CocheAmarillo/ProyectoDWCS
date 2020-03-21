<?php

namespace modelo;

class Institucion
{
    /**
     * Numero de Identificacion Fiscal de la Institucion
     *
     * @var [string]
     */
    private $vat;
    /**
     * Nombre de la Institucion
     *
     * @var [string]
     */
    private $nombre;
    /**
     * Email de la Institucion
     *
     * @var [string]
     */
    private $email;
    /**
     * Telefono de la Institucion
     *
     * @var [string]
     */
    private $telefono;
    /**
     * Codigo Postal de la Institucion
     *
     * @var [string]
     */
    private $codigo_postal;
    /**
     * Direccion de la Institucion
     *
     * @var [string]
     */
    private $direccion;
    /**
     * Web de la Institucion
     *
     * @var [string]
     */
    private $web;
    /**
     * Fecha de Alta de la Institucion
     *
     * @var [date]
     */
    private $fecha_alta;
    /**
     * Fecha de baja de la Institucion
     *
     * @var [date]
     */
    private $fecha_baja;
    /**
     * Identificador del país de la Institucion
     *
     * @var [int]
     */
    private $id_pais;
    /**
     * Identificador del socio de la Institucion
     *
     * @var [int]
     */
    private $id_socio;
    /**
     * Identificador del tipo de Institucion
     *
     * @var [int]
     */
    private $id_tipo;
    /**
     * Descripcion de la Institucion
     *
     * @var [string]
     */
    private $descripcion;
    /**
     * Fecha de modificacion de la Institucion
     *
     * @var [date]
     */
    private $fecha_mod;

    /**
     * Constructor de la clase
     *
     * @param [string] $vat
     * @param [string] $nombre
     * @param [string] $email
     * @param [string] $telefono
     * @param [string] $codigo_postal
     * @param [string] $direccion
     * @param [string] $web
     * @param [date] $fecha_alta
     * @param [int] $id_pais
     * @param [int] $id_socio
     * @param [int] $id_tipo
     * @param [string] $descripcion
     * @param [date] $fecha_mod
     */
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

    /**
     * Metodo que devuelve el valor de una propiedad si esta existe
     *
     * @param string $name nombre de la variable
     * @return string el valor de dicha propiedad
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * Establece el valor de vat
     *
     * @return  self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Establece el valor de fecha_alta
     *
     * @return  self
     */
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * Establece el valor de fecha_mod
     *
     * @return  self
     */
    public function setFecha_mod($fecha_mod)
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }
}
