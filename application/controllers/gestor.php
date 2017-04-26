<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Gestor extends CI_Controller {
	
public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('session');
    $this->load->library('util');
    $this->load->model('Log'); 
    $this->load->model('Admbd');

 }

public function index(){ 
    $this->Log->talogado(); 
    $this->session->set_userdata('perfil_atual', '2');

    $dados = array('menupriativo' => 'painel' );
    $dados['perfil_atual'] = 2;
    switch ( $this->session->userdata('perfil') ) {

      case '3':
      header("Location: ".base_url('home') ); exit;
      break;
      
  }

    $idcli = $this->session->userdata('idcliente');
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

    $mes = date("m");
    $ano = date("Y");
    $this->db->where('MONTH(fun_datanascimento)',$mes);
    $dados['aniversariantes'] = $this->db->get('funcionario')->result(); 

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->where('contr_idfuncionario',$iduser);
    $dados['contratos'] = $this->db->get('contratos')->result();

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;


    $noventa_dias = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +3 month");
    $noventa_dias = date("Y-m-d", $noventa_dias);
    $this->db->select('fun_cargo, fun_idfuncionario, fun_foto, fun_sexo, fun_nome, vnccontr, contr_cargo');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where('vnccontr >= ', date("Y-m-d"));
    $this->db->where('vnccontr <= ', $noventa_dias);
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status', "A");
    $dados['vencimentos'] = $this->db->get('funcionario')->result();

    //Referente ao grafico charts - salario por sexo e idade
    $this->db->select('fun_cargo, fun_idfuncionario, fun_foto, tipodesexo.descricao as sexo, fun_nome, contr_centrocusto,contr_departamento,contr_data_admissao,FLOOR(DATEDIFF(DAY, fun_datanascimento, getdate()) / 365.25) AS idadefun,sal_valor');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("tipodesexo", "tipSex = fun_sexo");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->join("salarios", "sal_idfuncionario = fun_idfuncionario",'left');
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where("salarios.sal_dataini =(SELECT max(b.sal_dataini) FROM salarios b WHERE b.sal_idfuncionario=funcionario.fun_idfuncionario
                                                                          AND b.sal_dataini<=getdate())");
    $this->db->where('fun_status', "A");
    $dados['salariosexo'] = $this->db->get('funcionario')->result(); 
    //var_dump($dados['salariosexo']);

    $this->db->select("escolaridade.*, fun_idfuncionario");
    $this->db->join('escolaridade', "fun_escolaridade = id_escolaridade");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario", "left");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status',"A");
    $dados['escolaridade'] = $this->db->get('funcionario')->result();
    


    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome, contr_data_admissao');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('MONTH(contr_data_admissao)',$mes);
    $this->db->where('YEAR(contr_data_admissao)',$ano);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['admitidos'] =$this->db->get('funcionario')->result();
    //$dados['sql'] = $this->db->last_query();


    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome, datdem');
    //$this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('MONTH(datdem)',$mes);
    $this->db->where('YEAR(datdem)',$ano);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "I");
    $dados['demitidos'] =$this->db->get('funcionario')->result();


    $this->db->select("fun_idfuncionario, fun_foto, fun_sexo, fun_nome, contr_cargo");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status',"A");
    $dados['equipe'] = $this->db->get("funcionario")->result();


    $this->db->select('fun_datanascimento');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    //$this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['idade'] =$this->db->get('funcionario')->result();


    $this->db->select('contr_data_admissao');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->join("funcionario", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['tempo_trabalhado'] =$this->db->get('contratos')->result();


    $this->db->select('contr_situacao, fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_idempresa', $idempresa);
    $this->db->where('fun_status', "A");
    $dados['situacao'] =$this->db->get('funcionario')->result();

    $um_ano = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -12 month");
    $um_ano = date("Y-m-d", $um_ano);
    $this->db->select('fun_idfuncionario, fun_foto, fun_sexo, fun_nome');
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('YEAR(contr_data_admissao) = YEAR(datdem)' );
    $this->db->where('contr_data_admissao <= ', date("Y-m-d"));
    $this->db->where('contr_data_admissao >= ', $um_ano);
    $this->db->where('fun_status', "I");
    $dem = $this->db->get('funcionario')->result();
    $this->db->select('COUNT(contr_idcontratos) AS admitidos');
    $this->db->where('contr_data_admissao <= ', date("Y-m-d"));
    $this->db->where('contr_data_admissao >= ', $um_ano);
    $admi = $this->db->get('contratos')->result();
    $dados['taxasaida'] = (count($dem) / $admi[0]->admitidos) * 100;

    //asos dos proximos 15 dias
    $date = new DateTime(date("Y-m-d"));
    $date->add(new DateInterval('P15D'));
    $this->db->select("COUNT(fun_idfuncionario) AS vencimento");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where("fun_proximoexame <=", $date->format('Y-m-d') );
    $this->db->where("fun_proximoexame >=", date('Y-m-d') );
    $this->db->where("fun_status", "A" );
    $dados['aso1'] = $this->db->get('funcionario')->row();

    //asos vencidos
    $this->db->select("COUNT(fun_idfuncionario) AS vencidos");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where("fun_proximoexame < ", date('Y-m-d') );
    $this->db->where("fun_status", "A" );
    $dados['aso2'] = $this->db->get('funcionario')->row();


    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $this->db->where('feed_data >=',date('Y/m/d'));
    $this->db->where('feed_data >=',date('Y/m/d', strtotime('-10 days', strtotime(date('Y/m/d')))));
    $feeds2 = $this->db->get('feedbacks')->num_rows();
    $dados['quantultimos'] = $feeds2;

    $this->db->where('tipo_idfuncionario',$iduser);     
    $mesativo = $this->db->order_by('tipo_mesref', 'desc')->get('tipodecalculo',1)->result();
    $mesativoref="";
    foreach ($mesativo as $value) { 
      $mesativoref = $value->tipo_mesref;
    }


    $this->db->where('tipo_idfuncionario',$iduser);
    $this->db->like('tipo_mesref', $mesativoref);
    $tipodecalculo = $this->db->get('tipodecalculo')->result(); 

    $totaldesconto = 0;
    $totalproventos = 0;
    $totalliquido = 0;
    foreach ($tipodecalculo as $value) { 
      if($value->tipo_tipocal == '11'){
        $this->db->where('even_idtipodecalculo',$value->tipo_idtipodecalculo);
        $eventos2 = $this->db->get('eventoscalculo')->result();                
        foreach ($eventos2 as $dados1) {                
          $valorevento = $dados1->even_valor;
          $valorevento = str_replace(',' , '.', $valorevento);
          if($dados1->even_tipoevento == '-'){$totaldesconto = $totaldesconto + $valorevento;}
          if($dados1->even_tipoevento != '-'){if($dados1->even_tipoevento != '#'){$totalproventos = $totalproventos + $valorevento;}}
        }
      }

    }

    $this->db->select('*');
    $this->db->from('pontoaponto');
    $this->db->join('ponto_parametros', 'ponto_parametros.para_idparametros = pontoaponto.pon_idparametros');
    $this->db->where('pon_idfuncionario',$iduser);
    $this->db->limit(1);
    $dados['pontoaponto'] = $this->db->get()->result();

    $dados['totalliquido'] =  $totalproventos - $totaldesconto;
    $dados['totalproventos'] =  $totalproventos;
    $dados['totaldesconto'] = $totaldesconto;

    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Dashboard"=>"#" );
    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_dash_gestor',$dados);
    $this->load->view('/geral/footer'); 
  }

