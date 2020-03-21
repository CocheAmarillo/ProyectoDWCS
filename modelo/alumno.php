<?php

namespace modelo;
/**
 * Clase para modelar los datos de un alumno
 */
class Alumno
{
    /**
     * el documento identificativo
     *
     * @var string
     */
    private $vat;
    /**
     * nombre completo del alumno
     *
     * @var string
     */
    private $nombre_completo;
    /**
     * el genero del alumno 
     *
     * @var string
     */
    private $genero;
    /**
     * Fecha de nacimiento
     *
     * @var date
     */
    private $fecha_nacimiento;
    /**
     * Fecha de alta en la base de datos
     *
     * @var date
     */
    private $fecha_alta;
    /**
     * Fecha de baja en la base de datos
     *
     * @var date
     */
    private $fecha_baja;
    /**
     * Fecha de modificacion de los datos en la base de datos
     *
     * @var date
     */
    private $fecha_mod;
    /**
     * Identificador del socio que dio de alta al alumno
     *
     * @var integer
     */
    private $id_socio;

    function __construct($vat, $nombre_completo, $genero, $fecha_nacimiento, $fecha_alta, $socio, $fecha_mod)
    {
        $this->vat = $vat;
        $this->nombre_completo = $nombre_completo;
        $this->genero = $genero;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_alta = $fecha_alta;
        $this->id_socio = $socio;
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
     * Establece el valor de fecha alta
     *
     * @return  self
     */
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * Establece el valor de fecha de modificación
     *
     * @return  self
     */
    public function setFecha_mod($fecha_mod)
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }
}
