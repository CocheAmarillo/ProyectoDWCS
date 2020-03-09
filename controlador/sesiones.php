<?php
function comprobar_sesion(){
	
	if(!isset($_SESSION['usuario'])){	
            
		return false;
	}
        else{
            return true;
        }
}

