function confirmLogOut() {
    var opcion = confirm("Esta seguro que desea cerrar sesion?");
    if (opcion == true) {
        window.location.href = "logout.php";
    }
}

function popUpLogout() {
    $(".d-none").addClass("d-block");
}