public function turnover(){

    $iduser = $this->session->userdata('id_funcionario');
    $sete_meses = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -7 month");
    $m = date("m", $sete_meses);
    $a = date("Y", $sete_meses);
    $ultimo_dia = date("t", mktime(0,0,0,$m,'01',$a));
    $sete_meses = $a."-".$m."-".$ultimo_dia;
    
    for ($i=0; $i < 6; $i++) {

        $this->db->select('COUNT(contr_idcontratos) AS total');
        $this->db->join("funcionario", "contr_idfuncionario = fun_idfuncionario");
        $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
        $this->db->where("chefiasubordinados.chefe_id", $iduser);
        $this->db->where("(datdem > '".$sete_meses."' OR datdem IS NULL)" );
        $this->db->where("(contr_data_admissao <= '".$sete_meses."')");
        $res = $this->db->get('contratos')->row();
        $total = $res->total;

        $m++;
        if ($m==13) {
            $m= "01";
            $a++;
        }
        $m = str_pad($m, 2, "0", STR_PAD_LEFT);

        $ultimo_dia = date("t", mktime(0,0,0,$m,'01',$a));
        $sete_meses = $a."-".$m."-".$ultimo_dia;
        $this->db->select('COUNT(contr_idcontratos) AS admitidos');
        $this->db->join("chefiasubordinados", "subor_idfuncionario = contr_idfuncionario");
        $this->db->where("chefiasubordinados.chefe_id", $iduser);
        $this->db->where("MONTH(contr_data_admissao)", $m);
        $this->db->where("YEAR(contr_data_admissao)", $a);
        $res = $this->db->get('contratos')->row();
        $admi = $res->admitidos;
        

        $this->db->select('COUNT(fun_idfuncionario) AS demitidos');
        $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
        $this->db->where("chefiasubordinados.chefe_id", $iduser);
        $this->db->where("MONTH(datdem)", $m);
        $this->db->where("YEAR(datdem)", $a);
        $res = $this->db->get('funcionario')->row();
        $demi = $res->demitidos;

        $x = ($admi + $demi) / 2;
        if ($x==0 && $total==0) {
            $total = 1;
        }
        $y = $x / $total;
        $turn = number_format( ($y*100), 1, ",", "" ) ;
        $ma = $this->util->mes_extenso( $m ) . "/" . $a;
        $dados['semestre'][$ma] = $turn;
    }
    
    header ('Content-type: text/html; charset=ISO-8859-1' );
    $this->load->view('/geral/box/turnover', $dados);

 }

