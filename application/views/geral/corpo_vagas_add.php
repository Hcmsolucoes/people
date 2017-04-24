<?php 

$titulo = "";
		$idcargo = "";
		$descricao = "";
		$pcd = "";
		$encerramento = "";
		$operacao=1;
		$id="";


if ( !empty($vaga) ) {
	$operacao=2;
	
	foreach ($vaga as $key => $value) {
		$id = $value->vaga_id;
		$titulo = $value->vaga_titulo;
		$idcargo = $value->vaga_fk_cargo;
		$descricao = $value->vaga_descricao;
		$pcd = ($value->vaga_ic_deficiente==1)? "checked" : "";
		$encerramento = $this->Log->alteradata1( $value->vaga_final );
	}


}


?>

<div style="width: 60%; margin: 0px auto;">

<h3 align="center">Cadastrar Vaga</h3>

	<form name="addvaga">
		<div class="col-md-10 form-group">

			<input type="text" value="<?php echo $titulo; ?>" class="form-control" name="titulo" id="titulo" placeholder="Titulo da vaga" required="">

		</div><div class="clearfix"></div>

		<div class="col-md-10 form-group">

			<select class="form-control" name="cargo" id="cargo" required="">
				<option value="">Selecione o Cargo</option>
				<?php foreach ($cargos as $key => $value) { 
					$sel = ($value->idcargo==$idcargo)? "selected" : ""; ?>
				<option value="<?php echo $value->idcargo; ?>" <?php echo $sel; ?> ><?php echo $value->descricao; ?></option>
				<?php } ?>
			</select>

		</div><div class="clearfix"></div>

		<div class="col-md-10 form-group">

			<textarea class="form-control" name="desc" id="desc" placeholder="Descrição da vaga" required=""><?php echo $descricao; ?></textarea>

		</div><div class="clearfix"></div>

		<div class="col-md-10 form-group">
			
			<div class='input-group' style="max-width: 40%;float: left; margin: 0px 20px 0px 0px;">
				<input type="text" class="form-control" value="<?php echo $encerramento; ?>" name="encerramento" id="encerramento" placeholder="Encerramento" required="">
				<span class="input-group-addon">
					<span class="fa fa-calendar"></span>
				</span>
			</div>

			<input type="checkbox" class="" name="pcd" id="pcd" data-on-text="PCD" data-off-text="Normal" <?php echo $pcd; ?> />

		</div><div class="clearfix"></div>

		<div class="clearfix"></div>

		<div class="col-md-6 form-group">
			<input type="submit" class="btn btn-primary" name="salvar" id="salvar" value="Salvar" />
			<span type="button" class="btn btn-danger" name="cancelar" id="cancelar" data-dismiss="modal">Cancelar</span>
			<img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
		</div>
		<input type="hidden" name="operacao" id="operacao" value="<?php echo $operacao; ?>">
		<input type="hidden" name="idv" id="idv" value="<?php echo $id; ?>">
		<textarea name="descricao" id="descricao" style="display: none;"></textarea>
	</form>
</div>

<script type="text/javascript">

	$("#pcd").bootstrapSwitch();

	$('#encerramento').datepicker({

		format: 'dd/mm/yyyy'

	});

	CKEDITOR.replace( 'desc', 
	{
		toolbar:
		[
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline', 'ImageButton' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
		{ name: 'styles', items : [ 'Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteFromWord','-','Undo','Redo' ] },            
		{ name: 'tools', items : [ 'Maximize','-','About' ] }
		]
	});
	
	$( 'form[name="addvaga"]' ).on( "submit", function( event ) {
		event.preventDefault();
		$("#load").show();
		$("#salvar").prop( "disabled", true );
		var desc = CKEDITOR.instances.desc.getData();
		$("#descricao").html( desc );

		$.ajax({            
			type: "POST",
			url: '<?php echo base_url().'gestor/vagaManipular' ?>',
			dataType : 'html',
			secureuri: false,
			data: $( this ).serialize(),              
			success: function(msg) 
			{         
				console.log(msg);
				if(msg==1){
					
					$(".alert").addClass("alert-success").html("Vaga Adicionada com sucesso").slideDown("slow");
					$(".alert").delay( 3500 ).hide(500);
					$("#myModal").modal("hide");
					$("#dadosedit").html("");
					setTimeout(function(){
						location.reload();
					}, 1000);
				}
				
				$("#salvar").prop( "disabled", false );
			} 
		});
	});
</script>