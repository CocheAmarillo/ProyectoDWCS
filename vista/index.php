<?php session_start();
        ?>

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
    integrity="sha384UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>ejer1</title>
  <style>
    #logo {
      width: 100px;
      height: 100px;
    }

    #fondo {
      height: 500px;
      width: 100%;

    }

    #principal {
      text-align: justify center;
      margin-top: 0;
      font-size: 1.3em;
      width: 75%;
      margin-left: 10%;
      height: 50%;
      position: relative;
      overflow: hidden;
    }

    footer {
      background-color: #ff3006;


    }

    i {
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

  <img id="fondo" src="./imagenes/fondo.jpg" alt="">

  <p id="principal">
    Esta es una web de venta de discos online. Aunque en la actualidad el soporte físico ya no es tan usado y la mayoría
    de gente escucha música a través de internet, nosotros queremos mantener viva la
    venta de discos para esa gente que todavía le gusta coleccionarlos o simplemente por el hecho de apoyar a los
    artistas.<br><br>
    En nuestra página encontrarás numerosos productos , independientemente del año de lanzamiento . Procuramos mantener
    nuestro stock actualizado para así incorporar nuevos productos que vayan saliendo al mercado.<br><br>
    Únicamente realizamos ventas a traves de nuestra página web, para lo cual solo es necesario proporcionar informacion
    básica así como una direccion de envío. No es necesario registrarse , pero si es recomendable, ya que ofrece una
    serie de ventajas y facilidades a la hora de realizar múltiples pedidos, así como ciertos descuentos que solo
    ofrecemos a clientes dados de alta. <br><br>
    En nuestra página disponemos de una sección para que los clientes se puedan poner en contacto con nosotros para
    cualquier duda o si necesitan nuestra ayuda para solucionar cualquier problema que puedan haber tenido con alguno de
    los pedidos realizados.

  </p>



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