<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

      public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->library('util');
            $this->load->model('Log'); 
            $this->load->model('Admbd');

      }

      public function index(){
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'inicio' );
            
            $iduser = $this->session->userdata('id_funcionario');
            
            switch ( $this->session->userdata('perfil') ) {

                  case '1':
                  case '2':
                  header("Location: ".base_url('home') ); exit;
                  break;
                  
            }
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();            

            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            //$idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');


            $this->db->select('COUNT(fun_idfuncionario) AS ativo');
            $this->db->where('fun_status', "A");
            $dados['total1'] = $this->db->get('funcionario')->row();
            $this->db->select('COUNT(fun_idfuncionario) AS inativo');
            $this->db->where('fun_status', "I");
            $dados['total2'] = $this->db->get('funcionario')->row();

            
            
            $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Dashboard"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_dash_admin',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function chefia(){

            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'chefia' );
            
            $iduser = $this->session->userdata('id_funcionario');
            
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('fun_status',"A");
            $dados['colaboradores'] = $this->db->get('funcionario')->result();            

            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;
            
            //$idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');
            
            
            $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Chefia"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_chefia',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function parametros(){ 
            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'parametros' );
            $iduser = $this->session->userdata('id_funcionario');
            $idcliente = $this->session->userdata('idcliente');
            $idempresa = $this->session->userdata('idempresa');

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();                     
            
            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            $this->db->select('em_idempresa, em_nome');
            $this->db->where('em_idcliente',$idcliente);
            $dados['empresas'] = $this->db->get('empresa')->result();
            
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');     
            $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Parâmetros"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_parametros',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function loadParametros(){            

            $idempresa = $this->input->post("empresa");
            
            $this->db->where('fun_status',"A");
            $this->db->where('fun_perfil in (2, 4, 6, 7)');
            $dados['gestores'] = $this->db->get('funcionario')->result();

            $this->db->select("responsavelrh.*, fun_nome, fun_foto, fun_sexo");
            $this->db->join('funcionario',"fun_idfuncionario = fk_idfuncionario");
            $this->db->where('fun_idempresa', $idempresa);
            $dados['resprh'] = $this->db->get('responsavelrh')->result();

            $this->db->select("lancamento_responsaveis.*, fun_nome, fun_foto, fun_sexo");
            $this->db->join('funcionario',"fun_idfuncionario = fk_idfuncionario");
            $this->db->where('fun_idempresa', $idempresa);
            $dados['resplanc'] = $this->db->get('lancamento_responsaveis')->result();

            $dados['tipo_solicitacoes'] = $this->db->get('solicitacao_tipo')->result();

            $this->db->where("idempresa", $idempresa);
            $dados['parametros'] = $this->db->get('parametros')->row();

            $this->db->order_by("descricao", "asc");
            $this->db->where("idempresa", $idempresa);
            $this->db->limit(20);
            $dados['eventos'] = $this->db->get('eventos')->result();

            $this->db->join("eventos", "idevento = fk_evento");
            $this->db->where("fk_ev_empresa", $idempresa);
            $dados['evlancamentos'] = $this->db->get('lancamento_eventos')->result();

            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/corpo_parametros_load',$dados);
      }


      public function salvarparam(){

            $idempresa = $this->input->post("empresa");
            $idcliente = $this->session->userdata('idcliente');
            $campo = $this->input->post("campo");
            $valor = $this->input->post("valor") ;
            //$dados['idempresa'] = $idempresa;
            $dados['idempresa'] = $idempresa;
            $dados['idcliente'] = $idcliente;
            $dados[$campo] = $valor;


            if( !empty($this->input->post('paramid')) ){ 

                  $id = $this->input->post('paramid');
                  $this->db->where('param_id', $id);
                  $r['update'] = $this->db->update("parametros", $dados);


            }else{

                  $this->db->insert("parametros", $dados);
                  $r['id'] = $this->db->insert_id();
                  
            }
            echo json_encode($r);

      }

      public function salvar_aprovadores(){

            $idempresa = $this->input->post("empresa");
            $tipo_solicitacao = $this->input->post("tipo_solicitacao");
            $aprovadores = $this->input->post("aprovadores");
            $dados['fk_empresa'] = $idempresa;
            $dados['apr_tipo_solicitacao'] = $tipo_solicitacao;
            
            foreach ($aprovadores as $key => $value) {

                  $this->db->select("id_apr_sol");
                  $this->db->where('apr_tipo_solicitacao', $tipo_solicitacao);
                  $this->db->where('fk_aprovador', $value);
                  $this->db->where('fk_empresa', $idempresa);
                  $aprovadores = $this->db->get('solicitacao_aprovador')->num_rows();
                  
                  if ( $aprovadores==0 ) {

                        $this->db->select("COUNT(id_apr_sol) AS total");
                        $this->db->where('apr_tipo_solicitacao', $tipo_solicitacao);
                        $this->db->where('fk_empresa', $idempresa);
                        $resultado = $this->db->get('solicitacao_aprovador')->row();
                        $dados['nivel_aprovador'] = $resultado->total + 1;
                        $dados['fk_aprovador'] = $value;
                        $this->db->insert("solicitacao_aprovador", $dados);
                  }
            }
            echo 1;
      }

      public function recuperar_aprovadores(){

            $idempresa = $this->input->post("empresa");
            $tipo_solicitacao =$this->input->post("tipo_solicitacao");

            $this->db->select("fun_foto, fun_sexo, fun_nome, id_apr_sol");
            $this->db->where('fk_empresa', $idempresa);
            $this->db->where('apr_tipo_solicitacao', $tipo_solicitacao);
            $this->db->join('funcionario', "fk_aprovador = fun_idfuncionario");
            $aprovadores = $this->db->get('solicitacao_aprovador')->result();
            $aprov="";
            foreach ($aprovadores as $key => $value) {

                  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
                  $foto = (empty($value->fun_foto) )? base_url("/img/".$avatar.".jpg") : $value->fun_foto;

                  $aprov .= "<div id='apr".$value->id_apr_sol."' class='list-group-item fleft-10'>                                    
                  <img src='".$foto."' class='pull-left' >
                  <span class='contacts-title'>".$value->fun_nome."</span>
                  <div class='list-group-controls'>
                    <button data-id='".$value->id_apr_sol."' class='btn btn-primary btn-rounded exc_ap'>
                          <span class='fa fa-times'></span></button>
                    </div>                                    
              </div>";
            /*
                  $aprov .= "<span id='apr".$value->id_apr_sol."' class='btn btn-default' style='width: 400px;'><img class='imgcirculo_xp fleft' src='".$foto."'>".$value->fun_nome." 
                  <i data-id='".$value->id_apr_sol."' class='fa fa-times exc_ap' style='float:right'></i></span><br />";*/
            }
            header ('Content-type: text/html; charset=ISO-8859-1');
            echo $aprov;
      }

      public function excluir_aprovador(){

            $id = $this->input->post("id");
            $tipo_solicitacao = $this->input->post("tipo_solicitacao");
            $idempresa = $this->input->post("empresa");

            $this->db->where("id_apr_sol", $id);
            $this->db->where("apr_tipo_solicitacao", $tipo_solicitacao);
            $this->db->where('fk_empresa', $idempresa);
            $this->db->delete("solicitacao_aprovador");

            $this->db->select("id_apr_sol");
            $this->db->where("apr_tipo_solicitacao", $tipo_solicitacao);
            $this->db->where('fk_empresa', $idempresa);
            $this->db->order_by('nivel_aprovador', "asc");
            $aprovadores = $this->db->get('solicitacao_aprovador')->result();

            foreach ($aprovadores as $key => $value) {

                  $dados['nivel_aprovador'] = $key + 1;
                  $this->db->where("id_apr_sol", $value->id_apr_sol);
                  $this->db->update("solicitacao_aprovador", $dados);
            }

            echo 1;
      }

      public function excluir_resprh(){

            $id = $this->input->post("id");
            $this->db->where("id_resp_rh", $id);
            $this->db->delete("responsavelrh");
            echo 1;
      }

      public function excluir_resplanc(){

            $id = $this->input->post("id");
            $this->db->where("id_resp_lancamento", $id);
            $this->db->delete("lancamento_responsaveis");
            echo 1;
      }

      public function autocompleteRespRH(){

            $idempresa = (!empty($this->input->post('empresa')) )?$this->input->post('empresa') : $this->session->userdata('idempresa');
            $iduser = $this->session->userdata('id_funcionario'); 
            $busca = $this->input->post('busca');
            $campo = $this->input->post('campo');
            $dados['classe'] = $this->input->post('classe');
            $dados['campo'] = $campo;

            $this->db->like("fun_nome", $busca);
            $this->db->where("fun_idempresa", $idempresa);

            if (empty($this->input->post('todos'))) {
                  $this->db->where("fun_perfil in (5, 6, 7)");
            }
            $this->db->where("fun_status", "A");
            $dados['lista'] =$this->db->get("funcionario")->result();

            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/autocomplete_lembrete',$dados);

      }

      public function acesso(){

            $this->Log->talogado(); 
            $this->session->set_userdata('perfil_atual', '3');
            $dados = array('menupriativo' => 'acesso' );

            $iduser = $this->session->userdata('id_funcionario');

            $this->db->where('fun_idfuncionario',$iduser);
            $dados['funcionario'] = $this->db->get('funcionario')->result();

            $this->db->where('fun_status',"A");
            $dados['colaboradores'] = $this->db->get('funcionario')->result();            


            $this->db->where('feed_idfuncionario_recebe',$iduser);
            $feeds = $this->db->get('feedbacks')->num_rows();
            $dados['quantgeral'] = $feeds;

            //$idcli = $this->session->userdata('idcliente');
            $this->db->select('tema_cor, tema_fundo');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['tema'] = $this->db->get('funcionario')->result();
            $dados['perfil'] = $this->session->userdata('perfil');


            $dados['breadcrumb'] = array('Admin'=>base_url('admin'), "Redefinir Acesso"=>"#" );
            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/corpo_acesso',$dados);
            $this->load->view('/geral/footer'); 
      }

      public function salvar_resp_rh(){

            $idempresa = $this->input->post("empresa");
            $aprovadores = $this->input->post("aprovadores");
            $dados['fk_idempresa'] = $idempresa;

            foreach ($aprovadores as $key => $value) {

                  $dados['fk_idfuncionario'] = $value;
                  $this->db->insert("responsavelrh", $dados);

            }
            echo 1;
      }

      public function salvar_resp_lancamento(){

            $aprovadores = $this->input->post("aprovadores");
            $dados['fk_idempresa'] = $this->input->post("empresa");

            foreach ($aprovadores as $key => $value) {

                  $dados['fk_idfuncionario'] = $value;
                  $this->db->insert("lancamento_responsaveis", $dados);

            }

            $this->db->select("lancamento_responsaveis.*, fun_nome, fun_foto, fun_sexo");
            $this->db->join('funcionario',"fun_idfuncionario = fk_idfuncionario");
            $this->db->where('fun_idempresa', $dados['fk_idempresa']);
            $resplanc = $this->db->get('lancamento_responsaveis')->result();
            $ret = "";
            foreach ($resplanc as $key => $value) { 
                  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
                  $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;

                  $ret .= '<div id="lanc'.$value->id_resp_lancamento.'" class="list-group-item fleft-10">                                    
                  <img src="'.$foto.'" class="pull-left" >
                  <span class="contacts-title">'.$value->fun_nome.'</span>
                  <div class="list-group-controls">
                      <button data-id="'.$value->id_resp_lancamento.'" class="btn btn-primary btn-rounded btnexclanc"><span class="fa fa-times"></span></button>
                  </div>                                    
                  </div>';
            }

          echo $ret;
      }

      public function acessocampos(){
            $idcolab = $this->input->post("colab");
            $this->db->select("usu_email, usu_perfil");
            $this->db->where("usu_idfuncionario", $idcolab);
            $usuario = $this->db->get("usuarios")->row();
            
            echo json_encode($usuario);
      }

      public function addevento_lancamento(){
            if (!empty($this->input->post('evento'))) {

            $dados['fk_evento'] = $this->input->post('evento');
            $dados['fk_ev_empresa'] = $this->input->post('empresa');

            if ($this->input->post('operacao')==1) {

                  $dados['tipo_campo'] = $this->input->post('campo');
                  $this->db->insert("lancamento_eventos", $dados);
                //echo $this->db->insert_id();

            }else{

                $this->db->where("fk_evento", $this->input->post('evento'));
                $this->db->where("fk_ev_empresa", $this->input->post('empresa'));
                $this->db->delete("lancamento_eventos");
                //echo 0;
            }

            $this->db->join("eventos", "idevento = fk_evento");
            $this->db->where("fk_ev_empresa", $this->input->post('empresa'));
            $eventos = $this->db->get("lancamento_eventos")->result();
            foreach ($eventos as $key => $value) {

                  switch ($value->tipo_campo) {
                            case '1': $campo = "Campo Hora";break;
                            case '2': $campo = "Campo Valor";break;
                            case '3': $campo = "Campo Hora/Valor";break;                            
                            default:$campo = "Campo Hora";break;
                        }
                  echo "<li class='list-group-item'>
                        <span>". $value->descricao ."</span>
                        <button data-id='".$value->idevento."' class='btn btn-primary btn-rounded btnexcevento fright'><span class='fa fa-times'></span>
                        </button>
                        <span class='fright' style='margin-right: 10px;'>".$campo."</span>
                    </li>";
            }

        }
      }


}