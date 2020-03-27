<?php

namespace vista;

use modelo\Empresa;


require_once '../modelo/empresa.php';
require_once '../controlador/metodosBBDD.php';
require_once '../controlador/sesiones.php';
session_start();
if (!\controlador\comprobar_sesion()) {
    header('Location: index.php');
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $datos_empresa = \controlador\buscar_empresa_por_id($_GET['id_empresa']);
    $datos_responsable = \controlador\buscar_responsable($datos_empresa['RESPONSABLE']);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!\controlador\update_empresa($_POST) || !\controlador\update_responsable($_POST)) {
        $_SESSION['alert_msg'] = "Error";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['alert_msg'] = "Data successfully modified";
        header("Location: busqueda_empresas.php");
        exit;
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
    <!--Estilo Personalizado-->
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
                    <h2>Modify company information</h2>
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
                    <label for="">Name:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre_emp" placeholder="" required value='<?php echo $datos_empresa['NOMBRE'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">VAT:</label>
                    <input type="text" class="form-control" name="vat_emp" placeholder="VAT" value='<?php echo $datos_empresa['VAT'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Email:</label>
                    <input type="email" class="form-control" name="email_emp" placeholder="exameple@gmail.com" required value='<?php echo $datos_empresa['EMAIL'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Phone Number:</label>
                    <input type="text" class="form-control" name="telefono_emp" placeholder="(+34) 123 456 789" required value='<?php echo $datos_empresa['TELEFONO'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">ZIP Code:</label>
                    <input type="text" class="form-control" name="codigo_postal_emp" placeholder="" required value='<?php echo $datos_empresa['CODIGO_POSTAL'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Address:</label>
                    <input type="text" class="form-control" name="direccion_emp" placeholder="Company Address" required value='<?php echo $datos_empresa['DIRECCION'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Web:</label>
                    <input type="text" class="form-control" name="web_emp" placeholder="www.google.com" value='<?php echo $datos_empresa['WEB'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Description:</label>
                    <input type="text" class="form-control" name="descripcion_emp" value='<?php echo $datos_empresa['DESCRIPCION'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Country</label>
                    <select name="pais_emp">
                        <?php
                        $array_paises = \controlador\cargar_paises();
                        $option = '';
                        foreach ($array_paises as $fila) {
                            if ($datos_empresa['PAIS'] == $fila['ID_PAIS']) {
                                $option .= '<option value="' . $fila['ID_PAIS'] . '"selected>' . $fila['NOMBRE'] . '</option>';
                            } else {
                                $option .= '<option value="' . $fila['ID_PAIS'] . '">' . $fila['NOMBRE'] . '</option>';
                            }
                        }
                        echo $option;
                        ?>

                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="">Company Type</label>
                    <select name="tipo_emp">
                        <?php
                        $array_emp = \controlador\cargar_tipo_empresa();

                        $option = '';
                        foreach ($array_emp as $fila) {
                            if ($datos_empresa['TIPO'] == $fila['TIPO']) {
                                $option .= '<option selected value="' . $fila['ID_TIPO_EMPRESA'] . '">' . $fila['TIPO'] . '</option>';
                            } else {
                                $option .= '<option value="' . $fila['ID_TIPO_EMPRESA'] . '">' . $fila['TIPO'] . '</option>';
                            }
                        }
                        echo $option;
                        ?>
                    </select>


                </div>
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Specialties</label>
                    <select name="especialidades_emp[]" multiple class="form-control w-25 text-left ">
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




            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-map-marker"></i>
                                <span id="info">Information about Person in Charge</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Name:</label>
                    <input type="text" class="form-control" name="nombre_resp" placeholder="" required value='<?php echo $datos_responsable['NOMBRE_COMPLETO'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Email:</label>
                    <input type="email" class="form-control" name="email_resp" placeholder="example@gmail.com" required value='<?php echo $datos_responsable['EMAIL'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Phone Number:</label>
                    <input type="text" class="form-control" name="telefono_resp" placeholder="(+34) 123 456 789" value='<?php echo $datos_responsable['TELEFONO'] ?>'>
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Job Title:</label>
                    <input type="text" class="form-control" name="cargo_resp" required value='<?php echo $datos_empresa['CARGO_RESPONSABLE'] ?>'>
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div style="margin-top:10px" class="form-group">
                <div class="col-sm-12 controls">
                    <input type="submit" class="btn btn-default" id="enviar" name="enviar" value="Modify"></input>
                    <input type="reset" class="btn btn-secondary" value="Clear"></input>
                </div>
            </div>
            <input type="hidden" value="<?php echo $datos_empresa['RESPONSABLE'] ?>" name="id_responsable">
            <input type="hidden" value="<?php echo $datos_empresa['ID_EMPRESA'] ?>" name="id_empresa">

        </form>

    </section>
    <?php
    require 'footer.php';
    ?>
</body>

</html>