<?php

use function controlador\add_movilidad_empresa;
use function controlador\add_movilidad_institucion;
use function controlador\buscar_alumno;
use function controlador\buscar_empresa;
use function controlador\buscar_institucion;
use function controlador\cargar_alumno_especialidad;

require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';

session_start();
if (!comprobar_sesion()) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_POST['alojamiento'])){
       
        $alojamiento="";
    } else{
        $alojamiento=$_POST['alojamiento'];
    }
    
    if($_POST['tipo']=="empresa"){
        
        
        if(add_movilidad_empresa($_POST['alumno'],$_POST['empresa'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$alojamiento,$_SESSION['id_socio'])){
            $_SESSION['alert_msg']="New mobility has been registered.";
        }
        else{
            $_SESSION['alert_msg']="Fail trying to register a new mobility. Not enough points.";
        }
        header("Location: movilidades.php?tipo=empresa");
        exit;
    }
    else if($_POST['tipo']=="institucion"){
        if(add_movilidad_institucion($_POST['alumno'],$_POST['institucion'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$alojamiento,$_SESSION['id_socio'])){
            $_SESSION['alert_msg']="New mobility has been registered.";
        }
        else{
            $_SESSION['alert_msg']="Fail trying to register a new mobility. Not enough points.";
        }
        header("Location: movilidades.php?tipo=institucion");
        exit;
    }
   
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $tipo = $_GET['tipo'];
}




?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>MERT</title>
    <link rel="shortcut icon" href="./imagenes/MERTLOGOPESTANA.png" type="image/png">
    <link rel="stylesheet" href="./css/estiloLogin.css">
</head>

<body class="d-flex flex-column">

    <?php
    require_once 'cabecera.php';
    require_once '../controlador/metodosBBDD.php';
    ?>

    <section class="container-fluid flex-grow pr-4 pl-4">

        <div class="container-fluid d-flex">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-100">
            <input type="hidden" value="<?php echo $tipo?>" name="tipo">
                <div class="form-row w-100 mw-100">
                    <div class="col-12">
                        <h2>Register Student Mobility</h2>
                    </div>
                </div>


                <div class="form-row text-center container-fluid">
                    <div class="col-sm-3"></div>

                    <div id="titulo2" class="col-md-2">
                        <h3>
                            <nav class="navbar navbar-light bg-light ">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Student List</span>
                                </a>
                            </nav>
                        </h3>
                        <?php $array_alumnos = buscar_alumno($_SESSION['id_socio']);
                        if ($array_alumnos == null) {
                            $cadena = "<p>No students registered by this user</p>";
                            echo $cadena;
                        } else { ?>
                            <table class="text-center table-responsive">
                                <tr class="border">
                                    <th class="border"></th>
                                    <th class="border">NAME</th>
                                    <th class="border" width="100px">VAT</th>
                                    <th class="border" width="120px">BIRTH DATE</th>
                                </tr>
                                <?php

                                $tr = '';
                                foreach ($array_alumnos as $fila) {
                                    $tr .= '<tr> <td><input required type="radio" name="alumno" value="' . $fila['ID_ALUMNO'] . '"' . '</td>';
                                    $tr .= '<td>' . $fila["NOMBRE_COMPLETO"] . '</td>';
                                    $tr .= '<td>' . $fila["VAT"] . '</td>';
                                    $tr.=' <td>' . $fila["FECHA_NACIMIENTO"] . '</td>';
                                   
                                    
                                }
                                echo $tr;
                                

                                ?>

                            </table>
                        <?php

                        }
                        

                        ?>

                    </div>
                    <div class="col-sm-2"></div>

                    <?php
                    if ($tipo == "empresa") {
                    ?>
                        <div id="titulo2" class="col-md-4">
                            <h3>
                                <nav class="navbar navbar-light bg-light">
                                    <a class="navbar-brand">
                                        <i class="fa fa-user"></i>
                                        <span id="info">Company List</span>
                                    </a>
                                </nav>
                            </h3>
                            <?php $array_empresa = buscar_empresa();
                        if ($array_empresa == null) {
                            $cadena = "<p>There are no companies registered</p>";
                            echo $cadena;
                        } else { ?>
                            <table class="text-center table-responsive">
                                <tr class="border">
                                    <th class="border"></th>
                                    <th class="border">NAME</th>
                                    <th class="border" width="100px">VAT</th>
                                    <th class="border" width="120px">EMAIL</th>
                                    <th class="border" width="120px">DESCRIPTION</th>
                                </tr>
                                <?php

                                $tr = '';
                                foreach ($array_empresa as $fila) {
                                    $tr .= '<tr> <td><input  required type="radio" name="empresa" value="' . $fila['ID_EMPRESA'] . '"' . '</td>';
                                    $tr .= '<td>' . $fila["NOMBRE"] . '</td>';
                                    $tr .= '<td>' . $fila["VAT"] . '</td>';
                                    $tr .= '<td>' . $fila["EMAIL"] . '</td>';
                                    $tr.=' <td>' . $fila["DESCRIPCION"] . '</td>';
                                   
                                    
                                }
                                echo $tr;
                                

                                ?>

                            </table>
                        <?php

                        }
                        

                        ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if ($tipo == "institucion") {
                    ?>
                        <div id="titulo2" class="col-md-4">
                            <h3>
                                <nav class="navbar navbar-light bg-light">
                                    <a class="navbar-brand">
                                        <i class="fa fa-user"></i>
                                        <span id="info">Institution List</span>
                                    </a>
                                </nav>
                            </h3>
                            <?php $array_inst = buscar_institucion();
                        if ($array_inst == null) {
                            $cadena = "<p>There are no institutions registered</p>";
                            echo $cadena;
                        } else { ?>
                            <table class="text-center table-responsive">
                                <tr class="border">
                                    <th class="border"></th>
                                    <th class="border">NOMBRE</th>
                                    <th class="border" width="100px">VAT</th>
                                    <th class="border" width="120px">EMAIL</th>
                                    <th class="border" width="120px">DESCRIPTION</th>
                                </tr>
                                <?php

                                $tr = '';
                                foreach ($array_inst as $fila) {
                                    $tr .= '<tr> <td><input required type="radio" name="institucion" value="' . $fila['ID_INSTITUCION'] . '"' . '</td>';
                                    $tr .= '<td>' . $fila["NOMBRE"] . '</td>';
                                    $tr .= '<td>' . $fila["VAT"] . '</td>';
                                    $tr .= '<td>' . $fila["EMAIL"] . '</td>';
                                    $tr.=' <td>' . $fila["DESCRIPCION"] . '</td>';
                                   
                                    
                                }
                                echo $tr;
                                

                                ?>

                            </table>
                        <?php

                        }
                        

                        ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group mt-5 mb-5">
                <div class="col-sm-12 controls text-center">
                    Start Date  <input type="date" name="fecha_inicio" class="mr-5" required>
                    End Date  <input type="date" name="fecha_fin" required><br><br>
                    Helped lodging  <input type="checkbox" name="alojamiento">
                    </div>
                </div>




                <div style="margin-top:10px" class="form-group mt-5">

                    <div class="col-sm-12 controls text-center">
                        <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Send"></input>
                        <input type="reset" class="btn btn-secondary" value="Clear"></input>
                    </div>

                </div>

            </form>

        </div>

    </section>

    <?php require 'footer.php' ?>
</body>

</html>