<?php
class Admbd extends CI_Model
{
 
    public function __construct()
    {
            parent::__construct();
            $this->load-> database();
    }
    
    public function armazenar($tabela = null, $dados = null, $id = null, $nomeid = null) {		
            if ($dados) {
                    if ($id) {
                            $this->db->where($nomeid, $id);
                            if ($this->db->update($tabela, $dados)) {
                                    return true;
                            } else {
                                    return false;
                            }
                    } else {
                            if ($this->db->insert($tabela, $dados)) {
                                    return $this->db->insert_id();
                            } else {
                                    return false;
                            }
                    }
            }
    }

    public function buscar($tabela = null, $id = null, $nomeid = null){		
            if ($id) {
                $this->db->where($nomeid, $id);
            }
            $this->db->order_by($nomeid, 'desc');
            return $this->db->get($tabela);            
    }
    
    public function delete($tabela = null, $id = null, $nomeid = null){		
            if ($id) {
            }
    }    
}