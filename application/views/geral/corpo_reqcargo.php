<div class="row">

<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

	<div class="col-md-12">
		<h2><i class="glyphicon glyphicon-link"></i> Cargo x Curso</h2>
		<div class="widget widget-default">

			<div class="fleft fleftmobile">
				<label>Escolha o Cargo</label><br>
				<select name="cargo" id="cargo" class="">
					<option value="">Cargo</option>
					<?php foreach ($cargos as $key => $value) { ?>
					<option value="<?php echo $value->idcargo; ?>"><?php echo $value->descricao; ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="clearfix" style="margin: 20px 0px;"></div>

			<div id="curcarg" style="display: none;"></div>

			<div class="clearfix" style="margin: 20px 0px;"></div>
			<form id="">
				<div class="fleft">
					<div class="panel panel-default fleft-7 fleftmobile">
						<div class="panel-heading ui-draggable-handle">
							<h3 class="">Lista de Cursos</h3>
						</div>

						<div class="fright" style="margin: 10px;">
							<span class="bold red" style="margin: 0px 25px 0px 0px;">Obrigatório</span>
							<span class="bold green">Desejável</span>
						</div>

						<div class="panel-body scroll mCustomScrollbar _mCS_4 mCS-autoHide" style="height: 250px;"><div id="mCSB_4" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0">

							<ul class="list-group border-bottom">
								<?php 
								$i = 0; 
								foreach ($cursos as $key => $value) { 
									$cor = ($i % 2 == 0)? "#fff" : "#f5f5f5";
									$i++;
									?>

									<li class="list-group-item" style="background-color: <?php echo $cor; ?>">
										<span><?php echo $value->nomecurso; ?></span>
										<div class="fright">
											<label class="check" style="margin: 0px 60px 0px 0px;">
												<input type="radio" class="iradio icheckbox" data-id="<?php echo $value->idcurso; ?>" name="iradio[<?php echo $value->idcurso; ?>]" value="1" />
											</label>
											<label class="check">
												<input type="radio" class="iradio icheckbox" data-id="<?php echo $value->idcurso; ?>" name="iradio[<?php echo $value->idcurso; ?>]" value="0" />
											</label>
										</div>
										<div class="clearfix"></div>
									</form>
								</li>

								<?php } ?>
							</ul>
						</div>                                  
					</div>
				</div>
			</div>
<span class="btn btn-info" id="cargcursalvar">Salvar</span>



		</div>
	</div>
</div>

<script type="text/javascript">

	$("#cargo").change(function(){

		$("#curcarg").fadeOut().html("");
		var id = $(this).val();

		$.ajax({         
			type: "POST",
			url: '<?php echo base_url('gestor/cargocurso'); ?>',
			secureuri:false,
			cache: false,
			data:{
				idcargo : id
			},              
			success: function(msg) 
			{

				$("#curcarg").html(msg).fadeIn();

			} 
		});
	});

	$("#cargcursalvar").click(function(e){
		
		var cursos = [];
		var i = 0;
		var id = $("#cargo").val();

		$("#curcarg").fadeOut().html("");

		if ($("#cargo").val()==""){
			$("#cargo").css("border-color", "red").focus();
			$(".alert").addClass("alert-danger").html("Escolha o cargo").fadeIn().delay(1200).fadeOut();
			return false;
		}

		$('.iradio').each(function(index, element){

			if ($(this).is(":checked")) {
				cursos[i] = {
					ic_tipo: $(this).val(),
					fk_idcurso: $(this).data("id")
					};
				i++;
			}
			
		});

		$.ajax({         
			type: "POST",
			url: '<?php echo base_url('gestor/salvarCursos'); ?>',
			secureuri:false,
			cache: false,
			data:{
				idcargo : id,
				cursos: cursos
			},              
			success: function(msg) 
			{
				$(".alert").removeClass("alert-danger").
				addClass("alert-success").
				html("Os requistos foram salvos. Atualize a página").
				fadeIn().
				delay(1200).
				fadeOut();			

			} 
		});
	});


</script>