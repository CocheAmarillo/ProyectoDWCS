<?php
require_once '../controlador/sesiones.php';

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

                    <a class="dropdown-item" href="busqueda_empresas.php">Listado de empresas</a>

                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Institución
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">



                    <a class="dropdown-item" href="busqueda_instituciones.php">Listado de instituciones</a>


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
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="busqueda_alumnos.php">Listado alumnos</a>

                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Movilidades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="movilidades.php?tipo=empresa">Movilidad con Empresa</a>
                        <a class="dropdown-item <?php if ($registrado == false) echo "disabled"; ?>" href="movilidades.php?tipo=institucion">Movilidad con Institucion</a>
                    </div>
                </li>

            <?php } ?>



        </ul>
        <div>
            <?php
            if ($registrado == true) { ?>
                <ul class="navbar-nav mr-auto nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" id="iconito"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item text-center" onclick="usuario()"><?php echo $_SESSION['usuario'] ?></a>
                            <a class="nav-link text-center p-2" onclick="editarPerfil()" href="#">Editar Perfil</a>
                            <a class="nav-link text-center p-2" onclick="confirmLogOut()" href="#">Cerrar Sesion</a>
                        </div>

                    </li>
                </ul>

            <?php } else { ?>
                <ul class="navbar-nav mr-auto nav-tabs">
                    <li class="nav-item align-right">
                        <?php
                        $var = "$_SERVER[REQUEST_URI]";
                        $var2 = substr($var, 20);
                        if ($var2 != "login.php") {
                            $_SESSION['previa'] = $var2;
                        }

                        ?>
                        <a class="nav-link" href="login.php">Iniciar Sesion</a>

                    </li>
                </ul>
            <?php } ?>
        </div>


    </div>
</nav>

<?php if (isset($_SESSION['alert_msg'])) {

?>
    <div class="alert alert-dismissible fade show" role="alert">
        <strong><?php echo $_SESSION['alert_msg'];
                unset($_SESSION['alert_msg']); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php

} ?>