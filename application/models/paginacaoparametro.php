<?php
class Paginacaoparametro extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database(); 
            $this->load->helper('url');
    }
    
    public function somarTodos() {	
             
             return $this->db->get('ponto_parametros')->num_rows();
    }
    
    public function buscarTodos($limit, $start) 
    { 
            $this->db->limit($limit, $start);
            $query = $this->db->order_by('para_datacompentencia', 'desc')->get('ponto_parametros');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
    }
    
}