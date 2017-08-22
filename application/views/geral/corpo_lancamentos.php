<div class="page-title">                    
	<h2><span class="fa fa-share-square-o"></span> Lançamentos</h2>
</div>

<div class="row">
	<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

	<div class="col-md-12">

		<form id="form_lancamento" name="form_lancamento" method="post" class="fleft-4 fleftmobile" >
		<!--<input type="hidden" id="competencia" name="competencia" value="<?php echo $competencia->id_competencia; ?>">-->
			<?php 
			$hoje = date('Y-m');
			$anomes_anterior = date('Y-m', strtotime('-1 months', strtotime($hoje.'-01')));
			$ano = substr($anomes_anterior, 0,4);
			$mes = substr($anomes_anterior, 6, 2);
			$periodo = substr($this->util->mes_extenso($mes), 0, 3)."/".$ano;
			?>
			<!--<label class="label label-default label-form" style="font-size: 1.2em;">
				Período: <?php //echo $this->Log->alteradata1($competencia->mes_competencia); ?>
			</label>-->
			<!--<input type="hidden" name="periodo" value="<?php echo str_pad($mes, 2, "0", STR_PAD_LEFT)."/".$ano; ?>">-->

			<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>

			<select name="fk_lancamento_empresa" required="true" id="cboempresa" class="" data-toggle="tooltip" data-placement="top" title="Empresa" style="margin: 0px 0px 5px 0px;">
				<option value="">Empresa</option>
				<?php foreach ($empresas as $key => $value) { ?>
				<option value="<?php echo $value->em_idempresa; ?>"><?php echo $value->em_nome; ?></option>
				<?php } ?>
			</select>

			<select name="competencia" id="competencia" style="margin: 0px 0px 5px 0px;" required >
				<option value="0">Competência</option>
			</select>

			<select name="selectcolab" required="true" id="selectcolab" class="selectpicker" data-live-search="true" data-div="resultado">
				<option value="0">Colaborador</option>
				<?php //foreach ($colaboradores as $key => $value) { ?>
				<!--<option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>-->
				<?php //} ?>
				
			</select>

			<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>

			<!--<select name="selectevento" required="true" id="selectevento" class="selectpicker" data-live-search="true" data-div="resultado">
				<option value="">Evento</option>
				<?php foreach ($eventos as $key => $value) { ?>
				<option value="<?php echo $value->idevento; ?>" tipo="<?php echo $value->tipo_campo; ?>"><?php echo $value->descricao; ?></option>
				<?php } ?>
			</select>-->
			<?php $i = 0; foreach ($eventos as $key => $value) { ?>
				<span class="fleft-4"><?php echo $value->CodigoEvento." - ".$value->descricao; ?></span>
				
				<?php if ( ($value->tipo_campo==1) || ($value->tipo_campo==3) ) { ?>
					<div id="" class="input-group fleft-3 fleftmobile" >
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-time"></span>
						</span>
						<input class="hora" type="text" name="hora[<?php echo $i ?>]" placeholder="Horas" style="width: 70px;">
					</div>
					<input type="hidden" name="eventos[<?php echo $i; ?>]" value="<?php echo $value->idevento; ?>">
				<?php $i++; } 
					if ( ($value->tipo_campo==2) || ($value->tipo_campo==3) ) {	?>
					<div id="" class="input-group " >
						<span class="input-group-addon"><span class="bold">R$</span></span>
						<input type="text" name="valor[<?php echo $i; ?>]" class="campomoeda" placeholder="Valor" style="width: 90px;">		
					</div>
					<input type="hidden" name="eventos[<?php echo $i; ?>]" value="<?php echo $value->idevento; ?>">
					<?php $i++; } ?>
				<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>

				<?php } ?>

			<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>

			<!--<div id="hora" class="input-group fleft-1" style="margin: 0px 10px 0px 0px; display: none;">
				<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
				<input type="text" name="hora" class="hora" placeholder="Horas" >				
			</div>

			<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>

			<div id="valor" class="input-group fleft-1" style="margin: 0px 10px 0px 0px; display: none;">
				<span class="input-group-addon"><span class="bold">R$</span></span>
				<input type="text" name="valor" class="campomoeda" placeholder="Valor" >		
			</div>

			<div class="clearfix" style="margin: 0px 0px 5px 0px;"></div>-->

			<input type="submit" value="Salvar" class="btn btn-primary">
			<img id="loadlanc" src="<?php echo base_url('img/loaders/default.gif') ?>" style="display: none;" >
		</form>

		<div class="fleft" id="grid"></div>

	</div>


