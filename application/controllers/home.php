<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->model('Log');
		$this->load->library('util');
	}
	
	public function sendmail()
	{
		$this->load->library('email');
		$this->email->from('contato@hcmsolucoes.com.br','Team OnePage');
		$this->email->to("yuri@synergie.com.br");
		$this->email->subject('Um email teste do CodeIgniter usando Gmail');
		$this->email->message("Eu posso agora enviar email do CodeIgniter usando o Gmail como meu servidor!");
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function index()
	{ 
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '1');
		$dados = array('menupriativo' => 'painel' );

		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');

		$mes = date("m");
		$dia = date("d");
		$this->db->where('MONTH(fun_datanascimento)',$mes);
		$this->db->where('DAY(fun_datanascimento) >= ',$dia);
		$this->db->where('fun_idempresa', $idempresa);
		$this->db->where('fun_status', "A");
		$this->db->order_by("fun_datanascimento", "desc");
		$dados['aniversariantes'] = $this->db->get('funcionario')->result();

		$this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->where('contr_idfuncionario',$iduser);
		$dados['contratos'] = $this->db->get('contratos')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;

		$this->db->join("Periodos", "fer_idperiodo = Per_idperiodos");
		$this->db->where("fer_idfuncionario", $iduser);
		$dados['ferias'] = $this->db->get("programacao_ferias")->result();
		$this->db->where("NOT EXISTS (SELECT *
			FROM programacao_ferias 
			WHERE  Per_idperiodos = fer_idperiodo) ");
		$this->db->where('Per_idfuncionario',$iduser);
		$this->db->where('Per_SitPer', 0);
		$dados['ferias'] = $this->db->get('Periodos')->result();

		$idcli = $this->session->userdata('idcliente');
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();

		$dados['perfil'] = $this->session->userdata('perfil');

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$this->db->where('feed_data >=',date('Y/m/d'));
		$this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
		$feeds2 = $this->db->get('feedbacks')->num_rows();
		$dados['quantultimos'] = $feeds2;


		$this->db->where('tipo_idfuncionario',$iduser);     
		$mesativo = $this->db->order_by('tipo_mesref', 'desc')->get('tipodecalculo',1)->result(); 
		$mesativoref="";
		foreach ($mesativo as $value) { 
			$mesativoref = $value->tipo_mesref;
		}


		$this->db->where('tipo_idfuncionario',$iduser);
		$this->db->like('tipo_mesref', $mesativoref);
		$tipodecalculo = $this->db->get('tipodecalculo')->result(); 

		$totaldesconto = 0;
		$totalproventos = 0;
		$totalliquido = 0;
		foreach ($tipodecalculo as $value) { 
			if($value->tipo_tipocal == '11'){
				$this->db->where('even_idtipodecalculo',$value->tipo_idtipodecalculo);
				$eventos2 = $this->db->get('eventoscalculo')->result();                
				foreach ($eventos2 as $dados1) {                
					$valorevento = $dados1->even_valor;
					$valorevento = str_replace(',' , '.', $valorevento);
					if($dados1->even_tipoevento == '-'){$totaldesconto = $totaldesconto + $valorevento;}
					if($dados1->even_tipoevento != '-'){if($dados1->even_tipoevento != '#'){$totalproventos = $totalproventos + $valorevento;}}
				}
			}

		}

		$this->db->select('*');
		$this->db->from('pontoaponto');
		$this->db->join('ponto_parametros', 'ponto_parametros.para_idparametros = pontoaponto.pon_idparametros');
		$this->db->where('pon_idfuncionario',$iduser);
		$this->db->order_by('pon_idpontoaponto', 'desc');
		$this->db->limit(1);
		$dados['pontoaponto'] = $this->db->get()->result();

		$dados['totalliquido'] =  $totalproventos - $totaldesconto;
		$dados['totalproventos'] =  $totalproventos;
		$dados['totaldesconto'] = $totaldesconto;
		$dados['mesativoref'] = $mesativoref;

		$dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Dashboard"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_destbord',$dados);
		$this->load->view('/geral/footer');
	}

	public function login()
	{
		
		if(!$this->session->userdata('id_funcionario') || !$this->session->userdata('logado')){ 


			$this->session->unset_userdata("instancia"); 
			$subdominio = $_SERVER['HTTP_HOST'];  
			$this->db->select("cli_nomecliente, cli_instancia, cli_fundoimagem, cli_fundologin");
			$this->db->where("cli_subdominio", $subdominio);
			$acesso = $this->db->get("cliente")->row();
			$dados['fundoimagem'] = ( empty($acesso->cli_fundoimagem) )? "wall_1.jpg" : $acesso->cli_fundoimagem;
			$dados['fundologin'] = ( empty($acesso->cli_fundologin) )? "" : $acesso->cli_fundologin;
			if (is_object($acesso)) {
		
              	$dados['instancia'] = $acesso->cli_instancia;
            	$this->session->set_userdata("instancia", $acesso->cli_instancia);
            	//echo $acesso->cli_nomecliente;
			}
           header ('Content-type: text/html; charset=ISO-8859-1');
			$this->load->view('/geral/login', $dados); 
			
		}else{
			$url = base_url('home');
			header("Location: $url ");

		}

	}
	public function teste()
	{
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '1');
		$dados = array('menupriativo' => 'painel' );

		echo $this->Log->duascolunas($dados); 

	}

	public function calendario()
	{

		header ('Content-type: text/html; charset=ISO-8859-1');
		$this->load->view('/geral/box/modalcalendario');

	}

	public function programacao_ferias(){
		$this->Log->talogado(); 
            $dados = array( 'menupriativo' => 'gestao');             
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $idcli = $this->session->userdata('idcliente');

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();

            $this->db->join("Periodos", "fer_idperiodo = Per_idperiodos");
            $this->db->where("fer_idfuncionario", $iduser);
            $dados['ferias'] = $this->db->get("programacao_ferias")->result();

			$this->db->where("NOT EXISTS (SELECT *
                   FROM programacao_ferias 
                   WHERE  Per_idperiodos = fer_idperiodo) ");
			
            $this->db->where('Per_idfuncionario',$iduser);
            $this->db->where('Per_SitPer', 0);
            $this->db->order_by("Per_dataFim", "asc");
            $this->db->limit(1);
            $dados['periodos'] = $this->db->get('Periodos')->row();

            $dados['breadcrumb'] = array('Colaborador'=>base_url('home'), "Gestão"=>"#", 'Programação de férias'=>'#' );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_ferias',$dados);
            $this->load->view('/geral/footer'); 
	}

	public function datapagamento(){
		$data = $this->input->post("data");
		$data_pag = $this->Log->alteradata2($data);
		$date = new DateTime($data_pag);
		$date->sub(new DateInterval('P2D'));
		$data_pag = $date->format('Y-m-d');

		$fer=true;
		while ($fer) {
			$this->db->where("data_feriado", $data_pag);
			$res = $this->db->get("feriado");			

			if ($res->num_rows()==0) {

				$fer=false;

			}else{
				$date = new DateTime($data_pag);
				$date->sub(new DateInterval('P1D'));
				$data_pag = $date->format('Y-m-d');
			}
			list($a, $m, $d) = explode("-", $data_pag);
			$dia_da_semana = date("D", mktime(0,0,0,$m,$d,$a) );

			if ($dia_da_semana  == "Sun" || $dia_da_semana  == "Sat") {
				$date = new DateTime($data_pag);
				$date->sub(new DateInterval('P1D'));
				$data_pag = $date->format('Y-m-d');
				$fer=true;
			}

		}

		
		echo $this->Log->alteradata1($data_pag);
	}

	public function salvarProgFerias(){

		$iduser = (!empty($this->input->post('idfun') ) )? $this->input->post('idfun') : $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');

		if ( !empty($this->input->post('gestor'))) {
			$dados['fer_idgestor'] = $this->input->post('gestor');
		}

		if ( !empty($this->input->post('periodos'))) {
			$dados['fer_idperiodo'] = $this->input->post('periodos');
		}

		$dados['fer_idfuncionario'] = $iduser;
		$dados['fer_datainicio'] = $this->Log->alteradata2($this->input->post('data_inicio'));
		$dados['fer_dias'] = $this->input->post('dias');
		$dados['fer_abono'] = $this->input->post('fer_abono');
		$dados['fer_decimoterceiro'] = $this->input->post('decterceiro');
		$dados['fer_data_pagamento'] = $this->Log->alteradata2($this->input->post('data_pagto') );
		$dados['fer_adiantamento'] = $this->input->post('adiantamento');

		if ( !empty($this->input->post('status'))) {
			$dados['fer_status'] = $this->input->post('status');
			if ($dados['fer_status']==1) {

				$dt = ($dados['fer_decimoterceiro']==1)?"sim": "nao";
				$sp = $this->input->post('data_pagto');
				$ad = ($dados['fer_adiantamento']==1)? "Sim": "Nao";

				$date = new DateTime($dados['fer_datainicio']);
				$date->add(new DateInterval('P'.$dados['fer_dias'].'D'));
				$datafim = $date->format('Y-m-d');

				$lem["fk_remetente"] = $dados['fer_idgestor'];
    			$lem["fk_empresa"] = $idempresa;
				$lem['fk_destinatario'] = $iduser;
				$lem["fk_categoria"] = 6;
				$lem["titulo_lembrete"] = utf8_decode( "Ferias" );
				$lem["descricao_lembrete"] = utf8_decode( "Abono: ".$dados['fer_abono']." dias<br>".
				"Decimo terceiro: ".$dt."<br>". "Sugestao de pagamento: ".$sp."<br>".
				"Adiantamento: ".$ad );
				$lem["dt_inicio_lembrete"] = $dados['fer_datainicio'];
				$lem["dt_final_lembrete"] = $datafim;

				$this->db->insert("lembrete", $lem);
				$idlembrete = $this->db->insert_id();
			}
		}

		if ( !empty($this->input->post('idferias')) ) {

			$idfer = $this->input->post('idferias');
			$this->db->where("fer_idferias", $idfer);
			$this->db->update("programacao_ferias", $dados);
			echo 1;
			return;
		}
		$this->db->insert("programacao_ferias", $dados);
		echo $this->db->insert_id();
	}

	public function excluirferias(){
		$id = $this->input->post("id");
		$this->db->where("fer_idferias", $id);
		$this->db->delete("programacao_ferias");
		$res['status']=1;
		echo json_encode($res);
	}


	public function modalConFerias(){
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idferias = $this->input->post('id');
		$dados['pagina']=$this->input->post('pagina');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->row();

		$this->db->join("Periodos", "fer_idperiodo = Per_idperiodos");
		$this->db->where("fer_idferias", $idferias);
		$dados['ferias'] = $this->db->get("programacao_ferias")->row();

		$this->db->where("NOT EXISTS (SELECT *
			FROM programacao_ferias 
			WHERE  Per_idperiodos = fer_idperiodo) ");

		$this->db->where('Per_idfuncionario',$iduser);
		$this->db->where('Per_SitPer', 0);
		$this->db->order_by("Per_dataFim", "asc");
		$this->db->limit(1);
		$dados['periodos'] = $this->db->get('Periodos')->row();
		
		header ('Content-type: text/html; charset=ISO-8859-1');
		$this->load->view('/geral/box/modalconferias',$dados);
	}

	public function periodoLivre(){
		header('Content-Type: application/json');
		$iduser = $this->input->post('idfun');

		$this->db->where("NOT EXISTS (SELECT *
                   FROM programacao_ferias 
                   WHERE  Per_idperiodos = fer_idperiodo) ");
		
		$this->db->where('Per_idfuncionario',$iduser);
		$this->db->where('Per_SitPer', 0);
		$this->db->order_by("Per_dataFim", "asc");
		$this->db->limit(1);
		$periodo = $this->db->get('Periodos')->row();
		//var_dump($periodo);
		$json['texto'] = utf8_encode("Não há período");
		$json['id'] = 0;
		if (is_object($periodo)) {
			
			$json['id'] = $periodo->Per_idperiodos;
			$json['texto'] = $this->Log->alteradata1($periodo->Per_dataini). " a " . $this->Log->alteradata1($periodo->Per_dataFim)." - Direito " . $periodo->Per_QtdDir. " dias";
			
		}
		echo json_encode($json);
	}

	public function newsletter(){
    	$this->Log->talogado(); 
        $iduser = $this->session->userdata('id_funcionario');
        $idempresa = $this->session->userdata('idempresa');
        $idcli = $this->session->userdata('idcliente');
        //$this->session->set_userdata('perfil_atual', '1');
        $dados = array('menupriativo' => 'newsletter' );

        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();

        $feeds = $this->db->get('feedbacks')->num_rows();
        $dados['quantgeral'] = $feeds;
        
        $this->db->select('tema_cor, tema_fundo');
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['tema'] = $this->db->get('funcionario')->result();
        $dados['perfil'] = $this->session->userdata('perfil');

        /*
        $this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();
        */

        $dados['categorias'] = $this->db->get('newsletter_categoria')->result();

        $this->db->select('newsletter.*, fun_foto, fun_nome, fun_sexo, descricao_categoria_newsletter');
        $this->db->join("funcionario", "fun_idfuncionario = fk_idfuncionario_newsletter");
        $this->db->join("newsletter_categoria", "id_categoria_newsletter = fk_categoria_newsletter");
        $this->db->where('fk_idempresa_newsletter',$idempresa);
        $this->db->order_by("id_newsletter", "desc");
        $dados['newsletter'] = $this->db->get("newsletter")->result();


        $this->session->unset_userdata('primsg');
        $dados['breadcrumb'] = array('Home'=>base_url('home'), "newsletter"=>"#" );

        $this->load->view('/geral/html_header',$dados);  
        $this->load->view('/geral/corpo_newsletter',$dados);
        $this->load->view('/geral/footer');
	}

	public function salvarNewsletter(){
        

        if (!empty($_FILES['file'])) {
         try {

            $instancia =$this->session->userdata('instancia');                
            $pasta = FCPATH.'/img/'. $instancia;

            if (!file_exists($pasta)) {
                if( ! mkdir($pasta, 0777, true) ){
                    throw new Exception("Nao foi possivel criar a pasta");
                }
            }

            if (!$_FILES['file']['error']) {
                $name = $this->util->geraString(7);;
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . end($ext);
                    $destination = $pasta."/".$filename;
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    echo base_url("img/".$instancia."/".$filename);
                }else{
                    echo  $_FILES['file']['error'];
                }     

            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }

            return;
        }


        $caminho_img = "";
        if (!empty($_FILES['imagem'])) {

         try {

            $instancia =$this->session->userdata('instancia');                
            $pasta = FCPATH.'/img/'. $instancia;

            if (!file_exists($pasta)) {
                if( ! mkdir($pasta, 0777, true) ){
                    throw new Exception("Nao foi possivel criar a pasta");
                }
            }

            if (!$_FILES['imagem']['error']) {
            	$name = $this->util->geraString(7);;
            	$ext = explode('.', $_FILES['imagem']['name']);
            	$filename = $name . '.' . end($ext);
            	$destination = $pasta."/".$filename;
            	$location = $_FILES["imagem"]["tmp_name"];
            	move_uploaded_file($location, $destination);
            	$caminho_img = base_url("img/".$instancia."/".$filename);
            	echo base_url("img/".$instancia."/".$filename);
            }else{
                echo  $_FILES['imagem']['error'];
            }

            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }
            
        }

        $idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario'); 

        $dados["titulo_newsletter"] = utf8_decode($this->input->post("newstitulo") ); 
        $dados["fonte_newsletter"] = utf8_decode($this->input->post("fonte") );
        $dados["descricao_newsletter"] = utf8_decode($this->input->post("mensagem") ); 
        $dados["url_imagem_newsletter"] = $caminho_img;
        $dados["fk_categoria_newsletter"] = $this->input->post("categoria");
        $dados["fk_idfuncionario_newsletter"] = $iduser;
        $dados["fk_idempresa_newsletter"] = $idempresa;
        $this->db->insert("newsletter", $dados);
        //header("Location: " . base_url("home/newsletter") );
    }

    public function excluirNewsletter(){

        $id = $this->input->post("id");
        $this->db->where("id_newsletter", $id);
        $this->db->delete("newsletter");
        $res['msg']=1;
        echo json_encode($res);

    }

    public function widgetNoticias(){
    	$idempresa = $this->session->userdata('idempresa');
    	$this->db->select('newsletter.*, descricao_categoria_newsletter');
        $this->db->join("newsletter_categoria", "id_categoria_newsletter = fk_categoria_newsletter");
        $this->db->where('fk_idempresa_newsletter',$idempresa);
        $this->db->order_by("id_newsletter", "desc");
        $this->db->limit(5);
        $dados['newsletter'] = $this->db->get("newsletter")->result();
        $dados['modal']=false;
        header ('Content-type: text/html; charset=ISO-8859-1');
        $this->load->view('/geral/box/modalnoticias',$dados);
    }

    public function modalnoticia(){
    	$id = $this->input->post('id');
    	$this->db->select('newsletter.*, descricao_categoria_newsletter');
        $this->db->join("newsletter_categoria", "id_categoria_newsletter = fk_categoria_newsletter");
        $this->db->where('id_newsletter', $id);
        $dados['newsletter'] = $this->db->get("newsletter")->row();

        $dados['modal']=true;
        header ('Content-type: text/html; charset=ISO-8859-1');
        $this->load->view('/geral/box/modalnoticias', $dados);
    }

    public function lancamentos(){
    	$this->Log->talogado();
		$this->session->set_userdata('perfil_atual', '1');
        $iduser = $this->session->userdata('id_funcionario');
        $idempresa = $this->session->userdata('idempresa');
        $idcli = $this->session->userdata('idcliente');
        $dados = array('menupriativo' => 'lancamentos' );

        $this->db->where('fk_idfuncionario', $iduser);
		$this->db->where('fk_idempresa', $idempresa);
		if ( !is_object($this->db->get('lancamento_responsaveis')->row())) {
			header("Location: " . base_url("home") );
			exit;
		}

        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();
        $dados['quantgeral'] = $this->db->get('feedbacks')->num_rows();

        $this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();

        $this->db->where('fun_idempresa', $idempresa);
        $this->db->where('fun_status',"A");
        //$this->db->limit(10);
        $dados['colaboradores'] = $this->db->get('funcionario')->result();
        
        $this->db->join("eventos", "idevento = fk_evento");
        $this->db->where("fk_ev_empresa", $idempresa);
        $dados['eventos'] = $this->db->get("lancamento_eventos")->result();

        $this->db->where('situacao_competencia', 0);
        $this->db->limit(1);
        $this->db->order_by("mes_competencia", "desc");
        $dados['competencia'] = $this->db->get("lancamento_competencia")->row();

        $this->db->select('tema_cor, tema_fundo');
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['tema'] = $this->db->get('funcionario')->result();
        $dados['perfil'] = $this->session->userdata('perfil');
		$dados['breadcrumb'] = array('Home'=>base_url('home'), "Lançamentos"=>"#" );


        $this->load->view('/geral/html_header', $dados);  
        $this->load->view('/geral/corpo_lancamentos', $dados);
        $this->load->view('/geral/footer');
    }

    public function salvarLancamento(){
    	$idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario'); 

        $dados["fk_colaborador"] = $this->input->post("selectcolab") ; 
        $dados["fk_colaborador_emissor"] = $iduser ; 
        $dados["fk_lancamento_empresa"] = $idempresa;
        $dados["fkcompetencia"] = $this->input->post("competencia");
        $ev = array();
        if (!empty($this->input->post("hora"))) {
        	foreach ($this->input->post("hora") as $key => $value) {

        		$idevento = $this->input->post("eventos")[$key];
        		if (!empty($value)) {        		    
        			$ev[$idevento][] = $value;
        		}       		
        	}
        }
        if (!empty($this->input->post("valor"))) {
        	foreach ($this->input->post("valor") as $key => $value) {

        		$idevento = $this->input->post("eventos")[$key];
        		if (!empty($value)) {        			
        			$ev[$idevento][] = $this->util->floatParaInsercao($value);
        		}        		
        	}
    	}

    	foreach ($ev as $key => $value) {   		

    		if (stripos($value[0], ":")) {
    			$dados["horas"] = $value[0];
    		}elseif(stripos($value[0], ".")){
    			$dados["valor"] = $value[0];
    		}

    		if (isset($value[1])) {
    			$dados["valor"] =$value[1];//posição 1 é valor
    		}
    		$dados["fk_codigo_evento"] = $key;
    		$this->db->insert("lancamento", $dados);
    		unset($dados["horas"]);
    		unset($dados["valor"]);
    	}
        
        $this->db->select("fun_nome, valor, horas, descricao, id_lancamento");
        $this->db->join("funcionario", "fun_idfuncionario = fk_colaborador");
        $this->db->join("eventos", "idevento = fk_codigo_evento");
        $this->db->join("lancamento_competencia", "fkcompetencia = id_competencia");
        $this->db->where("fk_colaborador", $this->input->post("selectcolab"));
        $this->db->where("fkcompetencia", $this->input->post("competencia"));
        $lanc['lancamentos'] = $this->db->get("lancamento")->result();

        if (count($lanc['lancamentos'])>0) {
        	header ('Content-type: text/html; charset=ISO-8859-1');
        	$this->load->view('/geral/box/gridlancamento', $lanc);
        }
    }

    public function excluirLancamento(){
    	$id = $this->input->post("id");
		$this->db->where("id_lancamento", $id);
		$this->db->delete("lancamento");
		echo 1;
    }

    public function admissao(){
    	$this->Log->talogado();
		$this->session->set_userdata('perfil_atual', '1');
        $iduser = $this->session->userdata('id_funcionario');
        $idempresa = $this->session->userdata('idempresa');
        $idcli = $this->session->userdata('idcliente');
        $dados = array('menupriativo' => 'admissao' );
	 
        $this->db->where('idempresa', $idempresa);
		$dados['cargos'] = $this->db->get('tabelacargos')->result();

		$this->db->where('fil_idempresa', $idempresa);
		$dados['filial'] = $this->db->get('filial')->result();

		$this->db->where('idempresa', $idempresa);
		$dados['departamentos'] = $this->db->get('tabeladepartamento')->result();

		$this->db->order_by("est_nomeestado", "asc");
		$dados['estados'] = $this->db->get('estado')->result();
		$dados['estadocivis'] = $this->db->get('estadocivil')->result();
		$dados['etnia'] = $this->db->get('etnia')->result();
		$dados['deficiencia'] = $this->db->get('tipodeficiencia')->result();
		$dados['bancos'] = $this->db->get('bancos')->result();
		$dados['logradouros'] = $this->db->get('tipologradouro')->result();

		$this->db->where('escolaridade_idcliente', $idcli);
		$dados['escolaridade'] = $this->db->get('escolaridade')->result();

		$this->db->where('idcliente', $idcli);
		$dados['parentesco'] = $this->db->get('tipodependente')->result();

		$this->db->join("tabelacargos", "idcargo = fk_cargo_admissao", "left");
		$this->db->join("filial", "fil_idempresa = adm_idfilial", "left");
		$this->db->where("admissao_status", 0);
		$this->db->where("fk_admidempresa", $idempresa);
		$this->db->where("fk_colaborador_emissor", $iduser);
		$dados['rascunho'] = $this->db->get("admissao")->result();
	 
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();
        $dados['quantgeral'] = $this->db->get('feedbacks')->num_rows();

        $this->db->where("idempresa", $idempresa);
        $dados['parametros'] = $this->db->get("parametros")->row();


        $this->db->select('tema_cor, tema_fundo');
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['tema'] = $this->db->get('funcionario')->result();
        $dados['perfil'] = $this->session->userdata('perfil');
		$dados['breadcrumb'] = array('Home'=>base_url('home'), "Admissao"=>"#" );


        $this->load->view('/geral/html_header', $dados);  
        $this->load->view('/geral/corpo_admissao', $dados);
        $this->load->view('/geral/footer');
    }


    public function salvar_admissao(){
    	//$this->Log->talogado();
    	$idempresa = $this->session->userdata('idempresa');
        $iduser = $this->session->userdata('id_funcionario');
        

       /* $dados["nome_admissao"] = $this->input->post("nome");
        $dados["fk_admdepartamento"] = $this->input->post("departamento");
        $dados["sexo_admissao"] = $this->input->post("sexo");
        */

        $datas = array("dtnascimento_admissao", "data_admissao", "dt_emissaoctps", "dt_emissaopis", "rg_emissao", "vencimentocnh");
        
        $id = $this->input->post("id");
        $campo = $this->input->post("campo");
        $valor = $this->input->post("valor");
        $required = $this->input->post("required");

        if ( in_array($campo, $datas)) {

        	$dados[$campo] = $this->Log->alteradata2($valor);

        }else if($campo == "salario_admissao"){

        	$dados[$campo] = $this->util->floatParaInsercao($valor);
        
        }else{
        
        	$dados[$campo] = $valor;
        
        }

        if ($required && trim($valor)=="") {
            $r['acao'] = "erro";
        	echo json_encode($r);
        	return;
        }    


        if ($id==0) {
        	$dados["fk_colaborador_emissor"] = $iduser ;
        	$dados["fk_admidempresa"] = $idempresa ;
        	$this->db->insert("admissao", $dados);
        	$r['acao'] = "insert";
        	$r['id'] = $this->db->insert_id();
        	
        }else{
        	$this->db->where("id_admissao", $id);
        	$r['acao'] = "update";
        	$r['id'] = $this->db->update("admissao", $dados);
        }
        echo json_encode($r);
		/*
        $dados["salario_admissao"] = $this->util->floatParaInsercao($this->input->post("salario"));
        $dados["tiposalario_admissao"] = $this->input->post("tiposalario");
        //$dados["nome_admissao"] = $this->input->post("nome");
        $dados["ic_pis"] = $this->input->post("pis");
        $dados["ic_emprego"] = $this->input->post("emprego");
        $dados["fk_cargo_admissao"] = $this->input->post("selectcargo");
        $dados["horaentrada"] = $this->input->post("entrada");
        $dados["horasaidainter"] = $this->input->post("saidaintervalo");
        $dados["horaentradainter"] = $this->input->post("entradaintervalo");
        $dados["horasaida"] = $this->input->post("saida");
        $dados["sabadoentrada"] = $this->input->post("sabadoentrada");
        $dados["sabadosaida"] = $this->input->post("sabadosaida");
        $dados["hrsemanal"] = $this->input->post("hrsemanal");
        $dados["hrmensal"] = $this->input->post("hrmensal");
        $dados["hrdsr"] = $this->input->post("hrdsr");

        if (!empty($this->input->post("dtnascimento"))) {
        	$dados["dtnascimento_admissao"] = $this->Log->alteradata2($this->input->post("dtnascimento"));
        }
        
        $dados["fkestadonascimento"] = $this->input->post("estado");
        $dados["fkcidadenascimento"] = $this->input->post("cidade");
        $dados["fkestadocivil"] = $this->input->post("estadocivil");
        $dados["nr_ctps"] = $this->input->post("ctps");
        $dados["serie_ctps"] = $this->input->post("serie");
        $dados["estado_ctps"] = $this->input->post("ctpsestado");

        if (!empty($this->input->post("dtctps"))) {
        	$dados["dt_emissaoctps"] = $this->Log->alteradata2($this->input->post("dtctps"));
        }        
        
        $pis = array(".", "-", "-");
        $dados["nr_pis"] = str_replace($pis, "", $this->input->post("numeropis"));;

        if (!empty($this->input->post("dtpis"))) {
        	$dados["dt_emissaopis"] = $this->Log->alteradata2($this->input->post("dtpis"));
        } 
        $dados["reservista"] = $this->input->post("reservista");
        $dados["cpf"] = str_replace($pis, "", $this->input->post("cpf") );
        $dados["rg"] = $this->input->post("rg");
        $dados["rgorgao"] = $this->input->post("orgaoemissor");
        if (!empty($this->input->post("dtrg"))) {
        	$dados["rg_emissao"] = $this->Log->alteradata2($this->input->post("dtrg"));
        }
        $dados["rg_estado"] = $this->input->post("estadorg");
        $dados["cnh"] = $this->input->post("cnhnumero");

        if (!empty($this->input->post("vencimentocnh"))) {
        	$dados["vencimentocnh"] = $this->Log->alteradata2($this->input->post("vencimentocnh"));
        }

        $dados["adm_idfilial"] = $this->input->post("cbofilial");
        $dados["adm_tipocontrato"] = $this->input->post("tipocontrato");
        $dados["cnhcategoria"] = $this->input->post("cnhcategoria");
        $dados["titulo"] = $this->input->post("titulo");
        $dados["zona"] = $this->input->post("zona");
        $dados["secao"] = $this->input->post("secao");
        $dados["fk_escolaridade_admissao"] = $this->input->post("escolaridade");
        $dados["fk_etnia_admissao"] = $this->input->post("etnia");
        $dados["fk_deficiencia_admissao"] = $this->input->post("deficiencia");
        $dados["ic_reabilitado"] = $this->input->post("reabilitado");
        $dados["fk_logradouro_admissao"] = $this->input->post("tipologradouro");
        $dados["endereco_admissao"] = $this->input->post("endereco");
        $dados["endereconumero"] = $this->input->post("numeroendereco");
        $dados["enderecocomplemento"] = $this->input->post("complemento");
        $dados["fk_enderecoestado"] = $this->input->post("estadoendereco");
        $dados["fk_enderecocidade"] = $this->input->post("cidadeendereco");
        $dados["fk_enderecobairro"] = $this->input->post("bairro");
        $dados["cep_admissao"] = str_replace($pis, "", $this->input->post("cep") );
        $dados["telefone_admissao"] = $this->input->post("telefone");
        $dados["celular_admissao"] = $this->input->post("celular");
        $dados["nomemae"] = $this->input->post("mae");
        $dados["nomepai"] = $this->input->post("pai");
        //$dados["nomeconjuge"] = $this->input->post("conjuge");
        //$dados["nascimentoconjuge"] = $this->Log->alteradata2($this->input->post("dtconjuge"));
        $dados["ic_contribuicaosindical"] = $this->input->post("contr");
        $dados["ic_periculosidade"] = $this->input->post("peric");
        $dados["valorpericulosidade"] = $this->input->post("peric_perc");
        $dados["ic_insalubridade"] = $this->input->post("insal");
        $dados["valorinsalubridade"] = $this->input->post("insa_perc");
        $dados["contratoexperiencia"] = $this->input->post("contrato");
        $dados["contratoprorrogacao"] = $this->input->post("prorrogacao");
        $dados["tipopagamento"] = $this->input->post("pagamento");
        $dados["bancoagencia"] = $this->input->post("agencia");
        $dados["bancoconta"] = $this->input->post("conta");
        $dados["contadigito"] = $this->input->post("digito");
        $dados["tipoconta"] = $this->input->post("tipoconta");
        $dados["ic_adiantamento"] = $this->input->post("adiantamento");
        $dados["fk_idbanco"] = $this->input->post("banco");
        $dados["ic_decimoterceiro"] = $this->input->post("decimoterceiro");
        $dados["ic_vt"] = $this->input->post("vt");
        //$dados["vt_qtd"] = $this->input->post("vtqtd");
        //$dados["vt_tipo"] = $this->input->post("vttipo");
        $dados["ic_vr"] = $this->input->post("vr");
        $dados["ic_assistenciamedica"] = $this->input->post("med");
        /*if (empty($this->input->post("medvalor"))) {
        	$dados["valorassistencia"] = 0;
        }else{
        	$dados["valorassistencia"] = $this->util->floatParaInsercao($this->input->post("medvalor"));	
        }*/
        /*
        $dados["ic_segurodesemprego"] = $this->input->post("segurodesemprego");
        $dados["emailcomercial"] = $this->input->post("emailcom");
        
        $dados["emailparticular"] = $this->input->post("emailpar");
        $this->db->db_debug = FALSE;
        $this->db->insert("admissao", $dados);
        $_SESSION['admmsg'] = $this->db->_error_message();

        if ( (!isset($_SESSION['admmsg'])) || ( strrpos($_SESSION['admmsg'], "context") ) ) {
        	$_SESSION['admmsg'] = "Dados cadastrados com sucesso";
        	$_SESSION['admclass'] = "alert-success";
        }else{
        	$_SESSION['admmsg'] = "Erro ao gravar.";
        	$_SESSION['admclass'] = "alert-danger";
        }
        
        $id = $this->db->insert_id();
        $d['fk_depadmissao'] = $id;
        $depcpf = $this->input->post("cpfdep");
        $depnome = $this->input->post("depnome");
        $depmae = $this->input->post("depmae");
        $depsexo = $this->input->post("depsexo");
        $depaux = $this->input->post("auxfamilia");
        $depir = $this->input->post("depimposto");
        $depnasc = $this->input->post("depnascimento");
        $depparentesco = $this->input->post("depparentesco");
        $i=0;

        
        foreach ($depnasc as $key => $value) {
        	if (!empty($value)) {
        		$d['nome_depadmissao'] = $depnome[$i];
        		$d['ic_ir_depadmissao'] = $depir[$i];
        		$d['sexo_depadmissao'] = $depsexo[$i];
        		$d['nascimento_depadmissao'] = $this->Log->alteradata2($depnasc[$i]);
        		$d['fk_idparentesco'] = $depparentesco[$i];
        		$d['cpf_depadmissao'] = $depcpf[$i];
        		$d['nomemae'] = $depmae[$i];
        		$d['ic_auxfamilia'] = $depaux[$i];
        		$i++;
        		$this->db->insert("admissao_dependente", $d);
        	}
    	}
    	$this->db->db_debug = TRUE;
        header("Location: ".base_url('home/admissao'));*/
    }

    public function salvar_dependente(){
    	
    	if ($this->input->post("id")==0) {        	
        	
        	$r['acao'] = "erro";
        	$r['mensagem'] = "Preencha os dados pessoais primeiro";
        	echo json_encode($r);
        	return;
        	
        }
        $dados['fk_depadmissao'] = $this->input->post("id");
        $dados["nome_depadmissao"] = $this->input->post("nome");
        $dados["cpf_depadmissao"] = $this->input->post("cpf");
        $dados["ic_ir_depadmissao"] = $this->input->post("ir");
        $dados["sexo_depadmissao"] = $this->input->post("sexo");
        $dados["fk_idparentesco"] = $this->input->post("parentesco");
        $dados["nascimento_depadmissao"] = $this->Log->alteradata2($this->input->post("nasc"));
        $dados["ic_auxfamilia"] = $this->input->post("aux");
        $dados["nomemae"] = $this->input->post("mae");

        if($this->input->post("iddep")>0){

        	$this->db->where("id_dependenteadmissao", $this->input->post("iddep"));
        	$r['acao'] = "update";
        	$r['id'] = $this->db->update("admissao_dependente", $dados);

        }else{
        	
        	$this->db->insert("admissao_dependente", $dados);
        	$r['acao'] = "insertdp";
        	$r['id'] = $this->db->insert_id();
        }

        
        echo json_encode($r);        

    }

    public function estadocidade(){

    	$id = $this->input->post("id");
    	$idcli = $this->session->userdata('idcliente');    	

    	if ($this->input->post("campo")=="estado") {
    		$array="<option value=''>Cidade</option>";
    		$this->db->where("cid_idestado", $id);
    		$this->db->order_by("cid_nomecidade", "asc");
    		foreach ($this->db->get('cidade')->result() as $key => $value) {
    			$array .= '<option value="'.$value->cid_idcidade.'">'.$value->cid_nomecidade.'</option>';
    		}
    	}elseif($this->input->post("campo")=="cidade") {
    		$array="<option value=''>Bairro</option>";
    		$this->db->where("bair_idcidade", $id);
    		$this->db->where("idcliente", $idcli);
    		$this->db->order_by("bair_nomebairro", "asc");
    		foreach ($this->db->get('bairro')->result() as $key => $value) {
    			$array .= '<option value="'.$value->bair_idbairro.'">'.$value->bair_nomebairro.'</option>';
    		}
    	}

		echo $array;
    }

    public function rascunhoadmissao(){

    	$id = $this->input->post("id");
    	$this->db->where('id_admissao', $id);
		$admissao = $this->db->get('admissao')->row();

		foreach ($admissao as $key => $value) {
			$array[$key] = $value;
		}

		if (!empty($admissao->data_admissao)) {
			$admissao->data_admissao=$this->Log->alteradata1($admissao->data_admissao);
		}
		if (!empty($admissao->dtnascimento_admissao)) {
			$admissao->dtnascimento_admissao=$this->Log->alteradata1($admissao->dtnascimento_admissao);
		}
		if (!empty($admissao->dt_emissaoctps)) {
			$admissao->dt_emissaoctps=$this->Log->alteradata1($admissao->dt_emissaoctps);
		}
		if (!empty($admissao->rg_emissao)) {
			$admissao->rg_emissao=$this->Log->alteradata1($admissao->rg_emissao);
		}
		if (!empty($admissao->vencimentocnh)) {
			$admissao->vencimentocnh=$this->Log->alteradata1($admissao->vencimentocnh);
		}
		echo json_encode($admissao);

    }

    public function excluirdependente(){
    	$id = $this->input->post("id");
		$this->db->where("id_dependenteadmissao", $id);
		$this->db->delete("admissao_dependente");
		echo 1;
    }

    public function getDependentes(){
    	$id = $this->input->post("id");
    	$this->db->join("tipodependente", "tipdep = fk_idparentesco", "left");
		$this->db->where('fk_depadmissao', $id);
		$dados['dependente'] = $this->db->get('admissao_dependente')->result();

		header ('Content-type: text/html; charset=ISO-8859-1');
		$this->load->view('/geral/edit/getdependentes', $dados);
    }

}