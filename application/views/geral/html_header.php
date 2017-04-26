<?php 
	header('Content-type: text/html; charset=ISO-8859-1');
	function ucwords_improved($s, $e = array())
	{return join(' ',array_map(create_function('$s','return (!in_array($s, ' . var_export($e, true) . ')) ? ucfirst($s) : $s;'), explode(' ', strtolower($s))));}
	setlocale(LC_CTYPE, 'pt_BR');
	
	$cargo="";
	if(isset($funcionario)){
		foreach ($funcionario as $value) {
			$nome = $value->fun_nome;
			$cargo = $value->fun_cargo;
			$matricula = $value -> fun_matricula;
			$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
			$foto = (empty($value->fun_foto) )? base_url("/img/".$avatar.".jpg")  : $value->fun_foto;
			
			$nome  = ucwords_improved($nome, array('da', 'das', 'de', 'do', 'dos', 'e'));
			$cargo = ucwords_improved($cargo, array('da', 'das', 'de', 'do', 'dos', 'e'));
			
		}
	}
	
	$prinome = explode(" ", $nome);
	// $prinome = ucwords(strtolower($prinome)); 
	
	$iduser = $this->session->userdata('id_funcionario');
	
	$idemp = $this->session->userdata('idempresa');
	$this->db->where('em_idempresa', $idemp);
	$empresa = $this->db->get('empresa')->result();
	//var_dump($empresa);
	foreach ($empresa as $key => $value) {
		$nome_empresa = $value->em_nome;
		
		//$nome_empresa = ucwords_improved(htmlentities($nome_empresa), array('da', 'das', 'de', 'do', 'dos', 'e'));
		
	}
	
	$fundo="default";
	$cor="theme-default.css";
	
	if (isset($tema)) {
		$fundo=$tema[0]->tema_fundo;
		$cor=$tema[0]->tema_cor;
	}
	
	$gtatv="";
	$admatv="";
	$colatv="";
	$rhatv="";
	$colicon="";
	$gticon="";
	$admicon="";
	$rhicon="";
	if(isset($perfil)){
		switch ($this->session->userdata('perfil_atual')) {
			case '2': $gtatv="green"; 
			$gticon='<i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;top: -20px;left: 20px;
			font-size: 25px;"></i>'; break;
			case '3': $admatv="green";$admicon='<i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;top: -20px;left: 20px;
			font-size: 25px;"></i>'; break;
			
			case '5': $rhatv="green";$rhicon='<i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;top: -20px;left: 20px;
			font-size: 25px;"></i>'; break;
			
			default: $colatv="green";$colicon='<i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;top: -20px;left: 20px;
			font-size: 25px;"></i>'; break;
		}
	}
	
	
	$notificacoes['qtd'] = 0;
	
	$this->db->select('feedbacks.feed_idfeedback, funcionario.fun_foto, funcionario.fun_nome');
	$this->db->join('funcionario', 'feedbacks.feed_idfuncionario_envia = funcionario.fun_idfuncionario');  
	$this->db->where('feed_idfuncionario_recebe',$iduser);            
	$this->db->where('ic_aprovado', 0);
	$this->db->order_by("feed_idfeedback", "desc");
	
	$feedbacks = $this->db->get("feedbacks")->result();
	if (!empty($feedbacks)) {
		$notificacoes['qtd'] += count($feedbacks);
		$novo = (count($feedbacks)>1)? "novos" : "novo";
		
		foreach ($feedbacks as $key => $value) {
			$desc = "<a href='". base_url()."perfil/feedbacks"."' class='list-group-item fleft' style='width: 100%;'>
			<img src='".$value->fun_foto."' class='pull-left' />                                    
			<p><span class='bold'>".$value->fun_nome."</span><span class='font-sub'> enviou um feedback para você aprovar</span></p>
			</a>";
			$notificacoes['descricao'][] = $desc;
		}
	}
	
	$this->db->where('ic_visualizado', 0);
	$this->db->where('fk_idfuncionario', $iduser);
	$noti = $this->db->get("notificacao")->result();
	
	if (!empty($noti)) {
		
		$notificacoes['qtd'] += count($noti);
		foreach ($noti as $key => $value) {
			switch ($value->ic_tipo_notificacao) {
				case '1': $iconenoti='fa-calendar-o'; break;
				case '2': $iconenoti='fa-comments-o'; break;
				case '3': $iconenoti='fa-thumbs-o-up'; break;
				case '4': $iconenoti='fa-comments-o'; break;				
				default:break;
			}
			if( !empty($value->img_notificacao) ){
				$img = "<img src='".$value->img_notificacao."' class='pull-left' />  ";
				
				}else{ 
				
				$img = "<span class='pull-left fa ".$iconenoti."' style='font-size: 2.0em;' ></span> ";
				
			}
			
			$desc = "<a href='".$value->link_notificacao."' class='list-group-item fleft notificacao' style='width: 100%;' id='".$value->id_notificacao."'>". $img ."
			<p><span class='font-sub'> '".$value->descricao_notificacao."'</span></p>
			</a>";
			$notificacoes['descricao'][] = $desc;
			
		}
		
	}
	
	
