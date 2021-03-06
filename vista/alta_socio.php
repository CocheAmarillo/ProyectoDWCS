<?php namespace vista;

use modelo\Socio;
use modelo\Institucion;




require_once '../controlador/metodosBBDD.php';
require_once '../modelo/socios.php';
require_once '../modelo/institucion.php';
require_once '../controlador/sesiones.php';
session_start();

if (\controlador\comprobar_sesion()) {
    header('Location: index.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $socio = new Socio($_POST['vat_soc'], $_POST['password_soc'], $_POST['usuario_soc'], $_POST['nombre_soc'], $_POST['email_soc'], $_POST['telefono_soc'], null, $_POST['cargo_soc'], $_POST['departamento_soc'], 1, 0, null, $_POST['pais_soc'], null);


    $id_insertado = \controlador\alta_socio($socio);

    $institucion = new Institucion($_POST['vat_inst'], $_POST['nombre_inst'], $_POST['email_inst'], $_POST['telefono_inst'], $_POST['codigo_postal_inst'], $_POST['direccion_inst'], $_POST['web_inst'], null, $_POST['pais_inst'], $id_insertado, $_POST['tipo_inst'], $_POST['descripcion_inst'], null);

    if ($id_insertado && $id_institucion = \controlador\alta_institucion($institucion)) {
        if (!isset($_POST['especialidades_institucion'])) {
            $especialiadades = null;
        } else {
            $especialiadades = $_POST['especialidades_institucion'];
        }
        \controlador\add_especialidad_institucion($id_institucion, $especialiadades);
        \controlador\update_puntuacion_socio($id_insertado, 2);
        
        \controlador\enviar_mail($_POST['email_soc'],"cocheamarillodsr@gmail.com","El usuario ". $_POST['usuario_soc']." ha sido dado de alta","Alta usuario");
        $_SESSION['id_socio'] = $id_insertado;
        $_SESSION['usuario'] = $socio->usuario;
        $_SESSION['alert_msg'] = "Welcome, you have been registered.";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['alert_msg'] = "Fail trying to register";
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
    <title>MERT</title>
    <link rel="shortcut icon" href="./imagenes/MERTLOGOPESTANA.png" type="image/png">
    <link rel="stylesheet" href="./css/estilo.css">

</head>

<body class="d-flex flex-column">

    <?php
    require_once 'cabecera.php';
    require_once '../controlador/metodosBBDD.php';
    ?>
    <section class="container-fluid flex-grow pr-4 pl-4">


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-row">
                <div class="col-12">
                    <h2>Register as a partner</h2>
                </div>
            </div>


            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-user"></i>
                                <span id="info">Personal Information</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">User</label>
                    <input type="text" class="form-control" id="nombre" name="usuario_soc" placeholder="Username" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password_soc" placeholder="Password" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="nombre" name="nombre_soc" placeholder="" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">VAT</label>
                    <input type="text" class="form-control" name="vat_soc" placeholder="VAT">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email_soc" placeholder="example@gmail.com " required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Telephone</label>
                    <input type="text" class="form-control" name="telefono_soc" placeholder="(+34) 123 456 789" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Position</label>
                    <input type="text" class="form-control" name="cargo_soc" placeholder="Head Master, proffesor... " required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Department</label>
                    <input type="text" class="form-control" name="departamento_soc" placeholder="Department" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Country</label>
                    <select name="pais_soc">
                        <?php
                        $array_paises = \controlador\cargar_paises();
                        $option = '';
                        foreach ($array_paises as $fila) {
                            $option .= '<option value="' . $fila['ID_PAIS'] . '">' . $fila['NOMBRE'] . '</option>';
                        }
                        echo $option;
                        ?>

                    </select>
                </div>

            </div>




            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-map-marker"></i>
                                <span id="titulo">Insitution Information</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="nombre_inst" name="nombre_inst" placeholder="" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">VAT</label>
                    <input type="password" class="form-control" name="vat_inst" placeholder="VAT">
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" name="email_inst" placeholder="example@gmail.com" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="telefono_inst" placeholder="(+34) 123 456 789" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="name">ZIP Code</label>
                    <input type="text" class="form-control" name="codigo_postal_inst" placeholder="" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="tel">Address</label>
                    <input type="text" class="form-control" name="direccion_inst" placeholder="User Address" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Web</label>
                    <input type="text" class="form-control" name="web_inst" placeholder="Web">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Description</label>
                    <input type="textarea" class="form-control" name="descripcion_inst" placeholder="Description">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Country</label>
                    <select name="pais_inst">
                        <?php
                        $array_paises = \controlador\cargar_paises();
                        $option = '';
                        foreach ($array_paises as $fila) {
                            $option .= '<option value="' . $fila['ID_PAIS'] . '">' . $fila['NOMBRE'] . '</option>';
                        }
                        echo $option;
                        ?>

                    </select>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Institution Type</label>
                    <select name="tipo_inst">
                        <?php
                        $array_inst = \controlador\cargar_tipo_institucion();

                        $option = '';
                        foreach ($array_inst as $fila) {
                            $option .= '<option value="' . $fila['ID_TIPO_INSTITUCION'] . '">' . $fila['TIPO'] . '</option>';
                        }
                        echo $option;
                        ?>
                    </select>


                </div>


            </div>
            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Specialties</label>
                    <select name="especialidades_institucion[]" multiple class="form-control w-25 text-left ">
                        <?php
                        $array_especialidades = \controlador\cargar_especialidades();
                        $option = '';
                        foreach ($array_especialidades as $fila) {
                            $option .= '<option value="' . $fila['ID_ESPECIALIDAD'] . '">' . $fila['TIPO'] . '</option>';
                        }
                        echo $option;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1"></div>

            </div>









            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Register"></input>
                    <input type="reset" class="btn btn-secondary" value="Clear"></input>

                </div>
            </div>

        </form>

    </section>
    <?php require 'footer.php'; ?>


</body>

</html>