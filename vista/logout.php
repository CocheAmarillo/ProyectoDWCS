<?php
	
	require_once 'sesiones.php';	
        session_start();
	
	$_SESSION = array();
	session_destroy();	// eliminar la sesion
	setcookie(session_name(), 123, time() - 1000); // eliminar la cookie
	header("Location: index.php?logout=true");
?>