
<?php if (count($cargocurso)>0) { ?>

<table id="tabela" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Curso</th>
			<th>Requisito</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($cargocurso as $key => $value) { 
			$req = ($value->ic_tipo==1)? "Obrigatório" : "Desejável";
			?>
		<tr id="cur<?php echo $value->id_cargocurso; ?>">
			<td><?php echo $value->nomecurso; ?></td>
			<td><?php echo $req; ?></td>
			<td>
					<span class="btn btn-default excur" data-id="<?php echo $value->id_cargocurso; ?>">
						<i class="fa fa-times"></i>
					</span>
			</td>
		</tr>
		<?php }	?>
	</tbody>
<?php }else{
	echo "Nenhum Curso vinculado";
	}	?>

<script type="text/javascript">
	$(".excur").on("click", function(){

		var id = $(this).data("id");

		$.ajax({    
			type: "POST",
			url: '<?php echo base_url('gestor/excluircargocurso'); ?>',
			secureuri:false,
			cache: false,
			data:{
				id : id
			},              
			success: function(msg) 
			{

				$("#cur"+id).fadeOut();

			} 
		});		
	});
</script>