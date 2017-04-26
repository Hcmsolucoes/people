<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Perfil_edit extends CI_Controller {
	
	public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd'); 
            $this->load-> database();
	}
	

    public function recu_senha()
    {

        if (!empty($this->input->post('usu_email'))) {$dados['usu_email'] = $this->input->post('usu_email'); }  

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usu_email',$dados['usu_email']);
        $usuario = $this->db->get()->result();

        if(!$usuario){
            echo json_encode(array(
                'success' => false,
                'msg' => 'E-mail não cadastrado.'
             ));
            return false;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 9; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $dados['usu_senha'] = md5($randomString);

        $body = 'Sua nova senha é : ' . $randomString;

        if(!$this->Admbd->emailto('Recuperação de senha HCM People', 'contato@hcmsolucoes.com.br', $dados['usu_email'], $body))
        {
            echo 'Error ao enviar e-mail!';
            return false;
        }

            $this->db->where('usu_email',$dados['usu_email']);
            $this->db->update('usuarios', ['usu_senha' => $dados['usu_senha']]); 

            echo json_encode(array(
                'success' => true,
                'msg' => 'Recuperação de senha enviado.'
             ));
    }

    public function alterar_senha()
    { 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['funcionario'] = $this->db->get()->result();
            $idcliente = $dados['funcionario'][0]->fun_idcliente;
            
            $this->load->view('/geral/edit/alterar_senha',$dados);
    }

    public function envia_senha()
    {       
            $dados = [];
            $this->load->view('/geral/edit/enviar_senha',$dados);
    }

    public function alterar_senha_salva()
    { 

        header('Content-Type: application/json');
        

            if (!empty($this->input->post('for_senha'))) {$dados['fun_senha'] = $this->input->post('for_senha'); }
            if (!empty($this->input->post('for_senhaconfirma'))) {$dados['fun_senhaconfirma'] = $this->input->post('for_senhaconfirma'); }

            if($dados['fun_senha'] != $dados['fun_senhaconfirma']){

                echo json_encode(array(
                    'success' => false,
                    'msg' => utf8_encode('As senhas não são iguais'),
                 ));

                return false;
            }

            $regS = '/^(?=.*[!@#$%&? "])/';
            if(!preg_match($regS, $dados['fun_senha'])){
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'Sua senha deve conter um digito especial.'
                 ));

                return false;
            }

            $regN = '/[^0-9]/';
            if(!preg_match($regN, $dados['fun_senha'])){
                echo json_encode(array(
                    'success' => false,
                    'msg' => utf8_encode('Sua senha deve conter um número.')
                 ));

                return false;
            }


            if(strlen($dados['fun_senha']) <= 10 ){
                echo json_encode(array(
                    'success' => false,
                    'msg' => utf8_encode('Sua senha deve conter no mínimo de 10 caracteres.')
                 ));

                return false;
            }

                unset($dados['fun_senhaconfirma']);
                $dados['fun_senha'] = md5($dados['fun_senha']);

                $iduser = (!empty($this->input->post('colaborador')) )? $this->input->post('colaborador') : $this->session->userdata('id_funcionario');
                
                $this->db->where('fun_idfuncionario', $iduser);
                $this->db->update('funcionario', $dados);

                $dados['usu_senha'] = $dados['fun_senha'];
                unset($dados['fun_senha']);

                $this->db->select('*');
                $this->db->from('usuarios');
                $this->db->where('usu_idfuncionario',$iduser);
                $usuario = $this->db->get()->result();

                if($usuario)
                {

                $this->db->where('usu_idfuncionario',$this->session->userdata('id_funcionario'));
                $this->db->update('usuarios', $dados);                    

                }
                //echo $this->db->last_query();

                echo json_encode(array(
                    'success' => true,
                    'msg' => 'Senha alterada com sucesso!.'
                 ));


    }

    public function pessoal_info()
    { 
            $this->db->select('*');
            $this->db->from('funcionario');
            $this->db->where('fun_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['funcionario'] = $this->db->get()->result();
            $idcliente = $dados['funcionario'][0]->fun_idcliente;

            $dados['etnia'] = $this->db->get("etnia")->result();
            $dados['estadocivil'] = $this->db->get("estadocivil")->result();

            $this->db->where('escolaridade_idcliente', $idcliente );
            $dados['escolaridade'] = $this->db->get("escolaridade")->result();
            header ('Content-type: text/html; charset=ISO-8859-1'); 
            $this->load->view('/geral/edit/perfil_pessoal',$dados);        
    }
        public function pessoal_info_salva()
        {    
            if (!empty($this->input->post('for_nome'))) {$dados['fun_nome'] = utf8_decode($this->input->post('for_nome')); }
            if (!empty($this->input->post('for_nacio'))) {$dados['fun_nacionalidade'] = $this->input->post('for_nacio'); }
            if (!empty($this->input->post('for_natual'))) {$dados['fun_naturalidade'] = utf8_decode($this->input->post('for_natual')); }
            if (!empty($this->input->post('for_sexo'))) {$dados['fun_sexo'] = $this->input->post('for_sexo'); }
            if (!empty($this->input->post('for_civil'))) {$dados['fun_estadocivil'] = $this->input->post('for_civil'); }
            if (!empty($this->input->post('for_datanasc'))) {$data1 = $this->input->post('for_datanasc'); $data1 = explode("/", $data1);                                          
                       list($dia, $mes, $ano ) = $data1; $dados['fun_datanascimento'] = ($ano.'-'.$mes.'-'.$dia);}
            if (!empty($this->input->post('for_raca'))) {$dados['fun_etnia'] = utf8_decode($this->input->post('for_raca')); }
            if (!empty($this->input->post('for_escola'))) {$dados['fun_escolaridade'] = $this->input->post('for_escola'); }
            $this->session->set_userdata('nome', $dados['fun_nome']);
            $this->Admbd->armazenar('funcionario', $dados, $this->session->userdata('id_funcionario'), 'fun_idfuncionario');
            echo 'ok';
        }        
        public function pessoal_contato()
        { 
            $this->db->select('*');
            $this->db->from('emails');
            $this->db->where('ema_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['emails'] = $this->db->get()->result();
            
            $this->db->select('*');
            $this->db->from('redesocial');
            $this->db->where('rede_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['redesocial'] = $this->db->get()->result();
            
            $this->db->select('*');
            $this->db->from('contato');
            $this->db->where('con_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['contato'] = $this->db->get()->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1'); 
            $this->load->view('/geral/edit/perfil_contato',$dados);        
	}
        public function pessoal_contato_edit()
        {
            if (!empty($this->input->post('id'))) {
                
                $id = $this->input->post('id'); 
                $this->db->select('*');
                $this->db->from('contato');
                $this->db->where('con_idcontato',$id);
                $dados['contato'] = $this->db->get()->result();

                $idcli = $this->session->userdata('idcliente');
            $this->db->where('idcliente', $idcli);
            $dados['parentesco'] = $this->db->get("tipodependente")->result();
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/perfil_contatoemeredit',$dados);   
            }    
        }
        public function pessoal_contato_salva()
        {
            if (!empty($this->input->post('for_nome1'))) {$dados['con_nome'] = utf8_decode($this->input->post('for_nome1')); }
            if (!empty($this->input->post('for_sexo1'))) {$dados['con_sexo'] = $this->input->post('for_sexo1'); }
            if (!empty($this->input->post('for_parent1'))) {$dados['con_parentesco'] = utf8_decode($this->input->post('for_parent1')); }
            if (!empty($this->input->post('for_ddi1'))) {$dados['con_ddi'] = $this->input->post('for_ddi1'); }
            if (!empty($this->input->post('for_ddd1'))) {$dados['con_ddd'] = $this->input->post('for_ddd1'); }
            if (!empty($this->input->post('for_numero1'))) {$dados['con_telefone'] = $this->input->post('for_numero1'); }
            if (!empty($this->input->post('for_ramal1'))) {$dados['con_ramal'] = $this->input->post('for_ramal1'); }
            if (!empty($this->input->post('for_noper1'))) {$dados['con_operadora'] = $this->input->post('for_noper1'); }
            if (!empty($this->input->post('for_id1'))) {$id = $this->input->post('for_id1'); }

            $this->Admbd->armazenar('contato', $dados, $id, 'con_idcontato');
            echo 'ok'; 
        }
        public function pessoal_contato_add()
        {
            if (!empty($this->input->post('for_nome1'))) {$dados['con_nome'] = utf8_decode($this->input->post('for_nome1')); }
            if (!empty($this->input->post('for_sexo1'))) {$dados['con_sexo'] = $this->input->post('for_sexo1'); }
            if (!empty($this->input->post('for_parent1'))) {$dados['con_parentesco'] = utf8_decode($this->input->post('for_parent1')); }
            if (!empty($this->input->post('for_ddi1'))) {$dados['con_ddi'] = $this->input->post('for_ddi1'); }
            if (!empty($this->input->post('for_ddd1'))) {$dados['con_ddd'] = $this->input->post('for_ddd1'); }
            if (!empty($this->input->post('for_numero1'))) {$dados['con_telefone'] = $this->input->post('for_numero1'); }
            if (!empty($this->input->post('for_ramal1'))) {$dados['con_ramal'] = $this->input->post('for_ramal1'); }
            if (!empty($this->input->post('for_noper1'))) {$dados['con_operadora'] = $this->input->post('for_noper1'); }
            $dados['con_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('contato', $dados);
            echo 'ok'; 
        }
        public function pessoal_contato_remove()
        {
           if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('contato', $id, 'con_idcontato');                
            }
       }
        public function pessoal_contatoemer()
        {   
            $idcli = $this->session->userdata('idcliente');
            $this->db->where('idcliente', $idcli);
            $dados['parentesco'] = $this->db->get("tipodependente")->result();
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/perfil_contatoemer', $dados);        
	       }
        
        public function pessoal_addemail()
        { 
             if (!empty($this->input->post('for_tipo'))) {$dados['ema_tipo'] = $this->input->post('for_tipo'); }
             if (!empty($this->input->post('for_email'))) {$dados['ema_email'] = $this->input->post('for_email'); }
             $dados['ema_idfuncionario'] = $this->session->userdata('id_funcionario');
             $idvolta = $this->Admbd->armazenar('emails', $dados);
             
             echo '<tr id="email'.$idvolta.'">
                             <td>'.$dados['ema_tipo'].'</td>
                             <td>'.$dados['ema_email'].'</td>
                             <td><button type="button" class="btn btn-default btn-sm removeemail" id="'.$idvolta.'"><span class="fa fa-times"></span></button></td>
                   </tr>';
          
             
         }
        public function pessoal_addrede()
         { 
             if (!empty($this->input->post('for_tipo1'))) {$dados['rede_tipo'] = utf8_decode($this->input->post('for_tipo1') ); }
             if (!empty($this->input->post('for_usu'))) {$dados['rede_nomeuser'] = utf8_decode($this->input->post('for_usu') ); }

             $dados['rede_idfuncionario'] = $this->session->userdata('id_funcionario');
             $idvolta = $this->Admbd->armazenar('redesocial', $dados);
             
             echo '<tr id="email'.$idvolta.'">
                             <td>'.$this->input->post('for_tipo1').'</td>
                             <td>'.$this->input->post('for_usu').'</td>
                             <td><button type="button" class="btn btn-default btn-sm removeemail" id="'.$idvolta.'"><span class="fa fa-times"></span></button></td>
                   </tr>';
          
             
         } 

        public function pessoal_endereco(){

            $iduser = $this->session->userdata('id_funcionario');
            $this->db->select("end_rua, end_numero, end_complemento, end_pais, end_cep, end_idbairro, bair_nomebairro, cid_nomecidade, est_nomeestado, end_idcidade, end_idestado");
            $this->db->join('bairro', 'funcionario.end_idbairro = bairro.bair_idbairro', 'left');
            $this->db->join('cidade', 'funcionario.end_idcidade = cidade.cid_idcidade', 'left');
            $this->db->join('estado', 'funcionario.end_idestado = estado.est_idestado', 'left');
            $this->db->where('fun_idfuncionario',$iduser);
            $dados['endereco'] = $this->db->get('funcionario')->row();
            $est = $dados['endereco']->end_idestado;
            $dados['estados'] = $this->db->get('estado')->result();

            $this->db->where('cid_idestado',$est);
            $dados['cidades'] = $this->db->get('cidade')->result();

            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/perfil_endereco', $dados); 

         }

        public function pessoal_removerede()
        { 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('redesocial', $id, 'rede_idredesocial');                
            }
        }

        public function pessoal_removeemail()
        { 
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('emails', $id, 'ema_idemail');                
            }
        }
        
        public function pessoal_profissional()
        { 
            $iduser = $this->session->userdata('id_funcionario');  
            $this->db->where('perfil_idfuncionario',$iduser);
            $dados['perfil_profissional'] = $this->db->get('perfil_profissional')->result();

            header ('Content-type: text/html; charset=ISO-8859-1'); 
            $this->load->view('/geral/edit/perfil_resumoprofis',$dados);

            
	}
        public function pessoal_profissional_edit()
        {
            if (!empty($this->input->post('resumoprof'))) {
                
                $id = $this->session->userdata('id_funcionario');
                $dados['perfil_resumo'] = utf8_decode( str_replace("\n",'<br />', addslashes($this->input->post('resumoprof'))) );

                $this->db->where("perfil_idfuncionario", $id);
                $res = $this->db->get("perfil_profissional")->row();
                if (is_object($res)) {
                   $this->Admbd->armazenar('perfil_profissional', $dados, $id, 'perfil_idfuncionario');
                }else{
                    $dados['perfil_idfuncionario'] = $id;
                    $this->Admbd->armazenar('perfil_profissional', $dados);
                }
                
                echo "ok";
            }
            
            
        }

        public function interesse_edit(){             
      
            $iduser = $this->session->userdata('id_funcionario');
            $this->db->where('inter_idfuncionario',$iduser);
            $dados['interessepessoal'] = $this->db->get('interessepessoal')->result();

            header ('Content-type: text/html; charset=ISO-8859-1'); 
            $this->load->view('/geral/edit/perfil_interesse_edit', $dados);

         }

         public function interesse_add(){

            if (!empty($this->input->post('inter_area'))) {$dados['inter_area'] = utf8_decode($this->input->post('inter_area') ); }
            if (!empty($this->input->post('inter_areadetalhe'))) {$dados['inter_areadetalhe'] = utf8_decode($this->input->post('inter_areadetalhe')); }
            
            $dados['inter_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('interessepessoal', $dados);
            echo 'ok'; 
        }

        public function interesse_remove(){
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('interessepessoal', $id, 'inter_idinteressepessoal');                
            }
        }

        public function academico_edit(){     
            
            header ('Content-type: text/html; charset=ISO-8859-1');
            $this->load->view('/geral/edit/perfil_academico_edit');
            

         }

        public function academico_add(){

            if (!empty($this->input->post('curso'))) {$dados['for_graduacao_curso'] = utf8_decode($this->input->post('curso')); }
            if (!empty($this->input->post('inter_area'))) {$dados['for_educacao_nivel'] = utf8_decode($this->input->post('inter_area')); }
            if (!empty($this->input->post('universidade'))) {$dados['for_nome_facu'] = utf8_decode($this->input->post('universidade')); }
            if (!empty($this->input->post('area'))) {$dados['for_areaconhecimento'] = utf8_decode($this->input->post('area')); }

            if (  !empty($this->input->post('inicio')) && !empty($this->input->post('fim'))  ) {
            
            $data1 = $this->input->post('inicio'); 
            $data1 = explode("/", $data1);                                          
            list($dia, $mes, $ano ) = $data1;
            $dados['for_datainicio'] = ($ano.'-'.$mes.'-'.$dia);
            
            $data2 = $this->input->post('fim'); 
            $data2 = explode("/", $data2);                                          
            list($dia, $mes, $ano ) = $data2;
            $dados['for_datafim'] = ($ano.'-'.$mes.'-'.$dia); 

            }else {
                $dados['for_detalhes'] = "Cursando";
            }
            $dados['for_idfuncionario'] = $this->session->userdata('id_funcionario');

            $this->Admbd->armazenar('formacao_academica', $dados);
            echo 'ok'; 
        }

        public function academico_remove(){
            if (!empty($this->input->post('id'))) {
                $id = $this->input->post('id');
                $this->Admbd->delete('formacao_academica', $id, 'for_idformacao');                
            }
        }


        public function foto_edit(){
            $url = base_url("/perfil/pessoal");

            if (isset($_FILES['fotoperfil'])) {

            	$this->load->library('util');            	
				$this->load->library('uploadimage');
            	
            	$idfun = $this->session->userdata('id_funcionario');
                $instancia =$this->session->userdata('instancia');                
                $pasta = FCPATH . '/assets/img/upload/'. $instancia;
                $extensao = strtolower(end(explode('.', $_FILES['fotoperfil']['name'] )));

                if (!file_exists($pasta)) {
                   mkdir($pasta, 0777, true);  //create directory if not exist
                }

                $array['arquivo'] = $_FILES['fotoperfil'];
                $array['altura'] = 400;
                $array['largura'] = 400;
                $array['pasta'] = $pasta."/";                
                $this->uploadimage->setVars($array);

                $nome = $idfun.$this->util->geraString(9);
                $res = $this->uploadimage->salvar($nome);
                //echo $nome; exit;
                
                if ($res=="Sucesso") {

                	$dados['fun_foto'] = base_url().'assets/img/upload/'.$instancia."/".$nome.".".$extensao;
                	$this->session->set_userdata("img", $dados['fun_foto']);
                	//$this->db->where('fun_idfuncionario', $idfun);
                	//$this->db->update('funcionario', $dados);
                   
                }
                header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                header("Location: ".$url);
                exit;
            }

            if(!empty($this->input->post('tam'))){
            	
            	$this->load->library('uploadimage');
            	$this->load->library('util'); 

            	$idfun = $this->session->userdata('id_funcionario');
            	$instancia =$this->session->userdata('instancia');                
                $pasta = FCPATH . '/assets/img/upload/'. $instancia;
                $foto = end(explode('/', $this->session->userdata('img')));
                
                $dados['fun_foto'] = $this->session->userdata('img');

                $x = $this->input->post('x');
                $y = $this->input->post('y');
                $xl = $ya = ceil( $this->input->post('tam') );
                //echo $xl." - ".$ya;exit;
                
                $caminho = $pasta."/".$foto;
                $nome = $idfun.$this->util->geraString(9);             
                $this->uploadimage->setLargura(300);
                $this->uploadimage->setAltura(300);
                $this->uploadimage->crop($x, $y, $xl, $ya, $caminho, $nome);

                $this->db->where('fun_idfuncionario', $idfun);
                $this->db->update('funcionario', $dados);
            	$this->session->unset_userdata("img");

            	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            	header("Location: ".$url);
                exit;
            }
            /*
            if (isset($_POST['remover']) ) {
            	$dados['fun_foto'] = "NULL";
                $this->db->where('fun_idfuncionario', $idfun);
                $this->db->update('funcionario', $dados);
                header("Location: ".$url);
                exit;
            }*/

            $this->load->view('/geral/modal_foto');

         }


}