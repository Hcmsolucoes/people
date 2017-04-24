<?php defined('BASEPATH') OR exit('No direct script access allowed');


class UploadImage  {

	private $arquivo;
	private $altura;
	private $largura;
	private $pasta;

	function __construct(){
				
	}

	public function setVars($array){
		$this->arquivo = $array['arquivo'];
		$this->altura  = $array['altura'];
		$this->largura = $array['largura'];
		$this->pasta   = $array['pasta'];
	}

	public function setLargura($larg){

		$this->largura = $larg;
	}
	public function setAltura($alt){
		
		$this->altura  = $alt;
	}
	public function setPasta($pasta){
		$this->pasta = $pasta;
	}

	private function getExtensao(){

		//retorna a extensao da imagem	
		return $extensao = strtolower(end(explode('.', $this->arquivo['name'])));
	}

	private function ehImagem($extensao){
		$extensoes = array('gif', 'jpeg', 'jpg', 'png');	 // extensoes permitidas
		if (in_array($extensao, $extensoes))
				return true;	
	}
		
		//largura, altura, tipo, localizacao da imagem original
	private function redimensionar($imgLarg, $imgAlt, $tipo, $img_localizacao){
			//descobrir novo tamanho sem perder a proporcao
			
			if ( $imgLarg > $imgAlt ){
				$novaLarg = $this->largura;
				$novaAlt = round( ($novaLarg / $imgLarg) * $imgAlt );
			}
			elseif ( $imgAlt > $imgLarg ){
				$novaAlt = $this->altura;
				$novaLarg = round( ($novaAlt / $imgAlt) * $imgLarg );
			}
			else 
			$novaAltura = $novaLargura = max($this->largura, $this->altura);
			
			
			//redimencionar a imagem
			
			//cria uma nova imagem com o novo tamanho	
			$novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
			
			switch ($tipo){
				case 1:	// gif
				$origem = imagecreatefromgif($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagegif($novaimagem, $img_localizacao);
				break;
				case 2:	// jpg
				$origem = imagecreatefromjpeg($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagejpeg($novaimagem, $img_localizacao);
				break;
				case 3:	// png
				$origem = imagecreatefrompng($img_localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
				imagepng($novaimagem, $img_localizacao);
				break;
			}
			
			//destroi as imagens criadas
			imagedestroy($novaimagem);
			imagedestroy($origem);
	}
		
	public function salvar($novo_nome=""){									
			$extensao = $this->getExtensao();
			
			if(empty($novo_nome)){
				//$novo_nome = Util::geraString() .".".$extensao;
				return false;
			}
			
			//localizacao do arquivo 
			$destino = $this->pasta . $novo_nome.".".$extensao;
			
			//move o arquivo
			if (! move_uploaded_file($this->arquivo['tmp_name'], $destino)){
				if ($this->arquivo['error'] == 1)
					return "Tamanho excede o permitido";
				else
					return "Erro " . $this->arquivo['error'];
			}

			if ($this->ehImagem($extensao)){												
				//pega a largura, altura, tipo e atributo da imagem
				//list($largura, $altura, $tipo, $atributo) = getimagesize($destino);

				// testa se é preciso redimensionar a imagem
				//if(($largura > $this->largura) || ($altura > $this->altura))
					//$this->redimensionar($largura, $altura, $tipo, $destino);
			}
			return "Sucesso";
		}

	public function crop($x, $y, $xl, $ya, $localizacao){

		list($largura, $altura, $tipo, $atributo) = getimagesize($localizacao);

		if ( ($largura != $altura) || ($largura>$this->largura || $altura>$this->altura) ){
				//$novaLarg = $this->largura;
				//$novaAlt = $this->altura;
			}
			$novaLarg = $this->largura;
			$novaAlt = $this->altura;
			//redimencionar a imagem
			
			//cria uma nova imagem com o novo tamanho	
			$novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
			
			switch ($tipo){
				case 1:	// gif
				$origem = imagecreatefromgif($localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, $x, $y,
					$novaLarg, $novaAlt, $xl, $ya);
				imagegif($novaimagem, $localizacao);
				break;
				case 2:	// jpg
				$origem = imagecreatefromjpeg($localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, $x, $y,
					$novaLarg, $novaAlt, $xl, $ya);
				imagejpeg($novaimagem, $localizacao);
				break;
				case 3:	// png
				$origem = imagecreatefrompng($localizacao);
				imagecopyresampled($novaimagem, $origem, 0, 0, $x, $y,
					$novaLarg, $novaAlt, $xl, $ya);
				imagepng($novaimagem, $localizacao);
				break;
			}
			
			//destroi as imagens criadas
			imagedestroy($novaimagem);
			imagedestroy($origem);

	}


	}

?>