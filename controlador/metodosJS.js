function confirmLogOut() {
  var opcion = confirm("Are you sure you want to exit?");
  if (opcion == true) {
    window.location.href = "logout.php";
  }
}

function popUpLogout() {
  $("#logout.d-none").addClass("d-block");
}

function popUpMovilidad_Error() {
  $("#mov_error.d-none").addClass("d-block");
}

function popUpMovilidad_OK() {
  $("#mov_ok.d-none").addClass("d-block");
}

function borrar(id, tipo) {

  console.log(id, tipo);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      if (this.response === "false") {
        alert("Se ha producido un error intentando borrar el elemento");
      } else {

        location.reload();
      }
    }
  };

  var params = "id=" + id + "&tipo=" + tipo;
  xhr.open("POST", "../controlador/borrado.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(params);
}

