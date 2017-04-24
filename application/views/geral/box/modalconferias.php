<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>
<div class="col-md-12">

<div class="widget widget-default">

<form id="prog_ferias" method="post">
	
<div class="form-group">
        <label class="col-md-3 control-label font-sub">Período</label>
        <div class="col-md-4">

        <span><?php echo $this->Log->alteradata1($ferias->Per_dataini). " a " . $this->Log->alteradata1($ferias->Per_dataFim); ?></span>
<!--<select name="periodos" id="periodos" required="">
	<option value="">Selecione</option>
	<?php if( is_object($periodos) ){ ?>
	<option value="<?php echo $periodos->Per_idperiodos; ?>"><?php echo $this->Log->alteradata1($periodos->Per_dataini). " a " . $this->Log->alteradata1($periodos->Per_dataFim); ?> - <?php echo "Direito " . $periodos->Per_QtdDir. " dias"; ?> </option>	
	<?php } ?>
</select>-->

</div>
</div>

<div class="separador"></div>

<div class="form-group">
        <label class="col-md-3 control-label font-sub">Data de início</label>
        <div class="col-md-4" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="data fleft" data-date-start-date="+2d" name="data_inicio" id="data_inicio" placeholder="Data" style="max-width: 90px;" required="" value="<?php echo $this->Log->alteradata1($ferias->fer_datainicio); ?>" />              
            <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id=''></span>
            </span>
          </div> 
        </div>
</div>        

<div class="separador"></div>

<div class="form-group">
<label class="col-md-3 control-label font-sub">Dias de Férias</label>
<div class="col-md-6">
<select class="fleft" name="dias" id="dias" required="">
	<?php if ($ferias->Per_QtdDir==30) {
    $f = ($ferias->fer_dias==30)? "selected":"" ;
    $g = ($ferias->fer_dias==20)? "selected":"" ;
	?>
	<option value="20" <?php echo $g; ?> >20 dias</option>
	<option value="30" <?php echo $f; ?> >30 dias</option>
	<?php }else{ ?>
	<option value="<?php echo $ferias->Per_QtdDir; ?>" selected ><?php echo $ferias->Per_QtdDir; ?> dias</option>
	<?php }?>
</select>

<span class="col-md-6 font-sub" id="txtabono" style="margin-top: 7px;display: none;">Abono 10 dias</span>

</div>
</div>

<div class="separador"></div>

<div class="form-group">
	<label class="col-md-3 control-label text-left font-sub">Receber 13&ordm; salario</label>
	<div class="col-md-4">                                    
		<label class="check">
    <?php $decsim = ($ferias->fer_decimoterceiro==1)? "checked": ""; ?>
    <?php $decnao = ($ferias->fer_decimoterceiro==0)? "checked": ""; ?>
		<input type="radio" class="icheckbox" name="decterceiro" <?php echo $decnao; ?> id="decnao" value="0" /> Não
		</label>
		<label class="check">
		<input type="radio" class="icheckbox" name="decterceiro" <?php echo $decsim; ?> id="decsim" value="1" /> Sim
		</label>
	</div>
	
</div>


<div class="separador"></div>

<div class="form-group">
        <label class="col-md-3 control-label font-sub">Sugestão de pagamento</label>
        <div class="col-md-4" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="fleft" name="data_pagto" id="data_pagto" placeholder="Data" style="max-width: 90px;" required="" readonly="true" value="<?php echo $this->Log->alteradata1($ferias->fer_data_pagamento); ?>" />   <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id='data1'></span>
            </span>
          </div> 
        </div>
</div>        

<div class="separador"></div>

<div class="form-group">
	<label class="col-md-3 control-label text-left font-sub">Gerar Adiantamento</label>
	<div class="col-md-4">                                    
		<label class="check">
    <?php $adsim = ($ferias->fer_adiantamento==1)? "checked": ""; ?>
    <?php $adnao = ($ferias->fer_adiantamento==0)? "checked": ""; ?>
		<input type="radio" class="icheckbox" name="adiantamento" id="adnao" <?php echo $adnao; ?> value="0" /> Não
		</label>
		<label class="check">
		<input type="radio" class="icheckbox" name="adiantamento" id="adsim" <?php echo $adsim; ?> value="1" /> Sim
		</label>
	</div>
	
</div>

<div class="separador"></div>
<?php if ($pagina=="") {?>
<div class="col-md-4">
	<input class="btn btn-info" type="submit" name="salvar" id="salvar" value="Aprovar" >
  <img id="load" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" >
</div>
<?php } ?>
<input type="hidden" name="idferias" id="idferias" value="<?php echo $ferias->fer_idferias; ?>" >
<input type="hidden" name="gestor" id="gestor" value="<?php echo $funcionario->fun_idfuncionario; ?>" >
<input type="hidden" name="idfun" id="idfun" value="<?php echo $ferias->fer_idfuncionario; ?>" >
<input type="hidden" name="fer_abono" id="fer_abono" value="<?php echo $ferias->fer_abono; ?>" />
<input type="hidden" name="status" id="status" />
</form>
</div>

</div>

<script type="text/javascript">
  $('.data').datepicker({
      
      format: 'dd/mm/yyyy',
      
    });

   $("#data_inicio").blur(function(){
    if( $(this).val().length == 10){
      var data = $(this).val();
      $.ajax({
        type: "POST",
        url: '<?php echo base_url("home/datapagamento"); ?>',
        cache: false,
        data: {
          data: data
        },
        success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else{
            $("#data_pagto").val(msg);
          }
        }
      });

    }//if
  });

  $("#prog_ferias").submit(function(e){
    e.preventDefault();
    $("#status").val(1);
    $.ajax({
      type: "POST",
      url: '<?php echo base_url("home/salvarProgFerias"); ?>',
      cache: false,
      data: $( this ).serialize(),

      success: function(msg){
        //console.log(msg); return;
        $("#load").show();
        if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else{

          $(".alert").addClass("alert-success")
          .html("Programação efetuada com sucesso")
          .slideDown("slow");
          $(".alert").delay( 2500 ).hide(500, function(){
            window.location.reload();
          });
          
        }
      }
    });
  });

  $("#dias").change(function(){
    if ($(this).val()==20) {
      $("#txtabono").show("slow");
      $("#fer_abono").val(10);
    }else{
      $("#txtabono").hide("slow");
      $("#fer_abono").val(0);
    }
  });
</script>