?>

<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />
		<title>HCM Soluções</title>  
		<meta name="viewport" content="width=device-width, initial-scale=1">    
		<link rel="icon" href="<?php echo base_url('assets/img/hcm.ico') ?>" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/'.$cor) ?>"/>
		<link rel="stylesheet" type="text/less" href="<?php echo base_url('assets/css/style.css') ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap-switch.css') ?>" >
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery/jquery.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/less.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery/jquery-ui.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/plugins/bootstrap/bootstrap.min.js') ?>"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="<?php echo base_url('js/bootstrap-switch.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jquery.dataTables.min.js') ?>" ></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jquery.complexify.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/k.js') ?>"></script>
		
		<!--select search -->
		<script type="text/javascript" src="<?php echo base_url('js/bootstrap-select.js') ?>"></script>
		<link rel="stylesheet" type="text/css" id="" href="<?php echo base_url('assets/css/bootstrap-select.css') ?>"/>
		
	</head>
	<style type="text/css">
		.teste{

    float: right;
    margin: 0px 7px;
		}
	</style>
	<body>
		<audio id="audio-alert" src="<?php echo base_url('assets/audio/alert.mp3') ?>" preload="auto"></audio>
		<audio id="audio-fail" src="<?php echo base_url('assets/audio/fail.mp3') ?>" preload="auto"></audio>
		
		<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
			<div id="myModalTamanho" class="modal-dialog modal-lg">
				<div class="modal-content" style="max-height:800px; overflow:scroll;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-titl bold" id="titulomodal" style="margin-top: 7px;"></h4>
					</div>
					<div class="modal-body" id="dadosedit" style="display: inline;">                       
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
		
		<div id="tela" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
			<div class="modal-dialog modal-sm">
				<div class="modal-content" style="max-height:595px; ">
					<div class="modal-body" id="corpotela" >
						<div class="acenter">
							<img  src="<?php echo base_url().'assets/img/logo-vert.png' ?>" style="max-width: 100%" >
						</div>
						<span class="bold">Nome da Solução:</span> <span class="font-sub">HCM PEOPLE</span><br>
						<span class="bold">Versão:</span> <span class="font-sub">1.0</span><br>
						<span class="bold">Dados do fornecedor:</span> <span class="font-sub">HCM SOLUÇÕES</span><br>
						<span class="bold">Contatos:</span> <span class="font-sub">contatos@hcmsolucoes.com.br</span><br>
					</div>                   
				</div>
			</div>
		</div><!-- /modal -->
		
		
		<!-- MESSAGE BOX-->
		<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
					<div class="mb-content">
						<p>Deseja realmente sair?</p>                    
						<p>Clique em Não para continuar trabalhando. Clique em Sim para efetuar o Logoff.</p>
					</div>
					<div class="mb-footer">
						<div class="pull-right">
							<a href="<?php echo base_url().'ajax/deslogar' ?>" class="btn btn-success btn-lg">Sim</a>
							<button class="btn btn-default btn-lg mb-control-close">Não</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MESSAGE BOX-->
		
		
		
		<div class="page-container">
			<div class="page-sidebar page-sidebar-fixed scroll mCustomScrollbar _mCS_1 mCS-autoHide">
				<div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0">
					<div id="mCSB_1_container" class="mCSB_container">
						<ul class="x-navigation">
							<li class="xn-logo">
								<?php if(isset($nome_empresa)){ ?>
									<a href="#" data-toggle="modal" data-target="#tela"><?php echo $nome_empresa; ?></a>
								<?php } ?>
								<a href="#" class="x-navigation-control"></a>
							</li>
							<li class="xn-profile">
								<a href="#" class="profile-mini">
								<img src="<?php echo $foto ?>" alt="<?php echo $prinome[0]; ?>"/>
								</a>
								<div class="profile">
									<div class="profile-image">
										<img class="imgcirculo_r" src="<?php echo $foto ?>" alt="<?php echo $prinome[0]; ?>"/>
									</div>
									<div class="profile-data">
										<div class="profile-data-name"><?php echo $prinome[0]; ?></div>
										<div class="profile-data-title"><?php echo $cargo; ?></div>
									</div>                                                                        
								</li>
								<li class="xn-title">
									<div class="row " id="menuprincipal">
										<div class="col-md-3 fleft <?php echo $colatv; ?>">
											<?php echo $colicon; ?>
										    <a href="<?php echo base_url('home') ?>">Colab</a>
										</div>
										
										<?php if($perfil==2 || $perfil==4 || $perfil==6 || $perfil==7){ ?>
											<div class="col-md-3  fleft <?php echo $gtatv; ?>">
												<?php echo $gticon; ?>
											<a href="<?php echo base_url('gestor') ?>">Gestor</a></div>
										<?php } ?>
										
										<?php if ($perfil > 4) { ?>
											<div class="col-md-2  fleft <?php echo $rhatv; ?>">
												<?php echo $rhicon; ?>
												<a href="<?php echo base_url('rh') ?>"> RH</a>
											</div>
										<?php } ?>
										
										<?php if($perfil==3 || $perfil==4 || $perfil==7){ ?>
											<div class="col-md-3  fleft <?php echo $admatv; ?>">
												<?php echo $admicon; ?>
												<a href="<?php echo base_url('admin') ?>">Admin</a>
											</div>
										<?php } ?>                                      
										
									</div>    
								</li>
								
								<?php switch ($this->session->userdata('perfil_atual')) {
									case '1':$this->load->view('/geral/box/menu_colab');break;
									case '2':$this->load->view('/geral/box/menu_gestor');break;
									case '3':$this->load->view('/geral/box/menu_adm');break;
									case '5':$this->load->view('/geral/box/menu_rh');break;
									default:$this->load->view('/geral/box/menu_colab');break;
								}
								
								?>
							</ul><!-- END X-NAVIGATION -->
						</div><!--mCSB_1_container-->
						<div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 32px; max-height: 190px; top: 42px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div>
					</div>
					
					
				</div><!-- END PAGE SIDEBAR -->
				
				
				<!-- PAGE CONTENT -->
				<div class="page-content">
					
					<!-- START X-NAVIGATION VERTICAL -->
					<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
						<!-- TOGGLE NAVIGATION -->
						<li class="xn-icon-button">
							<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
						</li>
						<!-- END TOGGLE NAVIGATION -->
						<!-- SEARCH -->
						<li class="xn-search">
							<form role="form">
								<input type="text" name="search" placeholder="Pesquisar pessoas" class="autocompletar" data-div="busca" />								
							</form>
						</li>
						
						<div class="fleftmobile" id="busca" ></div>
						<!-- END SEARCH -->
						<!-- SIGN OUT -->
						<li class="xn-icon-button pull-right">
							<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
						</li> 
						<!-- END SIGN OUT -->
						<!-- MESSAGES --><?php if( $notificacoes["qtd"]>0){ ?>
							<li class="xn-icon-button pull-right">
								<a href="#"><span class="fa fa-comments"></span></a>
								
								<div class="informer informer-danger"><?php echo $notificacoes["qtd"]; ?></div>
								
								<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
								<div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Mensagens</h3>                                
                                <div class="pull-right">
								<span class="label label-danger"><?php echo $notificacoes["qtd"]; ?> Novas</span>
                                </div>
								</div>
								<div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <?php foreach ($notificacoes["descricao"] as $key => $value) {
								echo $value;
                                }
								?>
								</div>     
								<div class="panel-footer text-center">
                                <a href="#">Ver todas mensagens</a>
								</div>                            
								</div> 
								
								</li><?php } ?> 
								<!-- END MESSAGES -->
								<!-- TASKS -->
								<!--
								<li class="xn-icon-button pull-right">
								<a href="#"><span class="fa fa-tasks"></span></a>
								<div class="informer informer-warning">3</div>
								<div class="panel panel-primary animated zoomIn xn-
								drop-left xn-panel-dragging">
								<div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tarefas</h3>                                
                                <div class="pull-right">
								<span class="label label-warning">3 ativas</span>
                                </div>
								</div>
								<div class="panel-body list-group scroll" style="height: 200px;">                                
                                <a class="list-group-item" href="#">
								<strong>Fechamento Folha Pagamento</strong>
								<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
								</div>
								<small class="text-muted">José Carlos, 25 Março 2017 / 80%</small>
                                </a>
                                <a class="list-group-item" href="#">
								<strong>Apuração do Ponto Colaboradores</strong>
								<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
								</div>
								<small class="text-muted">Pitter Silva, 10 Março 2017 / 75%</small>
                                </a>
                                <a class="list-group-item" href="#">
								<strong>Avaliação Desempenho Gestores</strong>
								<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
								</div>
								<small class="text-muted">José Carlos, 30 Abril 2017 / 95%</small>
                                </a>
                                <a class="list-group-item" href="#">
								<strong>Cálculo PLR 2017</strong>
								<div class="progress progress-small">
								<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
								</div>
								<small class="text-muted">Janaína Silva, 05 Abril 2017 /</small><small class="text-success"> Done</small>
                                </a>                                
								</div>     
								<div class="panel-footer text-center">
                                <a href="pages-tasks.html">Ver todas tarefas</a>
								</div>                            
								</div>                        
								</li>-->
								<!-- END TASKS -->
								</ul><!-- END X-NAVIGATION VERTICAL --> 
								
								<ul class="breadcrumb">
								<?php foreach ($breadcrumb as $key => $value) { ?>
								<li><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
								<?php } ?>								
								</ul>
								
								<!-- START THIS PAGE PLUGINS-->        
								<script type='text/javascript' src='<?php echo base_url('js/plugins/icheck/icheck.min.js') ?>'></script>        
								<script type="text/javascript" src="<?php echo base_url('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') ?>"></script>
								
								<script type="text/javascript" src="<?php echo base_url('js/plugins/scrolltotop/scrolltopcontrol.js') ?>"></script>
								
								<script type="text/javascript" src="<?php echo base_url('js/plugins/morris/raphael-min.js') ?>"></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/morris/morris.min.js') ?>"></script>       
								<script type="text/javascript" src="<?php echo base_url('js/plugins/rickshaw/d3.v3.js') ?>"></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/rickshaw/rickshaw.min.js') ?>"></script>
								<script type='text/javascript' src='<?php echo base_url('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>'></script>
								<script type='text/javascript' src='<?php echo base_url('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>'></script>                
								<script type='text/javascript' src='<?php echo base_url('js/plugins/bootstrap/bootstrap-datepicker.js') ?>'></script>
								<script type='text/javascript' src='<?php echo base_url('js/plugins/bootstrap/bootstrap-timepicker.min.js') ?>'></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/owl/owl.carousel.min.js') ?>"></script>                 
								<script type='text/javascript' src="<?php echo base_url('js/plugins/maskedinput/jquery.maskedinput.min.js') ?>"></script>
								<script type='text/javascript' src="<?php echo base_url('js/plugins/maskedinput/maskmoney.js') ?>"></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/moment.min.js') ?>"></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/daterangepicker/daterangepicker.js') ?>"></script>
								<script type="text/javascript" src="<?php echo base_url('js/plugins/summernote/summernote.js') ?>"></script>
								<!-- END THIS PAGE PLUGINS-->        
								
								<!-- START TEMPLATE -->
								
								
								<script type="text/javascript" src="<?php echo base_url('js/plugins.js') ?>"></script>        
								<script type="text/javascript" src="<?php echo base_url('js/actions.js') ?>"></script>
								<script>
								$( "#feedrecebido" ).click(function(e) {e.preventDefault();window.location.href = "<?php echo base_url().'perfil/feedbacks' ?>";   });
								/*
								var skycons = new Skycons();
								skycons.add("icon1", <?php echo $iconetempo ?>);
								skycons.play();
								*/
								
								$( document ).ready(function() {
								
								$(".notificacao").click(function(){
								
								var idnoti = $(this).attr("id");
								
								$.ajax({          
								type: "POST",
								url: '<?php echo base_url()."ajax/vistoNotificacao"; ?>',
								dataType : 'json',
								data: {
								idnoti: idnoti
								},           
								success: function(msg){
								//console.log(msg);
								if(msg.status === 'erro'){
								
								/* $(".alert").addClass("alert-danger")
								.html("Houve um erro. Contate o suporte.")
								.slideDown("slow");
								$(".alert").delay( 3500 ).hide(500);
								*/
								
								}else {
								
								//$("#it"+id).slideUp("fast");
								
								}
								
								} 
								});
								
								});
								
								$(".autocompletar").keyup(function(){
								
								var busca = $.trim( $(this).val() );    
								var div = $(this).data("div");
								if(busca !=""){
								
								$.ajax({          
								type: "POST",
								url: '<?php echo base_url("ajax/autocompletePerfil"); ?>',
								dataType : 'html',
								data: {
								busca: busca,
								},           
								success: function(msg){
								//console.log(msg);
								if(msg === 'erro'){
								
								$(".alert").addClass("alert-danger")
								.html("Houve um erro. Contate o suporte.")
								.slideDown("slow");
								$(".alert").delay( 3500 ).hide(500);
								
								}else {
								
								$("#"+div).html(msg);
								
								}
								
								} 
								}); 
								}else{
								$("#"+div).html("");
								}//if busca
								});
								
								});
								
								</script>																																																								