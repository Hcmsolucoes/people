<?php 
$pess="";
$prof="" ;
$acd="" ; 
$intr="" ;
 $cntr="" ;
 $feed="" ;
$pub="" ;
$familiar ="";
switch($menu_colab_perfil){
	case "pessoal": $pess="active" ; break;
	case "profissional": $prof="active" ; break;
	case "academico": $acd="active" ; break;
	case "familiar": $familiar ="active";break;
	
	case "publico": $pub="active" ; break;
	
}



?>

<div id="page-nav">
		
		<ul class="nav nav-tabs">
		<?php if($menu_colab_perfil != 'publico'){ ?>
            <li class="<?php echo $pess; ?>"><a href="<?php echo base_url().'perfil/pessoal' ?>">Dados Pessoais</a></li>
            <li class="<?php echo $familiar; ?>"><a href="<?php echo base_url().'perfil/familiar' ?>">Ficha Familiar</a></li>
            <li class="<?php echo $prof; ?>"><a href="<?php echo base_url().'perfil/profissional' ?>">Perfil Profissional</a></li>
            <li class="<?php echo $acd; ?>"><a href="<?php echo base_url().'perfil/academico' ?>">Perfil Acadêmico</a></li>
			<!--<li class="<?php echo $intr; ?>"><a href="<?php echo base_url().'perfil/interessepessoal' ?>">Interesses Pessoais</a></li>-->
			
        <?php } ?>

		</ul>
				
	</div>


<!--<div class="list-group" style=" border: none;">
    <?php if($menu_colab_perfil != 'publico'){ ?>
    <a href="<?php echo base_url().'perfil/pessoal' ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'pessoal'){ echo 'active';} ?>" ><span class="glyphicon glyphicon-user"></span> Dados Pessoais  </a>
    <a href="<?php echo base_url().'perfil/profissional' ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'profissional'){ echo 'active';} ?>"><span class="glyphicon glyphicon-book"></span> Perfil Profissional</a>
    <a href="<?php echo base_url().'perfil/academico' ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'academico'){ echo 'active';} ?>"><span class="glyphicon glyphicon-education"></span> Perfil Acadêmico</a>
    <a href="<?php echo base_url().'perfil/interessepessoal' ?>" class="list-group-item nbordlate"><span class="glyphicon glyphicon-heart <?php if($menu_colab_perfil == 'interesse'){ echo 'active';} ?>"></span> Interesses Pessoais</a>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'contrato'){ echo 'active';} ?>">
        <span class="glyphicon glyphicon-file"></span> Contrato de Trabalho</a>
        <div id="collapseTwo" class="panel-collapse collapse" style=" font-size: 11px;">
            <a href="<?php echo base_url().'perfil/contrato_demonstrativo' ?>"  class="list-group-item nbordlate <?php if($menu_colab_perfil_contrato == 'demonstrativo'){ echo 'active2';} ?>">
            <span class="glyphicon glyphicon-list-alt" style=" padding-left: 10px"></span> Demonstrativos de Pagamento</a>
                
            <a href="<?php echo base_url().'perfil/contrato_remuneracao_anual' ?>"  class="list-group-item nbordlate <?php if($menu_colab_perfil_contrato == 'remuneracao'){ echo 'active2';} ?>">
            <span class="glyphicon glyphicon-tasks" style=" padding-left: 10px"></span> Resumo Remuneração Anual</a>
                       
            <a href="<?php echo base_url().'perfil/contrato_contratos' ?>"  class="list-group-item nbordlate <?php if($menu_colab_perfil_contrato == 'contratos'){ echo 'active2';} ?>">
            <span class="glyphicon glyphicon-file" style=" padding-left: 10px"></span>Contrato de Trabalho</a>
        </div>            
    <a href="<?php echo base_url().'perfil/feedbacks' ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'feedback'){ echo 'active';} ?> "><span class="glyphicon glyphicon-thumbs-up"></span> Feedbacks</a>
    <a href="<?php echo base_url().'perfil/pessoal_publico/'.$this->session->userdata('id_funcionario') ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'publico'){ echo 'active';} ?>"><span class="glyphicon glyphicon-globe"></span> Perfil público</a>
    <?php }else{ ?>
    <a href="<?php echo base_url().'perfil/pessoal_publico/'.$this->session->userdata('id_funcionario') ?>" class="list-group-item nbordlate <?php if($menu_colab_perfil == 'publico'){ echo 'active';} ?>"><span class="glyphicon glyphicon-globe"></span> Perfil público</a>    
    <?php } ?>
</div>-->