<?php
require_once '../controlador/metodosBBDD.php';
require_once 'sesiones.php';
require_once '../modelo/alumno.php';

use modelo\Alumno;

session_start();
if (!comprobar_sesion()) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_alta = new DateTime();
    $fecha_alta = $fecha_alta->format('Y-m-d H:i:s');
    $alumno = new Alumno($_POST['vat_al'], $_POST['nombre_al'], $_POST['genero_al'], $_POST['fecha_nac_al'], $fecha_alta, $_SESSION['id_socio']);
    if (\controlador\alta_alumno($alumno)) {
        \controlador\update_puntuacion_socio($_SESSION['id_socio'], 3);
        echo "alumno insertado con exito";
    }
}
?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>ejer1</title>
        <link rel="stylesheet" href="./css/estiloAltas.css">
    </head>

    <body class="text-center">

        <?php
        require_once 'cabecera.php';
        require_once '../controlador/metodosBBDD.php';
        ?>


        <div class="container-fluid text-center d-flex justify-content-center">
            <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST" class="w-100">
                <div class="form-row text-center w-100 mw-100">
                    <div class="col-12 text-center">
                        <h2>Dar de alta un alumno</h2>
                    </div>
                </div>


                <div class="form-row tex mb-2 text-center">
                    <div id="titulo2" class="col-12">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="titulo">Informacion del Alumno</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                </div>

                <div class="form-row w-100 mt-3 mb-3">
                    <div class="form-group col-md-4 container-fluid w-100 mt-1 mb-4 text-left">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control"  id="nombre" name="nombre_al" placeholder="Nombre" required>
                    </div>
                </div>

                <div class="form-row w-100 mb-3">
                    <div class="form-group col-md-4 container-fluid w-100 text-left">
                        <label for="">VAT</label>
                        <input type="text" class="form-control" name="vat_al" placeholder="VAT">
                    </div>
                </div>



                <div class="form-row w-100 mt-3 mb-2">
                    <div class="form-group col-md-4 container-fluid w-100 text-left">
                        <label for="">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nac_al" required>
                    </div>
                </div>


                <div class="form-row w-100 mt-3 mb-5">
                    <div class="form-group col-md-4 container-fluid w-100">
                        <label for="">Género</label>
                        <select name="genero_al">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value='O'>Otre</option>
                        </select>
                    </div>
                </div>


                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls">
                        <input type="submit"  class="btn" id="enviar" name="enviar" value="Enviar"></input>
                        <input type="reset" class="btn btn-secondary" value="Borrar"></input>

                    </div>
                </div>

            </form>

        </div>


        <footer class="page-footer font-small blue pt-4">


            <div class="container-fluid">


                <div class="row">

                    <div id="icons" class="col-md-12 py-5">
                        <div class="mb-5 text-center">


                            <a class="fb-ic">
                                <i class="fa fa-facebook-f fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                            </a>

                            <a class="tw-ic">
                                <i class="fa fa-twitter fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                            </a>

                            <a class="gplus-ic">
                                <i class="fa fa-envelope fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                            </a>

                            <a class="li-ic">
                                <i class="fa fa-whatsapp fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                            </a>

                            <a class="ins-ic">
                                <i class="fa fa-instagram fa-lg  mr-md-5 mr-3 fa-2x"> </i>
                            </a>

                            <a class="pin-ic">
                                <i class="fa fa-pinterest fa-lg z fa-2x"> </i>
                            </a>
                        </div>
                    </div>


                </div>


            </div>



            <div id="copyright" class="footer-copyright text-center py-3">© 2020 Copyright

            </div>


        </footer>
    </body>

</html>