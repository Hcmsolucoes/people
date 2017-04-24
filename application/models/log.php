<?php
class Log extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database();
    }
    
    public function alteradata1($dataget) {	
        if( strlen($dataget)!=10){
            return "não preenchido";
        }	
        $data = $dataget;                                                      
        $data = explode("-", $data);                                          
        list($ano, $mes, $dia ) = $data;
        return ($dia.'/'.$mes.'/'.$ano);
    }

    public function alteradata2($dataget) { 

        if( strlen($dataget)!=10){
            return "não preenchido";
        }    
        $data = $dataget;                                                      
        $data = explode("/", $data);                                          
        list($dia, $mes, $ano ) = $data;
        return ($ano.'-'.$mes.'-'.$dia);
    }

    public function talogado() {		
        if(!$this->session->userdata('id_funcionario') || !$this->session->userdata('logado')){ 
                $url = base_url('/home/login');
                header("Location: $url ");
                exit();
            }
    }
     
    public function addlog($id_envolvido=null, $tipo=null, $id_tipo=null, $conteudo=null, $foto=null, $id_proprietario=null) {
         
         $dados['log_iduser_acao'] = $this->session->userdata('id_usuario');
         $dados['log_iduser_envolvido'] = $id_envolvido;
         $dados['log_iduser_proprietario_tipo'] = $id_proprietario;
         $dados['log_tipo'] = $tipo;
         $dados['log_tipoid'] = $id_tipo;
         $dados['log_conteudo'] = $conteudo;
         $dados['log_foto'] = $foto;
         $dados['log_data'] = date("Y-m-d H:i:s");
         $this->db->insert('log', $dados);  
         
     }
     
     function limitar($string, $tamanho, $encode = 'UTF-8') {
        if( strlen($string) > $tamanho ){
            $string = mb_substr($string, 0, $tamanho - 3, $encode) . '...';
            $nova = explode(' ',$string);
            $fruit = array_pop($nova);
            $titulo = implode(' ', $nova);
            $string = $titulo.'...';

        }else{
            $string = mb_substr($string, 0, $tamanho, $encode);
        }
        return $string;

    }
     public function duascolunas($dados = NULL) {
         return $this->load->view('/geral/html_header'). 
         
                 $this->load->view('/geral/footer'); 
         
     }
    
}