<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library('session');
                $this->load->model('Admbd');
                $this->load-> database();
	}
        public function index()
        {
            $this->load->view('upload_form', array('error' => ' ' ));
        }
        function do_bandeja()
	{
            $fileName = $_FILES['afile']['name'];
            $fileType = $_FILES['afile']['type'];
            $fileContent = file_get_contents($_FILES['afile']['tmp_name']);
            $dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);

            $json = json_encode(array(
              'name' => $fileName,
              'type' => $fileType,
              'dataUrl' => $dataUrl,
              'username' => $_REQUEST['username'],
              'accountnum' => $_REQUEST['accountnum']
            ));

            echo $json;
            
        }
        function codenot()
	{
            $id = $_POST['idnot'];
            $this->db->where('idup',$id);
            $this->db->where('regiao','noticia');
            $arquivo =  $this->db->get('upload')->result();
            foreach($arquivo as $arq):
                switch ($arq->tipo) {
                    case '.png':
                        echo base_url().''.$arq->url;
                        break;
                    case '.jpg':
                        echo base_url().''.$arq->url;
                        break;
                    case '.gif':
                        echo base_url().''.$arq->url;
                        break;
                    case '.doc':
                        echo base_url().''.$arq->url;
                        break;
                    case '.docx':
                        echo base_url().''.$arq->url;
                        break;
                    case '.pdf':
                        echo base_url().''.$arq->url;
                        break;
                    case '.xls':
                        echo base_url().''.$arq->url;
                        break;
                    case '.xlsx':
                        echo base_url().''.$arq->url;
                        break;
                    case '.mp3':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.m4a':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.wav':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.mp4':
                        echo '<video controls="" width="400"><source src="/'.$arq->url.'" type="video/mp4"> Your browser does not support HTML5 video.</video>';
                        break;
                    
                    

                }
            endforeach;
        }
        function codepg()
	{
            $id = $_POST['idnot'];
            $this->db->where('idup',$id);
            $this->db->where('regiao','pagina');
            $arquivo =  $this->db->get('upload')->result();
            foreach($arquivo as $arq):
                switch ($arq->tipo) {
                    case '.png':
                        echo base_url().''.$arq->url;
                        break;
                    case '.jpg':
                        echo base_url().''.$arq->url;
                        break;
                    case '.gif':
                        echo base_url().''.$arq->url;
                        break;
                    case '.doc':
                        echo base_url().''.$arq->url;
                        break;
                    case '.docx':
                        echo base_url().''.$arq->url;
                        break;
                    case '.pdf':
                        echo base_url().''.$arq->url;
                        break;
                    case '.xls':
                        echo base_url().''.$arq->url;
                        break;
                    case '.xlsx':
                        echo base_url().''.$arq->url;
                        break;
                    case '.mp3':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.m4a':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.wav':
                        echo '<audio controls=""><source src="/'.$arq->url.'" type="audio/mpeg"></audio>';
                        break;
                    case '.mp4':
                        echo '<video controls="" width="400"><source src="/'.$arq->url.'" type="video/mp4"> Your browser does not support HTML5 video.</video>';
                        break;
                   
                }
            endforeach;
        }
         function do_upload_fotousu()
	{
            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
            $ext = strtolower(substr($_FILES['afile']['name'],-4)); //Pegando extensão do arquivo
            //echo $ext;
            if($ext == 'docx'){$ext = '.docx';}
            if($ext == 'xlsx'){$ext = '.xlsx';}            
            $arqSize = $_FILES['afile']['size'];
            $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            $dir = 'assets/upload/intranet/usuarios/'; //Diretório para uploads
            move_uploaded_file($_FILES['afile']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo            
            $nomesimples =  preg_replace('/\.[^.]*$/', '', $_FILES['afile']['name']); 
            
            echo '<img class=" sombra2" id="imgfotouser"  style="width: 80px; height: 80px; border-radius: 50%;  behavior: url(PIE.htc);" src="'.base_url().$dir.$new_name.'"><br>';
	}
        
         function do_upload_backusu()
	{
            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
            $ext = strtolower(substr($_FILES['afile2']['name'],-4)); //Pegando extensão do arquivo
            //echo $ext;
            if($ext == 'docx'){$ext = '.docx';}
            if($ext == 'xlsx'){$ext = '.xlsx';}            
            $arqSize = $_FILES['afile2']['size'];
            $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            $dir = 'assets/upload/intranet/background/'; //Diretório para uploads
            move_uploaded_file($_FILES['afile2']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo            
            $nomesimples =  preg_replace('/\.[^.]*$/', '', $_FILES['afile2']['name']); 
            echo '<div class=" radious4" id="imgback" style=" width: 100%; height: 100px; background:url('.base_url().$dir.$new_name.') center; background-size:cover"></div>';
	}
        function do_upload_mensagem()
	{
            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
            $ext = strtolower(substr($_FILES['afile']['name'],-4)); //Pegando extensão do arquivo
            //echo $ext;
            if($ext == 'docx'){$ext = '.docx';}
            if($ext == 'xlsx'){$ext = '.xlsx';}            
            $arqSize = $_FILES['afile']['size'];
            $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            $dir = 'assets/upload/intranet/mensagens/'; //Diretório para uploads
            move_uploaded_file($_FILES['afile']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo            
            $nomesimples =  preg_replace('/\.[^.]*$/', '', $_FILES['afile']['name']); 
            
            $dados['arq_nome'] = $nomesimples;   
            $dados['arq_idusuarios'] = $this->session->userdata('id_usuario');
            $dados['arq_extensao'] = $ext;
            $dados['arq_tamanho'] = $arqSize;
            $dados['arq_novonome'] = $new_name;
            $dados['arq_url'] = $dir.$new_name;            
            $dados['arq_ativo'] = '1';
            $dados['arq_local'] = 'mensagem';
            
            echo $this->Admbd->armazenar('arquivos', $dados);  
	}
        function do_upload_grupo($id = null)
	{
            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
            $ext = strtolower(substr($_FILES['afile']['name'],-4)); //Pegando extensão do arquivo
            if($ext == 'docx'){$ext = '.docx';}
            if($ext == 'xlsx'){$ext = '.xlsx';}            
            $arqSize = $_FILES['afile']['size'];
            $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            $dir = 'assets/upload/intranet/grupos/'; //Diretório para uploads
            move_uploaded_file($_FILES['afile']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo            
            $nomesimples =  preg_replace('/\.[^.]*$/', '', $_FILES['afile']['name']); 
            
            $dados['arq_nome'] = $nomesimples;   
            $dados['arq_idusuarios'] = $this->session->userdata('id_usuario');
            $dados['arq_extensao'] = $ext;
            $dados['arq_tamanho'] = $arqSize;
            $dados['arq_novonome'] = $new_name;
            $dados['arq_url'] = $dir.$new_name;            
            $dados['arq_ativo'] = '1';
            $dados['arq_temp'] = '1';
            $dados['arq_local'] = 'grupo';
            $idarq = $this->Admbd->armazenar('arquivos', $dados);  
            
  
            
            
            
            $this->db->where('arq_idarquivos', $idarq);
            $this->db->where('arq_idusuarios', $this->session->userdata('id_usuario'));
            $arquivo = $this->db->get('arquivos')->result();

            foreach ($arquivo as $value) {
                $url = $value->arq_url;
            } 
            $dados2['grupo_foto'] = $url;
            $this->Admbd->armazenar('grupo', $dados2, $id, 'grupo_idgrupo');  
            echo $url;
	}
        
} 

