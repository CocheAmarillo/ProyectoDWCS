<?php

namespace vista;

require_once '../controlador/sesiones.php';
require_once '../controlador/metodosBBDD.php';
session_start();
if (!\controlador\comprobar_sesion()) {
    header('Location: index.php');
}

$nombre_socio=\controlador\buscar_nombre_socio($_SESSION['id_socio'])['nombre'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email_admin=\controlador\buscar_admin()['email'];
   $id_admin=\controlador\buscar_admin()['id_socio'];
   if(\controlador\enviar_mail($email_admin,$_POST['nombre'],$_POST['descripcion'],$_POST['asunto'])){
   
    \controlador\update_peticiones($_POST['asunto'],$_POST['descripcion'],$_SESSION['id_socio'],$id_admin);
    \header("Location:index.php");
   }


}
?>


<!DOCTYPE html>
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

    ?>


    <section class="container-fluid flex-grow" id="fila">
        <div class="row mt-5 pt-5 ml-3 mr-3 mb-4">
            <div class="col-md-4 ml-5 mb-5" id="colLogo">
                <img src="imagenes/MERTLOGOPESTANA.png" alt="logo2" id="logo2" class="rounded float-right mr-5 ">
            </div>
            <div class="col-lg-5 ">
                <div id="formulario" class="container">
                    <h2 class="text-center">Contact</h2>
                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <p>Name:</p>
                        <div style="margin-bottom: 25px" class="input-group ">

                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                            </div>
                            <input id="login-username" type="text" class="form-control" name="nombre" value="<?php echo $nombre_socio ?>">
                        </div>


                        <p>Subject:</p>
                        <div style="margin-bottom: 25px" class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-bullhorn"></i></div>
                            </div>

                            <select class="form-control" name="asunto">

                                <option>Request to register a new specialty</option>
                                <option>Request an information change</option>
                                <option>Contact to administrator</option>

                            </select>
                        </div>
                        <p>Description:</p>
                        <div style="margin-bottom: 25px" class="input-group ">

                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-comment"></i></div>
                            </div>
                            <textarea id="login-username" class="form-control" name="descripcion" value=""></textarea>
                        </div>







                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <input type="submit" value="Send" class="btn btn-default">
                                <input type="reset" class="btn btn-secondary" value="Clear"></input>

                            </div>
                        </div>



                    </form>


                </div>
            </div>
        </div>

    </section>

    <?php require 'footer.php' ?>

</body>

</html>