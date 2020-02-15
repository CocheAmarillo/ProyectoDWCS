<?php
require_once '../controlador/metodosBBDD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $usuario = \controlador\comprobar_usuario($_POST['usuario'], $_POST['password']);
    if ($usuario === false) {
        $err = true;
        $usuario = $_POST['usuario']; //para que permanezca en el campo de texto lo escrito por el usuario
    } else {
        session_start();
        // $usu tiene campos correo y codRes, correo 
        $_SESSION['id_socio'] = $usuario['id_socio'];
        $_SESSION['usuario'] = $usuario['usuario'];
        header("Location: index.php");
        
    }
}
?>


<!DOCTYPE html>
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
        <style>
            img {
                width: 100px;
                height: 100px;
            }

            #formulario {


                margin: auto;
                background-color: lightgray;
                padding: 1%;
                border: 1px solid lightgray;
                border-radius: 5px;
                margin-bottom: 5%;
                margin-top: 5%;

            }

            #formulario h2 {
                text-align: center;
            }

            #ini_ses {
                color: white;
                background-color: #ff3006;
            }

            footer {
                background-color: #ff3006;
                position: absolute;
                top: 100%;
                width: 100%;
            }

            i {
                color: black;
            }

            #copyright {
                color: black;
            }

            #icons {
                position: relative;
                top: 50px;
            }

            .dropdown-item.active {
                background-color: #ff3006;
            }

            .dropdown-item:active {
                background-color: #ff3006;
            }

            #busqueda {
                border-color: #ff3006;
            }

            #busqueda:hover {
                background-color: #ff3006;

            }
        </style>
    </head>

    <body>

        <?php
        require_once 'cabecera.php';
        if (isset($err) and $err == true) {
            echo "<p> Revise usuario y contraseña</p>";
        }
        ?>




        <div id="formulario" class="container">
            <h2>Iniciar sesión</h2>
            <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <div class="form-group">
                    <label for="">Usuario:</label>
                    <input type="text" class="form-control" id="user" placeholder="Introducir usuario" name="usuario" value="<?php if(isset($usuario))echo $usuario;?>">
                </div>
                <div class="form-group">
                    <label for="">Contraseña:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Introducir contraseña" name="password">
                </div>

                <input type="submit" name="enviar" id="ini_ses" class="btn btn-block" value="Iniciar Sesion">
            </form>
        </div>





        <footer class="page-footer font-small cyan darken-3">


            <div class="container">


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