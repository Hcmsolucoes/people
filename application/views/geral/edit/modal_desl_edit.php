<?php 
    
    $avatar = ( $solicitacao->fun_sexo==1 )?"avatar1":"avatar2";
    $foto = (empty($solicitacao->fun_foto) )? base_url("img/".$avatar.".jpg") : $solicitacao->fun_foto;
    $situacao = ($solicitacao->fun_status=="A")? "Ativo" : "Inativo";

    $datahora_efetiva = date('Y-m-d H:m:s' , strtotime($solicitacao->data_efetiva) );
list($data2, $hora2) = explode(" ", $datahora_efetiva);
$data2 = $this->Log->alteradata1( $data2 );
$disable="";
$pagina = '';
if ($pag == "aprovacao") {
  $disable = "readonly='true' disabled='true'";
  $pagina = 'gestor/aprovacoes';
}
?>

<h4>Status da solicitação:&nbsp;<span class="bold"><?php echo $solicitacao->descricao_status_solicitacao; ?></span></h4>
<form name="form_desligamento" id="form_desligamento" action="<?php echo base_url('gestor/salvarDesligamento'); ?>" method="post">

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
<div class="separador"></div>

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

  <label for="dt_desligamento" class="control-label">Data do desligamento</label>
   <div class='input-group' >
    <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="" value="<?php echo $data2; ?>" data-date-start-date="+0d">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>

  </div>  
</div>

<div class="clearfix"></div>

             <div class="fleft-7" style="margin-top: 20px;">
                <label for="" class="control-label">Motivo do desligamento</label>
                <div class="clearfix" ></div>
                <?php  ?>
                <select name="selectmotivo" id="selectmotivo" required="true">
                  <option value="1" <?php echo ($solicitacao->motivo_desligamento==1)? "selected":""; ?>>Pedido de demissão</option>
                  <option value="2" <?php echo ($solicitacao->motivo_desligamento==2)? "selected":""; ?>>Dispensa sem justa causa</option>
                  <option value="3" <?php echo ($solicitacao->motivo_desligamento==3)? "selected":""; ?>>Dispensa com justa causa</option>
                  <option value="4" <?php echo ($solicitacao->motivo_desligamento==4)? "selected":""; ?>>Término do contrato de experiência</option>
                  <option value="5" <?php echo ($solicitacao->motivo_desligamento==5)? "selected":""; ?>>Rescisão antecipada do contrato de experiência pelo empregador</option>
                  <option value="6" <?php echo ($solicitacao->motivo_desligamento==6)? "selected":""; ?>>Rescisão antecipada do contrato de experiência pelo funcionário</option>
                  <option value="7" <?php echo ($solicitacao->motivo_desligamento==7)? "selected":""; ?>>Falecimento do empregado</option>
                </select>
             </div>

             <div class="clearfix"></div>

             <div class="fleft-7" style="margin-top: 20px;">
                <label for="" class="control-label">Reposição de vaga</label>
                <div class="clearfix" ></div>
                <select name="reposicao" id="reposicao">
                  <option value="0" <?php echo ($solicitacao->ic_reposicao_vaga==0)? "selected":""; ?>>Não</option>
                  <option value="1" <?php echo ($solicitacao->ic_reposicao_vaga==1)? "selected":""; ?>>Sim</option>
                </select>
             </div>


<div class="clearfix"></div>

<img id="load_acao" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">

<div class="fleft" style="margin-top: 20px;">     
 <label for="motivo" class="control-label">Observação</label>
 <div class="clearfix" ></div>
 <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%" <?php echo $disable; ?>><?php echo $solicitacao->motivo_solicitacao; ?></textarea>
 
 <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
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

<div class="clearfix"></div>
<?php //if ($pag != "aprovacao") {  ?>
<div class="fleft-7 fleftmobile" style="">

  <?php if ( ($solicitacao->solicitacao_status==1) && ($pag == "") ) {  ?>
  <span id="encaminhar" class="btn btn-primary acao" style="" data-campo="solicitacao_status" data-valor="2">Encaminhar</span>
  <?php } ?>
  <?php if ( ($solicitacao->solicitacao_status==1) || ($pag == "aprovacao")) {  ?>
  <input type="submit" style="" name="alterar_desligamento" value="Salvar" class="btn btn-primary">
  <?php } ?>

  <!--<span class="btn btn-danger" style="" data-dismiss="modal">Sair</span>-->
               <!--<span id="aprovar" class="btn btn-default acao" style="width: 100%;margin-bottom: 7px;" data-campo="solicitacao_status" data-valor="3">Aprovar</span>

               <span id="rejeitar" class="btn btn-default acao" style="width: 100%;" data-campo="solicitacao_status" data-valor="4">Rejeitar</span>-->
</div>
<?php //} ?>
<input type="hidden" id="solicitacao" name="solicitacao" value="<?php echo $solicitacao->solicitacao_id; ?>">
<input type="hidden" id="pag" name="pag" value="<?php echo $pagina; ?>">
<div class="clearfix"></div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.campodata').datepicker({
            format: 'dd/mm/yyyy'
        });
	});
</script>

