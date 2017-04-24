<?php
class Paginacaolancamentofazer extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database(); 
            $this->load->helper('url');
            $this->load->library('session');
            

            

    }
    
    public function somarTodos() {
        
            $this->db->where('para_ativo', '1');
            $ponativo = $this->db->get('ponto_parametros')->result();
            foreach ($ponativo as $value) {
                $dataativa = $value ->para_datacompentencia;
            }       
        
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');
            $this->db->where('fun_idempresa', $this->session->userdata('idempresa'));
            
            return $this->db->get()->num_rows();
    }
    
    public function buscarTodos($limit, $start) 
    { 
        $this->db->where('para_ativo', '1');
            $ponativo = $this->db->get('ponto_parametros')->result();
            foreach ($ponativo as $value) {
                $dataativa = $value ->para_datacompentencia;
            }     
        $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->join('contratos', 'contratos.contr_idfuncionario = funcionario.fun_idfuncionario');            
            $this->db->where('fun_idempresa', $this->session->userdata('idempresa'));
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
    }
    
}