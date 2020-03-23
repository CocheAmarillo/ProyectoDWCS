<?php

namespace vista;

require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';
require_once '../modelo/alumno.php';

use modelo\Alumno;


session_start();
if (!\controlador\comprobar_sesion()) {
    $registrado = false;
} else {
    $registrado = true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

            <div class="container-fluid d-flex">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-100" class="border">
                    <div class="form-row w-100 mw-100">
                        <div class="col-12">
                            <h2>Partner List</h2>
                        </div>
                    </div>
                    <div class="form-row tex text-center">
                        <div id="titulo2" class="col-12">
                            <h3>
                                <nav class="navbar navbar-light bg-light">
                                    <a class="navbar-brand">
                                        <i class="fa fa-user"></i>
                                        <span id="info">Partner Data</span>
                                    </a>
                                </nav>
                            </h3>
                        </div>
                    </div>

                    <div id="resultado" class="container-fluid  d-flex">
                        <table class="text-center table-responsive">
                            <tr class="border">


                                <th class="border">VAT</th>
                                <th class="border" width="100px">NAME</th>
                                <th class="border" width="200px">EMAIL</th>
                                <th class="border" width="120px">PHONE NR</th>
                                <th class="border">USERNAME</th>
                                <th class="border" width="120px">MODIFICATION DATE</th>
                                <th class="border" width="180px">POSITION</th>
                                <th class="border">REGISTER DATE</th>
                                <th class="border">INSTITUTION</th>
                                <th class="border">COUTRY</th>
                                <th class="border">ACTIONS</th>

                            </tr>
                            <?php
                            $array_socio = \controlador\buscar_socios($_POST['fecha1'], $_POST['fecha2']);

                            if ($array_socio == null) {
                                echo "<tr><td colspan='17'>No parterns registered between dates</td></tr>";
                            } else {
                                $tr = '';
                                foreach ($array_socio as $fila) {
                                    $tr .= '<tr>';
                                    $tr .= '<td>' . $fila["VAT"] . '</td>';
                                    $tr .= '<td>' . $fila["NOMBRE_COMPLETO"] . '</td>';
                                    $tr .= '<td>' . $fila["EMAIL"] . '</td>
                                    <td>' . $fila["TELEFONO"] . '</td>
                                    <td>' . $fila["USUARIO"] . '</td>
                                    <td>' . $fila["FECHA_MOD"] . '</td>
                                    <td>' . $fila["CARGO"] . '</td>
                                    <td>' . $fila["FECHA_ALTA"] . '</td>';
                                    $tr .= '<td>' . \controlador\buscar_institucion_por_id($fila["ID_SOCIO"])['NOMBRE'] . '</td>';
                                    $tr .= '<td>' .  \controlador\buscar_pais($fila["PAIS"])['nombre'] . '</td>';
                                    $tr .= "<td><a href='enviar_correo_socio.php?socio=".$fila['ID_SOCIO']."'><i class='fa fa-trash'></i></a></td></tr>";
                                }
                                echo $tr;
                            }
                            ?>

                        </table>
                    </div>


                    <div class="form-group mt-5 mb-5">
                        <div class=" col-sm-12 controls text-center">Dates Range: <input type="date" name="fecha1" value="0000-00-00"><input type="date" name="fecha2" value="0000-00-00">
                            <input type="submit" value="Send"></div>

                    </div>
                </form>


            </div>

        </section>

        <?php require 'footer.php' ?>
    </body>

    </html>

<?php
} else {
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

            <div class="container-fluid d-flex">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-100" class="border">
                    <div class="form-row w-100 mw-100">
                        <div class="col-12">
                            <h2>Partner List</h2>
                        </div>
                    </div>
                    <div class="form-row tex text-center">
                        <div id="titulo2" class="col-12">
                            <h3>
                                <nav class="navbar navbar-light bg-light">
                                    <a class="navbar-brand">
                                        <i class="fa fa-user"></i>
                                        <span id="info">Partner Data</span>
                                    </a>
                                </nav>
                            </h3>
                        </div>
                    </div>

                    <div class="form-group mt-5 mb-5">
                        <div class=" col-sm-12 controls text-center">Dates Range: <input type="date" name="fecha1" value="0000-00-00"><input type="date" name="fecha2" value="0000-00-00">
                            <input type="submit" value="Send"></div>
                    </div>


                </form>


            </div>

        </section>

        <?php require 'footer.php' ?>
    </body>

    </html>

<?php
}
?>