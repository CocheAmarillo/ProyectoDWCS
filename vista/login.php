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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ejer1</title>

    <link rel="stylesheet" href="./css/estiloAltas.css">

</head>

<body>

    <?php
    require_once 'cabecera.php';
    if (isset($err) and $err == true) {
        echo "<p> Revise usuario y contraseña</p>";
    }
    ?>

    <section id="broken">

    <div id="formulario" class="container">
        <h2>Iniciar sesión</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="">Usuario:</label>
                <input type="text" class="form-control" id="user" placeholder="Introducir usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario; ?>">
            </div>
            <div class="form-group">
                <label for="">Contraseña:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Introducir contraseña" name="password">
            </div>

            <input type="submit" name="enviar" id="ini_ses" class="btn btn-block" value="Iniciar Sesion">
        </form>
    </div>
    </section>



    <?php require 'footer.php'; ?>

</body>

</html>