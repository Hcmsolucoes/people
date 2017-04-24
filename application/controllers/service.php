<?php 
header('Content-Type: application/json');

if(!defined('BASEPATH')) exit('No direct script access allowed');
class Service extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->model('Log'); 
        $this->load->model('Admbd');  
     }

    public function logar(){
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $this->db->select('*');
        $this->db->from('funcionario');
        $this->db->where('fun_email',$email);
        $this->db->where('fun_senha',$senha);
        $usuario = $this->db->get()->result();		
        if(count($usuario)===1){
            $this->db->where('eme_idempresa',$usuario[0]->fun_idempresa);
            $modulos = $this->db->get('modulos_e_empresa')->result();
            $mod = '';
            $avatar = ( strcasecmp($usuario[0]->fun_sexo, "masculino")==0 )?"avatar1":"avatar2";
            $foto = (empty( $usuario[0]->fun_foto) )? "http://hcmsolucoes.com.br/people/img/".$avatar.".jpg" : $usuario[0]->fun_foto;
            foreach ($modulos as $value) {
                $mod = $mod.','.$value->eme_idmodulo;
            }
            $dados = array(
                'id_funcionario' => $usuario[0]->fun_idfuncionario,
                'perfil'         => $usuario[0]->fun_perfil,
                'perfil_atual'   => $usuario[0]->fun_perfil,
                'nome'           => $usuario[0]->fun_nome,
                'foto'           => $foto,

                'email'          => $usuario[0]->fun_email,   
                'cargo'          => $usuario[0]->fun_cargo,   
                'idempresa'      => $usuario[0]->fun_idempresa,
                'idcliente'      => $usuario[0]->fun_idcliente,     
                'modulos'        => $mod,
                'logado'         => TRUE
                );
            $this->session->set_userdata($dados); 
            redirect( base_url());                      
        }else{
           echo "erro";
       }
     }

    public function teste(){
        $dados[] = array('id' => 1, "Nome"=> "Lucas Rodrigues", "sexo"=>"Masculino", "Telefone"=>"1333513378", "cpf"=>"34888573875", "email"=>"drigues24@gmail.com" );

        echo json_encode($dados);
     }




}

?>