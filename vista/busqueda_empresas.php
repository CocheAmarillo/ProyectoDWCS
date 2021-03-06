<?php namespace vista;
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
                        <h2>Company List</h2>
                    </div>
                </div>
                <div class="form-row tex text-center">
                    <div id="titulo2" class="col-12">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Company Data</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                </div>

                <div id="resultado" class="container-fluid  d-flex">

                    <table class="text-center table-responsive">
                        <tr class="border">
                            <?php if ($registrado == true) { ?>
                                <th class="border">JOB TITLE</th>
                                <th class="border">VAT</th>
                            <?php  } ?>
                            <th class="border" width="100px">COMPANY NAME</th>
                            <th class="border" width="180px">DESCRIPTION</th>
                            <?php if ($registrado == true) { ?>
                                <th class="border" width="200px">EMAIL</th>
                                <th class="border" width="120px">PHONE NR</th>
                                <th class="border">ZIP CODE</th>
                                <th class="border" width="120px">ADDRESS</th>
                                <th class="border" width="120px">WEB</th>



                                <th class="border" width="200px">REGISTER DATE</th>
                                <th class="border" width="200px">PARTNER</th>
                                <th class="border">PERSON IN CHARGE</th>
                            <?php  } ?>
                            <th class="border" width="100px">COUNTRY</th>
                            <th class="border" width="150px">TYPE</th>
                            <th class="border" width="40px">SPECIALTIES</th>
                         
                                <th class="border" width="120px">ACTIONS</th>
                           
                        </tr>
                        <?php
                        $array_empresas = \controlador\buscar_empresa();
                        if ($array_empresas == null) {
                            echo "<tr><td colspan='19'>No companies registered</td></tr>";
                        } else {
                            $tr = '';
                            foreach ($array_empresas as $fila) {
                                $tr .= '<tr>';
                                if ($registrado == true) {

                                    $tr .= ' <td>' . $fila["CARGO_RESPONSABLE"] . '</td>
                            <td>' . $fila["VAT"] . '</td>';
                                }
                                $tr .= '<td>' . $fila["NOMBRE"] . '</td>' .
                                    '<td>' . $fila["DESCRIPCION"] . '</td>';
                                if ($registrado == true) {
                                    $tr .= '<td>' . $fila["EMAIL"] . '</td>
                            <td>' . $fila["TELEFONO"] . '</td>
                            <td>' . $fila["CODIGO_POSTAL"] . '</td>
                            <td>' . $fila["DIRECCION"] . '</td>
                            <td>' . $fila["WEB"] . '</td>

                            <td>' . $fila["FECHA_ALTA"] . '</td>
                            <td>' . \controlador\buscar_nombre_socio($fila["SOCIO"])['nombre'] . '</td>
                            <td>' . \controlador\buscar_nombre_responsable($fila["RESPONSABLE"])['nombre'] . '</td>';
                                }
                                $tr .= '<td>' .  \controlador\buscar_pais($fila["PAIS"])['nombre'] . '</td>';
                                $tr .= '<td>' . \controlador\buscar_tipo_empresa($fila["TIPO"])['tipo'] . '</td>';
                                $cadena = "";
                                $array_especialidades = \controlador\cargar_empresa_especialidad($fila['ID_EMPRESA']);
                                if ($array_especialidades != null) {
                                    foreach ($array_especialidades as $fila_especialidad) {
                                        $cadena .= $fila_especialidad['especialidad'] . "<br>";
                                    }
                                }


                                $tr .= "<td>$cadena</td</tr>";
                                if ($registrado == true && $fila['SOCIO']==$_SESSION['id_socio']) {
                                    $tr .= "<td><a href='modificar_empresa.php?id_empresa=".$fila['ID_EMPRESA']."'><i class='fa fa-edit'></i></a><button type='button' onclick=borrar(".$fila['ID_EMPRESA'].",'empresa');><i class='fa fa-trash'></i></button></td></tr>";
                                }
                                else{
                                    $tr.="<td>Actions not allowed</td>";
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