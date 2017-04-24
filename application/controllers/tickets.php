<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Tickets extends CI_Controller {
      
      public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd');  
      }

      public function index(){ 
            // $this->Log->talogado(); 
            // $this->session->set_userdata('perfil_atual', '3');
            // $dados = array('menupriativo' => 'painel' );
            
            // $iduser = $this->session->userdata('id_funcionario');

            
            // $this->db->where('fun_idfuncionario',$iduser);
            // $dados['funcionario'] = $this->db->get('funcionario')->result();
            
           
            
            // $this->db->where('feed_idfuncionario_recebe',$iduser);
            // $feeds = $this->db->get('feedbacks')->num_rows();
            // $dados['quantgeral'] = $feeds;
            
            // //$idcli = $this->session->userdata('idcliente');
            // $this->db->select('tema_cor, tema_fundo');
            // $this->db->where('fun_idfuncionario',$iduser);
            // $dados['tema'] = $this->db->get('funcionario')->result();
            // $dados['perfil'] = $this->session->userdata('perfil');
            
            
            // $dados['breadcrumb'] = array('Admin'=>base_url().'admin', "Dashboard"=>"#" );

            $this->load->view('/geral/html_header',$dados);  
            $this->load->view('/geral/tickets',$dados);
            $this->load->view('/geral/footer'); 
      }

}