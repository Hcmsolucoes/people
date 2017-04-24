
<div class="col-md-12">
	<div class="widget widget-default">

		<h3>Gerenciamento de Vagas
<a href="#" id="addv" class="add fright" >
  <i class="fa fa-plus-circle"></i>
</a>
		</h3>
		<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

		<div class="clearfix" style="margin:10px 0px;"></div>

		<table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
<thead>
		<tr>
     <th>Cód</th>
     <th>Titulo</th>
     <th>Abertura</th>
     <th>Encerramento</th>
     <th>PCD</th>
     <th>Status</th>
     <th>Editar</th>
  </tr>
	</thead>
<tbody >
<?php

foreach ($vaga as $key => $value) {

	$abertura = $this->Log->alteradata1($value->vaga_inicio);
	$encerramento = $this->Log->alteradata1($value->vaga_final);
	$pcd= ($value->vaga_ic_deficiente==1)? '<i class="fa fa-wheelchair" aria-hidden="true"></i>
' : "";
	if($value->vaga_ic_ativo==1){
		$ativo = "selected";
		$inativo = "";
	}else{
		$ativo = "";
		$inativo = "selected";
	}
?>
<tr id="<?php echo $value->vaga_id; ?>">
	<td><?php echo $value->vaga_id; ?></td>
	<td><?php echo $value->vaga_titulo; ?></td>
	<td><?php echo $abertura; ?></td>
	<td><?php echo $encerramento; ?></td>
	<td style="font-size: 18px;"><?php echo $pcd; ?></td>
	<td>
	<select name="status" class="status form-control" id="status" data-cod="<?php echo $value->vaga_id; ?>" style="max-width: 100px;">
		<option value="1" <?php echo $ativo; ?>>Ativo</option>
		<option value="0" <?php echo $inativo; ?> >Inativo</option>
	</select>
	</td>
	<td style="font-size: 18px;">
	<a href="#" class="edit" data-cod="<?php echo $value->vaga_id; ?>">
		<i class="fa fa-edit" aria-hidden="true"></i>
	</a>
	</td>	
</tr>
	<?php } ?>
</tbody>
</table>



	</div><!--widget-->
</div><!--col md 12-->
<script type="text/javascript">

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
     },
     "ordering": false
     }); 

	$("#addv").click(function(){
		
		$.ajax({            
            type: "POST",
            url: '<?php echo base_url().'gestor/vagadd' ?>',
            dataType : 'html',
            secureuri: false,
            data:{
            	add: 1
            	},            
            success: function(msg){  
            	$("#dadosedit").html(msg);
             	$("#myModal").modal( "show" );
          } 
      });

	 });

	$(".status").change(function(){
		var id = $(this).data("cod");
		var status = $(this).val();
		
		$.ajax({            
            type: "POST",
            url: '<?php echo base_url().'gestor/vagaManipular' ?>',
            dataType : 'html',
            secureuri: false,
            data:{
            	id: id,
            	operacao: 3,
            	status: status
            	},            
            success: function(msg){
            	
            	if(msg==1){
            		$(".alert").addClass("alert-success").html("Status alterado com sucesso").slideDown("slow");
				$(".alert").delay( 3500 ).hide(500);
            	}
            	             	
          } 
      });

	 });

	$(".edit").click(function(){
		var id = $(this).data("cod");
		
		$.ajax({            
            type: "POST",
            url: '<?php echo base_url().'gestor/vagadd' ?>',
            dataType : 'html',
            secureuri: false,
            data:{
            	id: id
            	},            
            success: function(msg){

            	$("#dadosedit").html(msg);
             	$("#myModal").modal( "show" );
          } 
      });

	});
    

</script>