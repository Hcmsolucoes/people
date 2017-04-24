	<div class="widget widget-default">
        
        <div class="content-box-wrapper">
        <form name="addinter">
		<div class="col-md-2">
    		<div class="form-group">
                <label for="interesse" class="control-label">Area de interesse</label>
                    <select class="form-control" id="interesse" name="inter_area">
                        <option value="Livros">Livros</option>
                        <option value="Esportes">Esportes</option>
                        <option value="Filmes">Filmes</option>
                        <option value="Hobbies">Hobbies</option>
                        <option value="Series">Series</option>
                        <option value="Moda">Moda</option>                     
                        <option value="Frase e Citações">Frase e Citações</option> 
                        <option value="Culinária">Culinária</option>      
                        <option value="Lugares">Lugares</option>      
                    </select>
             </div>
         </div>


        <div class="col-md-6">
             <div class="form-group">
                <label for="descricao" class="control-label">Descrição</label>
                <input class="form-control" id="descricao" name="inter_areadetalhe" required="" type="text" value="">                        
              </div>
         </div>

         <div class="col-md-6" style="margin-top: 20px">
             
            <button class="btn btn-primary" name="save" type="submit" ><span class="fa fa-check"></span> Salvar</button>
            <button id="cancela" class=" btn btn-danger" ><span class="fa fa-times"></span> Cancelar</button>
            
         </div></form>

<div class="clearfix"></div>

       </div>
     </div>



    <div class="widget widget-default">
                    <h3 class="">
                     Interesses Cadastrados
                    </h3>
                   
                        <div class="list-group ">
                        <?php foreach ($interessepessoal as $value) {?>
                            <div class=" list-group-item inter<?php echo $value->inter_idinteressepessoal?>" >
                                <div class="col-md-6 ">
                                    <h3 class="bold txleft"><?php echo $value->inter_area?></h3>
                                    <span class="font-sub txleft" style="margin: 0px 0px 0px 7px;">
                                        <?php echo $value->inter_areadetalhe ?>
                                    </span>                                                    
                                 </div>
                                 <div class="col-md-2">
                                    <i type="button" class="btn exc" id="<?php echo $value->inter_idinteressepessoal?>"><span class="fa fa-times"></span></i>
                                  </div>
                                        
                          <div class="clearfix"></div></div>                                   
                            
                            <?php } ?>
                        </div>                      
                        
                  
</div>

<script type="text/javascript">

	$( "#cancela" ).click(function(e) {
          $('#myModal').modal('hide');
		$( "#dadosedit" ).html(""); 
    });


	$( 'form[name="addinter"]' ).submit( function( event ) {
        event.preventDefault();
        $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/interesse_add' ?>',
           dataType : 'html',
           secureuri: false,
                data: $( this ).serialize(),              
                success: function(msg) 
                      {         
                        
                        console.log(msg);
                        if(msg=="ok"){
                        	location.reload(); 
                        }
                         
                      } 
             
                });
      });

	$( ".exc" ).click(function(e) {
         e.preventDefault();
         id = $(this).attr('id');
         $('.inter'+id).slideUp("slow");
        
         $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/interesse_remove' ?>',
           dataType : 'html',
           secureuri: false,
                data: {id : id },             
                success: function() {  

                 $('.inter'+id).remove();

                 } 
                });         
    });


</script>