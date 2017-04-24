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



}

	?>