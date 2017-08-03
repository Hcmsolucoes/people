<?php // ver se tem o modulo ponto a ponto
$modulos = explode(",", $this->session->userdata('modulos'));
$modpont = false;
foreach ($modulos as $value) {
	if($value == 1){
		$modpont = true; 
	}
}
$iduser = $this->session->userdata('id_funcionario');  
?>	

 <!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
	<a href="<?php echo base_url('home') ?>">
        <span class="fa fa-home"></span><span class="xn-text">Início</span>
    </a>               
</li>    

<!-- menu meu perfil -->
<li class="<?php echo ($menupriativo=="perfil")? "active":"" ?>">
	<a href="<?php echo base_url('perfil/pessoal') ?>">
        <span class="fa fa-user"></span> <span class="xn-text">Meu Perfil</span>
    </a>                  
</li> 


<!--  menu Mensagens e Lembretes -->
<li class="<?php echo ($menupriativo=="lembretes")? "active":"" ?>">
	<a href="<?php echo base_url('perfil/lembretes') ?>">
        <span class="fa fa-calendar"></span> <span class="xn-text">Calendário</span>
    </a>                  
</li>

<li class="<?php echo ($menupriativo=="mensagem")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/mensagem') ?>">
        <span class="fa fa-comments"></span> <span class="xn-text">Mensagens</span>
    </a>                  
</li>

<!-- menu ponto a ponto -->
<?php if($modpont){?>
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
    <a href="#"><span class="fa fa-truck"></span> <span class="xn-text">Ponto a Ponto</span></a> 
	<ul>
        <li><a href="<?php echo base_url('pontoaponto/verpremios')?>">
            <span class="fa fa-money"></span>
            <span class="xn-text">Consultar Prêmios</span></a>
        </li>
    </ul>                      
</li> 
<?php } ?>  

<!-- menu gestão do dia a dia -->
<li class="xn-openable <?php echo ($menupriativo=="gestao")? "active":"" ?>">
    <a href="#"><span class="fa fa-briefcase"></span> <span class="xn-text">Gestão do dia a dia</span></a>
    <ul><?php if (!empty($parametros)) { 
        if($parametros->solicitarferias == 1){ ?>                              
        <li><a href="<?php echo base_url('home/programacao_ferias')?>">
            <span class="fa fa-plane"></span>
            <span class="xn-text">Programação de Férias</span></a>
        </li>
        <?php } } ?>

        <?php if (!empty($parametros)) { 
            if( ($parametros->ic_lancamento == 1) && (isset($lancamento)) ){ ?>
        <li>
            <a href="<?php echo base_url('home/lancamentos') ?>">
                <span class="fa fa-share-square-o"></span>
                <span class="xn-text">Lançamentos</span>
            </a>  
        </li>
        <?php } } ?>
        
        <?php if( isset($admissao) ){ ?>
        <li>
            <a href="<?php echo base_url('home/admissao') ?>">
                <span class="fa fa-plus-circle"></span>
                <span class="xn-text">Admissão</span>
            </a>  
        </li>
       <?php } ?>
        <li><a href="<?php echo base_url('perfil/relatorios'); ?>">
            <span class="fa fa-file-text"></span>
            <span class="xn-text">Relatórios</span></a>
        </li>
    </ul>
</li>

<!-- menu feedback -->
<li class="<?php echo ($menupriativo=="feedback")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/feedbacks') ?>">
        <span class="fa fa-comments-o"></span><span class="xn-text">Feedbacks</span>
    </a>  
</li>

<!-- menu perfil público -->
<li class="<?php echo ($menupriativo=="publico")? "active":"" ?>">
    <a href="<?php echo base_url('perfil/pessoal_publico/'.$iduser); ?>">
        <span class="fa fa-male"></span><span class="xn-text">Perfil Público</span>
    </a>                       
</li>
