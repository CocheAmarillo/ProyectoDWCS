<?php
	
	require_once 'sesiones.php';	
        session_start();
	
	$_SESSION = array();
	session_destroy();	// eliminar la sesion
	setcookie(session_name(), 123, time() - 1000); // eliminar la cookie
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Sesión cerrada</title>
	</head>
	<body>
		<p>La sesión se cerró correctamente, hasta la próxima</p>
		<a href = "index.php">Ir a la página de inicio</a>
	</body>
</html>