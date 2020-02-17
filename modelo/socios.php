<?php
namespace modelo;
class Socio{
   
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
    
    function __construct($vat, $password, $usuario, $nombre_completo, $email, $telefono, $fecha_alta, $cargo, $departamento, $r_alojamiento, $puntuacion, $rol, $pais,$fecha_mod) {
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
        $this->fecha_mod=$fecha_mod;
    }
    
    public function __get($name) {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }

    public function __set($name,$value){
        if(property_exists($this, $name)){
             $this->$name=$value;
        }
    }
    


}