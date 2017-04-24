<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Perfil extends CI_Controller {
	
	public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd');
			
	}
	
	public function pessoal()
        { 
            $this->Log->talogado(); 
            $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'pessoal', 'menu_colab_perfil_contrato' => '');             
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');

            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();
            
            $this->db->where('ema_idfuncionario',$iduser);
            $dados['emails'] = $this->db->get('emails')->result();
            
            $this->db->where('rede_idfuncionario',$iduser);
            $dados['redesocial'] = $this->db->get('redesocial')->result();
            
            $this->db->where('con_idfuncionario',$iduser);
            $dados['contato'] = $this->db->get('contato')->result();
            
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('endereco', 'endereco.end_idendereco = funcionario.fun_idendereco');  
            $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
            $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
            $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro');  
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['endereco'] = $this->db->get()->result(); 
            

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');


            $this->db->where('doc_idfuncionario',$iduser);
            $dados['documentos'] = $this->db->get('documentos')->result();


            $this->db->select('*');
            $this->db->join('motivos', 'motivos.mot_idmotivos = histcargos.car_motivo');
            $this->db->join('tabelacargos', 'tabelacargos.idcargo=histcargos.idcargo');
            $this->db->join('empresa', 'empresa.em_idempresa = histcargos.idempresa');
            $this->db->where('car_idfuncionario',$iduser);      
            $dados['histcargos'] = $this->db->get('histcargos')->result();


            $this->db->select('*');
            $this->db->join('motivos', 'motivos.mot_idmotivos = salarios.sal_idmotivo');
            $this->db->where('sal_idfuncionario', $iduser);
            $this->db->order_by('sal_idsalarios', "asc");
            $dados['histsalarios'] = $this->db->get('salarios')->result();


            $this->db->select('*');
            $this->db->join('tipoafastamento', 'afastamentos.afa_tipo = tipoafastamento.tipafa');
            $this->db->where('afa_idfuncionario', $iduser);
            $this->db->order_by('afa_id', "desc");
            $dados['histafastamento'] = $this->db->get('afastamentos')->result();


            $this->db->select('hiscus_inicio, descricao, em_nomefantasia');
            $this->db->join('tabelacentrocusto', 'tabelacentrocusto.idcentro = histcentrocusto.idcentro');
            $this->db->join('empresa', 'empresa.em_idempresa = histcentrocusto.idempresa');
            $this->db->where('hiscus_idfuncionario', $iduser);
            $dados['histcentrocusto'] = $this->db->get('histcentrocusto')->result();

            
            $this->db->where('banc_idfuncionario',$iduser);
            $dados['dadosbancarios'] = $this->db->get('dadosbancarios')->result();

            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;


            $this->db->select('fun_nome, fun_foto, fun_sexo');
            $this->db->where('fun_idempresa', $idempresa);
            $this->db->where_not_in('fun_idfuncionario', $iduser);
            $this->db->limit(6, 0);
            $equipe = $this->db->get('funcionario')->result();
            $dados['equipe'] = $equipe;

            $this->db->select('*');
            $this->db->from('dependentes');
            $this->db->join('tipodependente', 'dependentes.deptipo = tipodependente.tipdep');  
            $this->db->where('dep_idfuncionario',$iduser);
            $dados['dependentes'] = $this->db->get()->result();

            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();

            $this->db->where('for_idfuncionario',$iduser);
            $dados['formacao_academica'] = $this->db->get('formacao_academica')->result(); 


            $this->db->select('*');
            $this->db->from('contratos');
            $this->db->join('funcionario', 'funcionario.fun_idfuncionario = contratos.contr_idfuncionario');  
            $this->db->join('endereco', 'endereco.end_idendereco = funcionario.fun_idendereco');  
            $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
            $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
            $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro'); 
            $this->db->join('empresa', 'empresa.em_idempresa = contratos.contr_idempresa');  
            $this->db->where('contr_idfuncionario',$iduser);
            $dados['contratos'] = $this->db->get()->result();
			
            $this->session->set_userdata('perfil_atual', '1');

            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Meu Perfil"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_pessoal',$dados);
            $this->load->view('/geral/footer'); 
	}
    
    public function pessoal_publico($id = null){ 
            $this->Log->talogado();            
            $dados = array( 'menupriativo' => 'publico', 'menu_colab_perfil' => 'publico', 'menu_colab_perfil_contrato' => '');             
            $iduser = $id; $idvisita = $this->session->userdata('id_funcionario');             
            $this->db->where('fun_idfuncionario',$iduser); $empresa1 = $this->db->get('funcionario')->result();
            $this->db->where('fun_idfuncionario',$idvisita); $empresa2 = $this->db->get('funcionario')->result();            
            foreach ($empresa1 as $empresa) { $empresa01 =  $empresa->fun_idempresa; }
            foreach ($empresa2 as $empresa) { $empresa02 =  $empresa->fun_idempresa; }            
            if($empresa01 == $empresa02){
                
                $this->db->where('fun_idfuncionario',$iduser);
                $dados['funcionario'] = $this->db->get('funcionario')->result();

                $idcli = $this->session->userdata('idcliente');
                $this->db->select('tema_cor, tema_fundo');
                $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
                $dados['perfil'] = $this->session->userdata('perfil');
                
                $this->db->where('perf_idperfprof',$iduser);
                $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();  
                
                $this->db->where('for_idfuncionario',$iduser);
                $dados['formacao_academica'] = $this->db->get('formacao_academica')->result();  
                
                $this->db->where('con_idfuncionario',$iduser);
                $dados['contato'] = $this->db->get('contato')->result();
                
                $this->db->where('ema_idfuncionario',$iduser);
                $dados['emails'] = $this->db->get('emails')->result();
                
                $this->db->select('*');
                $this->db->from('endereco');
                $this->db->join('funcionario', 'endereco.end_idendereco = funcionario.fun_idendereco'); 
                $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
            $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
            $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro'); 
                $this->db->where('fun_idfuncionario',$iduser);
                $dados['endereco'] = $this->db->get()->result();
            
                $this->db->where('rede_idfuncionario',$iduser);
                $dados['redesocial'] = $this->db->get('redesocial')->result();
                
                $this->load->view('/geral/html_header', $dados);  
                $this->load->view('/geral/corpo_perfil_publico',$dados);
                $this->load->view('/geral/footer'); 
                
            }else{
                $this->load->view('/geral/html_header_proibido');  
                 echo '<p class="text-center tit" style="margin-top: 30px">Você não pode ver esse perfil.</p>';
                $this->load->view('/geral/footer');                
            }
            
           
	 }
        public function profissional(){ 
            $this->Log->talogado(); 
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'profissional',
                'menu_colab_perfil_contrato' => ''
                );
            $this->session->set_userdata('perfil_atual', '1');
            $iduser = $this->session->userdata('id_funcionario');  
            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();  
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_profissional',$dados);
            $this->load->view('/geral/footer'); 
	     }
       
        public function academico()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'academico',
                'menu_colab_perfil_contrato' => ''
                );            
            
            $this->db->where('for_idfuncionario',$iduser);
            $dados['formacao_academica'] = $this->db->get('formacao_academica')->result();  
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_academico',$dados);
            $this->load->view('/geral/footer'); 
	}
        public function interessepessoal()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'interesse',
                'menu_colab_perfil_contrato' => ''
                );            
            
            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_interessepessoal',$dados);
            $this->load->view('/geral/footer'); 
        }
        public function contrato_demonstrativo()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'demonstrativo',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'demonstrativo'
                );
            $this->db->where('tipo_idfuncionario',$iduser);
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();             
            $this->session->set_userdata('perfil_atual', '1');
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Holerith"=>"#" );
			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo',$dados);
            $this->load->view('/geral/footer'); 
	}
        public function contrato_remuneracao_anual()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'remuneracao'
                );
            $this->session->set_userdata('perfil_atual', '1');

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_remuneranual',$dados);
            $this->load->view('/geral/footer'); 

	}
        public function contrato_evolucao_salarial()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');   
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'evolucao'
                );
            $this->session->set_userdata('perfil_atual', '1');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;


            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

			
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_evolusalarial',$dados);
            $this->load->view('/geral/footer'); 

	}
        public function contrato_contratos()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'perfil',
                'menu_colab_perfil' => 'contrato',
                'menu_colab_perfil_contrato' => 'contratos'
                );            
            
            $this->db->select('*');
            $this->db->from('contratos');
            $this->db->join('funcionario', 'funcionario.fun_idfuncionario = contratos.contr_idfuncionario');  
            $this->db->join('endereco', 'endereco.end_idendereco = funcionario.fun_idendereco');  
            $this->db->join('estado', 'endereco.end_idestado = estado.est_idestado');  
            $this->db->join('cidade', 'endereco.end_idcidade = cidade.cid_idcidade');  
            $this->db->join('bairro', 'endereco.end_idbairro = bairro.bair_idbairro'); 
            $this->db->join('empresa', 'empresa.em_idempresa = contratos.contr_idempresa');  
            $this->db->where('contr_idfuncionario',$iduser);
            $dados['contratos'] = $this->db->get()->result(); 
            
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_contato_contratos',$dados);
            $this->load->view('/geral/footer'); 
	}
        public function feedbacks()
        { 
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'feedback',
                'menu_colab_perfil' => 'feedback',
                'menu_colab_perfil_contrato' => ''
                );            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();


            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');
            $this->db->where('feed_idfuncionario_recebe',$iduser);            
            $this->db->where('ic_aprovado', 1);
            $this->db->order_by("feed_idfeedback", "desc");
            $dados['feedbacks'] = $this->db->get("feedbacks")->result();
            foreach ($dados['feedbacks'] as $key => $value) {
                $this->db->where('fk_feedback', $value->feed_idfeedback);
                $dados['competencias'][$value->feed_idfeedback] = $this->db->get("feedbacks_competencia")->result();
            }

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();           

            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 0);
            $dados['aprovacao'] = $this->db->get("feedbacks")->result();


            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome, fun_sexo');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 2);
            $dados['ocultos'] = $this->db->get("feedbacks")->result();


            $this->db->where('fk_empresa', $idempresa);
            $dados['perguntas'] = $this->db->get("feedbacks_pergunta")->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
			
			$feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Feedbacks"=>"#", "meus feedbacks"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_feedbacks',$dados);
            $this->load->view('/geral/footer'); 
	}

        public function demonstrativoBusca(){
           
            $idtipo = $this->input->post('calcdata');
            $this->db->where('tipo_idtipodecalculo',$idtipo);            
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo_busca',$dados);

        }

        public function demonstrativoUltimo(){
            $idfun = $this->session->userdata('id_funcionario');
            $this->db->where('tipo_idfuncionario',$idfun);
            $this->db->order_by('tipo_idtipodecalculo',"desc");
            $this->db->limit(1, 0);         
            $dados['tipodecalculo'] = $this->db->get('tipodecalculo')->result();
            $this->load->view('/geral/corpo_perfil_contato_demonstrativo_busca',$dados);

        }

        public function aniversariantes()
        { 
            $this->Log->talogado(); 
                     
            $iduser = $this->session->userdata('id_funcionario');   
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();



            $mes = date("m");
            $this->db->where('MONTH(fun_datanascimento)',"6");
            $dados['aniversariantes'] = $this->db->get('funcionario')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
           
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_aniversariantes',$dados);
            $this->load->view('/geral/footer'); 
         }

        public function familiar(){
            $this->Log->talogado();
            $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'familiar', 'menu_colab_perfil_contrato' => '');
                  
            $iduser = $this->session->userdata('id_funcionario');
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();
            
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->select('*');
            $this->db->from('dependentes');
            $this->db->join('tipodependente', 'dependentes.deptipo = tipodependente.tipdep');  
            $this->db->where('dep_idfuncionario',$iduser);
            $dados['dependentes'] = $this->db->get()->result();            
            
            $this->session->set_userdata('perfil_atual', '1');
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_perfil_familiar',$dados);
            $this->load->view('/geral/footer'); 
         }

        
        public function lembretes(){
            $this->Log->talogado(); 
            $iduser = $this->session->userdata('id_funcionario');
            $idempresa = $this->session->userdata('idempresa');
            $this->session->set_userdata('perfil_atual', '1');
            $dados = array(
                'menupriativo' => 'lembretes'
                );
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

/*
            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');
            $this->db->where('feed_idfuncionario_recebe',$iduser);            
            $this->db->where('ic_aprovado', 1);
            $this->db->order_by("feed_idfeedback", "desc");
            $dados['feedbacks'] = $this->db->get("feedbacks")->result();
            foreach ($dados['feedbacks'] as $key => $value) {
                $this->db->where('fk_feedback', $value->feed_idfeedback);
                $dados['competencias'][$value->feed_idfeedback] = $this->db->get("feedbacks_competencia")->result();
            }

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get("parametros")->row();           

            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 0);
            $dados['aprovacao'] = $this->db->get("feedbacks")->result();


            $this->db->select('feedbacks.*, funcionario.fun_foto, funcionario.fun_nome');
            $this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $this->db->where('ic_aprovado', 2);
            $dados['ocultos'] = $this->db->get("feedbacks")->result();


            $this->db->where('fk_empresa', $idempresa);
            $dados['perguntas'] = $this->db->get("feedbacks_pergunta")->result();
*/
            
            $dados["categorias"] = $this->db->get("lembrete_categoria")->result();
            
            
            $dados['breadcrumb'] = array('Colaborador'=>base_url().'home', "Mensagens e lembretes"=>"#", "Cadastro de lembrete"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_lembrete_cadastro',$dados);
            $this->load->view('/geral/footer'); 
        }

}