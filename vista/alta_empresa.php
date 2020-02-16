<?php




require_once '../controlador/metodosBBDD.php';
require_once 'sesiones.php';
session_start();
if(!comprobar_sesion()){
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    
}
?>

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

            #titulo {
                color: #00c1ec;
            }

            form>i {
                color: white;
                background-color: #00c1ec;
                border: 5px solid #00c1ec;
                border-radius: 50%;
            }

            #enviar {
                background-color: #00c1ec;
                color: white;
            }

            footer {
                background-color: #ff3006;


            }

            footer i {
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
        require_once '../controlador/metodosBBDD.php';
        ?>



        <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
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
                                <span id="titulo">Informacion Personal</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control"  id="nombre" name="usuario_soc" placeholder="Usuario">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password_soc" placeholder="Password">
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Nombre Completo</label>
                    <input type="text" class="form-control"  id="nombre" name="nombre_soc" placeholder="Nombre Completo">
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
                    <input type="text" class="form-control" name="email_soc" placeholder="Email">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control" name="telefono_soc" placeholder="Telefono">
                </div>
                <div class="form-group col-md-1"></div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Cargo</label>
                    <input type="text" class="form-control" name="cargo_soc" placeholder="Cargo">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Departamento</label>
                    <input type="text" class="form-control" name="departamento_soc" placeholder="Departamento">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Pais</label>
                    <select name="pais_soc">
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

            </div>




            <div class="form-row">
                <div id="titulo2" class="col-12">
                    <h3>
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand">
                                <i class="fa fa-map-marker"></i>
                                <span id="titulo">Información de su Institución</span>
                            </a>
                        </nav>
                    </h3>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control"  id="nombre_inst" name="nombre_inst" placeholder="Nombre">
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
                    <input type="text" class="form-control"  id="email" name="email_inst" placeholder="Email">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono_inst" placeholder="Telefono">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="name">Codigo postal</label>
                    <input type="text" class="form-control" name="codigo_postal_inst" placeholder="Codigo Postal">
                </div>
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="tel">Dirección</label>
                    <input type="text" class="form-control" name="direccion_inst" placeholder="Direccion">
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
                    <label for="">Descripcion</label>
                    <input type="textarea" class="form-control" name="descripcion_inst" placeholder="Descripcion">
                </div>
                <div class="form-group col-md-1"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="">Pais</label>
                    <select name="pais_inst">
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
                <div class="form-group col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="">Tipo de institucion</label>
                    <select name="tipo_inst">
<?php
$array_inst = controlador\cargar_tipo_institucion();
echo $array_inst['TIPO'];
$option = '';
foreach ($array_inst as $fila) {
    $option .= '<option value="' . $fila['ID_TIPO_INSTITUCION'] . '">' . $fila['TIPO'] . '</option>';
}
echo $option;
?>
                    </select>


                </div>
                <div class="form-group col-md-1"></div>

            </div>









            <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit"  class="btn" id="enviar" name="enviar" value="Enviar"></input>
                    <input type="reset" class="btn btn-secondary" value="Borrar"></input>

                </div>
            </div>

        </form>




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