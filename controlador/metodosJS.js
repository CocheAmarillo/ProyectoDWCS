function confirmLogOut() {
    var opcion = confirm("Are you sure?");
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