<style type="text/css">
	.form-group{
    margin: 25px 0px;
	}
	
</style>
<?php $iduser = $this->session->userdata('id_funcionario'); 
	
	$lem = array();
	foreach ($lembretes as $key => $value) {
		
		$lem[$value->id_lembrete] = $value;
		
	}
?>

<div class="message-box animated fadeIn" data-sound="alert" id="mb-exclembrete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-times"></span> Excluir Lembrete ?</div>
			<div class="mb-content">
				<p>Deseja excluir esse lembrete?</p>                    
				<p>Clique em Não para continuar trabalhando. Clique em Sim apagá-lo.</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<a id="exclembrete" href="#" data-id="" class="btn btn-danger btn-lg mb-control-close ">Sim</a>
					<button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="fleft-10">
		<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>
		
		<!-- START CONTENT FRAME LEFT -->
		<div class="col-md-3" >
			<div class="page-title">                    
				<h2><span class="fa fa-calendar"></span> Calendário</h2>
				<div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div>
			</div>
			<div class="content-frame-left ">
				<div class="fleft-10" style="margin-bottom: 10px;">
					<a href="#addlembrete" id="addlemb" aria-controls="addlembrete" role="tab" data-toggle="tab" class="btn btn-danger btn-block btn-lg">
					<span class="fa fa-edit"></span> <span class="desc">Novo Lembrete</span>
					</a>
				</div>
				
				<div class="fleft-10" style="margin-bottom: 10px;">
					<div class="list-group border-bottom">
						
						<a href="#abacalendario" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item active aba">
						<span class="fa fa-calendar"></span> <span class="desc">Calendário</span>
						</a>
						
						<a href="#lembrete" aria-controls="lembrete" role="tab" data-toggle="tab" class="list-group-item aba">
						<span class="fa fa-calendar"></span> <span class="desc">Meus Lembretes</span>
						</a>
						
					</div>                        
				</div>
			</div>
		</div>
		<!-- END CONTENT FRAME LEFT -->
		
		<div class="col-md-9">
			
			<div class="tab-content">
				<?php //echo $sql; ?>
				<div role="tabpanel" class="tab-pane " id="lembrete">
					
					<div class="widget widget-default">
						<h3 class=""><span class="fa fa-calendar"></span> Meus Lembretes</h3>
						<div class="col-md-12">
							<table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
								<thead>
									<tr>
										<th>Titulo</th>
										<th>Descrição</th>
										<th>Data de aviso</th>
										<th>Recorrente</th>
										<th>Categoria</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
										
										foreach ($lem as $key => $value) {
											
											$recor = ($value->ic_recorrente_lembrete==1)?"Sim":"Não";
											$data = "Não Preenchido";
											if (!empty($value->dt_inicio_lembrete)) {
												
												$data = date('d/m/Y', strtotime($value->dt_inicio_lembrete));// $this->Log->alteradata1($datalembrete);
												
											}
										?>
										<tr id="lembrete<?php echo $value->id_lembrete; ?>" data-titulo="<?php echo $value->titulo_lembrete; ?>" data-id="<?php echo $value->id_lembrete; ?>" class="lembrete" >
											<td><?php echo $value->titulo_lembrete; ?></td>
											<td><?php echo substr($value->descricao_lembrete, 0, 30)."..."; ?></td>
											<td><?php echo $data; ?></td>
											<td><?php echo $recor; ?></td>
											<td><?php echo $value->desc_categoria; ?></td>
											<td>
												<?php 
													if($value->fk_remetente==$iduser){ ?>
													<span data-id="<?php echo $value->id_lembrete; ?>" data-box="#mb-exclembrete" class="fa fa-times  mb-control exclemb" style="cursor: pointer;margin-right: 20px;"></span> 
												<?php } ?>
												<span data-id="<?php echo $value->id_lembrete; ?>" class="fa fa-eye lembrete" style="cursor: pointer;"></span>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								
							</table>
						</div>
					</div>
					
				</div>
				
				<div role="tabpanel" class="tab-pane" id="addlembrete">
					<form id="formlembrete">
						<div class="widget widget-default">
						<h3 class=""><span class="fa fa-edit"></span> Novo Lembrete</h3>
						
						
						<div class="col-md-8 centralizar">
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">Categoria</label>
									<div class="col-md-6">
										<select name="categoria" id="categoria" required="">
											<option value="">-- Escolha a categoria --</option>
											<?php foreach ($categorias as $key => $value) { ?>
												<option value="<?php echo $value->id_categoria; ?>"><?php echo $value->desc_categoria; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">Título</label>
									<div class="col-md-6">
										<input type="text" class="" name="titulo" placeholder="Dê um titulo ao lembrete" style="width: 100%;" />
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">Descrição</label>
									<div class="col-md-6">
										<textarea class="form-control" name="descricao" placeholder="Descreva seu lembrete" rows="4"></textarea>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div id="destinatarios" style="display: none;">
									<div class="form-group">
										<label class="col-md-3 control-label font-sub">Departamentos</label>
										<div class="col-md-6">
											<div class="autocomplete" >                           
												<input type="text" id="busca_dep" data-campo="departamento" data-div="div_dep" class="autocompletar form-control" placeholder="" style="width: 60px;background: transparent;" />
												<div id="div_dep"></div>
											</div>
										</div>              
									</div>
									
									<div class="clearfix"></div>
									
									<div class="form-group">
										<label class="col-md-3 control-label font-sub">Colegas de trabalho</label>
										<div class="col-md-6">
											<div class="autocomplete" >
												<input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="div_colab" class="autocompletar form-control" placeholder="" style="width: 60px;background: transparent;"/>
												<div id="div_colab"></div>
											</div>
										</div>
									</div>
									
									
								</div> <!-- destinatarios div -->
								
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">O lembrete é recorrente?</label>
									<div class="col-md-6">
										<select name="recorrente" id="select_recorrente">
											<option value="0">Não</option>
											<option value="1">Sim</option>
										</select>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">Data para aviso</label>
									<div class="col-md-3" style="margin-right: 10px;">
										<div class='input-group date' >
											<input type="text" class="data" name="data_aviso" id="data_aviso" placeholder="Data" style="max-width: 90px;" />              
											<span class="input-group-addon">
												<span class="fa fa-calendar" id='data1'></span>
											</span>
										</div> 
									</div>
									<div class="col-md-3">
										<div class='input-group date' >
											<input type="text" class="hora" name="hora_aviso" id="hora_aviso" placeholder="Hora" style="max-width: 75px;" />
											<span class="input-group-addon">
												<span class="fa fa-clock-o" id='hora1'></span>
											</span>
										</div>
									</div>          
								</div>
								
								<div class="clearfix"></div>
								
								<div id="recorrente" style="display: none;">
									<div class="form-group">
										<label class="col-md-3 control-label font-sub">Data de término do aviso</label>
										<div class="col-md-3" style="margin-right: 10px;">
											<div class='input-group date' >
												<input type="text" class="data" name="data_termino" id="data_termino" placeholder="Data" style="max-width: 90px;" />
												<span class="input-group-addon">
													<span class="fa fa-calendar" id='data2'></span>
												</span>
											</div>
										</div>
										<div class="col-md-2">
											<div class='input-group date' >
												<input type="text" class="hora" name="hora_termino" id="hora_termino" placeholder="Hora" style="max-width: 75px;" />
												<span class="input-group-addon">
													<span class="fa fa-clock-o" id='hora2'></span>
												</span>
											</div>
										</div>
									</div>
									
									<div class="clearfix"></div>
									
									<div class="form-group">
										<label class="col-md-3 control-label font-sub">Período</label>
										<div class="col-md-6">
											<select name="periodo">
												<option value="1">Diáriamente</option>
												<option value="2">Semanalmente</option>
												<option value="3">Mensalmente</option>
												<option value="4">Anualmente</option>
											</select>
										</div>
									</div>
								</div><!--fim div recorrente-->
								<div class="clearfix"></div>
								
								<div class="form-group">
									<label class="col-md-3 control-label font-sub">Sem validade</label>
									<div class="col-md-6">
										<label class="check"><input type="checkbox" class="icheckbox" name="validade" id="validade" /> Sem prazo para terminar</label>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<input type="submit" value="Salvar" class="btn btn-info" />
								<img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
								<div id="selecionados"></div>
							</form>
						</div><!--md6-->
					</div>
				</div><!-- add lembrete -->
				
				<div role="tabpanel" class="tab-pane active" id="abacalendario">
					
					<div class="widget widget-default">
						<div class="col-md-12">
							<div class="calendar">                                
								<div id="calendario"></div>                            
							</div>
						</div>
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="minhasmensagens">
					
					<div class="widget widget-default">
						<div class="col-md-12">
							<div class="messages messages-img">
								<?php 
									
									$primsg = "";
									foreach ($msg_recebidas as $key => $value) { 
										$in = ($value->fk_remetente_mensagem==$iduser)? "in" : "" ;
										list($data, $hora) = explode(" ", $value->datahora_mensagem);
										$data = $this->Log->alteradata1( $data );
										$primsg = $value->id_mensagem;
										
									?>
									<div class="item <?php echo $in; ?>" id="it<?php echo $value->id_mensagem; ?>">
										<div class="image">
											<img src="<?php echo $value->fun_foto; ?>">
										</div>
										
										<div class="text">
											
											<div class="heading">
												<a href="#"><?php echo $value->fun_nome; ?></a>
												
												<span class="date"><?php echo $data." ".substr($hora, 0, 5); ?></span>
												
												<div class="clearfix"></div>
												
												<span class="btn btn-default excmsg fright" id="<?php echo $value->id_mensagem; ?>" >
													Excluir <span class="fa fa-times" ></span>
												</span>
												
											</div>
											<span><?php echo $value->texto_mensagem; ?></span>
										</div>
									</div>
									<?php }
									$this->session->set_userdata('primsg', $primsg);
								?>
								<span class="label label-default" id="vermais" data-fim="<?php echo $primsg; ?>" style="cursor: pointer;">Ver mais...</span>
								<img id="msgload" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
								
							</div>
						</div>
					</div>
				</div><!--tab recebidas-->
				
			</div><!--tab content -->
		
		
		</div>
	</div>
</div>

<script type='text/javascript' src='<?php echo base_url('js/plugins/icheck/icheck.min.js') ?>'></script>        
<script type='text/javascript' src='<?php echo base_url('js/plugins/fullcalendar/fullcalendar.min.js') ?>'></script>
<script type='text/javascript' src='<?php echo base_url('js/plugins/fullcalendar/lang/pt-br.js') ?>'></script>               
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$(document).on("click", ".excmsg", function(){
			
			var id = $(this).attr("id");
			$("#it"+id).slideUp("slow");
			
			$.ajax({          
				type: "POST",
				url: '<?php echo base_url()."ajax/excluirmensagens"; ?>',
				dataType : 'json',
				data: {
					id: id
				},           
				success: function(msg){
					//console.log(msg);
					if(msg.status === 'erro'){
						
						$(".alert").addClass("alert-danger")
						.html("Houve um erro. Contate o suporte.")
						.slideDown("slow");
						$(".alert").delay( 3500 ).hide(500);
						
						}else {
						
						$("#it"+id).slideUp("fast");
						
					}
					
				} 
			});
		});
		
		$(".exclemb").click(function(){
			
			var id = $(this).data("id");
			$("#exclembrete").data("id", id);
			
		});
		
		$("#nao").click(function(){
			
			$("#exclembrete").data("id", "");
			
		});
		
		$("#exclembrete").click(function(){
			var id = $(this).data("id");
			
			$.ajax({          
				type: "POST",
				url: '<?php echo base_url("ajax/excluirLembrete"); ?>',
				dataType : 'json',
				data: {
					id: id
				},           
				success: function(msg){
					//console.log(msg);
					if(msg.status === 'erro'){
						
						$(".alert").addClass("alert-danger")
						.html("Houve um erro. Contate o suporte.")
						.slideDown("slow");
						$(".alert").delay( 3500 ).hide(500);
						
						}else {
						
						$("#lembrete"+id).hide("fast");
						
					}
					
				} 
			});
		});
		
		$(".lembrete").click(function(){
		var id = $(this).data("id");
		var titulo = $(this).data("titulo");
		$("#titulomodal").text(titulo);
		$( "#dadosedit" ).html("");
		$("#myModalTamanho").removeClass("modal-lg");
		$('#myModal').modal('show');
		
		$.ajax({             
        type: "POST",
        url: '<?php echo base_url('ajax/modaLembrete') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
		id: id
        },              
        success: function(msg) 
        {    
		
		$( "#dadosedit" ).html(msg);
		
        } 
		});
		
		});
		
		$("#vermais").click(function(){
		
		var fim = parseInt( $(this).data("fim") ) ;
		$("#msgload").show();
		
		$.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/maismensagens"; ?>',
        dataType : 'json',
        data: {
		fim: fim
        },           
        success: function(msg){
		//console.log(msg.mensagens);
		if(msg.status === 'erro'){
		
		$(".alert").addClass("alert-danger")
		.html("Houve um erro. Contate o suporte.")
		.slideDown("slow");
		$(".alert").delay( 3500 ).hide(500);
		
		}else {
		
		$("#vermais").data("fim", msg.fim);
		$("#vermais").before(msg.mensagens);
		
		}
		
        } 
		})
		.done(function( data ) {
        $("#msgload").hide();
		}); 
		
		});
		
		$('#calendario').fullCalendar({
		header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
		},
		weekNumbers: true,
		navLinks: true,
		events: '<?php echo base_url("ajax/calendarLembretes"); ?>',
		selectable: true,
		eventRender: function (event, element) {
        element.popover({
		html: true,
		title: event.name,
		placement: 'top',
		trigger: 'hover',
		content: event.description
        });
		}
		});
		
		$('#tabela').DataTable({
		"language": {
        "paginate": {
		"next": "Avan&ccedil;ar", previous: "Voltar"
		},
		"lengthMenu": "Mostrar _MENU_ linhas por p&aacute;gina",
		"search":"Filtrar",
		"zeroRecords": "Nada encontrado",
		"info": "Exibindo _PAGE_ de _PAGES_",
		"infoEmpty": "Nenhum registro encontrado"          
		}
		});
		
		
		$(".autocomplete").click(function(){
		$(this).find("input[type=text]").focus();
		});
		
		$(".icheckbox,.iradio").iCheck({
		checkboxClass: 'icheckbox_minimal-grey',
		radioClass: 'iradio_minimal-grey'
		
		});
		
		$('#radiotodos').on("ifUnchecked", function(){
		$("#destinatarios").slideDown();
		});
		
		$('#radiofiltro').on("ifUnchecked", function(){
		$("#destinatarios").slideUp();
		});
		
		$('#validade').on("ifChecked", function(){
		$("#data_termino, #hora_termino").val("").prop( "disabled", true );
		});
		$('#validade').on("ifUnchecked", function(){
		$("#data_termino, #hora_termino").prop( "disabled", false );
		});
		
		$("#select_recorrente").change(function(){
		if($(this).val()==1){
        $("#recorrente").slideDown();
		}else{
        $("#recorrente").slideUp();
        $("#data_termino, #hora_termino").val("");
		}
		});
		
		$('.data').datepicker({
		format: 'dd/mm/yyyy'
		});
		
		$('.hora').timepicker({
		showMeridian: false
		});
		
		$(".autocompletar").keyup(function(){
		
		var busca = $.trim( $(this).val() );
		var campo = $(this).data("campo");
		var div = $(this).data("div");
		var classe = $(this).data("classe");
		if(busca !=""){
		
        $.ajax({          
		type: "POST",
		url: '<?php echo base_url()."ajax/autocompleteLembrete"; ?>',
		dataType : 'html',
		data: {
		busca: busca,
		classe: classe,
		campo: campo
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
        $("#div_dep, #div_colab").html("");
		}//if busca
		});
		
		$(document).on("click",".exc", function(){
		var id = $(this).attr("rm");
		
		$("#dep"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#depart"+id).remove();
		});
		
		
		$("#colabor"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabs"+id).remove();
		});
		
		
		});
		
		//click no item do autocompletar departamento
		$(document).on("click",".itemdep", function(){
		var nome = $(this).data("nome");
		var id = $(this).attr("id");    
		
		$("#busca_dep").val("");
		
		$("#busca_dep").before("<div class='btn btn-default fleft' id='dep"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
		$("<input type='hidden' name='depts[]' id='depart"+id+"' value='"+id+"' >").appendTo("#selecionados");
		
		$("#div_dep").html(""); 
		
		});
		
		//click no item do autocompletar colaborador
		$(document).on("click",".itemcolab", function(){
		var nome = $(this).data("nome");
		var id = $(this).attr("id");    
		
		$("#busca_colab").val("");
		
		$("#busca_colab").before("<div class='btn btn-default fleft' id='colabor"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
		$("<input type='hidden' name='colabs[]' id='colabs"+id+"' value='"+id+"' >").appendTo("#selecionados");
		
		$("#div_colab").html(""); 
		
		});
		
		$(document).on("click",".itemcolabmsg", function(){
		var nome = $(this).data("nome");
		var id = $(this).attr("id");    
		
		$("#msgcolab").val("");
		
		$("#msgcolab").before("<div class='btn btn-default fleft' id='colabor"+id+"'>"+nome+" <i rm='"+id+"' class='fa fa-times exc'> </i></div>");
		$("<input type='hidden' name='colabs[]' id='colabs"+id+"' value='"+id+"' >").appendTo("#msgselecionados");
		
		$("#div_colabmsg").html(""); 
		
		});
		
		$("#formlembrete").on("submit", function(e){
		
		$("#load").show();
		e.preventDefault();
		
		$.ajax({          
        type: "POST",
        url: '<?php echo base_url("ajax/salvarLembrete"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),
		
        success: function(msg){
		//console.log(msg);
		if(msg === 'erro'){
		
		$(".alert").addClass("alert-danger")
		.html("Houve um erro. Contate o suporte.")
		.slideDown("slow");
		$(".alert").delay( 3500 ).hide(500);
		
        }else if(msg>0){
		
		window.location.href = '<?php echo base_url("perfil/lembretes"); ?>';
		
		}
		
		} 
		});
		
		});
		
		$("a").click(function(){
		
		$(".aba").removeClass("active");
		
		if( $(this).hasClass("list-group-item") ){        
        
        $(this).addClass("active");
		
		}
		});
		
		$(".del").click(function(){
		
		var id = $(this).attr("id");
        //$("#it"+id).slideUp("slow");
		
        $.ajax({          
		type: "POST",
		url: '<?php echo base_url("ajax/excluirmensagens"); ?>',
		dataType : 'json',
		data: {
		id: id,
		acao: "del"
		},           
		success: function(msg){
		console.log(msg);
		if(msg.status === 'erro'){
		
		$(".alert").addClass("alert-danger")
		.html("Houve um erro. Contate o suporte.")
		.slideDown("slow");
		$(".alert").delay( 3500 ).hide(500);
		
		}else {
		
		$("#it"+id).slideUp("fast");
		
		}
		
		} 
        });
		});
		
		$(".list-group-item, #addlem, #addm").click(function(){
		var texto = $(this).find(".desc").text();
		//$("#itematual").html(" > "+texto);
		
		});
		
		});
		
		</script>
		
				