<?php namespace vista;
require_once '../controlador/sesiones.php';
require_once '../controlador/metodosBBDD.php';
session_start();
if (\controlador\comprobar_sesion()) {
    header('Location: index.php');
}

$previa= $_SESSION['previa'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = \controlador\comprobar_usuario($_POST['usuario'], $_POST['password']);

    if ($usuario === false) {
        $_SESSION['alert_msg']="Check again username and password.";
        $usuario = $_POST['usuario']; //para que permanezca en el campo de texto lo escrito por el usuario
    } else {
        
     
       
        $_SESSION['id_socio'] = $usuario['id_socio'];
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['alert_msg']="Sesion has been started";
        if(!isset($_SESSION['previa']) || $_SESSION['previa']==""){
           header("Location: index.php");
        }
        else{
            header("Location: ".$previa);
        }
        exit;
        
       
      
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
                <img src="imagenes/MERTLOGOPESTANA.png" alt="MERT" id="logo2" class="rounded float-right mr-5" alt="logo de la web">
            </div>
            <div class="col-lg-5 ">
                <div id="formulario" class="container">
                    <h2 class="text-center">Log In</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="">User:</label>
                            <input type="text" class="form-control" id="user" placeholder="User" name="usuario" value="<?php if(isset($usuario)) echo $usuario;?>">
                        </div>
                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">
                        </div>

                        <input type="submit" name="enviar" id="btn_login" class="btn btn-default btn-block mt-4 mb-5" value="Log In">
                        <div class="form-group text-center"><a href="alta_socio.php">Register</a></div>

                    </form>
                </div>
            </div>
        </div>

    </section>

    <?php require 'footer.php' ?>

</body>

</html>