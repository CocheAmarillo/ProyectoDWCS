<?php
require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';

session_start();
if (!comprobar_sesion()) {
    header('Location: index.php');
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
    <title>Movilidades</title>
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
                <div class="form-row w-100 mw-100">
                    <div class="col-12">
                        <h2>Registrar movilidad alumno</h2>
                    </div>
                </div>


                <div class="form-row text-center container-fluid">
                    <div class="col-sm-3"></div>

                    <div id="titulo2" class="col-md-2">
                        <h3>
                            <nav class="navbar navbar-light bg-light ">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Lista de Alumnos</span>
                                </a>
                            </nav>
                        </h3>
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
                                        <span id="info">Lista de Empresas</span>
                                    </a>
                                </nav>
                            </h3>
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
                                    <span id="info">Lista de Instituciones</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                    <?php
                    }
                    ?>  
                </div>






                <div style="margin-top:10px" class="form-group">

                    <div class="col-sm-12 controls text-center">
                        <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Enviar"></input>
                        <input type="reset" class="btn btn-secondary" value="Borrar"></input>
                    </div>

                </div>

            </form>

        </div>

    </section>

    <?php require 'footer.php' ?>
</body>

</html>