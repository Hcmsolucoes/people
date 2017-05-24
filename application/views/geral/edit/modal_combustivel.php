<?php 

$avatar = ( $solicitacao->fun_sexo==1 )?"avatar1":"avatar2";
$foto = (empty($solicitacao->fun_foto) )? base_url("img/".$avatar.".jpg") : $solicitacao->fun_foto;
$situacao = ($solicitacao->fun_status=="A")? "Ativo" : "Inativo";

$datahora_efetiva = date('Y-m-d H:m:s' , strtotime($solicitacao->data_efetiva) );
list($data2, $hora2) = explode(" ", $datahora_efetiva);
$data2 = $this->Log->alteradata1( $data2 );

$valorcomb = number_format($solicitacao->valor_aumento, 2, ",", ".");
$disable="";
$pagina = '';
if ($pag == "aprovacao") {
  $disable = "readonly='true' disabled='true'";
  $pagina = 'gestor/aprovacoes';
}
?>

<h4 style="margin-left: 10px;">Status da solicitação:&nbsp;<span class="bold"><?php echo $solicitacao->descricao_status_solicitacao; ?></span></h4>
<form name="form_combustivel" id="form_combustivel" action="<?php echo base_url('gestor/salvarDesligamento'); ?>" method="post">

<div class="fleft-10 fleftmobile">

    <div class="fleft">
      <img class="" src="<?php echo $foto; ?>" style="margin: 0px 10px 0px 0px;border: 3px solid #ccc;max-width: 90px;border-radius: 20%;">
    </div>

    <div class="fleft">
      <span class="fleft font-sub bold"><?php echo $solicitacao->fun_nome; ?></span>
      <br>
      <span class="fleft bold">Matricula:</span>&nbsp;<span><?php echo $solicitacao->fun_matricula; ?></span>
      <br />
      <span class="fleft bold">Admissão:</span>&nbsp;<span><?php echo $this->Log->alteradata1($solicitacao->contr_data_admissao); ?></span>
      <br />
      <span class="fleft bold">Cargo:</span>&nbsp;<span><?php echo $solicitacao->contr_cargo; ?></span>
      <br />
      <span class="fleft bold">Departamento:</span>&nbsp;<span><?php echo $solicitacao->contr_departamento; ?></span>
      <br />
      <span class="fleft bold">Salario Atual:</span>&nbsp;R$<span><?php echo number_format($solicitacao->sal_valor, 2, ".", ","); ?></span>
      <br />
      <span class="fleft bold">Situação Atual:</span>&nbsp;<span><?php echo $situacao; ?></span>
    </div>
</div>


 <div class="separador" style="margin-bottom: 20px;"></div>

 <div class="fleft-5 fleftmobile">
<span class="bold">Solicitante: </span><span><?php echo $funcionario->fun_nome; ?></span>
<?php 
    $dtconvert = date('Y-m-d H:m:s' , strtotime($solicitacao->data_hora_solicitacao) );
    $dtlog = explode(" ", $dtconvert);
    $dt = $this->Log->alteradata1( $dtlog[0] );
    $hr = substr($dtlog[1], 0, 5 );
  ?>
  <label class="font-sub"><?php echo $dt. " " .$hr; ?></label>
  
<div class="fleft-7" style="margin: 20px 50px 0px 0px;">

  <label for="" class="control-label">Data do vale</label>
     <div class='input-group' >
      <input class="form-control txleft campodata" type="text" name="dt_valecomb" id="dt_valecomb" placeholder="Data do vale" required="" data-date-start-date="+0d" value="<?php echo $data2; ?>">
      <span class="input-group-addon">
        <span class="fa fa-calendar"></span>
      </span>
    </div>

  </div>


<div class="fleft-7 fleftmobile ">
 <label for="" class="control-label">Situação</label>
 <select name="situacao_comb" required="true" id="situacao_comb" class="form-control" >
   <option value="">Selecione</option>
   <option value="1" <?php echo ($solicitacao->situacao_combustivel==1)? "selected" : ""; ?>>Inclusão</option>
   <option value="2" <?php echo ($solicitacao->situacao_combustivel==2)? "selected" : ""; ?>>Alteração</option>
   <option value="3" <?php echo ($solicitacao->situacao_combustivel==3)? "selected" : ""; ?>>Exclusão</option>
 </select>
</div>


  <div class="fleft-7 fleftmobile " style="margin-bottom: 20px;">
   <label for="" class="control-label">Valor do vale</label>
   <div class="input-group">                                            
    <span class="input-group-addon">R$</span>
    <input type="text" name="combvalor" id="combvalor" class="form-control campomoeda" placeholder="Valor" value="<?php echo $valorcomb; ?>">
  </div>
</div>

</div><!--fleft-5-->

<div class="clearfix"></div>

<div class="fleft" style="margin-top: 20px;">             
 <label for="motivo" class="control-label">Motivo do vale</label>

 <div class="clearfix" ></div>

 <textarea required="true" class="form-control" name="obs_comb" id="obs_comb" cols="70" rows="5" style="width: 100%" <?php echo $disable; ?> ><?php echo $solicitacao->motivo_solicitacao; ?></textarea>

 <?php if ( ($solicitacao->solicitacao_status==1) || ($pag == "aprovacao")) {  ?>
 <input type="submit" style="" id="alterar_comb" name="alterar_comb" value="Salvar" class="btn btn-primary">
 <?php } ?>

 <?php if ( ($solicitacao->solicitacao_status==1) && ($pag == "") ) {  ?>
 <span style="min-width: 105px;display: none;" id="enc_comb" class="btn btn-primary encaminhar" data-load="load_comb" data-acao="0">Encaminhar</span>
   <?php } ?>

 <span style="min-width: 105px;display: none;" id="limpar_comb" class="btn btn-default" >OK</span>
 <img id="load_comb" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>">
</div>

<input type="hidden" id="solicitacao" name="solicitacao" value="<?php echo $solicitacao->solicitacao_id; ?>">
<input type="hidden" id="pag" name="pag" value="<?php echo $pagina; ?>">

<div class="clearfix" ></div>
</form>

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
<span class="label label-default " style="font-size: 1.3em;">Sequencia de aprovações</span>

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
<script type="text/javascript">
  $(document).ready(function(){
    $('.campodata').datepicker({
      format: 'dd/mm/yyyy'
    });

    $(".campomoeda").maskMoney({thousands:'.',decimal:','});

  });
</script>