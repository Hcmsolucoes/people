<div class="widget widget-default">
    <?php  foreach ($contato as $value) { ?>

    <form name="modcont">


       <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="for_nome1" class="control-label">Nome Completo</label>
                <input class="form-control" id="for_nome1" name="for_nome1" required="" type="text" value="<?php echo $value-> con_nome ?>">                            
                <input class="form-control" id="for_id1" name="for_id1" required="" type="hidden" value="<?php echo $value-> con_idcontato ?>">                            
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="for_sexo1" class="control-label">Sexo</label>
                <select class="form-control" id="for_sexo1" name="for_sexo1">
                 <option><?php echo $value-> con_sexo ?></option>
                 <option>Masculino</option>
                 <option>Feminino</option>                     
             </select>
         </div>
     </div>
     <div class="col-md-5">
        <div class="form-group">
            <label class="control-label" for="for_parent1">Grau de Parentesco</label>
            <select class="form-control" id="for_parent1" name="for_parent1">
             <option><?php echo $value-> con_parentesco ?></option>
             <option>Pai/Mãe</option>
             <option>Filho(a)</option>                     
             <option>Tio(a)</option>  
             <option>Outros</option>  
         </select>
     </div>
 </div>
</div>
        
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="for_ddi1" class="control-label">DDI</label>
            <input class="form-control" id="for_ddi1" name="for_ddi1" required="" type="text" value="<?php echo $value-> con_ddi ?>">                            
        </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
        <label for="for_ddd1" class="control-label">DDD</label>
        <input class="form-control" id="for_ddd1" name="for_ddd1" required="" type="text" value="<?php echo $value-> con_ddd ?>">                            
    </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="for_numero1" class="control-label">Número de telefone</label>
    <input class="form-control" id="for_numero1" name="for_numero1" required="" type="text" value="<?php echo $value-> con_telefone ?>">                            
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label for="for_ramal1" class="control-label">Ramal</label>
    <input class="form-control" id="for_ramal1" name="for_ramal1" type="text" value="<?php echo $value-> con_ramal ?>">                            
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label for="for_noper1" class="control-label">Operadora</label>
    <input class="form-control" id="for_noper1" name="for_noper1"  type="text" value="<?php echo $value-> con_operadora ?>">                            
</div>
</div>
</div>
<div class="col-md-5" style="margin-top: 20px;">
   <button type="submit" class="btn btn-primary" ><span class="fa fa-check"></span> Salvar</button>
   <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Fechar</button>
   <button type="button" class="btn btn-danger removecont" style=" margin-left: 30px" id="<?php echo $value-> con_idcontato ?>" data-dismiss="modal"><span class="fa fa-times"></span> Excluir</button>
</div>
</form>
<?php } ?>
</div>

<script type="text/javascript">



  $( 'form[name="modcont"]' ).on( "submit", function( event ) {
    event.preventDefault();
    $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'perfil_edit/pessoal_contato_salva' ?>',
        dataType : 'html',
        secureuri: false,
        data: $( this ).serialize(),              
        success: function(msg) 
        { 
                       //$('#myModal').modal('hide');
                       location.reload(); 
                   } 
               });
});

  $( ".removecont" ).click(function(e) {
   e.preventDefault();
   id = $(this).attr('id');
   $.ajax({             
    type: "POST",
    url: '<?php echo base_url().'perfil_edit/pessoal_contato_remove' ?>',
    dataType : 'html',
    secureuri: false,
    data: {id : id },             
    success: function() { 
                 //$('#myModal').modal('hide');
                 location.reload(); 
             } 
         });         
});


</script>

