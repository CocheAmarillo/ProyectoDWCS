<?php
require_once 'sesiones.php';

$registrado=false;
if (comprobar_sesion()) {
    $registrado = true;
}
//logooooo2.png


?> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.php"><img src="imagenes/logofinal.png" id="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
              <?php
                    if ($registrado == false) {?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Iniciar Sesion</a>
            </li>
             <li class="nav-item">
                 <a class="nav-link" href="alta_socio.php">Registrarse como socio</a>
            </li>
                    <?php } ?>
              <?php
                    if ($registrado == true) { ?>
              <li class="nav-item">
                  <a class="nav-link" href="logout.php">Cerrar Sesion</a>
            </li>
                   
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Altas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  
                    <a class="dropdown-item" href="alta_empresa.php">Alta empresa</a>

                    <a class="dropdown-item" href="alta_alumno.php">Alta alumno</a>
                </div>
            </li>
             <?php } ?>

        </ul>

        <?php if($registrado==true){ ?>
        <form class="form-inline my-2 my-lg-0">

            <p>Usuario:<?php echo $_SESSION['usuario']." con id: ".$_SESSION['id_socio']; ?> </p>

        </form>
        <?php } ?>

    </div>
</nav>