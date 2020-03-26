<?php

namespace vista;

use modelo\Socio;
use modelo\Institucion;




require_once '../controlador/metodosBBDD.php';
require_once '../modelo/socios.php';
require_once '../modelo/institucion.php';
require_once '../controlador/sesiones.php';
session_start();

if (!\controlador\comprobar_sesion()) {
    header('Location: index.php');
}

$datos_socio = \controlador\buscar_socio($_SESSION['id_socio']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!\controlador\update_socio($_SESSION['id_socio'], $_POST)) {
        $_SESSION['alert_msg'] = "Error";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['alert_msg'] = "Data modificated succesfully";
        header("Location: index.php");
        exit;
    }
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
    <section class="container-fluid flex-grow pr-4 pl-4">


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-row">
                <div class="col-12">
                    <h2>Modify Information</h2>
                </div>
            </div>


            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-user"></i>
                                <span id="info">Personal Information</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">User</label>
                    <input type="text" class="form-control" id="nombre" name="usuario_soc" placeholder="Username" required value='<?php echo $datos_socio['USUARIO']; ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password_soc" placeholder="Password" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="nombre" name="nombre_soc" placeholder="" required value='<?php echo htmlspecialchars($datos_socio['NOMBRE_COMPLETO']) ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">VAT</label>
                    <input type="text" class="form-control" name="vat_soc" placeholder="VAT" value='<?php echo $datos_socio['VAT'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email_soc" placeholder="example@gmail.com " required value='<?php echo $datos_socio['EMAIL'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Telephone</label>
                    <input type="text" class="form-control" name="telefono_soc" placeholder="(+34) 123 456 789" required value='<?php echo $datos_socio['TELEFONO'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Position</label>
                    <input type="text" class="form-control" name="cargo_soc" placeholder="Head Master, proffesor... " required value='<?php echo $datos_socio['CARGO'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Department</label>
                    <input type="text" class="form-control" name="departamento_soc" placeholder="Department" required value='<?php echo $datos_socio['DEPARTAMENTO'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Country</label>
                    <select name="pais_soc">
                        <?php
                        $array_paises = \controlador\cargar_paises();
                        $option = '';
                        foreach ($array_paises as $fila) {
                            if ($datos_socio['PAIS'] == $fila['ID_PAIS']) {
                                $option .= '<option value="' . $fila['ID_PAIS'] . '"selected>' . $fila['NOMBRE'] . '</option>';
                            } else {
                                $option .= '<option value="' . $fila['ID_PAIS'] . '">' . $fila['NOMBRE'] . '</option>';
                            }
                        }
                        echo $option;
                        ?>

                    </select>
                </div>

            </div>

            <div class="form-group col-md-1"></div>

            </div>

            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Update"></input>
                    <input type="reset" class="btn btn-secondary" value="Clear"></input>

                </div>
            </div>

        </form>

    </section>
    <?php require 'footer.php'; ?>


</body>

</html>