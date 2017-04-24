<div class="page-title">                    
  <h2><span class="fa fa-flag"></span> Cadastro de Equipamentos</h2>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="widget widget-default">
      <form>
        <div class="row" style=" margin-top: 20px">
            <div class="fleft">
                <div class="form-group">
                    <label for="for_nome" class="control-label">Nome do equipamento</label>
                    <input class="form-control" id="for_nome" name="for_nome" required="" type="text" value="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="for_desc" class="control-label">Descrição</label>
                    <input class="form-control" id="for_desc" name="for_desc" required="" type="text" value="">
                </div>
            </div>
            <div class="fleft" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary"><span class="fa fa-check" aria-hidden="true"></span> Adicionar</button>
            </div>
        </div>
      
     </form>

   </div>


   <div class="widget widget-default">
    <h3 class="">Equipamentos Cadastrados</h3>
    <div class="separador"></div>

    <p style=" margin-bottom: 0px;"><?php echo $links; ?></p>

    <div class="clearfix"></div>

    <div style=" min-width: 200px; overflow: auto; ">
      <table class="table " id="tableemail" style="text-align: left; min-width: 400px;">
       <thead>
         <tr style=" font-size: 12px">
           <th>Nome</th>
           <th>Descrição</th>
           <th>Excluir</th> 
         </tr>
       </thead>
       <tbody>
         <?php if ($results) { foreach ($results as $value) { ?>                                                  
         <tr id="para<?php echo $value -> equi_idequipamentos ?>" >
          <td><?php echo $value -> equi_nome ?></td>
          <td><?php echo $value -> equi_descricao ?></td>
          <td>
            <a href="#">
              <span class="removeparame fa fa-times" id="<?php echo $value -> equi_idequipamentos ?>"></span>  
            </a>        
          </td>
        </tr>
        <?php  } } ?>
      </tbody>
    </table>
  </div>

</div>

</div>

</div>
<script>
  $('#collapseTwoponto').collapse();
  $( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    $.ajax({             
      type: "POST",
      url: '<?php echo base_url().'pontoaponto/equipamentos_cad_salva' ?>',
      dataType : 'html',
      secureuri: false,
      data: $( this ).serialize(),              
      success: function(msg) 
      {         
        console.log(msg);
        location.reload(); 

      } 
    });
  });
  $( ".removeparame" ).click(function(e) {
   e.preventDefault();
   id = $(this).attr('id');
   tremove = '#para'+id;
   $(tremove).hide(200);
   $.ajax({             
    type: "POST",
    url: '<?php echo base_url().'pontoaponto/equipamentos_cad_remove' ?>',
    dataType : 'html',
    secureuri: false,
    data: {id : id },             
    success: function() {  } 
  });         
 });        

</script>