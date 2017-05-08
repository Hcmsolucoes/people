<?php // ver se tem o modulo ponto a ponto
	
	$modulos = explode(",", $this->session->userdata('modulos'));
	
?>

<!-- menu inicio -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
	<a href="<?php echo base_url('gestor') ?>">
    <span class="fa fa-home"></span>
	<span class="xn-text">In�cio</span>
	</a>               
</li>    

<li>
	<a href="#">
	<span class="fa fa-desktop"></span>
	<span class="xn-text">Dashboards</span>
	</a>  
</li>    

<?php if( in_array("pontoaponto", $modulos) ){?>
	<!-- menu ponto a ponto -->
	<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
		<a href="#">
		<span class="fa fa-truck"></span>
		<span class="xn-text">Ponto a Ponto</span>
		</a>
		<ul>
			<li><a href="<?php echo base_url('pontoaponto/parametros') ?>">
				<span class="fa fa-cogs"></span>
				<span class="xn-text">Par�metros</span></a>
			</li>
			<li><a href="<?php echo base_url('pontoaponto/equipamentos_cad') ?>">
				<span class="fa fa-flag"></span>
				<span class="xn-text">Equipamentos</span></a>
			</li>
			<li><a href="<?php echo base_url('pontoaponto/lancamentos_feito') ?>">
				<span class="fa fa-check-square-o"></span>
				<span class="xn-text">Lan�amentos</span></a>
			</li>
		</ul>
	</li>
<?php } ?>

<li class="<?php echo ($menupriativo=="lembretes")? "active":"" ?>">
	<a href="<?php echo base_url('gestor/lembretes') ?>">
	<span class="fa fa-calendar"></span> <span class="xn-text">Calend�rio</span>
    </a>                  
</li> 

<li class="<?php echo ($menupriativo=="minhaequipe")? "active":"" ?>">
	<a href="<?php echo base_url('gestor/equipe'); ?>">
	<span class="fa fa-group"></span>
	<span class="xn-text">Minha Equipe</span></a>
</li>

<li class="xn-openable <?php echo ($menupriativo=="treinamentos")? "active":"" ?>">
	<a href="#">
	<span class="fa fa-mortar-board"></span>
	<span class="xn-text">Treinamentos</span>
	</a>
	<ul>
        <li><a href="<?php echo base_url('gestor/calendario') ?>">
            <span class="fa fa-calendar"></span>
            <span class="xn-text">Calend�rio</span></a>
		</li>
        <li><a href="<?php echo base_url('gestor/cargos') ?>">
            <span class="fa fa-trophy"></span>
            <span class="xn-text">Requisitos de Cargos</span></a>
		</li>
	</ul>
</li>

<li class="xn-openable <?php echo ($menupriativo=="ferias")? "active":"" ?>">
	<a href="#">
    <span class="fa fa-briefcase"></span>
    <span class="xn-text">Gest�o do dia a dia</span></a>
    <ul>
		<li><a href="<?php echo base_url('gestor/conferias') ?>">
			<span class="fa fa-plane"></span>
			<span class="xn-text">Confirma��o de F�rias</span></a>
		</li>
		<!--<li><a href="<?php echo base_url('gestor/ferias') ?>">
			<span class="fa fa-plane"></span>
			<span class="xn-text">Programa��o de f�rias</span></a>
		</li>-->
		<li class="<?php echo ($menupriativo=="aprovacoes")? "active":"" ?>">
			<a href="<?php echo base_url('gestor/aprovacoes'); ?>">
			<span class="fa fa-thumbs-o-up"></span>
			<span class="xn-text">Aprova��es</span></a>
		</li>
        <li class="<?php echo ($menupriativo=="solicitacoes")? "active":"" ?>">
			<a href="<?php echo base_url('gestor/solicitacoes'); ?>">
            <span class="fa fa-retweet"></span>
            <span class="xn-text">Solicita��es</span></a>
		</li>
	</ul>
</li>

<li class="<?php echo ($menupriativo=="newsletter")? "active":"" ?>">
	<a href="<?php echo base_url('home/newsletter') ?>">
    <span class="fa fa-rss"></span> <span class="xn-text">Boletim Informativo</span>
	</a>
</li>