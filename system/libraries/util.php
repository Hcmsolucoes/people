<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util {

	public function __construct()
	{
		
	}
	
	public function floatParaInsercao(&$valor){
		$pattern = '/[^0-9.,]*/';
		$replacement = '';
		$valor = preg_replace($pattern, $replacement, $valor);
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		return $valor;
	}

	public function antiSql($str=null){
		if(!empty($str)){
			$sql = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/','',$str);
			$sql = trim($str);
			$sql = strip_tags($str);
			$sql = addslashes($str);
		}
		
		return $str;
	}

	public function formatarMoeda($valor){

		return number_format($valor, 2,",",".");
	}

	public function geraString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function converteDataParaInsercao($data){
		$data = substr($data, 6,4)."-".substr($data, 3,2)."-".substr($data, 0,2);
		return $data;
	}

	public function mes_extenso($mes){
		$mes = ltrim($mes, "0");
		$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		return $meses[$mes]; 
	}

	public function horasToMinutos($horas){

		if (strstr($horas, ':')){

			$separatedData = explode(':', $horas);
			$minutesInHours    = $separatedData[0] * 60;
			$minutesInDecimals = $separatedData[1];
			$totalMinutes = $minutesInHours + $minutesInDecimals;

		}else{

			$totalMinutes = $horas * 60;
		
		}
		
		
		return $totalMinutes;
	}

	public function minutosToHoras($minutos){
		$horas          = floor($minutos / 60);
		$decimalMinutes = $minutos - floor($minutos/60) * 60;
		$hoursMinutes = sprintf("%02d:%02d", $horas, $decimalMinutes);
		return $hoursMinutes; 
	}

	public function somaHora($hora1,$hora2){

		$h1 = explode(":",$hora1);
		$h2 = explode(":",$hora2);

		$segundo = $h1[2] + $h2[2] ;
		$minuto  = $h1[1] + $h2[1] ;
		$horas   = $h1[0] + $h2[0] ;
		$dia   	= 0 ;

		if($segundo > 59){

			$segundodif = $segundo - 60;
			$segundo = $segundodif;
			$minuto = $minuto + 1;
		}

		if($minuto > 59){

			$minutodif = $minuto - 60;
			$minuto = $minutodif;
			$horas = $horas + 1;
		}

		if($horas > 24){
			/*
			$num = 0;

			(int)$num = $horas / 24;
			$horaAtual = (int)$num * 24;
			$horasDif = $horas - $horaAtual;

			$horas = $horasDif;				

			for($i = 1; $i <= (int)$num; $i++){

				$dia +=  1 ;
			}
			*/
		}
		
		if(strlen($horas) == 1){

			$horas = "0".$horas;
		}

		if(strlen($minuto) == 1){

			$minuto = "0".$minuto;
		}

		if(strlen($segundo) == 1){

			$segundo = "0".$segundo;
		}

		return  $horas.":".$minuto.":".$segundo;

	}



}

	?>