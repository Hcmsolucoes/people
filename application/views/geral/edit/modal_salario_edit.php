<?php 

$avatar = ( $solicitacao->fun_sexo==1 )?"avatar1":"avatar2";
$foto = (empty($solicitacao->fun_foto) )? base_url("img/".$avatar.".jpg") : $solicitacao->fun_foto;
$situacao = ($solicitacao->fun_status=="A")? "Ativo" : "Inativo";

$datahora_efetiva = date('Y-m-d H:m:s' , strtotime($solicitacao->data_efetiva) );
list($data2, $hora2) = explode(" ", $datahora_efetiva);
$data2 = $this->Log->alteradata1( $data2 );

$novovalor = number_format($solicitacao->valor_aumento, 2, ",", ".");
$disable="";
$pagina = '';
if ($pag == "aprovacao") {
  $disable = "readonly='true' disabled='true'";
  $pagina = 'gestor/aprovacoes';
}
?>

<h4 style="margin-left: 10px;">Status da solicita��o:&nbsp;<span class="bold"><?php echo $solicitacao->descricao_status_solicitacao; ?></span></h4>
<form name="form_aumento" id="form_aumento" action="<?php echo base_url('gestor/salvarAumentoSalaral'); ?>" method="post">

<div class="fleft-10 fleftmobile">

<div class="fleft">
  <img class="fleft" src="<?php echo $foto; ?>" style="margin: 0px 10px 0px 0px;border: 3px solid #ccc;max-width: 90px;border-radius: 20%;">
</div>

<div class="fleft">
  <span class="fleft font-sub bold"><?php echo $solicitacao->fun_nome; ?></span>
  <br>
  <span class="fleft bold">Matricula:</span>&nbsp;<span><?php echo $solicitacao->fun_matricula; ?></span>
  <br />
  <span class="fleft bold">Admiss�o:</span>&nbsp;<span><?php echo $this->Log->alteradata1($solicitacao->contr_data_admissao); ?></span>
  <br />
  <span class="fleft bold">Cargo:</span>&nbsp;<span><?php echo $solicitacao->contr_cargo; ?></span>
  <br />
  <span class="fleft bold">Departamento:</span>&nbsp;<span><?php echo $solicitacao->contr_departamento; ?></span>
  <br />
  <span class="fleft bold">Salario Atual:</span>&nbsp;R$<span><?php echo number_format($solicitacao->sal_valor, 2, ".", ","); ?></span>
  <br />
  <span class="fleft bold">Situa��o Atual:</span>&nbsp;<span><?php echo $situacao; ?></span>
</div>
</div>

<div class="separador"></div>

  <div class="fleft-5 fleftmobile" style="padding: 5px 10px">

    <span class="bold">Solicitante: </span><span><?php echo $funcionario->fun_nome; ?></span>

    <?php 
    $dtconvert = date('Y-m-d H:m:s' , strtotime($solicitacao->data_hora_solicitacao) );
    $dtlog = explode(" ", $dtconvert);
    $dt = $this->Log->alteradata1( $dtlog[0] );
    $hr = substr($dtlog[1], 0, 5 );
  ?>
  <label class="font-sub"><?php echo $dt. " " .$hr; ?></label>

    <div class="fleft-7 divcombocolab">
     <label for="dt_desligamento" class="control-label">Data da altera��o</label>
     <div class='input-group' >
      <input class="form-control txleft campodata" type="text" name="dt_aumento" id="dt_aumento" placeholder="Data da altera��o" required="" value="<?php echo $data2; ?>" >
      <span class="input-group-addon">
        <span class="fa fa-calendar"></span>
      </span>
    </div>
  </div>

  <div class="fleft-7" style="margin-top: 20px;">
    <label for="" class="control-label">Motivo do altera��o</label>
    <select name="motivo_aumento" required="true" id="motivo_aumento" class="form-control" <?php echo $disable; ?> >
     <option value="">Selecione</option>
     <?php foreach ($motivos as $key => $value) { 
      $sel = ($solicitacao->motivo_aumento==$value->mot_idmotivos)? "selected" : "" ;
      ?>
      <option value="<?php echo $value->mot_idmotivos; ?>" <?php echo $sel ?>><?php echo $value->motivo; ?></option>
      <?php } ?>
    </select>

  </div>

  <div class="fleft-8" style="margin-top: 20px;">
   <label for="" class="control-label">Novo Valor Proposto</label>

   <div class="input-group">                                            
    <span class="input-group-addon">R$</span>
    <input type="text" name="novovalor" id="novovalor" class="form-control campomoeda" placeholder="Novo Valor" value="<?php echo $novovalor; ?>" <?php echo $disable; ?> >
    <span id="porcentagem" class="input-group-addon"></span>
  </div>
