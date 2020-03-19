<?php

namespace vista;

require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';
require_once '../modelo/alumno.php';

use modelo\Alumno;


session_start();
$admin=false;
if (!\controlador\comprobar_sesion()) {
    $registrado = false;
} else {
    $registrado = true;
    if(\controlador\cargar_rol($_SESSION['id_socio'])==1){
        $admin=true;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body class="d-flex flex-column">

    <?php
    require_once 'cabecera.php';
    require_once '../controlador/metodosBBDD.php';
    ?>

    <section id="tabla" class="container-fluid flex-grow pr-4 pl-4">

        <div class="container-fluid d-flex form-row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-100" class="border">
                <div class="form-row w-100 mw-100">
                    <div class="col-12">
                        <h2>Mobility List</h2>
                    </div>
                </div>

                <div class="form-row text text-center">
                    <div id="titulo2" class="col-12 w-50">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Company mobility</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                  
                    
                </div>
                <div id="resultado" class="container-fluid  d-flex">

                    <table class="text-center table-responsive">
                        <tr class="border">

                            <th class="border">NOMBRE ALUMNO</th>
                            <th class="border">NOMBRE EMPRESA</th>

                            <th class="border" width="100px">FECHA INICIO</th>
                            <th class="border" width="180px">FECHA FIN</th>
                            <?php if ($admin == true) { ?>
                                <th class="border" width="200px">FECHA ALTA</th>

                            <?php  } ?>

                        </tr>
                        <?php
                        $array_movilidades = \controlador\buscar_movilidades_empresas($_SESSION['id_socio']);
                    
                        if ($array_movilidades == null) {
                            echo "<tr><td colspan='19'>No mobilities registered</td></tr>";
                        } else {
                            $tr = '';
                            foreach ($array_movilidades as $fila) {
                                $tr .= '<tr>';


                                $tr .= ' <td>' . $fila["nombre_alumno"] . '</td>
                            <td>' .$fila['nombre_empresa'] . '</td>'; 

                                $tr .= '<td>' . $fila["fecha_inicio"] . '</td>' .
                                    '<td>' . $fila["fecha_fin_estimado"] . '</td>';
                                if ($admin == true) {
                                    $tr .= '<td>' . $fila["fecha_alta"] . '</td>';
                        

                            
                                


                             
                              
                            }
                            
                        }
                        echo $tr;
                    }
                        ?>

                    </table>
                </div>








                 <div class="form-row text text-center">
                    <div id="titulo2" class="col-12 w-50">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Institution mobility</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                  
                    
                </div>
                <div id="resultado" class="container-fluid  d-flex">

                    <table class="text-center table-responsive">
                        <tr class="border">

                            <th class="border">NOMBRE ALUMNO</th>
                            <th class="border">NOMBRE EMPRESA</th>

                            <th class="border" width="100px">FECHA INICIO</th>
                            <th class="border" width="180px">FECHA FIN</th>
                            <?php if ($admin == true) { ?>
                                <th class="border" width="200px">FECHA ALTA</th>

                            <?php  } ?>

                        </tr>
                        <?php
                        $array_movilidades = \controlador\buscar_movilidades_institucion($_SESSION['id_socio']);
                    
                        if ($array_movilidades == null) {
                            echo "<tr><td colspan='19'>No mobilities registered</td></tr>";
                        } else {
                            $tr = '';
                            foreach ($array_movilidades as $fila) {
                                $tr .= '<tr>';


                                $tr .= ' <td>' . $fila["nombre_alumno"] . '</td>
                            <td>' .$fila['nombre_empresa'] . '</td>'; 

                                $tr .= '<td>' . $fila["fecha_inicio"] . '</td>' .
                                    '<td>' . $fila["fecha_fin_estimado"] . '</td>';
                                if ($admin == true) {
                                    $tr .= '<td>' . $fila["fecha_alta"] . '</td>';
                        

                            
                                


                             
                              
                            }
                            
                        }
                        echo $tr;
                    }
                        ?>

                    </table>
                </div>

            </form>


        </div>

    </section>

    <?php require 'footer.php' ?>
</body>

</html>