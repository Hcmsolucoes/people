<style type="text/css">
	.md10{
		margin-right: 10px;
	}
	.borda{
		border: 1px solid #ccc;
		padding: 7px;
	}
	.grande{
		width: 310px;
	}
	.pequeno{
		width: 112px;
	}
	.xgrande{
		width: 500px;
	}
	.copia{
		margin-bottom: 10px;
	}
	.excpar{
		font-size: 20px;
		cursor: pointer;
	}
	label.error{
		float: left;
    	width: auto;
	}
</style>

<div class="page-title">
	<h2><span class="fa fa-list-alt"></span> Admissão</h2>
</div>

<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

<div class="col-md-12">

	<table id="tabelaadm" class="table table-striped table-hover">
  <thead>
    <tr>
      <!--<th>Selecionar</th>-->
      <th>Colaborador</th>
      <th>Data da admissão</th>
      <th>Cargo</th>
      <th>Emissor</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($admissoes as $key => $value) { 
      
      $data = $this->Log->alteradata1( $value->data_admissao );
		
	 /*
      $datahora_efetiva = date('Y-m-d H:m:s' , strtotime($value->data_efetiva) );
      list($data2, $hora2) = explode(" ", $datahora_efetiva);
      $data2 = $this->Log->alteradata1( $data2 );
      */
      ?>

      <tr class="ver" id="<?php echo $value->id_admissao; ?>" style="cursor: pointer;">
        
        <td ><?php echo $value->nome_admissao ?></td>
        <td ><?php echo $data; ?></td>
        <td ><?php echo $value->descricao; ?></td>
        <td ><?php echo $value->fun_nome; ?></td>
        
      </tr>
      <?php }  ?>
    </tbody>
  </table>



</div>

<script type="text/javascript">
	$(".ver").click(function(){
		var id = $(this).attr("id");
		$('#titulomodal').text("Visualizar admissão");
		$( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' >");
		$(".modal-content").css("max-height", "600px");
		$("#myModal").modal('show');

		$.ajax({            
			type: "POST",
			url: '<?php echo base_url('rh/veradmissao') ?>',
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

	$('#myModal').on('hidden.bs.modal', function (e) {
  		$( "#dadosedit" ).html("");
	});

</script>