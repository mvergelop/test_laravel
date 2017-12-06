

<?php

	
	
function generateRandomString($length) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 


function getFechaStr($fecha){


	$fecha_srt = substr($fecha,8,2).'/'. substr($fecha,5,2) .'/'.substr($fecha,0,4);



	return $fecha_srt;

}

	
	




?>