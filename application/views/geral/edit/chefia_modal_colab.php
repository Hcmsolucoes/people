<div style="padding: 0px 10px;">

<table id="tabelacolaboradores" class="table table-striped table-hover table-condensed table-responsive">
<thead>
		<tr>
     <th>Nome</th>
     <th>Cargo</th>
     <th>Matricula</th>
     <th>CPF</th>
     <th>Empresa</th>
     <th></th>
  </tr>
	</thead>
<tbody>
<?php
$arr = array();
foreach ($subordinados as $key => $value) {
 $arr[] = $value->subor_idfuncionario;
}
foreach ($usuarios as $key => $value) {

  $check = ( in_array($value->fun_idfuncionario, $arr) )?"checked" : "";
	
?>
<tr id="<?php echo $value->fun_idfuncionario; ?>">
	<td><?php echo $value->fun_nome; ?></td>
	<td><?php echo $value->fun_cargo; ?></td>
  <td><?php echo $value->fun_matricula; ?></td>
  <td><?php echo $value->fun_cpf; ?></td>
	<td><?php echo $value->em_nomefantasia; ?></td>
	<td>
    <input type="checkbox" <?php echo $check; ?> class="incluir" data-fun="<?php echo $value->fun_idfuncionario; ?>" >
	</td>
</tr>
	<?php } ?>
</tbody>
</table>

</div>
<script type="text/javascript">
  
  $(".incluir").on("change", function(){
      
      var idchefe = $("#chefe").val();
      var idcolab = $(this).data("fun");

      if( $(this).is(":checked") ){
        var operacao = 1;
      }else{
        var operacao = 0; 
      }
      console.log(operacao);
      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."ajax/chefia_edit_subor";?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          chefe: idchefe,
          colab: idcolab,
          operacao: operacao
        },              
        success: function(msg) {
        
          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
           subordinados(idchefe);
           $(".alert").addClass("alert-success")
              .html("Subordinado alterado com sucesso")
              .slideDown("slow");
          }
          $(".alert").delay( 3500 ).hide(500);
          
        } 
      });

    });


  $(document).ready(function(){

    $('#tabelacolaboradores').DataTable({
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

  });

</script>