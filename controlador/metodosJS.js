function confirmLogOut() {
    var opcion = confirm("Esta seguro que desea cerrar sesion?");
    if (opcion == true) {
        window.location.href = "logout.php";
    }
}

function popUpLogout() {
    $("#logout.d-none").addClass("d-block");
}

function popUpMovilidad_Error(){
    $("#mov_error.d-none").addClass("d-block");
}

function popUpMovilidad_OK(){
    $("#mov_ok.d-none").addClass("d-block");
}