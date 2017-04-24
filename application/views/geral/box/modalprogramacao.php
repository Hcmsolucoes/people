<form id="formtreinamento">
      <div class="widget widget-default">
        <div class="col-md-8 ">

          <div class="form-group">
            <label class="col-md-3 control-label font-sub">Curso</label>
            <div class="col-md-6">
             <select name="curso" id="curso" required="" style="max-width: 100%;">
               <option value="">-- Escolha o curso --</option>
               <?php foreach ($cursos as $key => $value) { 
               	$sel = ($programacao->idcurso==$value->idcurso)? "selected" : "" ;
               	?>
               <option value="<?php echo $value->idcurso; ?>" <?php echo $sel; ?> ><?php echo $value->nomecurso; ?></option>
               <?php } ?>
             </select>
           </div>
         </div>

         <div class="clearfix"></div>

         <div class="form-group">
          <label class="col-md-3 control-label font-sub">Data de inicio</label>
          <div class="col-md-4" style="margin-right: 10px;">
            <div class='input-group date' >
              <input type="text" class="data fleft" name="data_aviso" id="data_aviso" placeholder="Data" data-date-start-date="+1d" style="max-width: 90px;" required="" value="<?php echo $this->Log->alteradata1( $programacao->data_inicio); ?>" />          
              <span class="input-group-addon fleft">
                <span class="fa fa-calendar" id='data1'></span>
              </span>
            </div> 
          </div>

        </div>

        <div class="clearfix"></div>

        <div class="form-group">
          <label class="col-md-3 control-label font-sub">Data de término</label>
          <div class="col-md-4" style="margin-right: 10px;">
            <div class='input-group date' >
              <input type="text" class="data fleft" name="data_termino" id="data_termino" placeholder="Data" style="max-width: 90px;" required="" value="<?php echo $this->Log->alteradata1( $programacao->data_final); ?>" />
              <span class="input-group-addon fleft">
                <span class="fa fa-calendar" id='data2'></span>
              </span>
            </div> 
          </div>

        </div>

        <div class="clearfix"></div>

        <div class="form-group">
          <label class="col-md-3 control-label font-sub">Qtd de aulas</label>
          <div class="col-md-3">
            <input type="number" class="form-control" name="aulas" min="0" value="<?php echo $programacao->qtdaulas; ?>" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">

         <label class="col-md-3 control-label font-sub">Tipo de duração</label>
         <div class="col-md-4">
           <select class="form-control" name="tipoduracao" id="tipoduracao" required="">
             <option value="">-- Escolha o tipo --</option>
             <?php foreach ($duracao as $key => $value) { 
             	$sel = ($programacao->fk_duracaotreinamento==$value->id_duracao)? "selected" : "" ;
             	?>
             <option value="<?php echo $value->id_duracao; ?>" <?php echo $sel; ?> ><?php echo $value->duracao_descricao; ?></option>
             <?php } ?>
           </select>
         </div>

         <label class="col-md-2 control-label font-sub">Duração</label>
         <div class="col-md-3">
          <input type="number" class="form-control" name="duracao" id="duracao" min="0" value="<?php echo $programacao->nr_duracao; ?>" />
        </div>


      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Carga Horária</label>
        <div class="col-md-3">
          <input type="number" class="form-control" name="cargahoraria" id="cargahoraria" min="0" value="<?php echo $this->util->minutosToHoras($programacao->cargahoraria); ?>" />
        </div>
        <label class="fleft control-label font-sub">(Horas)</label>
      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Qtd de Vagas</label>
        <div class="col-md-3">
          <input type="number" class="form-control" name="vagas" id="vagas" min="1" value="<?php echo $programacao->vagas; ?>" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label class="col-md-3 control-label font-sub">Tipo de Realização</label>
        <div class="col-md-6">
         <select name="realizacao" id="realizacao" required="">
           <option value="">-- Escolha o tipo --</option>
           <?php foreach ($realizacao as $key => $value) { 
           	$sel = ($programacao->fk_tiporealizacao==$value->id_tiporealizacao)? "selected" : "" ; 
           	?>
           <option value="<?php echo $value->id_tiporealizacao; ?>" <?php echo $sel; ?> ><?php echo $value->descricaorealizacao; ?></option>
           <?php } ?>
         </select>
       </div>
     </div>

     <div class="clearfix"></div>

     <div class="form-group">
      <label class="col-md-3 control-label font-sub">Valor de custo</label>
      <div class="col-md-3">
        <input type="text" class="form-control campomoeda" name="custo" id="custo" value="<?php echo number_format( $programacao->valor, 2, ",","."); ?>" />
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
      <label class="col-md-3 control-label font-sub">Realizado</label>
      <div class="col-md-3">
       <select name="status" id="status" class="form-control" required="">
         <option value="0" <?php echo ($programacao->calendario_status==0)? "selected" : "" ; ?> >Não</option>
         <option value="1" <?php echo ($programacao->calendario_status==1)? "selected" : "" ; ?> >Sim</option>
       </select>
     </div>
   </div>

   <div class="clearfix"></div>

   <div class="form-group">
    <label class="col-md-3 control-label font-sub">Observação</label>
    <div class="col-md-6">
      <textarea class="form-control" name="obs" id="obs" style="max-width: 100%"><?php echo $programacao->observacao; ?></textarea>
    </div>
  </div>

  <div class="clearfix"></div>

  <input type="submit" value="Alterar" name="alterar" id="salvar" class="btn btn-info" />
  <img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" >
  <div id="selecionados"></div>
  <input type="hidden" name="id_calendario" value="<?php echo $programacao->id_calendario; ?>">
</form>

<script type="text/javascript">
	$(".campomoeda").maskMoney({thousands:'.',decimal:','});

	$("#formtreinamento").on("submit", function(e){

      $("#load").show();
      $("#salvar").prop("disabled", true);
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("ajax/salvarTreinamento"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
        	
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){

         window.location.href = '<?php echo base_url("gestor/calendario"); ?>';

       }

     } 
   	 });
     });

    $('.data').datepicker({
      format: 'dd/mm/yyyy'
     });

    $("#data_aviso").blur(function(){
      if( $(this).val().length == 10){
        var data = $(this).val();
        $("#data_termino").prop("disabled", false);
        $('#data_termino').datepicker('setStartDate', data);
      }
    });

    $(document).ready(function(){
    	var data = $("#data_inicio").val();
    	$('#data_termino').datepicker('setStartDate', data);
    });
</script>