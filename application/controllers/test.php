<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {
      
      public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('html');
            $this->load->library('session');
            $this->load->model('Log'); 
            $this->load->model('Admbd'); 
            $this->load->database();
      }

      public function index(){ 
            print_r($this);
            phpinfo();
            ob_start();
            $this->db->select('*');
            $this->db->from('contato');
            $this->db->where('con_idfuncionario',$this->session->userdata('id_funcionario'));
            $dados['contato'] = $this->db->get()->result();

            $data = ['fun_senha' => '123458'];

            $this->db->where('fun_idfuncionario', 56);
            $this->db->update('funcionario', $data);
            print_r($dados);

      }


      public function soap()
      {
 
            $parameters =  array(
            'prExecFmt'=> 'tefFile',
            'prFileName'=> 'relatoriotestes',
            'prRelatorio'=> 'FPRE300.COL',
            'prFileExt'=> 'Arquivo Formato PDF',
            'prSaveFormat'=> 'tsfPDF',
            'prEntranceIsXML'=> 'F',
            'prEntrada'=> '<EAbrCad=32,2,24><EAbrEmp=1><EAbrTcl=1>');

            ini_set('soap.wsdl_cache_enabled',0); 
            ini_set('soap.wsdl_cache_ttl',0);

            $client = new SoapClient('http://201.94.148.59:8080/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_relatorios?wsdl');
            $stringWithFile = $client->__soapCall("Relatorios", ['senior', 'senior', 0, $parameters]);

            $fp = file_put_contents("document.pdf", "w");
            fwrite($fp, base64_decode($stringWithFile));
            readfile($fp);

          $decodeds = $stringWithFile->prRetorno;
          header('Content-Description: File Transfer');
          header("Content-Type: application/pdf");
          header('Content-Disposition: attachment; filename=document.pdf');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          flush();
          file_put_contents("document.pdf", base64_decode($decodeds));
          readfile("document.pdf");
           
          
          echo "<pre>".print_r($decodeds)."</pre>"; 
          
         
         /*var_dump($stringWithFile);
         $decoded = base64_decode($decodeds);
$file = 'invoice.pdf';
file_put_contents($file, $decoded);

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}*/
      }

      public function envia()
      {

            $body = 'teste';

            if(!$this->Admbd->emailto('teste email', 'no-reply@intelstore.com', 'raafamg@gmail.com', $body))
            {
                  echo 'Send e-mail error!';
                  die();
            }

            echo 'E-mail has ben send!';
            die();
      }


}