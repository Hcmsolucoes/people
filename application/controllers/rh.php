<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Rh extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->model('Log'); 
	}

	public function index(){ 
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'painel' );

		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcliente = $this->session->userdata('idcliente');
		$selectempresa = (!empty($this->input->post("empresa")) )? $this->input->post("empresa") : "";

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->select('em_idempresa, em_nome');
		$this->db->where('em_idcliente',$idcliente);
		$dados['empresas'] = $this->db->get('empresa')->result();

   
        //subordinados
        $this->db->where('not exists(
        select * from chefiasubordinados where chefiasubordinados.subor_idfuncionario = funcionario.fun_idfuncionario)');
		$this->db->where('fun_status', "A");
		if ( !empty($selectempresa) ) {
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['naosubordinados'] = $this->db->get('funcionario')->result();

		$this->db->where('exists(
        select * from chefiasubordinados where chefiasubordinados.subor_idfuncionario = funcionario.fun_idfuncionario)');
		$this->db->where('fun_status', "A");
		if ( !empty($selectempresa) ) {
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['subordinados'] = $this->db->get('funcionario')->result();
       
        
		$noventa_dias = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +3 month");
		$noventa_dias = date("Y-m-d", $noventa_dias);
		$this->db->select('fun_cargo, fun_idfuncionario, fun_foto, fun_sexo, fun_nome, vnccontr, contr_cargo');
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where('vnccontr >= ', date("Y-m-d"));
		$this->db->where('vnccontr <= ', $noventa_dias);
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$this->db->where('fun_status', "A");
		$dados['vencimentos'] = $this->db->get('funcionario')->result();


		$this->db->select('contr_situacao, fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$this->db->where('fun_status', "A");
		$dados['situacao'] =$this->db->get('funcionario')->result();


		//deficiencia
		$this->db->select("descricaodeficiencia, fun_idfuncionario");
		$this->db->join('tipodeficiencia', "id_tipodeficiencia = tipodeficiencia");
		$this->db->where('fun_status',"A");
		$this->db->where('deficiente',"S");
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['deficienciarh'] = $this->db->get('funcionario')->result();


		$this->db->select("escolaridade.*, fun_idfuncionario");
		$this->db->join('escolaridade', "fun_escolaridade = id_escolaridade");
		$this->db->where('fun_status',"A");
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['escolaridade'] = $this->db->get('funcionario')->result();


		//asos dos proximos 15 dias
		$date = new DateTime(date("Y-m-d"));
		$date->add(new DateInterval('P15D'));
		$this->db->select("COUNT(fun_idfuncionario) AS vencimento");
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where("fun_proximoexame <=", $date->format('Y-m-d') );
		$this->db->where("fun_proximoexame >=", date('Y-m-d') );
		$this->db->where("fun_status", "A" );
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['aso1'] = $this->db->get('funcionario')->row();

    	//asos vencidos
		$this->db->select("COUNT(fun_idfuncionario) AS vencidos");
		$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
		$this->db->where("fun_proximoexame < ", date('Y-m-d') );
		$this->db->where("fun_status", "A" );
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['aso2'] = $this->db->get('funcionario')->row();

		$this->db->select("COUNT(fun_idfuncionario) AS masc");
		$this->db->where("fun_sexo", 1 );
		$this->db->where("fun_status", "A" );
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['masc'] = $this->db->get('funcionario')->row();
		$this->db->select("COUNT(fun_idfuncionario) AS fem");
		$this->db->where("fun_sexo", 2 );
		$this->db->where("fun_status", "A" );
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$dados['fem'] = $this->db->get('funcionario')->row();

		$this->db->select('fun_datanascimento');
    	if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$this->db->where('fun_status', "A");
		$dados['idade'] =$this->db->get('funcionario')->result();

		$this->db->select('contr_data_admissao');
		$this->db->join("funcionario", "contr_idfuncionario = fun_idfuncionario");
		if ( !empty($selectempresa) ) {
			
			$this->db->where('fun_idempresa', $selectempresa);
		}
		$this->db->where('fun_status', "A");
		$dados['tempo_trabalhado'] =$this->db->get('contratos')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;
		
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();

		$dados['perfil'] = $this->session->userdata('perfil');

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$this->db->where('feed_data >=',date('Y/m/d'));
		$this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
		$feeds2 = $this->db->get('feedbacks')->num_rows();
		$dados['quantultimos'] = $feeds2;

		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Dashboard"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_dash_rh',$dados);
		$this->load->view('/geral/footer');
	}

	public function eventos(){
		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'painel' );
		$dados['perfil'] = $this->session->userdata('perfil');
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');
		
		$this->db->where("idempresa", $idempresa);
		$dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;
		
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();
		$this->db->where('feed_idfuncionario_recebe',$iduser);
		$this->db->where('feed_data >=',date('Y/m/d'));
		$this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
		$feeds2 = $this->db->get('feedbacks')->num_rows();
		$dados['quantultimos'] = $feeds2;

		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Eventos"=>"#" );
		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_eventos',$dados);
		$this->load->view('/geral/footer');
	}

	public function aprovacoes(){

		$this->Log->talogado();
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'aprovacoes' );
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
		$this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
		$this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
		$this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
		$this->db->where('ic_efetivado != ',1);
		$this->db->where('solicitacao_status >= 3');
		$dados['solicitacoes'] = $this->db->get('solicitacoes')->result();

		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();

		$dados['perfil'] = $this->session->userdata('perfil');
		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Aprovações"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_aprovados',$dados);
		$this->load->view('/geral/footer');
	}

	public function mensagem(){
		$this->Log->talogado();
		$this->session->set_userdata('perfil_atual', '5');
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array(
			'menupriativo' => 'mensagem'
			);

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$feeds = $this->db->get('feedbacks')->num_rows();
		$dados['quantgeral'] = $feeds;
		
		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();
		$dados['perfil'] = $this->session->userdata('perfil');

		$this->db->where("idempresa", $idempresa);
		$dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
		$this->db->join('funcionario', 'mensagem.fk_destinatario_mensagem = funcionario.fun_idfuncionario');
		$this->db->where('fk_remetente_mensagem',$iduser);
		$this->db->where('ic_vizualizado != 2 AND ic_vizualizado != 4');
		$this->db->order_by("id_mensagem", "desc");
		$this->db->limit(10);
		$dados['msg_enviadas'] = $this->db->get("mensagem")->result();

		$this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
		$this->db->join('funcionario', 'mensagem.fk_remetente_mensagem = funcionario.fun_idfuncionario');
		$this->db->where('fk_destinatario_mensagem', $iduser);
		$this->db->where('ic_vizualizado != 3 AND ic_vizualizado != 5');
		$this->db->order_by("id_mensagem", "desc");
		$this->db->limit(10);
		$dados['msg_recebidas'] = $this->db->get("mensagem")->result();

		$this->db->select('mensagem.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
		$this->db->join('funcionario', 'mensagem.fk_remetente_mensagem = funcionario.fun_idfuncionario');
		$this->db->where('ic_vizualizado = 2 OR ic_vizualizado = 3');
		$this->db->where('(fk_remetente_mensagem = '.$iduser.' OR fk_destinatario_mensagem = '.$iduser.')');
		$this->db->order_by("id_mensagem", "desc");
		$this->db->limit(10);
		$dados['msg_excluidas'] = $this->db->get("mensagem")->result();
		$this->session->unset_userdata('primsg');
		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Mensagens"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_mensagem',$dados);
		$this->load->view('/geral/footer');
	}

	public function efetivar(){

		$id = $this->input->post("id");
		$dados['ic_efetivado'] = 1;
		$this->db->where("solicitacao_id", $id);
		$this->db->update("solicitacoes", $dados);
		echo 1;
	}

	public function integracoes(){

		$this->Log->talogado(); 
		$this->session->set_userdata('perfil_atual', '5');
		$dados = array('menupriativo' => 'integracoes' );
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');

		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();

		$this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
		$this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
		$this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
		$this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
		$this->db->where('ic_efetivado',1);
		$this->db->where('solicitacao_status = 3');
		$dados['solicitacoes'] = $this->db->get('solicitacoes')->result();

		$this->db->join("funcionario", "fun_idfuncionario = fer_idfuncionario");
		$this->db->where('fun_status',"A");
		$this->db->where('fer_status', 1);
		$dados['ferias'] = $this->db->get('programacao_ferias')->result();

		$this->db->select("id_admissao, nome_admissao, data_admissao, ic_integrado, fun_nome, descricao");
		$this->db->join("funcionario", "fun_idfuncionario = fk_colaborador_emissor");
		$this->db->join("tabelacargos", "idcargo = fk_cargo_admissao");
		$this->db->where("fk_admidempresa", $idempresa);
		$this->db->where("admissao_status", 2);
		$dados['admissoes'] = $this->db->get("admissao")->result();

		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();

		$dados['perfil'] = $this->session->userdata('perfil');
		$dados['breadcrumb'] = array('RH'=>base_url('rh'), "Integrações"=>"#" );

		$this->load->view('/geral/html_header',$dados);  
		$this->load->view('/geral/corpo_integrados',$dados);
		$this->load->view('/geral/footer');
	}

	public function admissao(){
		$this->Log->talogado();
		$this->session->set_userdata('perfil_atual', '5');
		$iduser = $this->session->userdata('id_funcionario');
		$idempresa = $this->session->userdata('idempresa');
		$idcli = $this->session->userdata('idcliente');
		$dados = array('menupriativo' => 'admissao' );

		$this->db->select("id_admissao, nome_admissao, data_admissao, fun_nome, descricao");
		$this->db->join("funcionario", "fun_idfuncionario = fk_colaborador_emissor");
		$this->db->join("tabelacargos", "idcargo = fk_cargo_admissao");
		$this->db->where("fk_admidempresa", $idempresa);
		$this->db->where("admissao_status", 1);
		$dados['admissoes'] = $this->db->get("admissao")->result();


		$this->db->where('fun_idfuncionario',$iduser);
		$dados['funcionario'] = $this->db->get('funcionario')->result();
		$dados['quantgeral'] = $this->db->get('feedbacks')->num_rows();

		$this->db->where("idempresa", $idempresa);
		$dados['parametros'] = $this->db->get("parametros")->row();

		$this->db->select('tema_cor, tema_fundo');
		$this->db->where('fun_idfuncionario',$iduser);
		$dados['tema'] = $this->db->get('funcionario')->result();
		$dados['perfil'] = $this->session->userdata('perfil');
		$dados['breadcrumb'] = array('Gestor'=>base_url('gestor'), "Admissao"=>"#" );


		$this->load->view('/geral/html_header', $dados);  
		$this->load->view('/geral/corpo_admissaorh', $dados);
		$this->load->view('/geral/footer');
	}

	public function veradmissao(){

		$iduser = $this->session->userdata('id_funcionario');
        $idempresa = $this->session->userdata('idempresa');
        $idcli = $this->session->userdata('idcliente');
        $dados = array('menupriativo' => 'admissao' );
	 	$id = $this->input->post("id");

	 	$this->db->where('id_admissao', $id);
		$dados['admissao'] = $this->db->get('admissao')->row();

		$this->db->join("tipodependente", "tipdep = fk_idparentesco", "left");
		$this->db->where('fk_depadmissao', $id);
		$dados['dependente'] = $this->db->get('admissao_dependente')->result();

        $this->db->where('idempresa', $idempresa);
		$dados['cargos'] = $this->db->get('tabelacargos')->result();

		$this->db->select('em_idempresa, em_nome');
		$this->db->where('em_idcliente',$idcli);
		$dados['empresas'] = $this->db->get('empresa')->result();

		$this->db->where('fil_idempresa', $idempresa);
		$dados['filial'] = $this->db->get('filial')->result();

		$this->db->where('idempresa', $idempresa);
		$dados['departamentos'] = $this->db->get('tabeladepartamento')->result();

		$this->db->order_by("est_nomeestado", "asc");
		$dados['estados'] = $this->db->get('estado')->result();

		$this->db->where('cid_idestado', $dados['admissao']->fkestadonascimento);
		$dados['cidades'] = $this->db->get('cidade')->result();

		$this->db->where('cid_idestado', $dados['admissao']->fk_enderecoestado);
		$dados['cidadesendereco'] = $this->db->get('cidade')->result();

		$dados['horbase'] = $this->db->get("horarios")->result();

		$this->db->where('bair_idcidade', $dados['admissao']->fk_enderecocidade);
		$dados['bairrosendereco'] = $this->db->get('bairro')->result();

		$this->db->where('fk_idadmissaodoc', $id);
		$dados['docs'] = $this->db->get('admissao_doc')->result();

		$dados['estadocivis'] = $this->db->get('estadocivil')->result();
		$dados['etnia'] = $this->db->get('etnia')->result();
		$dados['deficiencia'] = $this->db->get('tipodeficiencia')->result();
		$dados['bancos'] = $this->db->get('bancos')->result();
		$dados['logradouros'] = $this->db->get('tipologradouro')->result();

		$this->db->where('escolaridade_idcliente', $idcli);
		$dados['escolaridade'] = $this->db->get('escolaridade')->result();
		$this->db->where('idcliente', $idcli);
		$dados['parentesco'] = $this->db->get('tipodependente')->result();

		header ('Content-type: text/html; charset=ISO-8859-1');
		$this->load->view('/geral/edit/modal_rhadmissao', $dados);
	}


}