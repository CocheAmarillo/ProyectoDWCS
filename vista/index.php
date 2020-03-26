<?php namespace vista; 

session_start();


?>

<!DOCTYPE html>
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
  <link rel="shortcut icon" href="./imagenes/MERTLOGOPESTANA.png" type="image/png">
  <title>MERT</title>
  <style>
    #img2 {
      margin-top: 3%;
      height: 400px;
      width: 1000px;
    }

    #descripcion {
      margin-top: 2%;
      margin-bottom: 2%;
      margin-left: 5%;
      text-align: justify;
    }
  </style>

  <link rel="stylesheet" href="./css/estilo.css">

  <script src="../controlador/metodosJS.js"></script>
</head>

<body class="d-flex flex-column">
  <?php
  
  require_once 'cabecera.php';

  ?>
  <section class="container-fluid flex-grow pr-4 pl-4">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img id="img2" class="d-block" src="imagenes/3.jpg" alt="Primera imagen del carrusel">
        </div>
        <div class="carousel-item">
          <img id="img2" class="d-block" src="imagenes/1.jpg" alt="Segunda imagen del carrusel">
        </div>
        <div class="carousel-item">
          <img id="img2" class="d-block" src="imagenes/2.png" alt="Tercera imagen del carrusel">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <section id="descripcion">
    <p class="text-center">Welcome to <b><i><span>M</span><span style="color: #f26b40">E</span><span>R</span><span style="color: #f26b40">T</span></i></b><br>
      A website to help you search companies and institutions where your students can do the internships/Job training.It also allowed you to register new companies and students.
    </p>


  </section>
  <?php require 'footer.php'; ?>

</body>

</html>

<!--, una web para facilitar 
    la búsqueda de empresas o insitutuciones en las que los alumnos puedan realizar sus prácticas.<br>
      También permite que los usuarios den de alta en nuestra base de datos nuevas empresas y alumnos para asi darlos a conocer a otros usuarios que puedan estar interesados-->