



<?php

//Tablas 
use App\Sesiones;
use App\Condominios;
use App\LogAuditoria;
use App\User;

//Librearias
//use Auth;


function flashcountconfirmusers(){

	if (Auth::user()->tipo == '1'){
		$cantidad = User::  where ('activo',0)
						 -> where ('confirm',1)
						 -> count();

		Session::flash('count-confirm-users', $cantidad);

	}

	

}

function createLog($tipo,$mensaje){

	LogAuditoria::create (['id_condominio' => Auth::user()->id_condominio,
						   'mensaje'       => $mensaje,
						   'tipo'		   => $tipo,	
						   'time_at'	   => date('Y-m-d H:i:s')
		]);

}


function userValidator (){

	if (Auth::check()){
		return true;
	} else {
		return false;
	}

}

function user1Validator(){

	if (Auth::check()){
		if (Auth::user()->tipo == '1'){
			return true;	
		} else {
			return false;
		}
		
	} else {
		return false;
	}

}

function user2Validator(){
	
	if (Auth::check()){
		if (Auth::user()->tipo == '2'){
			return true;	
		} else {
			return false;
		}
		
	} else {
		return false;
	}

}

function userReportValidator(){
	return true;
}

function user3Validator(){
	return true;

}


function nombreCondominio (){

	if (Auth::check()) {

		return Auth::user()->nombre_condominio;

	} else {

		$sesion = Sesiones:: where ('sesion_id',Session::getId())
	                      -> select ('nombre_condominio','id_condominio')
	                      -> first();
	    if (isset($sesion->id_condominio)){
	        return $sesion->nombre_condominio;
	    }

	}

	return '';
    
    
    

}

function createSesion($url,$idCondominio){


	if ($idCondominio > 0 ){
		$condominio = Condominios:: where ('id',$idCondominio)
								 -> select ('id','nombre')
                                 -> first();
	}else {
		$condominio = Condominios:: where ('url',$url)
								 -> select ('id','nombre')
                                 -> first();

	}

    if (isset($condominio->id)){

        Sesiones:: where ('sesion_id' , Session::getId())
                -> delete();

        Sesiones:: create (['sesion_id' => Session::getId(),
                            'id_condominio' => $condominio->id,
                            'nombre_condominio' => $condominio->nombre]);

       	return true;
    }

    return false;

}

	
function generateRandomString($length) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ[]{}"), 0, $length); 
} 


function getFechaStr($fecha){


	$fecha_srt = substr($fecha,8,2).'/'. substr($fecha,5,2) .'/'.substr($fecha,0,4);



	return $fecha_srt;

}


function dividir ($divisor,$dividendo){

	if ($dividendo == 0) {
		return 0;
	}else {
		
		return formatNumber($divisor/$dividendo);
	}

}

function porcentaje ($divisor,$dividendo){

	if ($dividendo == 0) {
		return 0.00;
	}else {

		$resultado = ($divisor/$dividendo) * 100;

		return $resultado;
		
		//return (formatNumber($resultado)).'%';
	}

}

function formatNumber($number){

	return number_format($number, 2, '.', ',');
}

function getNumberStr($str){
	$number = '';



	for ($i = 0 ; $i< strlen($str) ; $i++){
		if ($str[$i] == ',') {
			$chart = '.';
		}elseif ($str[$i] == '.') {
			$chart = '';
		}else { $chart = $str[$i];}
		$number = $number . $chart;

	}

	return $number;

}


function removeDash($str){
	$result = '';

	for ($i = 0 ; $i< strlen($str) ; $i++){
		if ($str[$i] == '-') {
			$chart = '';
		}else { $chart = $str[$i];}
		$result = $result . $chart;
	}

	return $result;


}


?>