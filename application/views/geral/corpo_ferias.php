<div class="message-box animated fadeIn" data-sound="alert" id="mb-exclembrete">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Excluir programação de férias ?</div>
            <div class="mb-content">
                <p>Deseja excluir essa programação?</p>                    
                <p>Clique em Não para continuar trabalhando. Clique em Sim apagá-lo.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a id="exclembrete" href="#" data-id="" class="btn btn-danger btn-lg mb-control-close ">Sim</a>
                    <button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="page-title">                    
<h2><span class="fa fa-plane"></span> Programação de férias</h2>
</div>

<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

<div class="col-md-12">

<div class="widget widget-default">

<form id="prog_ferias" method="post">
	
<div class="form-group">
        <label class="col-md-2 control-label font-sub">Escolha o período</label>
        <div class="col-md-4">
<?php if( is_object($periodos) ) { ?>
<select name="periodos" id="periodos" required="">
	<option value="">Selecione</option>
	<option value="<?php echo $periodos->Per_idperiodos; ?>"><?php echo $this->Log->alteradata1($periodos->Per_dataini). " a " . $this->Log->alteradata1($periodos->Per_dataFim); ?> - <?php echo "Direito " . $periodos->Per_QtdDir. " dias"; ?> </option>
</select>
<?php }else{ ?>
    <label id="conteudo" class="bold font-sub">Não há períodos</label>
<?php } ?>
</div>
</div>

<div class="separador"></div>

<div class="form-group">
        <label class="col-md-2 control-label font-sub">Data de início</label>
        <div class="col-md-2" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="data fleft" data-date-start-date="+2d" name="data_inicio" id="data_inicio" placeholder="Data" style="max-width: 90px;" required=""/>              
            <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id=''></span>
            </span>
          </div> 
        </div>
</div>        

<div class="separador"></div>

<div class="form-group">
<label class="col-md-2 control-label font-sub">Dias de Férias</label>
<div class="col-md-4">
<select class="fleft" name="dias" id="dias" required="">
	<?php
  if( is_object($periodos) ) { 
   if ($periodos->Per_QtdDir==30) { ?>
	<option value="20">20 dias</option>
	<option value="30" selected >30 dias</option>
	<?php }else{ ?>
	<option value="<?php echo $periodos->Per_QtdDir; ?>" selected ><?php echo $periodos->Per_QtdDir; ?> dias</option>
	<?php } } ?>
</select>

<span class="col-md-5 font-sub" id="txtabono" style="margin-top: 7px;display: none;">Abono 10 dias</span>

</div>
</div>

<div class="separador"></div>

<div class="form-group">
	<label class="col-md-2 control-label text-left font-sub">Receber 13&ordm; salario</label>
	<div class="col-md-4">                                    
		<label class="check">
		<input type="radio" class="icheckbox" name="decterceiro" id="decnao" checked="checked" value="0" /> Não
		</label>
		<label class="check">
		<input type="radio" class="icheckbox" name="decterceiro" id="decsim" value="1" /> Sim
		</label>
	</div>
	
</div>


<div class="separador"></div>

<div class="form-group">
        <label class="col-md-2 control-label font-sub">Sugestão de pagamento</label>
        <div class="col-md-2" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="fleft" name="data_pagto" id="data_pagto" placeholder="Data" style="max-width: 90px;" required="" readonly="true" />              
            <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id='data1'></span>
            </span>
          </div> 
        </div>
</div>        

<div class="separador"></div>

<div class="form-group">
	<label class="col-md-2 control-label text-left font-sub">Gerar Adiantamento</label>
	<div class="col-md-4">                                    
		<label class="check">
		<input type="radio" class="icheckbox" name="adiantamento" id="adnao" checked="checked" value="0" /> Não
		</label>
		<label class="check">
		<input type="radio" class="icheckbox" name="adiantamento" id="adsim" value="1" /> Sim
		</label>
	</div>
	
</div>

<div class="separador"></div>

<div class="col-md-2">
	<input class="btn btn-primary" type="submit" name="salvar" id="salvar" value="Confirmar" >
</div>
<input type="hidden" name="fer_abono" id="fer_abono" value="0" />
</form>
</div>


<div class="widget widget-default">
	
	<table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
        <thead>
          <tr>
            <th>Período</th>
            <th>Data de início</th>
            <th>Dias solicitados</th>
            <th>Abono</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($ferias as $key => $value) {
          	switch ($value->fer_status) {
          		case '0': $status = "Aguardando aprovação"; break;
          		case '1': $status = "Aprovado"; break;
          		case '2': $status = "Rejeitado"; break;
          	}
       
           ?>
              <tr id="ferias<?php echo $value->fer_idferias; ?>" data-titulo="Férias programada" class="ferias" >
                <td><?php echo $this->Log->alteradata1($value->Per_dataini). " a " . $this->Log->alteradata1($value->Per_dataFim); ?></td>
                <td><?php echo $this->Log->alteradata1($value->fer_datainicio); ?></td>
                <td><?php echo $value->fer_dias; ?></td>
                <td><?php echo $value->fer_abono; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php if ($value->fer_status==0) { ?>               
                  <span data-id="<?php echo $value->fer_idferias; ?>" data-box="#mb-exclembrete" class="fa fa-times  mb-control exclemb" style="cursor: pointer;margin-right: 20px;"></span>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>

          </table>
</div>



</div>
<script type='text/javascript' src='<?php echo base_url('js/plugins/icheck/icheck.min.js') ?>'></script>   
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
		$.ajax({
			type: "POST",
			url: '<?php echo base_url("home/salvarProgFerias"); ?>',
			cache: false,
			data: $( this ).serialize(),

			success: function(msg){

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
      $("#fer_abono").val(0);
			$("#txtabono").hide("slow");
		}
	});

	$(".ferias").click(function(){
		/*
      var id = $(this).attr("id");
      var titulo = $(this).data("titulo");
      $("#titulomodal").text(titulo);
      $( "#dadosedit" ).html("");
      $('#myModal').modal('show');

      $.ajax({             
        type: "POST",
        url: '<?php echo base_url('home/modalferias'); ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          id: id
        },              
        success: function(msg) 
        {    
          
          $( "#dadosedit" ).html(msg);

        } 
      });*/
    });
 	
 	$("#exclembrete").click(function(){
      var id = $(this).data("id");

      $.ajax({          
          type: "POST",
          url: '<?php echo base_url("home/excluirferias"); ?>',
          dataType : 'json',
          data: {
            id: id
          },           
          success: function(msg){
            //console.log(msg);
          if(msg.status === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#ferias"+id).hide("fast", function(){
            	window.location.reload();
            });
          
          }

        } 
      });
    });

    $(".exclemb").click(function(){

      var id = $(this).data("id");
      $("#exclembrete").data("id", id);

    });

    $("#nao").click(function(){

      $("#exclembrete").data("id", "");
      
    });

</script>