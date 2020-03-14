<?php

use modelo\Empresa;

require_once '../modelo/empresa.php';
require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';
session_start();
if (!comprobar_sesion()) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empresa = new Empresa(null, $_POST['cargo_resp'], $_POST['vat_emp'], $_POST['nombre_emp'], $_POST['email_emp'], $_POST['telefono_emp'], $_POST['codigo_postal_emp'], $_POST['direccion_emp'], null, $_POST['pais_emp'], $_SESSION['id_socio'], $_POST['tipo_emp'], $_POST['web_emp'], $_POST['descripcion_emp'], null);
    if ($id_empresa = \controlador\alta_empresa($empresa, $_POST['email_resp'], $_POST['nombre_resp'], $_POST['telefono_resp'])) { //el metodo devuelve el id de la empresa insertada o false si se produjo algun error

        if (!isset($_POST['especialidades_emp'])) {
            $especialiadades = null;
        } else {
            $especialiadades = $_POST['especialidades_emp'];
        }
        \controlador\add_especialidad_empresa($id_empresa, $especialiadades);
        \controlador\update_puntuacion_socio($_SESSION['id_socio'], 3);
        $_SESSION['alert_msg']="New company has been registered";
        header("Location: busqueda_empresas.php");
        exit;
    }
    else{
        $_SESSION['alert_msg']="Fail trying to register a new company";
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
    <!--Estilo Personalizado-->
    <link rel="stylesheet" href="./css/estiloLogin.css">

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
                    <h2>Dar de alta una empresa</h2>
                </div>
            </div>


            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-user"></i>
                                <span id="info">Informacion Personal</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre_emp" placeholder="Nombre" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">VAT</label>
                    <input type="text" class="form-control" name="vat_emp" placeholder="VAT">
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email_emp" placeholder="email@gmail.com" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono_emp" placeholder="123456789" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Codigo Postal</label>
                    <input type="text" class="form-control" name="codigo_postal_emp" placeholder="36883" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" name="direccion_emp" placeholder="Direccion" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Web</label>
                    <input type="text" class="form-control" name="web_emp" placeholder="www.google.com">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion_emp">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Pais</label>
                    <select name="pais_emp">
                        <?php
                        $array_paises = controlador\cargar_paises();
                        $option = '';
                        foreach ($array_paises as $fila) {
                            $option .= '<option value="' . $fila['ID_PAIS'] . '">' . $fila['NOMBRE'] . '</option>';
                        }
                        echo $option;
                        ?>

                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="">Tipo de Empresa</label>
                    <select name="tipo_emp">
                        <?php
                        $array_emp = controlador\cargar_tipo_empresa();

                        $option = '';
                        foreach ($array_emp as $fila) {
                            $option .= '<option value="' . $fila['ID_TIPO_EMPRESA'] . '">' . $fila['TIPO'] . '</option>';
                        }
                        echo $option;
                        ?>
                    </select>


                </div>
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Especialidades</label>
                    <select name="especialidades_emp[]" multiple class="form-control w-25 text-left ">
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




            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-map-marker"></i>
                                <span id="info">Información de su Responsable</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Nombre completo</label>
                    <input type="text" class="form-control" name="nombre_resp" placeholder="Nombre" required>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email_resp" placeholder="email@gmail.com" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono_resp" placeholder="1211223123123">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Cargo en la empresa</label>
                    <input type="text" class="form-control" name="cargo_resp" required>
                </div>
                <div class="form-group col-md-1"></div>
            </div>











            <div style="margin-top:10px" class="form-group">
                <div class="col-sm-12 controls">
                    <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Enviar"></input>
                    <input type="reset" class="btn btn-secondary" value="Borrar"></input>
                </div>
            </div>

        </form>

    </section>
    <?php
    require 'footer.php';
    ?>
</body>

</html>