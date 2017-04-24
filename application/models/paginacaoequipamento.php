<?php
class Paginacaoequipamento extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database(); 
            $this->load->helper('url');
            $this->load->library('session');
            

    }
    
    public function somarTodos() {	
             
             return $this->db->get('ponto_equipamentos')->num_rows();
    }
    
    public function buscarTodos($limit, $start) 
    { 
            $this->db->limit($limit, $start);
                     $this->db->where('equi_idempresa',$this->session->userdata('idempresa'));
            $query = $this->db->get('ponto_equipamentos');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
    }
    
}