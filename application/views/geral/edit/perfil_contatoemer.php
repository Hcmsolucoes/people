<div class="widget widget-default">

   <form name="modcont2">                        

       <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="for_nome1" class="control-label">Nome Completo</label>
                <input class="form-control" id="for_nome1" name="for_nome1" required="" type="text" value="">                
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="for_sexo1" class="control-label">Sexo</label>
                <select class="form-control" id="for_sexo1" name="for_sexo1">
                 <option>Masculino</option>
                 <option>Feminino</option>                     
             </select>
         </div>
     </div>
     <div class="col-md-5">
        <div class="form-group">
            <label class="control-label" for="for_parent1">Grau de Parentesco</label>
            <select class="form-control" id="for_parent1" name="for_parent1">
             <option>Pai/Mãe</option>
             <option>Filho(a)</option>                     
             <option>Tio(a)</option>  
             <option>Outros</option>  
            </select>
     </div>
 </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-2">
        <div class="form-group">
            <label for="for_ddi1" class="control-label">DDI</label>
            <input class="form-control" id="for_ddi1" name="for_ddi1" required="" type="text" value="">                            
        </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
        <label for="for_ddd1" class="control-label">DDD</label>
        <input class="form-control" id="for_ddd1" name="for_ddd1" required="" type="text" value="">                            
    </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="for_numero1" class="control-label">Número de Telefone</label>
    <input class="form-control" id="for_numero1" name="for_numero1" required="" type="text" value="">                            
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label for="for_ramal1" class="control-label">Ramal</label>
    <input class="form-control" id="for_ramal1" name="for_ramal1" type="text" value="">                            
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label for="for_noper1" class="control-label">Operadora</label>
    <input class="form-control" id="for_noper1" name="for_noper1"  type="text" value="">                            
</div>
</div>
</div>                   
<div class="col-md-4" style="margin-top: 20px;">
<button type="submit" class="btn btn-primary" ><span class="fa fa-plus"></span> Adicionar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</button>
</div>

</form>
</div>

<script type="text/javascript">



  $( 'form[name="modcont2"]' ).on( "submit", function( event ) {
    event.preventDefault();
    $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'perfil_edit/pessoal_contato_add' ?>',
        dataType : 'html',
        secureuri: false,
        data: $( this ).serialize(),              
        success: function() 
        { 
					  //$('#myModal').modal('hide');
                    location.reload(); 
                } 
            });
});


</script>

