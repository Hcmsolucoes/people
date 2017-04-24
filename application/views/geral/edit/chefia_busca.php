
<?php //echo $this->db->last_query(); ?>
<table class="table table-striped table-hover table-condensed table-responsive">
<thead>
		<tr>
     <th>Nome</th>
     <th>Cargo</th>
     <th>Empresa</th>

  </tr>
	</thead>
<tbody>
<?php foreach ($usuarios as $key => $value) { ?>
<tr class="colab" data-idgestor="<?php echo $value->fun_idfuncionario; ?>" >
	<td><?php echo $value->fun_nome; ?></td>
	<td><?php echo $value->fun_cargo; ?></td>
	<td><?php echo $value->em_nomefantasia; ?></td>
</tr>
	<?php } ?>
</tbody>
</table>


<script type="text/javascript">

  function subordinados(idchefe){

    var chefe = idchefe;
    //console.log(chefe);
    $.ajax({          
        type: "POST",
        url: '<?php echo base_url("ajax/jsonHierarquia");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          chefe: chefe
        },              
        success: function(msg){
        
          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
           //$("#h3nome").html("Hierarquia abaixo de "+nome);     
            $("#result_subor").html(msg);
            $("#resultado").slideDown();
          }
          
        } 
      });   

   }
	
  
  $(".colab").on("click", function(){
      var id = $(this).data("idgestor");
      $("#chefe").val(id);
      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("ajax/buscaGestor");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          chefe: id
        },              
        success: function(msg) {
        
          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
           $("#result").html(msg);
           $('#modalchefia').modal('hide');
           subordinados(id);
          }
          
        } 
      });

    });


</script>