public function equipe(){ 
    $this->Log->talogado(); 
    $dados = array( 'menupriativo' => 'perfil', 'menu_colab_perfil' => 'pessoal', 'menu_colab_perfil_contrato' => '');
           
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

            //$corpo = (!empty( $this->input->post('corpo') )? $this->input->post('corpo') : 1) ;

    $this->db->select("funcionario.*,  bairro.bair_nomebairro, cidade.cid_nomecidade, est_nomeestado " );
    $this->db->where('fun_idfuncionario',$iduser);
    //$this->db->join('endereco', "end_idendereco = fun_idendereco");
    $this->db->join('bairro', "end_idbairro = bair_idbairro", "LEFT");
    $this->db->join('cidade', "end_idcidade = cid_idcidade", "LEFT");
    $this->db->join('estado', "end_idestado = est_idestado", "LEFT");
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    /*
    $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento");
    $this->db->join('contratos',"contr_idfuncionario = fun_idfuncionario");
    $this->db->where('fun_idempresa',$idempresa);
    $this->db->where('fun_idfuncionario != ',$iduser);
    $dados['equipe'] = $this->db->get('funcionario')->result();
    */

    $this->db->select("funcionario.*, contratos.contr_data_admissao, contratos.contr_departamento, contratos.contr_centrocusto, contr_cargo, contr_situacao, chefiasubordinados.subor_id");
            $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
            $this->db->where("chefiasubordinados.chefe_id", $iduser);
            $this->db->where('fun_status',"A");
            $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
            $this->db->from('funcionario');
            $dados['equipe'] = $this->db->get()->result();   


    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;            

    $this->session->set_userdata('perfil_atual', '2');
    $dados['breadcrumb'] = array('Gestor'=>base_url('gestor'), "Gestão da Equipe"=>"#", "minha equipe"=>base_url('gestor/equipe') );
    $this->load->view('/geral/html_header',$dados);
            /*
            switch ($corpo) {
                   case '1': $this->load->view('/geral/corpo_equipe',$dados); break;
                   case '2': $this->load->view('/geral/corpo_equipe_resultado',$dados); break;                   
                   default: $this->load->view('/geral/corpo_equipe',$dados); break;
             }
             */
             $this->load->view('/geral/corpo_equipe',$dados);          
             $this->load->view('/geral/footer'); 
           }

public function aprovacoes(){

    $this->Log->talogado(); 
    $dados = array('menupriativo' => 'aprovacoes' );
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcli = $this->session->userdata('idcliente');

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    //$this->db->where('fk_aprovador',$iduser);
    //$eu = $this->db->get('solicitacao_aprovador')->row();


    /*$this->db->where('fun_idempresa',$idempresa);
    $this->db->where('fun_status',"A");
    $dados['colaboradores'] = $this->db->get('funcionario')->result();*/

    $this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
    $this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
    $this->db->join('solicitacao_aprovador', "nivel_atual = nivel_aprovador");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->where('idempresa', $idempresa);
    $this->db->where('fk_aprovador', $iduser);
    $this->db->where('fk_tipo_solicitacao = apr_tipo_solicitacao');
    $this->db->where('solicitacao_status = 2');
    $dados['solicitacoes'] = $this->db->get('solicitacoes')->result();
    
    /*
    $this->db->where('idcliente',$idcli);
    $dados['motivos'] = $this->db->get('motivos')->result();
    
    $this->db->where('idempresa',$idempresa);
    $dados['cargos'] = $this->db->get('tabelacargos')->result();
    */
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();

    $dados['perfil'] = $this->session->userdata('perfil');

    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Aprovações"=>"#" );

    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_aprovacoes',$dados);
    $this->load->view('/geral/footer');
  

   }

public function solicitacoes(){

    $this->Log->talogado(); 
    $dados = array('menupriativo' => 'solicitacoes' );
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcli = $this->session->userdata('idcliente');

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_idempresa',$idempresa);
    $this->db->where('fun_status',"A");
    $dados['colaboradores'] = $this->db->get('funcionario')->result();

    $this->db->select('fun_nome, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');
    $this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->where('id_solicitante',$iduser);
    $dados['solicitacoes'] = $this->db->get('solicitacoes')->result();

    
    $this->db->where('idcliente',$idcli);
    $dados['motivos'] = $this->db->get('motivos')->result();

    
    $this->db->where('idempresa',$idempresa);
    $dados['cargos'] = $this->db->get('tabelacargos')->result();

    
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();

    $dados['perfil'] = $this->session->userdata('perfil');

    $dados['breadcrumb'] = array('Gestor'=>base_url().'gestor', "Solicitações"=>"#" );

    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_solicitacoes',$dados);
    $this->load->view('/geral/footer');
  

   }

public function salvarDesligamento(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');    
    
    
    if (!empty($this->input->post('motivo') ) ) {
        $dados['motivo_solicitacao'] = utf8_decode($this->input->post('motivo'));
    }
    $dados['data_efetiva'] = $this->Log->alteradata2( $this->input->post('dt_desligamento') );
    $pag = (!empty($this->input->post('pag')) )? $this->input->post('pag'): 'gestor/solicitacoes';

    if ( !empty($this->input->post('alterar_desligamento')) ) {

        $idsol = $this->input->post('solicitacao');
        $this->db->where("solicitacao_id", $idsol);
        $this->db->update("solicitacoes", $dados);
        header("Location: ". base_url($pag) );
        exit;
    }else{

        $dados['idcliente'] = $idcliente;
        $dados['idempresa'] = $idempresa;
        $dados['id_solicitante'] = $iduser;
        $dados['fk_tipo_solicitacao'] = $this->input->post('tipo');
        $dados['sol_idfuncionario'] = $this->input->post('colaborador');
        $this->db->insert("solicitacoes", $dados);
        echo $this->db->insert_id();
    }
    //
 }

