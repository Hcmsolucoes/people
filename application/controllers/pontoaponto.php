<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Pontoaponto extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->model('Admbd');  
        $this->load->model('Log'); 
        $this->load->library("pagination");
    }


    public function index()
    { 

    }

    public function verpremios()
    {
        $this->Log->talogado(); 
        $this->session->set_userdata('perfil_atual', '1');
        $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'verpremios' );            
        $iduser = $this->session->userdata('id_funcionario');             
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();

        $dados['parametros'] = $this->db->order_by('para_datacompentencia', 'desc')->get('ponto_parametros')->result();            
        $this->db->where('pon_idfuncionario', $iduser);
        $dados['pontoaponto'] = $this->db->get('pontoaponto')->result(); 
        $this->db->select('*');
        $this->db->from('funcionario');
        $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
        $this->db->where('fun_idfuncionario', $iduser);
        $dados['funcionarios_edit'] = $this->db->get()->result();

        $this->db->where('para_ativo', 1);
        $dados['ponto_parametros'] = $this->db->order_by('para_idparametros', 'desc')->get('ponto_parametros')->result();

        $this->db->where('equi_idempresa', $this->session->userdata('idempresa'));
        $dados['ponto_equipamentos'] = $this->db->get('ponto_equipamentos')->result();

        $idcli = $this->session->userdata('idcliente');
        $this->db->select('tema_cor, tema_fundo');
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['tema'] = $this->db->get('funcionario')->result();
        $dados['perfil'] = $this->session->userdata('perfil');

        $dados['breadcrumb'] = array("Colaborador"=>base_url().'home', 'Ponto a ponto'=>"#", "Consultar prêmios"=>base_url().'pontoaponto/verpremios' ); 

        $this->load->view('/geral/html_header', $dados);  
        $this->load->view('/geral/corpo_ponto_verpremios',$dados);
        $this->load->view('/geral/footer');
    }
    public function verpremios_comp()
    {
        $this->Log->talogado(); 
        $this->session->set_userdata('perfil_atual', '1');
        $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'verpremios' );            
        $iduser = $this->session->userdata('id_funcionario');             

        $dados['parametros'] = $this->db->order_by('para_datacompentencia', 'desc')->get('ponto_parametros')->result();            
        $this->db->where('pon_idparametros', $this->input->post('idcomp'));
        $this->db->where('pon_idfuncionario', $iduser);
        $dados['pontoaponto'] = $this->db->get('pontoaponto')->result(); 
        $this->db->select('*');
        $this->db->from('funcionario');
        $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
        $this->db->where('fun_idfuncionario', $iduser);
        $dados['funcionarios_edit'] = $this->db->get()->result();

        $this->db->where('para_idparametros', $this->input->post('idcomp'));
        $dados['ponto_parametros'] = $this->db->order_by('para_idparametros', 'desc')->get('ponto_parametros')->result();

        $this->db->where('equi_idempresa', $this->session->userdata('idempresa'));
        $dados['ponto_equipamentos'] = $this->db->get('ponto_equipamentos')->result();

        $idcli = $this->session->userdata('idcliente');
        $this->db->select('tema_cor, tema_fundo');
        $this->db->where('fun_idfuncionario',$iduser);
        $dados['tema'] = $this->db->get('funcionario')->result();
        $dados['perfil'] = $this->session->userdata('perfil');

        header ('Content-type: text/html; charset=ISO-8859-1');

        if(count($dados['pontoaponto'])> 0){
            $this->load->view('/geral/edit/ponto_verpremios',$dados);
        }else{
            echo 'Sem lançamentos.';
        }
    }

    public function parametros()
    { 
        $this->load->model('Paginacaoparametro');  
        $this->Log->talogado(); 
        $this->session->set_userdata('perfil_atual', '2');
        $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'parametros' );            
        $iduser = $this->session->userdata('id_funcionario'); 

        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();

        $config = array();
        $config["base_url"] = base_url() . "pontoaponto/parametros";
        $config["total_rows"] = $this->Paginacaoparametro->somarTodos();
        $config["per_page"] = 4;
        $config["uri_segment"] = 3;
        $config['next_link']   = 'Próximo';
        $config['prev_link']   = 'Anterior';        

        $config['last_link']   = 'Último';
        $config['last_tag_open'] = '<div class="fleft btn btn-default>';
        $config['last_tag_close'] = '</div>';
        $config['first_link']  = 'Primeiro';
        $config['first_tag_open'] = '<div class="fleft btn btn-default>';
        $config['first_tag_close'] = '</div>';

            // Configuracoes de estilo da url
        $config['full_tag_open'] = '<div class="paginat">';
        $config['full_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div class="fleft btn btn-default>';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="fleft btn btn-default>';
        $config['prev_tag_close'] = '</div>';

            $config['num_tag_open'] = '<div class="fleft btn btn-default">'; // divisão da paginação
            $config['num_tag_close'] = '</div>';        

            $config['cur_tag_open'] = '<div class="fleft btn btn-default"><b>'; // selecionado
            $config['cur_tag_close'] = '</b></div>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $dados["results"] = $this->Paginacaoparametro->buscarTodos($config["per_page"], $page);            
            $dados["links"] = $this->pagination->create_links();

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Ponto a ponto"=>"#", "Parâmetros"=>base_url().'pontoaponto/parametros' );
            $this->load->view('/geral/html_header', $dados);  
            $this->load->view('/geral/corpo_ponto_parametros',$dados);
            $this->load->view('/geral/footer');
        }
    public function parametro_edit()
        { 
            $this->Log->talogado(); 
            if (!empty($this->input->post('for_datacomp'))) {
                $data = $this->input->post('for_datacomp');                                                   
                $data = explode("/", $data); 
                list($dia, $mes, $ano ) = $data;
                $dados['para_datacompentencia'] = ($ano.'-'.$mes.'-01'); 
                $datacomp = $dados['para_datacompentencia'];
            }

            if (!empty($this->input->post('for_datapaga'))) {
                $data1 = $this->input->post('for_datapaga');                                                   
                $data1 = explode("/", $data1); list($dia, $mes, $ano ) = $data1; $dados['para_compintegracao'] = ($ano.'-'.$mes.'-'.$dia);}
                if (!empty($this->input->post('for_metamin'))) {$dados['para_metamin'] = $this->input->post('for_metamin'); }
                if (!empty($this->input->post('for_proe2'))) {$dados['para_proventoe2'] = $this->input->post('for_proe2'); }
                if (!empty($this->input->post('for_metacom'))) {$dados['para_metacombustivel'] = $this->input->post('for_metacom'); }


                $this->db->like('para_datacompentencia', $datacomp);
            /*
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));//empresa for
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));//funcio for
             * 
             */
            $ponto_parametros = $this->db->get('ponto_parametros')->num_rows();
            
            if($ponto_parametros == 0){
                $this->Admbd->armazenar('ponto_parametros', $dados);
                echo 'ok';
            }
        }
    public function parametro_ativa()
    { 
            $this->Log->talogado(); 
            if (!empty($this->input->post('id'))) {
               $id = $this->input->post('id');

               $dados['para_ativo'] = 0;
               $this->db->where("para_idparametros != ", $id);
               $this->db->update('ponto_parametros', $dados); 

               $id = $this->input->post('id');
               $dados['para_ativo'] = 1;
               $this->Admbd->armazenar('ponto_parametros', $dados, $id, 'para_idparametros');

           }
     }

    public function parametro_remove()
    { 
        $this->Log->talogado(); 
        if (!empty($this->input->post('id'))) {
            $id = $this->input->post('id');
            $this->Admbd->delete('ponto_parametros', $id, 'para_idparametros');                
        }
    }

    public function lancamentos_feito()
    { 
        $this->Log->talogado(); 
        $this->session->set_userdata('perfil_atual', '2');
        $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'lancamentos' );            
        $iduser = $this->session->userdata('id_funcionario');            

        $this->db->where('fun_idfuncionario',$iduser);
        $dados['funcionario'] = $this->db->get('funcionario')->result();

        $this->db->where('para_ativo', '1');
        $dados['ponto_parametros'] = $this->db->get('ponto_parametros')->result();


        $this->load->model('Paginacaolancamentofeito'); 
        $config = array();
        $config["base_url"] = base_url() . "pontoaponto/lancamentos_feito";
        $config["total_rows"] = $this->Paginacaolancamentofeito->somarTodos();
        $config["per_page"] = 4;
        $config["uri_segment"] = 3;
        $config['next_link']   = 'Próximo';
        $config['prev_link']   = 'Anterior';        

        $config['last_link']   = 'Último';
        $config['last_tag_open'] = '<div>';
        $config['last_tag_close'] = '</div>';
        $config['first_link']  = 'Primeiro';
        $config['first_tag_open'] = '<div>';
        $config['first_tag_close'] = '</div>';

            // Configuracoes de estilo da url
        $config['full_tag_open'] = '<div class="paginat">';
        $config['full_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div class="fleft btn btn-default">';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="fleft btn btn-default">';
        $config['prev_tag_close'] = '</div>';

            $config['num_tag_open'] = '<div class="fleft btn btn-default">'; // divisão da paginação
            $config['num_tag_close'] = '</div>';        

            $config['cur_tag_open'] = '<div class="fleft btn btn-default"><b>'; // selecionado
            $config['cur_tag_close'] = '</b></div>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $dados["results"] = $this->Paginacaolancamentofeito->buscarTodos($config["per_page"], $page);            
            $dados["links"] = $this->pagination->create_links();
            

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Ponto a Ponto"=>"#", "Lançamentos"=>base_url().'pontoaponto/lancamentos_feito' );
            $this->load->view('/geral/html_header', $dados);  
            $this->load->view('/geral/corpo_ponto_lancamentos',$dados);
            $this->load->view('/geral/footer');
    }
        public function lancamentos_fazer()
        { 
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '2');
            $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'lancamentos' );            
            $iduser = $this->session->userdata('id_funcionario');            
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('para_ativo', '1');
            $dados['ponto_parametros'] = $this->db->get('ponto_parametros')->result();
            
            
            $this->load->model('Paginacaolancamentofazer'); 
            $config = array();
            $config["base_url"] = base_url() . "pontoaponto/lancamentos_fazer";
            $config["total_rows"] = $this->Paginacaolancamentofazer->somarTodos();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            $config['next_link']   = 'Próximo';
            $config['prev_link']   = 'Anterior';        

            $config['last_link']   = 'Último';
            $config['last_tag_open'] = '<div class="fleft btn btn-default>';
            $config['last_tag_close'] = '</div>';
            $config['first_link']  = 'Primeiro';
            $config['first_tag_open'] = '<div class="fleft btn btn-default>';
            $config['first_tag_close'] = '</div>';

            // Configuracoes de estilo da url
            $config['full_tag_open'] = '<div class="paginat">';
            $config['full_tag_close'] = '</div>';

            $config['next_tag_open'] = '<div class="fleft btn btn-default">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = '<div class="fleft btn btn-default">';
            $config['prev_tag_close'] = '</div>';

            $config['num_tag_open'] = '<div class="fleft btn btn-default">'; // divisão da paginação
            $config['num_tag_close'] = '</div>';        

            $config['cur_tag_open'] = '<div class="fleft btn btn-default"><b>'; // selecionado
            $config['cur_tag_close'] = '</b></div>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $dados["results"] = $this->Paginacaolancamentofazer->buscarTodos($config["per_page"], $page);            
            $dados["links"] = $this->pagination->create_links();
            

            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Ponto a Ponto"=>"#", "Lançamentos"=>base_url().'pontoaponto/lancamentos_fazer' );
            $this->load->view('/geral/html_header', $dados);  
            $this->load->view('/geral/corpo_ponto_lancamentos_fazer',$dados);
            $this->load->view('/geral/footer');
        }

        public function lancamentos_cad()
        { 
            if (!empty($this->input->post('for_tipoeq'))) {$dados['pon_idequipamentos'] = $this->input->post('for_tipoeq'); }
            if (!empty($this->input->post('for_netamin'))) {$dados['pon_e1_metamim'] = $this->input->post('for_netamin'); }
            if (!empty($this->input->post('for_fatura'))) {$dados['pon_e1_faturarealizado'] = $this->input->post('for_fatura'); }
            if (!empty($this->input->post('for_apro'))) {$dados['pon_e1_aproveitament'] = $this->input->post('for_apro'); }
            if (!empty($this->input->post('for_comi'))) {$dados['pon_e1_ganhocomissao'] = $this->input->post('for_comi'); }
            if (!empty($this->input->post('for_ajust'))) {$dados['pon_e1_ajust'] = $this->input->post('for_ajust'); }
            if (!empty($this->input->post('for_macro'))) {$dados['pon_e1_macros'] = $this->input->post('for_macro'); }
            if (!empty($this->input->post('for_jornada'))) {$dados['pon_e1_jornada'] = $this->input->post('for_jornada'); }
            if (!empty($this->input->post('for_interst'))) {$dados['pon_e1_intersticio'] = $this->input->post('for_interst'); }
            if (!empty($this->input->post('for_continua'))) {$dados['pon_e1_intersticio'] = $this->input->post('for_continua'); }
            if (!empty($this->input->post('for_almoco'))) {$dados['pon_e1_almoco'] = $this->input->post('for_almoco'); }
            if (!empty($this->input->post('for_semanal'))) {$dados['pon_e1_descsemanal'] = $this->input->post('for_semanal'); }
            if (!empty($this->input->post('for_faltas'))) {$dados['pon_e1_faltasjust'] = $this->input->post('for_faltas'); }
            if (!empty($this->input->post('for_advert'))) {$dados['pon_e1_advertencia'] = $this->input->post('for_advert'); }
            if (!empty($this->input->post('for_suspens'))) {$dados['pon_e1_suspensao'] = $this->input->post('for_suspens'); }
            if (!empty($this->input->post('for_pleve'))) {$dados['pon_e1_picoleve'] = $this->input->post('for_pleve'); }
            if (!empty($this->input->post('for_pgrave'))) {$dados['pon_e1_picogrande'] = $this->input->post('for_pgrave'); }
            if (!empty($this->input->post('for_tipodesca'))) {$dados['pon_e2_ctenfcompdescarga'] = $this->input->post('for_tipodesca'); }
            if (!empty($this->input->post('for_ctenf'))) {$dados['pon_e2_ctenf'] = $this->input->post('for_ctenf'); }
            if (!empty($this->input->post('for_topog'))) {$dados['pon_e2_tacografo'] = $this->input->post('for_topog'); }
            if (!empty($this->input->post('for_fichajr'))) {$dados['pon_e2_fichajornada'] = $this->input->post('for_fichajr'); }
            if (!empty($this->input->post('for_acidente'))) {$dados['pon_e2_acidente'] = $this->input->post('for_acidente'); }
            if (!empty($this->input->post('for_docven'))) {$dados['pon_e2_docuvencido'] = $this->input->post('for_docven'); }
            if (!empty($this->input->post('for_suspen'))) {$dados['pon_e2_suspensao '] = $this->input->post('for_suspen'); }
            if (!empty($this->input->post('for_unifo'))) {$dados['pon_e2_uniformes'] = $this->input->post('for_unifo'); }
            if (!empty($this->input->post('for_metac'))) {$dados['pon_e3_meta'] = $this->input->post('for_metac'); }
            if (!empty($this->input->post('for_realiz'))) {$dados['pon_e3_realizado'] = $this->input->post('for_realiz'); }
            if (!empty($this->input->post('for_resul'))) {$dados['pon_e3_resultado'] = $this->input->post('for_resul'); }
            if (!empty($this->input->post('for_totalprem'))) {$dados['pon_totalpremio'] = $this->input->post('for_totalprem'); }
            if (!empty($this->input->post('for_idpparame'))) {$dados['pon_idparametros'] = $this->input->post('for_idpparame'); }
            
            if (!empty($this->input->post('for_totviola'))) {$dados['pon_e1_totviola'] = $this->input->post('for_totviola'); }
            if (!empty($this->input->post('for_valpre1'))) {$dados['pon_e1_valpre'] = $this->input->post('for_valpre1'); }
            if (!empty($this->input->post('for_totaletapa2'))) {$dados['pon_e2_valpre'] = $this->input->post('for_totaletapa2'); }
            if (!empty($this->input->post('for_totalep3'))) {$dados['pon_e3_valpre'] = $this->input->post('for_totalep3'); }
            if (!empty($this->input->post('for_idponto'))) {$idponto = $this->input->post('for_idponto'); }
            
            $dados['pon_idfuncionario'] =$this->input->post('for_idfuncio');

            if($this->input->post('for_idponto') == ''){
                if($dados['pon_e3_valpre'] == '0'){ $dados['pon_uso'] = '1';}
                $this->Admbd->armazenar('pontoaponto', $dados);
            }else{ 
                $this->Admbd->armazenar('pontoaponto', $dados, $idponto, 'pon_idpontoaponto');
                echo 'Atualizado!';
            }
            

        }
        public function lancamentos_usuario()
        { 
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '2');
            $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'lancamentos' );            
            $iduser = $this->session->userdata('id_funcionario');  
            switch ($this->input->post('param')) {
                case 'Nome':$parame = 'fun_nome';break;
                case 'Matricula':$parame = 'fun_matricula';break;
                case 'Admissão':$parame = 'contr_data_admissao';break;
                case 'Cargo':$parame = 'contr_cargo';break;
            }    
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('pontoaponto', 'pontoaponto.pon_idfuncionario = funcionario.fun_idfuncionario', 'left');
            $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
            $this->db->where('fun_idempresa', $this->session->userdata('idempresa'));
            $this->db->like($parame,$this->input->post('pesquisa'));
            $dados['funcionarios'] = $this->db->get()->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/resul_buscafun01',$dados);            
        }

        public function lancamentos_edit()
        {
            $this->Log->talogado(); 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
            $this->db->where('fun_idfuncionario', $this->input->post('id'));
            $dados['funcionarios_edit'] = $this->db->get()->result();
            
            //$this->db->where('pon_uso !=',2);
            
            
            $this->db->select('*');
            $this->db->from('pontoaponto');
            $this->db->join('ponto_parametros', 'ponto_parametros.para_idparametros = pontoaponto.pon_idparametros');
            $this->db->where('pon_idfuncionario', $this->input->post('id'));
            $dados['pontoaponto'] = $this->db->get()->result();

            
            $this->db->where('para_ativo', 1);
            $dados['ponto_parametros'] = $this->db->order_by('para_idparametros', 'desc')->get('ponto_parametros')->result();
            
            $this->db->where('equi_idempresa', $this->session->userdata('idempresa'));
            $dados['ponto_equipamentos'] = $this->db->get('ponto_equipamentos')->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/ponto_lancamentos',$dados);

        }
        public function lancamentos_novo()
        {
            $this->Log->talogado(); 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
            $this->db->where('fun_idfuncionario', $this->input->post('id'));
            $dados['funcionarios_edit'] = $this->db->get()->result();
            
            $this->db->where('para_ativo', 1);
            $dados['ponto_parametros'] = $this->db->order_by('para_idparametros', 'desc')->get('ponto_parametros')->result();
            
            $this->db->where('equi_idempresa', $this->session->userdata('idempresa'));
            $dados['ponto_equipamentos'] = $this->db->get('ponto_equipamentos')->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/ponto_lancamentos',$dados);

        }
        public function lancamentos_del()
        {

            $this->Log->talogado(); 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('pontoaponto', $id, 'pon_idpontoaponto');                
            }
        }
        
        public function equipamentos_cad()
        {
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '2');
            $dados = array('menupriativo' => 'pontoaponto', 'menuponto'=>'cad_eq' );            
            $iduser = $this->session->userdata('id_funcionario'); 
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->load->model('Paginacaoequipamento'); 
            $config = array();
            $config["base_url"] = base_url() . "pontoaponto/equipamentos_cad";
            $config["total_rows"] = $this->Paginacaoequipamento->somarTodos();
            $config["per_page"] = 4;
            $config["uri_segment"] = 3;
            $config['next_link']   = 'Próximo';
            $config['prev_link']   = 'Anterior';        

            $config['last_link']   = 'Último';
            $config['last_tag_open'] = '<div class="fleft btn btn-default>';
            $config['last_tag_close'] = '</div>';
            $config['first_link']  = 'Primeiro';
            $config['first_tag_open'] = '<div class="fleft btn btn-default>';
            $config['first_tag_close'] = '</div>';

            // Configuracoes de estilo da url
            $config['full_tag_open'] = '<div class="paginat">';
            $config['full_tag_close'] = '</div>';

            $config['next_tag_open'] = '<div class="fleft btn btn-default">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = '<div class="fleft btn btn-default">';
            $config['prev_tag_close'] = '</div>';

            $config['num_tag_open'] = '<div class="fleft btn btn-default">'; // divisão da paginação
            $config['num_tag_close'] = '</div>';        

            $config['cur_tag_open'] = '<div class="fleft btn btn-default"><b>'; // selecionado
            $config['cur_tag_close'] = '</b></div>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $dados["results"] = $this->Paginacaoequipamento->buscarTodos($config["per_page"], $page);            
            $dados["links"] = $this->pagination->create_links();
            
            
            $idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');

            $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Ponto a Ponto"=>"#", "Equipamentos"=>base_url().'pontoaponto/equipamentos_cad' );
            $this->load->view('/geral/html_header', $dados);  
            $this->load->view('/geral/corpo_ponto_cadequipamento',$dados);
            $this->load->view('/geral/footer');
        }
        
        public function equipamentos_cad_salva()
        {
            $this->Log->talogado(); 
            if (!empty($this->input->post('for_nome'))) {$dados['equi_nome'] = $this->input->post('for_nome'); }
            if (!empty($this->input->post('for_desc'))) {$dados['equi_descricao'] = $this->input->post('for_desc'); }
            $dados['equi_idempresa'] = $this->session->userdata('idempresa'); 

            $this->Admbd->armazenar('ponto_equipamentos', $dados);
        }
        public function equipamentos_cad_remove()
        {
            $this->Log->talogado(); 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('ponto_equipamentos', $id, 'equi_idequipamentos');                
            }
        }
        
    }