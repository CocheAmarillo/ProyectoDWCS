<?php

namespace modelo;

/**
 * Clase para modelar los datos de una empresa 
 */
class Empresa
{
    /**
     * El identificador del responsable de la empresa
     *
     * @var integer
     */
    private $id_responsable;
    /**
     * El puesto en la empresa del responsable
     *
     * @var string
     */
    private $cargo_responsable;
    /**
     * Documento identificativo de la empresa
     *
     * @var string
     */
    private $vat;
    /**
     * Nombre de la empresa
     *
     * @var string
     */
    private $nombre;
    /**
     * Correo electronico de la empresa
     *
     * @var string
     */
    private $email;
    /**
     * Numero de telefono de la empresa
     *
     * @var string
     */
    private $telefono;
    /**
     * Numero de codigo postal
     *
     * @var string
     */
    private $codigo_postal;
    /**
     * Direccion de la empresa
     *
     * @var string
     */
    private $direccion;
    /**
     * Direccion web de la empresa
     *
     * @var string
     */
    private $web;
    /**
     * Breve descripcion de la empresa
     *
     * @var string
     */
    private $descripcion;
    /**
     * Fecha de alta de la empresa en la base de datos
     *
     * @var date
     */
    private $fecha_alta;
    /**
     * Identificador del país al que pertenece la empresa
     *
     * @var integer
     */
    private $id_pais;
    /**
     * Identificador del socio que registró la empresa en la base de datos
     *
     * @var integer
     */
    private $id_socio;
    /**
     * Identificador del tipo de empresa
     *
     * @var integer
     */
    private $id_tipo;
    /**
     * Fecha de baja de la empresa en la base de datos
     *
     * @var date
     */
    private $fecha_baja;
    /**
     * Fecha de modificación de los datos en la base de datos
     *
     * @var date
     */
    private $fecha_mod;

    public function __construct($id_responsable, $cargo_responsable, $vat, $nombre, $email, $telefono, $codigo_postal, $direccion, $fecha_alta, $id_pais, $id_socio, $id_tipo, $web, $descripcion, $fecha_mod)
    {
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
        $this->fecha_mod = $fecha_mod;
    }


    /**
     * Meotod mágico que devuelve el valor de una propiedad si esa existe 
     *
     * @param string $name el nombre de la propiedad a la que se intenta acceder
     * @return string el valor de dicha propiedad
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }



    /**
     * Establece el valor del vat
     *
     * @return  self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Establece el valor de la fecha de alta
     *
     * @return  self
     */
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * establece el valor de la fecha de modificación
     *
     * @return  self
     */
    public function setFecha_mod($fecha_mod)
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }

    /**
     * Establece el valor del id_responsable
     *
     * @return  self
     */
    public function setId_responsable($id_responsable)
    {
        $this->id_responsable = $id_responsable;

        return $this;
    }
}
