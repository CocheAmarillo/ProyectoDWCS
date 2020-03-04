<?php
require_once 'sesiones.php';

$registrado = false;
if (comprobar_sesion()) {
    $registrado = true;
}

?>
<script type="text/javascript" src="../controlador/metodosJS.js"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.php"><img src="imagenes/logofinal.png" id="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-tabs">
            <?php
            if ($registrado == false) { ?>
            <?php } ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Empresa
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="alta_empresa.php">Dar de alta</a>
                    <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Dar de baja</a>
                    <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Modificacion de datos</a>
                    <a class="dropdown-item" href="busqueda_empresas.php">Búsqueda de empresas</a>

                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Institución
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                    <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Dar de baja</a>
                    <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Modificacion de datos</a>
                    <a class="dropdown-item" href="busqueda_instituciones.php">Búsqueda de instituciones</a>


                </div>
            </li>

            <?php
            if ($registrado == true) { ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Alumno
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="alta_alumno.php">Dar de alta</a>
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Dar de baja</a>
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Modificacion de datos</a>
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Movilidades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Movilidad con Empresa</a>
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="">Movilidad con Institucion</a>
                    </div>
                </li>

            <?php } ?>



        </ul>
        <div>
            <?php
            if ($registrado == true) { ?>
                <ul class="navbar-nav mr-auto nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" onclick="confirmLogOut()" href="#">Cerrar Sesion</a>
                    </li>
                </ul>

            <?php } else { ?>
                <ul class="navbar-nav mr-auto nav-tabs">
                    <li class="nav-item align-right">
                        <a class="nav-link" href="login.php">Iniciar Sesion</a>
                    </li>
                </ul>
            <?php } ?>
        </div>

        <?php if ($registrado == true) { ?>
            <form class="form-inline my-2 my-lg-0">

                <p>Usuario:<?php echo $_SESSION['usuario'] . " con id: " . $_SESSION['id_socio']; ?> </p>

            </form>
        <?php } ?>

    </div>
</nav>
<div class="alert alert-dismissible fade show d-none" role="alert">
    <strong>Sesion Cerrada Correctamente</strong> Hasta la próxima!.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>