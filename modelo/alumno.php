<?php
namespace modelo;
class Alumno{
    private $vat;
    private $nombre_completo;
    private $genero;
    private $fecha_nacimiento;
    private $fecha_alta;
    private $fecha_baja;
    private $id_socio;
    
    function __construct($vat, $nombre_completo, $genero, $fecha_nacimiento, $fecha_alta, $socio) {
        $this->vat = $vat;
        $this->nombre_completo = $nombre_completo;
        $this->genero = $genero;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_alta = $fecha_alta;
        $this->id_socio = $socio;
    }

    
    
     public function __get($name) {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }
}