<?php

namespace controlador;
\session_start();

require_once 'metodosBBDD.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tipo = $_POST['tipo'];
    $id = $_POST['id'];

    $correcto = "true";
    $mensaje="";
    switch ($tipo) {
        case 'empresa':
            
            if(!borrar_empresa($id)){
                $correcto= "false";
            }
            else{
                $mensaje="Company has been deleted";
            }

            break;
        case 'institucion':
            if(!borrar_institucion($id)){
                $correcto= "false";
            }
            else{
                $mensaje="Institution has been deleted";
            }

            break;
        case 'alumno':
            if(!borrar_alumno($id)){
                $correcto= "false";
            }
            else{
                $mensaje="Student has been deleted";
            }

            break;
        case 'socio':
            if(!borrar_socio($id)){
                $correcto= "false";
            }
            else{
                $mensaje="Partner has been deleted";
            }

            break;
        default:
            $correcto = "false";
    }
    if($correcto=="true"){
        $_SESSION['alert_msg']=$mensaje;
    }
    echo $correcto;
}