</div>

<script type="text/javascript">

	$('.hora').mask("999:99");
	$('.hora').keyup(function(){
		var min = $(this).val().substr(3, 2);
		if (min>59) {
			var h = $(this).val().substr(0, 3);
			$(this).val(h + "59");
		}
	});

	$('.data').datepicker({

		format: 'dd/mm/yyyy'
	});

	$(".campomoeda").maskMoney({thousands:'.',decimal:','});

	$("#selectevento").change(function(){

		$("#hora, #valor").hide();
		//console.log($("#selectevento option:selected").attr("tipo"));

		switch( $("#selectevento option:selected").attr("tipo") ){
			case "1": $("#hora").show("slow"); break;
			case "2": $("#valor").show("slow"); break;
			case "3": $("#hora, #valor").show("slow"); break;
			default: $("#hora, #valor").hide(); break;
		}
	});

	$("#form_lancamento").submit(function(e){
		e.preventDefault();
		$("#loadlanc").show();

		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/salvarLancamento"); ?>',
			cache: false,
			data: $( this ).serialize(),

			success: function(msg){

				if(msg === 'erro'){

					$(".alert").addClass("alert-danger")
					.html("Houve um erro. Contate o suporte.")
					.slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);

				}else{
					$("#loadlanc").hide();
					$("#grid").html(msg);          
				}
				$(".hora, .campomoeda").val("");
			}
		});
	});

	$("#selectcolab").change(function(){
		$("#loadlanc").show();

		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/salvarLancamento"); ?>',
			cache: false,
			data: {
				selectcolab: $("#selectcolab").val(),
				competencia: $("#competencia").val()
			},
			success: function(msg){

				if(msg === 'erro'){

					$(".alert").addClass("alert-danger")
					.html("Houve um erro. Contate o suporte.")
					.slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);

				}else{
					$("#loadlanc").hide();
					$("#grid").html(msg);          
				}
			}
		});
	});

	$("#cboempresa").change(function(){
		$("#loadlanc").show();
		$("#selectcolab").html('<option value="0">Colaborador</option>');
		$("#competencia").html('<option value="0">Aguarde...</option>');
		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/combofuncionarios"); ?>',
			cache: false,
			data: {
				idempresa: $("#cboempresa").val(),
			},
			success: function(msg){

				if(msg === 'erro'){

					$(".alert").addClass("alert-danger")
					.html("Houve um erro. Contate o suporte.")
					.slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);

				}else{
					$("#loadlanc").hide();
					$("#selectcolab").html(msg);
					$("#selectcolab").selectpicker('refresh');
				}
			}
		});

		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/periodosempresa"); ?>',
			cache: false,
			data: {
				idempresa: $("#cboempresa").val(),
			},
			success: function(msg){

				if(msg === 'erro'){

					$(".alert").addClass("alert-danger")
					.html("Houve um erro. Contate o suporte.")
					.slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);

				}else{
					$("#loadlanc").hide();
					$("#competencia").html(msg);
				}
			}
		});

	});

	$(document).on("click", ".delanc", function(){
		
		var id = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/excluirLancamento"); ?>',
			cache: false,
			data: {
				id: id
			},success: function(msg){

				if(msg === 'erro'){

					$(".alert").addClass("alert-danger")
					.html("Houve um erro. Contate o suporte.")
					.slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);

				}else{
					$("#"+id).parent().parent().remove();
				}
			}
		});
	});
</script>