<?php
 foreach ($funcionario as $value) {
    $nome = $value->fun_nome;
    $nacionalidade = $value->fun_nacionalidade;
    $naturalidade = $value->fun_naturalidade;
    $sexo = $value->fun_sexo;
    $estcivil = $value->fun_estadocivil;
    $datanascimento = $value->fun_datanascimento;
    $raca = $value->fun_etnia;
    $escol = $value->fun_escolaridade;
}?>
<div class="widget widget-default">
                     <form>
                  
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="for_nome" class="control-label">Nome completo</label>
                                 <input class="form-control" id="for_nome" name="for_nome" required="" type="text" value="<?php echo $nome ?>">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="for_datanasc" class="control-label ">Data de nascimento</label>
                                 <div class='input-group date' id='datetimepicker1'>
                                     <input type='text' name="for_datanasc" id="for_datanasc" class="form-control" value="<?php echo $this->Log->alteradata1($datanascimento)?>" />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="for_sexo" class="control-label">Sexo</label>
                                 <select class="form-control" id="for_sexo" name="for_sexo" required="">
                                    <option value="">Sexo </option>
                                    <?php 
                                        $selmasc = ($sexo==1)? "selected" : "" ;
                                        $selfem = ($sexo==2)? "selected" : "" ;
                                    ?>
                                    <option value="1" <?php echo $selmasc; ?>>Masculino</option>
                                    <option value="2" <?php echo $selfem; ?>>Feminino</option>                     
                                  </select>                                 
                             </div>
                         </div>                    
                     
                   
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="for_civil" class="control-label">Estado civil</label>
                                 <select class="form-control" id="for_civil" name="for_civil" required="">
                                    <option value="">Selecione</option>
                                    <?php foreach ($estadocivil as $key => $value) {

                                        $sel = ($estcivil==$value->id_estciv)? "selected" : "" ;
                                        ?>
                                    <option value="<?php echo $value->id_estciv; ?>"<?php echo $sel ?> ><?php echo $value->estciv_descricao; ?></option>
                                    <?php } ?>
                                  </select>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="for_nacio" class="control-label ">Nacionalidade</label>
                                 <input class="form-control" id="for_nacio" name="for_nacio" required="" type="text" value="<?php echo $nacionalidade ?>">
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="for_natual" class="control-label">Naturalidade</label>
                                 <input class="form-control" id="for_natual" name="for_natual" required="" type="text" value="<?php echo $naturalidade ?>">
                                 
                             </div>
                         </div>
                    
                     
                     
                   
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="for_raca" class="control-label">Raça e cor</label>
                                 <select class="form-control" id="for_raca" name="for_raca" required="">
                                    <option value=""> Selecione </option>
                                    <?php foreach ($etnia as $key => $value) { 

                                        $sel = ($raca==$value->id_etnia)? "selected" : "" ;

                                        ?>
                                      <option value="<?php echo $value->id_etnia; ?>"<?php echo $sel ?> ><?php echo $value->etnia_descricao; ?></option>
                                    <?php } ?>
                                  </select>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="for_escola" class="control-label">Escolaridade</label>
                                 <select class="form-control" id="for_escola" name="for_escola">
                                    <option value="">Selecione</option>
                                    <?php foreach ($escolaridade as $key => $value) { 

                                        $sel = ($escol==$value->id_escolaridade)? "selected" : "" ;

                                        ?>
                                    <option value="<?php echo $value->id_escolaridade; ?>"<?php echo $sel ?> ><?php echo $value->escolaridade_descricao; ?></option>
                                    <?php } ?>
                                  </select>
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