public function salvarAumentoSalaral(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');    
    $pag = (!empty($this->input->post('pag')) )? $this->input->post('pag'): 'gestor/solicitacoes';
    
    $dados['data_efetiva'] = $this->Log->alteradata2( $this->input->post('dt_aumento') );    

    if (!empty($this->input->post('novovalor'))) {
       $dados['valor_aumento'] = $this->util->floatParaInsercao($this->input->post('novovalor'));
    }

    if (!empty($this->input->post('motivo_aumento') ) ) {
        $dados['motivo_aumento'] = $this->input->post('motivo_aumento');
    }

    if (!empty($this->input->post('sal_obs') ) ) {
        $dados['motivo_solicitacao'] = utf8_decode($this->input->post('sal_obs'));
    }


    if ( !empty($this->input->post('alterar_aumento')) ) {

        $idsol = $this->input->post('solicitacao');
        $this->db->where("solicitacao_id", $idsol);
        $this->db->update("solicitacoes", $dados);
        header("Location: ". base_url($pag) );
        exit;
    }else{

        $dados['idcliente'] = $idcliente;
        $dados['idempresa'] = $idempresa;
        $dados['id_solicitante'] = $iduser;
        $dados['fk_tipo_solicitacao'] = $this->input->post('tipo');
        $dados['sol_idfuncionario'] = $this->input->post('colaborador');
        $this->db->insert("solicitacoes", $dados);
        echo $this->db->insert_id();
    }
    //header("Location: ". base_url('gestor/solicitacoes') );
 }

public function salvarMudancaCargo(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');    
    $pag = (!empty($this->input->post('pag')) )? $this->input->post('pag'): 'gestor/solicitacoes';

    if (!empty($this->input->post('dt_mudanca') ) ) {
    $dados['data_efetiva'] = $this->Log->alteradata2( $this->input->post('dt_mudanca') );
    }  

    if (!empty($this->input->post('fk_cargo') ) ) {
        $dados['fk_cargo'] = $this->input->post('fk_cargo');
    }

    if (!empty($this->input->post('motivo_aumento') ) ) {
        $dados['motivo_aumento'] = $this->input->post('motivo_aumento');
    }

    if (!empty($this->input->post('obs_mudanca') ) ) {
        $dados['motivo_solicitacao'] = utf8_decode($this->input->post('obs_mudanca'));
    }
    if ( !empty($this->input->post('alterar_mudanca')) ) {

        $idsol = $this->input->post('solicitacao');
        $this->db->where("solicitacao_id", $idsol);
        $this->db->update("solicitacoes", $dados);
        header("Location: ". base_url($pag) );
        exit;
    }else{

        $dados['idcliente'] = $idcliente;
        $dados['idempresa'] = $idempresa;
        $dados['id_solicitante'] = $iduser;
        $dados['fk_tipo_solicitacao'] = $this->input->post('tipo');
        $dados['sol_idfuncionario'] = $this->input->post('colaborador');
        $this->db->insert("solicitacoes", $dados);
        echo $this->db->insert_id();
    }
 }

