<?php

namespace modelo;

class Socio
{

    private $vat;
    private $password;
    private $usuario;
    private $nombre_completo;
    private $email;
    private $telefono;
    private $fecha_alta;
    private $fecha_baja;
    private $cargo;
    private $departamento;
    private $r_alojamiento;
    private $puntuacion;
    private $id_rol;
    private $id_institucion;
    private $id_pais;
    private $fecha_mod;

    function __construct($vat, $password, $usuario, $nombre_completo, $email, $telefono, $fecha_alta, $cargo, $departamento, $r_alojamiento, $puntuacion, $rol, $pais, $fecha_mod)
    {
        $this->vat = $vat;
        $this->password = $password;
        $this->usuario = $usuario;
        $this->nombre_completo = $nombre_completo;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->fecha_alta = $fecha_alta;
        $this->cargo = $cargo;
        $this->departamento = $departamento;
        $this->r_alojamiento = $r_alojamiento;
        $this->puntuacion = $puntuacion;
        $this->id_rol = $rol;
        $this->id_pais = $pais;
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
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

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

    /**
     * Set the value of id_rol
     *
     * @return  self
     */ 
    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;

        return $this;
    }
}
