<?php
	
	require_once '../controlador/sesiones.php';
		session_start();
		if(!comprobar_sesion()){
			header("Location: index.php");
		}
		else{
			$_SESSION = array();
			
			setcookie(session_name(), 123, time() - 1000);
			$_SESSION['alert_msg']="Session has been closed. See you next time."; // eliminar la cookie
			header("Location: index.php");
		
		}
	
