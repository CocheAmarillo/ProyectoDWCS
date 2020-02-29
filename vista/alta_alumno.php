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

    $alumno = new Alumno($_POST['vat_al'], $_POST['nombre_al'], $_POST['genero_al'], $_POST['fecha_nac_al'], null, $_SESSION['id_socio'], null);
    if ($id_alumno=\controlador\alta_alumno($alumno)) { //la función devuelve el id del alumno insertado en la base de datos

        if (!isset($_POST['especialidades_alumno'])) {
            $especialiadades = null;
        } else {
            $especialiadades = $_POST['especialidades_alumno'];
        }
        \controlador\update_puntuacion_socio($_SESSION['id_socio'], 3);
        \controlador\add_especialidad_alumno($id_alumno,$especialiadades);
        echo "Alumno insertado con exito";
        
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
    <title>ejer1</title>
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
                        <h2>Dar de alta un alumno</h2>
                    </div>
                </div>


                <div class="form-row tex text-center">
                    <div id="titulo2" class="col-12">
                        <h3>
                            <nav class="navbar navbar-light bg-light">
                                <a class="navbar-brand">
                                    <i class="fa fa-user"></i>
                                    <span id="info">Informacion del Alumno</span>
                                </a>
                            </nav>
                        </h3>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="form-group col-md-4 container-fluid w-100 text-left">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre_al" placeholder="Nombre" required>
                    </div>
                </div>

                <div class="form-row w-100">
                    <div class="form-group col-md-4 container-fluid w-100 text-left">
                        <label for="">VAT</label>
                        <input type="text" class="form-control" name="vat_al" placeholder="VAT">
                    </div>
                </div>



                <div class="form-row w-100">
                    <div class="form-group col-md-4 container-fluid w-100 text-left">
                        <label for="">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nac_al" required>
                    </div>
                </div>



                <div class="form-row w-100 text-right">
                    <div class="form-group col-md-5 container-fluid w-50">
                        <label for="">Género</label>
                        <select name="genero_al">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value='O'>Otre</option>
                        </select>
                    </div>

                    <div class="form-group col-md-5 container-fluid text-left w-25">
                        <label for="">Especialidades</label>
                        <select name="especialidades_alumno[]" multiple class="form-control w-25 text-left ">
                            <?php
                            $array_especialidades = controlador\cargar_especialidades();
                            $option = '';
                            foreach ($array_especialidades as $fila) {
                                $option .= '<option value="' . $fila['ID_ESPECIALIDAD'] . '">' . $fila['TIPO'] . '</option>';
                            }
                            echo $option;
                            ?>
                        </select>
                    </div>
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