public function minhaSolicitacao(){

   $iduser = $this->session->userdata('id_funcionario');
   $idempresa = $this->session->userdata('idempresa');
   $idcliente = $this->session->userdata('idcliente');
   $idsolicitacao = $this->input->post('id');
   $tipo = $this->input->post('tipo');
   $dados['pag'] = "";

   $this->db->select('fun_nome, fun_foto, fun_status, fun_sexo, fun_matricula, contr_cargo,  contr_data_admissao, contr_departamento, sal_valor, descricao_solicitacao, descricao_status_solicitacao, solicitacoes.*');

    $this->db->join('funcionario', "fun_idfuncionario = sol_idfuncionario");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("salarios", "sal_idfuncionario = fun_idfuncionario");
    $this->db->where('solicitacao_id', $idsolicitacao);
    $dados['solicitacao'] = $this->db->get('solicitacoes')->row();
    if (!empty($this->input->post('pag'))) {
        $dados['pag'] = $this->input->post('pag');
    }
    
    //recupera o log da solicitação
    $this->db->select('fun_nome, fun_foto, fun_sexo, solicitacao_log.*');
    $this->db->join('funcionario', "fun_idfuncionario = fk_idaprovador");
    $this->db->where('fk_idsolicitacao', $idsolicitacao);
    $dados['log'] = $this->db->get("solicitacao_log")->result();

    //recupera todos os aprovadores
    $this->db->select("fun_nome, fun_foto, fun_sexo");
    $this->db->join('funcionario', "fun_idfuncionario = fk_aprovador");
    $this->db->where('apr_tipo_solicitacao', $dados['solicitacao']->fk_tipo_solicitacao );
    $this->db->where("fun_status", "A");
    $this->db->where('fk_empresa', $idempresa);
    $dados['aprovadores'] = $this->db->get('solicitacao_aprovador')->result();

    
    $this->db->select('fun_nome, fun_idfuncionario');
    $this->db->where('fun_idfuncionario', $iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->row();

    header ('Content-type: text/html; charset=ISO-8859-1');
    switch ($tipo) {
        case '1': $this->load->view('/geral/edit/modal_desl_edit',$dados); break;
        case '3': 
        $this->db->where('idcliente',$idcliente);
        $dados['motivos'] = $this->db->get('motivos')->result();
        $this->load->view('/geral/edit/modal_salario_edit',$dados); 
        break;
        case '4':
        $this->db->where('idcliente',$idcliente);
        $dados['motivos'] = $this->db->get('motivos')->result();
        $this->db->where('idempresa',$idempresa);
        $dados['cargos'] = $this->db->get('tabelacargos')->result();
        $this->load->view('/geral/edit/modal_mudanca',$dados); break;

        default: break;
    }
    

   //echo $idsolicitacao;
 }

public function acao_solicitacao(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcliente = $this->session->userdata('idcliente');

    $id = $this->input->post('id');
    $campo = $this->input->post('campo');
    $valor = $this->input->post('valor');
    $dados[$campo] = $valor;
    $this->db->where("solicitacao_id", $id);
    $this->db->update("solicitacoes", $dados);

    $this->db->select("descricao_solicitacao, fk_tipo_solicitacao, data_hora_solicitacao");
    $this->db->join('solicitacao_tipo', "id_tipo_solicitacao = fk_tipo_solicitacao");
    $this->db->where('solicitacao_id', $id);
    $solic = $this->db->get('solicitacoes')->row();

    $this->db->where('fun_idfuncionario', $iduser);
    $funcionario = $this->db->get('funcionario')->row();


    $this->db->select("fun_nome, fun_email, solicitacao_aprovador.*");
    $this->db->join('funcionario', "fun_idfuncionario = fk_aprovador");
    $this->db->where('apr_tipo_solicitacao', $solic->fk_tipo_solicitacao );
    $this->db->where('fk_empresa', $idempresa);
    $this->db->where("nivel_aprovador", 1);
    $aprovadores = $this->db->get('solicitacao_aprovador')->row();

    switch ($valor) {
        case '2': $acao_feita = "encaminhou"; break;    
        default: break;
    }
    /*
    $datahora = date('Y-m-d H:m:s' , strtotime($solic->data_hora_solicitacao) );
                  list($data, $hora) = explode(" ", $datahora);
                  $data = $this->Log->alteradata1( $data );
    */

    if ($valor==2) {
      
        //notifica o primeiro aprovador
        $noti['descricao_notificacao'] = "Existem solicitações para aprovar";
        $noti['link_notificacao'] = base_url("/gestor/aprovacoes") ;
        $noti['ic_tipo_notificacao'] = 3;
        $noti['fk_idfuncionario'] = $aprovadores->fk_aprovador;
        $this->db->insert("notificacao", $noti);
        
        //envia o email 
        $nome = explode(" ", $aprovadores->fun_nome) ;
        $mensagem = "<h3>Olá ".$nome[0]."</h3>
        <h4>Existem novas solicitações para serem avaliadas</h4>
        <p>".$funcionario->fun_nome. " ". $acao_feita ." uma solicitação de " .$solic->descricao_solicitacao. " </p>
        <p></p>";
        $this->load->library('email');
        $this->email->from('contato@hcmsolucoes.com.br','HCM People');
        $this->email->to($aprovadores->fun_email);
        $this->email->subject( utf8_encode('Novas solicitações para avaliar') );
        $this->email->set_mailtype("html");
        $this->email->message( utf8_encode($mensagem) );
        $this->email->send();

    }

    echo 1;
 }

public function solicitacao_busca(){

    $id = $this->input->post('id');
    $this->db->select("fun_idfuncionario, fun_foto, fun_nome, fun_status, fun_sexo, contr_cargo, fun_matricula, contr_data_admissao, contr_departamento, sal_valor");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("salarios", "sal_idfuncionario = fun_idfuncionario");
    $this->db->where("fun_idfuncionario", $id);
    $this->db->order_by("sal_idsalarios", "desc");

    $dados['colaborador'] = $this->db->get('funcionario')->row();
    $dados['opt'] = $this->input->post('opt');

    header ('Content-type: text/html; charset=ISO-8859-1');
    $this->load->view("/geral/box/solicitacao_colab", $dados);

 }

public function historico(){

    $iduser = $this->input->post('id');
    $historico = $this->input->post('historico');
    $this->db->select('*');
    

    header ('Content-type: text/html; charset=ISO-8859-1');
    switch ($historico) {
        case '1': 
        $this->db->join('motivos', 'motivos.mot_idmotivos = salarios.sal_idmotivo');
        $this->db->where('sal_idfuncionario', $iduser);
        $this->db->order_by('sal_dataini', "desc");
        $this->db->limit(3);
        $dados['histsalarios'] = $this->db->get('salarios')->result();
        $view = "histsalarial"; break;

        case '2': 
        $this->db->join('motivos', 'motivos.mot_idmotivos = histcargos.car_motivo');
        $this->db->join('tabelacargos', 'tabelacargos.idcargo=histcargos.idcargo');
        $this->db->join('empresa', 'empresa.em_idempresa = histcargos.idempresa');
        $this->db->where('car_idfuncionario',$iduser);
        $this->db->order_by("car_inicio", "desc"); 
        $this->db->limit(3);  
        $dados['histcargos'] = $this->db->get('histcargos')->result();
        $view = "histcargos"; break;
        
        default: $view = "histsalarial"; break;
    }
    $this->load->view("/geral/box/".$view, $dados);

 }

public function calendario(){
    $this->Log->talogado(); 
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $idcli = $this->session->userdata('idcliente');
    $this->session->set_userdata('perfil_atual', '2');
    $dados = array('menupriativo' => 'treinamento');

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();
    
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where("idempresa", $idempresa);
    $dados['parametros'] = $this->db->get("parametros")->row();

    $this->db->select('id_calendario, data_inicio, calendario_status, valor, idcurso, nomecurso, ');
    $this->db->join("cursos", "fk_cursotreinamento = idcurso");
    $this->db->order_by("data_inicio", "asc");
    $dados['programacoes'] = $this->db->get('calendariotreinamento')->result();

    //$this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
    //$this->db->where('fk_remetente',$iduser);
    //$this->db->or_where('fk_destinatario',$iduser);
    $dados['cursos'] = $this->db->get('cursos')->result();
    $dados['duracao'] = $this->db->get('tipoduracao')->result();
    $dados['realizacao'] = $this->db->get('tiporealizacao')->result();

    $dados["categorias"] = $this->db->get("lembrete_categoria")->result();            
    $dados['breadcrumb'] = array('Gestor'=>base_url("gestor"), "Treinamentos"=>"#", "Calendário"=>"#" );
    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_treinamento',$dados);
    $this->load->view('/geral/footer'); 
}

public function modalprogramacao(){
    $id = $this->input->post("id");
    $this->db->where("id_calendario", $id);        
    $this->db->join("cursos", "fk_cursotreinamento = idcurso");
    $dados['programacao'] = $this->db->get('calendariotreinamento')->row();

    $dados['cursos'] = $this->db->get('cursos')->result();
    $dados['duracao'] = $this->db->get('tipoduracao')->result();
    $dados['realizacao'] = $this->db->get('tiporealizacao')->result();

    header ('Content-type: text/html; charset=ISO-8859-1');
    $this->load->view("/geral/box/modalprogramacao", $dados);
}

public function ajaxcalendario(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

    $this->db->where('fun_idfuncionario',$iduser);
    $func = $this->db->get('funcionario')->row();
 
    $this->db->join("cursos", "fk_cursotreinamento = idcurso");
    $dados = $this->db->get('calendariotreinamento')->result();

    $this->db->where('fk_empresa_feriado',$idempresa);
    $feriados = $this->db->get('feriado')->result();

   
        foreach ($dados as $key => $value) {
            
            $inicio = date('Y-m-d', strtotime($value->data_inicio));
            $inicio2 = date('d/m/Y', strtotime($value->data_inicio));
            $termino = date('Y-m-d', strtotime($value->data_final. " +1 days") );
            $termino2 = date('d/m/Y', strtotime($value->data_final) );

            $hoje = date("Ymd");
            $dat = date('Ymd', strtotime($value->data_inicio));


            if ( ($value->calendario_status==0) && ($dat < $hoje) ) {
               $cor = "#ffce23";
            }elseif($value->calendario_status==1){
                $cor = "green";
            }else{
                $cor = "";
            }
           
            $arr[] = array('allDay' => "false", 
                "title"=>utf8_encode($value->nomecurso),
                "id"=>$value->id_calendario, 
                "start"=>$inicio, 
                "end"=>$termino,
                "description"=>utf8_encode($value->nomecurso)."<br>".
                "<b>Vagas: </b>".$value->vagas."<br>".
                "<b>Inicio: </b>".$inicio2. "<br><b>Termino: </b>".$termino2."<br>".
                  utf8_encode($value->observacao),
                  "backgroundColor"=>$cor
                );
            }

            foreach ($feriados as $key => $value) {

                $inicio = date('Y-m-d', strtotime($value->data_feriado));
                $arr[] = array('allDay' => "false", 
                    "title"=>utf8_encode($value->descricao_feriado),
                    "id"=>$value->id_feriado."f", 
                    "start"=>$inicio, 
                    "end"=>"",
                    "backgroundColor"=>"#ca0000"
                    );
            }

            echo json_encode($arr);
        }

public function lembretes(){
    $this->Log->talogado(); 
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');

    $this->session->set_userdata('perfil_atual', '2');
    $dados = array(
        'menupriativo' => 'lembretes'
        );
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $iddepart = $dados['funcionario'][0]->fk_departamento;

    $idcli = $this->session->userdata('idcliente');
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where("idempresa", $idempresa);
    $dados['parametros'] = $this->db->get("parametros")->row();

    $this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
    $this->db->where('fk_remetente',$iduser);
    $dados['lembretes'] = $this->db->get('lembrete')->result();

    $dados["categorias"] = $this->db->get("lembrete_categoria")->result();
    $dados['breadcrumb'] = array('gestor'=>base_url('gestor'), "Lembretes"=>"#", "Cadastro de lembrete"=>"#" );
    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_lembrete',$dados);
    $this->load->view('/geral/footer'); 
}

public function excluirprogramacao(){
    $id = $this->input->post("id");
    $this->db->where("id_calendario", $id);
    $this->db->delete("calendariotreinamento");
    $res['status']=1;
    echo json_encode($res);
}

public function conferias(){

    $this->Log->talogado();
    $this->session->set_userdata('perfil_atual', '2');
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $dados = array('menupriativo' => 'ferias' );
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;
    
    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->select("fun_idfuncionario, fun_nome");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fun_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status',"A");
    $dados['equipe'] = $this->db->get('funcionario')->result(); 

    $this->db->join("funcionario", "fun_idfuncionario = fer_idfuncionario");
    $this->db->where('fun_idfuncionario',$iduser);
    $fun = $this->db->get('programacao_ferias')->row();

    $this->db->join("funcionario", "fun_idfuncionario = fer_idfuncionario");
    $this->db->join("chefiasubordinados", "subor_idfuncionario = fer_idfuncionario");
    $this->db->where("chefiasubordinados.chefe_id", $iduser);
    $this->db->where('fun_status',"A");
    $dados['ferias'] = $this->db->get('programacao_ferias')->result();

    if (is_object($fun)) {
       array_push($dados['ferias'], $fun);
    }

    $dados['breadcrumb'] = array('gestor'=>base_url('gestor'), "Ferias"=>"#", "Confirmação de férias"=>"#" );
    $this->load->view('/geral/html_header',$dados);  
    $this->load->view('/geral/corpo_conferias',$dados);
    $this->load->view('/geral/footer'); 
}

public function view_colabsubor(){

    $ids = explode(",", $this->input->post("ids") );
    $this->db->select("fun_idfuncionario, fun_foto, fun_nome, fun_sexo, contr_cargo, em_nome");
    $this->db->join("contratos", "contr_idfuncionario = fun_idfuncionario");
    $this->db->join("empresa", "em_idempresa = fun_idempresa");
    $this->db->where_in("fun_idfuncionario", $ids);
    $dados['pessoas'] = $this->db->get('funcionario')->result();

    header ('Content-type: text/html; charset=ISO-8859-1');
    $this->load->view("/geral/box/modal_colabsubor", $dados);
}

public function aprovar(){
    $id = $this->input->post("id");
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    //$dados['solicitacao_observacao'] = utf8_decode($this->input->post("obs"));
    
    //Resgato os dados da solicitação
    $this->db->select('fun_nome, fun_email, descricao_solicitacao, descricao_status_solicitacao, fk_tipo_solicitacao');
    $this->db->join('funcionario', "fun_idfuncionario = id_solicitante");
    $this->db->join('solicitacao_tipo', "fk_tipo_solicitacao = id_tipo_solicitacao");
    $this->db->join('solicitacao_status', "id_status_solicitacao = solicitacao_status");
    $this->db->where('solicitacao_id',$id);
    $solicitacao = $this->db->get('solicitacoes')->row();

    //resgato os dados do aprovador
    $this->db->where("apr_tipo_solicitacao", $solicitacao->fk_tipo_solicitacao);
    $this->db->where("fk_aprovador", $iduser);
    $aprovador = $this->db->get('solicitacao_aprovador')->row();

    //verifico o total de aprovadores para esta solicitação
    $this->db->select("COUNT(id_apr_sol) AS total");
    $this->db->where('apr_tipo_solicitacao', $solicitacao->fk_tipo_solicitacao);
    $this->db->where('fk_empresa', $idempresa);
    $resultado = $this->db->get('solicitacao_aprovador')->row();

    if ($this->input->post("st")==4) {
        $status = "Rejeitada";
        $dados['solicitacao_status'] = $this->input->post("st");
    }else{
        $status = "Aprovada";
        // verifica se sou o ultimo a aprovar. Caso não seja atualizo o nivel para o próximo aprovador
        if ($resultado->total > $aprovador->nivel_aprovador) {
            $dados['nivel_atual'] = $aprovador->nivel_aprovador + 1;
            
            //envia notificação para o próximo aprovador
            $this->db->select("fk_aprovador");
            $this->db->where("apr_tipo_solicitacao", $solicitacao->fk_tipo_solicitacao);
            $this->db->where("nivel_aprovador", $dados['nivel_atual']);
            $this->db->where('fk_empresa', $idempresa);
            $proximo = $this->db->get('solicitacao_aprovador')->row();
            $noti['descricao_notificacao'] = "Existem solicitações para aprovar";
            $noti['link_notificacao'] = base_url("/gestor/aprovacoes") ;
            $noti['ic_tipo_notificacao'] = 3;
            $noti['fk_idfuncionario'] = $proximo->fk_aprovador;
            $this->db->insert("notificacao", $noti);

        }else{
            //ultimo aprovador muda o status
            $dados['nivel_atual'] = 0;
            $dados['solicitacao_status'] = $this->input->post("st");
        }
    }

    //atualizo o nivel da solicitação
    $this->db->where("solicitacao_id", $id);
    $this->db->update("solicitacoes", $dados);
    //($dados['solicitacao_status']==3)? "Aprovada":"Rejeitada";

    $log['fk_idsolicitacao'] = $id;
    $log['fk_idaprovador'] = $iduser;
    $log['log_comentario'] = utf8_decode($this->input->post("obs"));
    $log['log_status_aprovacao'] = $this->input->post("st");
    $this->db->insert("solicitacao_log", $log);


    //envia o email para o solicitante da solicitação
    $this->load->library('email');
    $mensagem = "<h3>Olá ".$solicitacao->fun_nome." </h3>
            <h4>Novo estado da solicitação de ".$solicitacao->descricao_solicitacao."</h4>
            <p>Sua Solicitação alterada para ".$status."</p>
            <p>".$log['log_comentario']."</p>
            <p>Acesse o sistema People para visualizar</p>";

    $this->email->from('contato@hcmsolucoes.com.br',utf8_encode('Status da solicitação'));
    $this->email->to($solicitacao->fun_email);
    $this->email->subject(utf8_encode('Solicitação vista'));
    $this->email->set_mailtype("html");
    $this->email->message( utf8_encode($mensagem) );
    $this->email->send();
    echo 1;
}

public function modalsolicita(){
    $id = $this->input->post("id");
    $this->db->where("id_calendario", $id);        
    $this->db->join("cursos", "fk_cursotreinamento = idcurso");
    $dados['programacao'] = $this->db->get('calendariotreinamento')->row();

    $dados['cursos'] = $this->db->get('cursos')->result();
    $dados['duracao'] = $this->db->get('tipoduracao')->result();
    $dados['realizacao'] = $this->db->get('tiporealizacao')->result();

    header ('Content-type: text/html; charset=ISO-8859-1');
    $this->load->view("/geral/box/modalprogramacao", $dados);
}

public function salvarAnalise(){
    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    /*
    $im = imagegrabscreen();

    $instancia =$this->session->userdata('instancia');   
    $pasta = FCPATH . '/assets/img/upload/'. $instancia;
    if (!file_exists($pasta)) {
        mkdir($pasta, 0777, true);  //create directory if not exist
    }
    $nome = $this->util->geraString(7);
    imagejpeg($im,  $pasta."/".$nome.".jpg");
    */
    $dados['descricao_analise'] = utf8_decode( $this->input->post("texto") ) ;
    $dados['fk_funcionario_analise'] = $iduser;
    $dados['url_imagem'] = $this->input->post("img");
    //var_dump($dados['descricao_analise']);return;
    $this->db->insert("analisedashboard", $dados);
    echo $this->db->insert_id();

}

public function calendarGestor(){

    $iduser = $this->session->userdata('id_funcionario');
    $idempresa = $this->session->userdata('idempresa');
    $this->db->join("lembrete_categoria", "lembrete.fk_categoria = id_categoria");
    $this->db->join("funcionario", "fun_idfuncionario = fk_destinatario");
    $this->db->where('fk_remetente',$iduser);
    $dados = $this->db->get('lembrete')->result();

    $this->db->where('fk_empresa_feriado',$idempresa);
    $feriados = $this->db->get('feriado')->result();

    $lem = array();
    foreach ($dados as $key => $value) {

        $lem[$value->id_lembrete] = $value;

    }
    
    foreach ($lem as $key => $value) {
        if( substr($value->dt_final_lembrete, 0,4)=="0000" || empty($value->dt_final_lembrete) ){
            $termino = "";
        }else{
            $termino = date('Y-m-d', strtotime($value->dt_final_lembrete. " +1 day") );
        }

        $inicio = date('Y-m-d', strtotime($value->dt_inicio_lembrete));
        $arr[] = array('allDay' => "false", 
            "title"=>utf8_encode($value->titulo_lembrete),
            "id"=>$value->id_lembrete, 
            "start"=>$inicio, 
            "end"=>$termino,
            "description"=> "<b>Para " .utf8_encode($value->fun_nome). "</b><br>" . utf8_encode($value->descricao_lembrete)
            );
    }

    foreach ($feriados as $key => $value) {

        $inicio = date('Y-m-d', strtotime($value->data_feriado));
        $arr[] = array('allDay' => "false", 
            "title"=>utf8_encode($value->descricao_feriado),
            "id"=>$value->id_feriado."f", 
            "start"=>$inicio, 
            "end"=>"",
            "backgroundColor"=>"#ca0000"
            );
    }

    echo json_encode($arr);
}

public function analise(){

    $iduser = $this->session->userdata('id_funcionario');
    /*$this->Log->talogado(); 
    $dados = array( 'menupriativo' => '');
    $idempresa = $this->session->userdata('idempresa');

    $this->db->where('fun_idfuncionario',$iduser);
    $dados['funcionario'] = $this->db->get('funcionario')->result();

    $this->db->select('tema_cor, tema_fundo');
    $this->db->where('fun_idfuncionario',$iduser);
    $dados['tema'] = $this->db->get('funcionario')->result();
    $dados['perfil'] = $this->session->userdata('perfil');

    $this->db->where('feed_idfuncionario_recebe',$iduser);
    $feeds = $this->db->get('feedbacks')->num_rows();
    $dados['quantgeral'] = $feeds;         

    $this->session->set_userdata('perfil_atual', '2');
    $dados['breadcrumb'] = array('Gestor'=>base_url('gestor'), "Minhas Análises"=>"#" );
    $this->load->view('/geral/html_header',$dados);*/
    $this->db->where('fk_funcionario_analise', $iduser);
    $this->db->order_by("id_analise", "desc");
    $dados['analises'] = $this->db->get("analisedashboard")->result();

    header ('Content-type: text/html; charset=ISO-8859-1');
    $this->load->view('/geral/corpo_analise',$dados);          
    //$this->load->view('/geral/footer'); 
}



}