<?php

namespace vista;

require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';
require_once '../modelo/alumno.php';

use modelo\Alumno;



session_start();
if (!\controlador\comprobar_sesion()) {
    header('Location: index.php');
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

        <div class="container-fluid d-flex">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="w-100" class="border">
                <div class="form-row w-100 mw-100">
                    <div class="col-12">
                        <h2>Student List</h2>
                    </div>
                </div>
                <div class="form-row tex text-center">
                    <div id="titulo2" class="col-12">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Student Data</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                </div>

                <div id="resultado" class="container-fluid  d-flex">

                    <table class="text-center table-responsive">
                        <tr class="border">
                            <th class="border">ID</th>
                            <th class="border">VAT</th>
                            <th class="border" width="100px">NAME</th>
                            <th class="border" width="200px">GENDER</th>
                            <th class="border" width="120px">BIRTH DATE</th>
                            <th class="border">REGISTER DATE</th>
                            <th class="border" width="120px">MODIFICATION DATE</th>
                            <th class="border" width="120px">SPECIALTIES</th>
                            <th class="border" width="120px">ACTIONS</th>
                        </tr>
                        <?php
                        $array_alumnos = \controlador\buscar_alumno($_SESSION['id_socio']);
                        if ($array_alumnos == null) {
                            echo "<tr><td colspan='9'>No students registered by this user</td></tr>";
                        } else {
                            $tr = '';
                            foreach ($array_alumnos as $fila) {
                                $tr .= '<tr>
                            <td>' . $fila["ID_ALUMNO"] . '</td>';
                                $tr .= '<td>' . $fila["VAT"] . '</td>';
                                $tr .= '<td>' . $fila["NOMBRE_COMPLETO"] . '</td>
                            <td>' . $fila["GENERO"] . '</td>
                            <td>' . $fila["FECHA_NACIMIENTO"] . '</td>
                            <td>' . $fila["FECHA_ALTA"] . '</td>
                            <td>' . $fila["FECHA_MOD"] . '</td>';






                                $cadena = "";
                                $array_especialidades = \controlador\cargar_alumno_especialidad($fila['ID_ALUMNO']);
                                if ($array_especialidades != null) {
                                    foreach ($array_especialidades as $fila_especialidades) {
                                        $cadena .= $fila_especialidades['especialidad'] . "<br>";
                                    }
                                }

                                $tr .= "<td>$cadena</td>";
                                $tr .= "<td><a href='modificar_alumno.php?id_alumno=" . $fila['ID_ALUMNO'] . "'><i class='fa fa-edit'></i></a><button  type='button' onclick=borrar(" . $fila['ID_ALUMNO'] . ",'alumno');><i class='fa fa-trash'></i></button></td></tr>";
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