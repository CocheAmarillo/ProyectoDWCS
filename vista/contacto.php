<!DOCTYPE html>
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
        integrity="sha384UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
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

        #formulario_contacto {




            margin: auto;
            background-color: lightgray;
            padding: 1%;
            border: 1px solid lightgray;
            border-radius: 5px;
            margin-bottom: 5%;
            margin-top: 5%;


        }

        #boton_enviar {
            background-color: #ff3006;
            color: white;
        }

        footer {
            background-color: #ff3006;
            position: absolute;
            top: 100%;
            width: 100%;
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

   <?php require_once 'cabecera.php';
   ?>





    <div id="formulario_contacto" class="container">

        <div id="loginbox" style="margin-top:50px;" class="mainbox">
            <div class="panel panel-info">
                <h2>Contacto</h2>

                <div style="padding-top:30px" class="panel-body">

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form">
                        <p>Nombre:</p>
                        <div style="margin-bottom: 25px" class="input-group ">

                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                            </div>
                            <input id="login-username" type="text" class="form-control" name="username" value=""
                                placeholder="Ingrese su nombre">
                        </div>
                        <p>Email:</p>

                        <div style="margin-bottom: 25px" class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i id="user" class="fa fa-envelope-square"></i></div>
                            </div>
                            <input id="login-email" type="email" class="form-control" name="email"
                                placeholder="ingrese su email">
                        </div>

                        <p>Asunto:</p>
                        <div style="margin-bottom: 25px" class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-bullhorn"></i></div>
                            </div>

                            <select class="form-control">
                                <option selected>Seleccione un asunto</option>
                                <option>Ponerse en contacto con el gerente</option>
                                <option>Realizar pedido</option>
                                <option>consulta sobre un pedido realizado</option>

                            </select>
                        </div>







                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <a href="#" class="btn btn-danger" id="boton_enviar">Enviar </a>
                                <input type="reset" class="btn btn-secondary" value="Borrar"></input>

                            </div>
                        </div>



                    </form>



                </div>
            </div>
        </div>

    </div>




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