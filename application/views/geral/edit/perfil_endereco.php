<div class="widget widget-default">
   <form>
      
       <div class="col-md-6">
           <div class="form-group">
               <label for="for_nome" class="control-label">Endereço</label>
               <input class="form-control" id="for_endereco" name="for_endereco" required="" type="text" value="<?php echo $endereco->end_rua; ?>">
           </div>
       </div>
       <div class="fleft-1">
           <div class="form-group">
               <label for="for_numero" class="control-label ">Número</label>
               <input type='text' name="for_numero" id="for_numero" class="form-control" value="<?php echo $endereco->end_numero; ?>" />
           </div>
       </div>
       <div class="col-md-3">
           <div class="form-group">
            <label for="for_complemento" class="control-label">Complemento</label>
            <input class="form-control" id="for_complemento" name="for_complemento" required="" value="<?php echo $endereco->end_complemento; ?>">      
        </div>
    </div>                    
    
    <div class="clearfix" style="margin-top: 10px;"></div>
    
    <div class="col-md-3">
       <div class="form-group">
           <label for="for_cep" class="control-label">CEP</label>
           <input class="form-control" id="for_cep" name="for_cep" required="" value="<?php echo $endereco->end_cep; ?>">  
       </div>
   </div>

   <div class="fleft-1">
       <div class="form-group">
           <label for="for_nacio" class="control-label ">Estado</label>
           <select class="form-control" id="for_estado" name="for_estado" required="">
            <option value="">Selecione</option>
            <?php foreach ($estados as $key => $value) {

                $sel = ($endereco->end_idestado==$value->est_idestado)? "selected" : "" ;
                ?>
                <option value="<?php echo $value->est_idestado; ?>"<?php echo $sel ?> ><?php echo $value->est_nomeestado; ?></option>
                <?php } ?>
            </select>
       </div>
   </div>

   <div class="col-md-4">
       <div class="form-group">
           <label for="for_cidade" class="control-label ">Cidade</label>
           <select class="form-control" id="for_cidade" name="for_cidade" required="">
             <?php if (!empty($endereco->end_idcidade) ) { ?>
             
             <?php foreach ($cidades as $key => $value) {

                $sel = ($endereco->end_idcidade==$value->cid_idcidade)? "selected" : "" ;

                ?>
                <option value="<?php echo $value->cid_idcidade; ?>" <?php echo $sel ?> ><?php echo $value->cid_nomecidade; ?></option>
             <?php } 
             }
              ?>
            </select>
       </div>
   </div>

   <div class="col-md-4">
       <div class="form-group">
           <label for="for_cidade" class="control-label ">Bairro</label>
           <select class="form-control" id="for_cidade" name="for_cidade" required=""></select>
       </div>
   </div>
   
   
   <div class="col-md-6" style="margin-top: 20px">
     <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Salvar</button>
     <span class="btn btn-danger" id="btcancela"><span class="fa fa-times"></span>
     Cancelar</span>

 </div>
 
</form>
</div>
<script type="text/javascript">
    $(function () {
        
        $('#for_datanasc').datepicker({
            format: 'dd/mm/yyyy'
        });
        
        
        $( "#btcancela" ).click(function(e) {
            $('#myModal').modal('hide');
            $( "#dadosedit" ).html("");		 
        });
        
        $( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({             
                type: "POST",
                url: '<?php echo base_url().'perfil_edit/pessoal_info_salva' ?>',
                dataType : 'html',
                secureuri: false,
                data: $( this ).serialize(),              
                success: function(msg) 
                {         
                  console.log(msg); 
                  if(msg === 'ok'){
                      
                      $(".alert").html('Alterado com sucesso! Aguarde a aprovação');
                      $(".alert").show(300);
                      $(".alert").delay( 3500 ).hide(500);                              
                      $( "#myModal" ).delay( 3000 ).modal('hide');
                  }
              }
          }); 
        });
    });
    
    
</script>