</div>

</div>



<div class="clearfix"></div>

<div class="fleft-5 fleftmobile" style="margin: 20px 0px 0px 10px;">             
 <label for="sal_obs" class="control-label">Motivo do Aumento</label>

 <div class="clearfix" ></div>

 <textarea required="true" class="form-control" name="sal_obs" id="sal_obs" cols="70" rows="5" style="width: 100%" <?php echo $disable; ?>><?php echo $solicitacao->motivo_solicitacao; ?></textarea>

 <img id="load_aumento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">

 <?php if ( ($solicitacao->solicitacao_status==1)&& ($pag == "")) {  ?>
 <span id="encaminhar" class="btn btn-primary acao" style="" data-campo="solicitacao_status" data-valor="2">Encaminhar</span>
  <?php } ?>

   <?php if ( ($solicitacao->solicitacao_status==1) || ($pag == "aprovacao")) {  ?>
 <input type="submit" style="" name="alterar_aumento" value="Salvar" class="btn btn-primary">
 <?php } ?>

</div>

<div class="fleft-5 fleftmobile" style="margin: 20px 0px 0px 10px;">
<span class="label label-default " style="font-size: 1.3em;">Aprovadores</span>

<div class="clearfix" style="margin: 7px 0px;"></div>

<?php foreach ($aprovadores as $key => $value) { 

  $nome = explode(" ", $value->fun_nome)[0];
  ?>
<a href="#" class="friend fleft-2">
  <img src="<?php echo $value->fun_foto; ?>" style="border: 3px solid #ccc;border-radius: 20%;">
  <span><?php echo $nome; ?></span>
</a>
<?php } ?>

</div>


<?php if (!empty($log)) { ?>
<div class="fleft-5 fleftmobile" style="margin: 20px 0px 0px 10px;">
<span class="label label-default " style="font-size: 1.3em;">Sequencia de aprova��es</span>

<div class="clearfix" style="margin: 7px 0px;"></div>

 <?php foreach ($log as $key => $value) { 
  $dtconvert = date('Y-m-d H:m:s' , strtotime($value->log_datahora) );
  $dtlog = explode(" ", $dtconvert);
  $dt = $this->Log->alteradata1( $dtlog[0] );
  $hr = substr($dtlog[1], 0, 5 );
  ?>
<label class="font-sub"><?php echo $dt. " " .$hr; ?></label>
<br>
<label class="control-label"><?php echo $value->fun_nome; ?>: </label>
<span><?php echo $value->log_comentario; ?></span>
<div class="clearfix" style="margin: 7px 0px;"></div>
<?php } ?>
 </div>
<?php } ?><!-- fim do if -->


<input type="hidden" id="solicitacao" name="solicitacao" value="<?php echo $solicitacao->solicitacao_id; ?>">
<input type="hidden" name="" id="salario" value="<?php echo $solicitacao->sal_valor; ?>" >
<input type="hidden" id="pag" name="pag" value="<?php echo $pagina; ?>">

<div class="clearfix" ></div>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $('.campodata').datepicker({
      format: 'dd/mm/yyyy'
    });

    $(".campomoeda").maskMoney({thousands:'.',decimal:','});
    
    $("#novovalor").blur(function(){

      var sal_atual = Number($("#salario").val() );
      var sal_novo = Number( $(this).val().replace(".", "").replace(/,/g , ".") );
      var dif = sal_novo - sal_atual;
      var porc = (dif * 100) / sal_atual;
      $("#porcentagem").html(porc.toFixed(2) + "%");      
      
    });

  });
</script>