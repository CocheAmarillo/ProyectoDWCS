<?php
namespace modelo;
/**
 * Clase Socio.
 */
class Socio
{
   /**
    * Número de identificación.
    *
    * @var string
    */
    private $vat;
    /**
     * Contraseña del socio.
     *
     * @var string
     */
    private $password;
    /**
     * Nombre de usuario del socio.
     *
     * @var string
     */
    private $usuario;
    /**
     * Nombre y apellidos del socio.
     *
     * @var string
     */
    private $nombre_completo;
    /**
     * Email del socio.
     *
     * @var string
     */
    private $email;
    /**
     * Teléfono del socio.
     *
     * @var integer
     */
    private $telefono;
    /**
     * Fecha de alta del socio.
     *
     * @var date
     */
    private $fecha_alta;
    /**
     * Fecha de baja del socio.
     *
     * @var date
     */
    private $fecha_baja;
    /**
     * Cargo del socio.
     *
     * @var string
     */
    private $cargo;
    /**
     * Departamento al que pertenece el socio.
     *
     * @var string
     */
    private $departamento;
    /**
     * Indica si el socio ayudó o no a encontrar alojamiento.
     *
     * @var boolean
     */
    private $r_alojamiento;
    /**
     * Puntuaciones que tiene el socio.
     *
     * @var integer
     */
    private $puntuacion;
    /**
     * Identificador del rol del socio.
     *
     * @var integer
     */
    private $id_rol;
    /**
     * Identificador de la institución del socio.
     *
     * @var integer
     */
    private $id_institucion;
    /**
     * identificador del país del socio.
     *
     * @var integer
     */
    private $id_pais;
    /**
     * Fecha en la que se modificó los datos del socio.
     *
     * @var date
     */
    private $fecha_mod;
/**
 * Constructor de socios.
 *
 * @param string $vat número de identificación 
 * @param string $password contraseña del socio.
 * @param string $usuario usuario del socio.
 * @param string $nombre_completo nombre completo del socio.
 * @param string $email correo del socio.
 * @param integer $telefono teléfono del socio.
 * @param Date $fecha_alta fecha en la que se da de alta el socio.
 * @param string $cargo cargo al que pertenece el socio.
 * @param string $departamento departamento al que pertenece el socio.
 * @param boolean $r_alojamiento indica si el socio ayudó o no a encontrar alojamiento.
 * @param integer $puntuacion puntuaciones que tiene dicho socio.
 * @param integer $rol rol que encadena el socio.
 * @param string $pais país al que pertenece el socio.
 * @param Date $fecha_mod fecha en la que se modifica algún dato del socio.
 */
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

   /**
    * Obtiene los datos del socio si estos existen.
    *
    * @param string $name nombre del socio.
    * @return void
    */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }


    /**
     * Establece el Vat del socio.
     *
     * @return self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * Establece la contraseña del socio. 
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Establece la fecha de alta del socio.
     *
     * @return  self
     */
    public function setFecha_alta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * Establece la fecha de modificación del socio.
     *
     * @return  self
     */
    public function setFecha_mod($fecha_mod)
    {
        $this->fecha_mod = $fecha_mod;

        return $this;
    }

    /**
     * Establece el identificador del rol del socio.
     *
     * @return  self
     */ 
    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;

        return $this;
    }
}
