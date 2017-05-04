<?php 
$avatar = ( $colaborador->fun_sexo==1 )?"avatar1":"avatar2";
$foto = (empty($colaborador->fun_foto) )? base_url("img/".$avatar.".jpg") : $colaborador->fun_foto;
?>
<div class="fleft">
  <img class="fleft" src="<?php echo $foto; ?>" style="margin: 0px 10px 0px 0px;border: 3px solid #ccc;max-width: 90px;border-radius: 20%;">
</div>

<div class="fleft fleftmobile" id="div">
        			<span class="fleft font-sub bold"><?php echo $colaborador->fun_nome; ?></span>
        			<br>
        			<span class="fleft bold">Matricula:</span>&nbsp;<span><?php echo $colaborador->fun_matricula; ?></span>
        			<br />
        			<span class="fleft bold">Admissão:</span>&nbsp;<span><?php echo $this->Log->alteradata1($colaborador->contr_data_admissao); ?></span>
        			<br />
        			<span class="fleft bold">Cargo:</span>&nbsp;<span><?php echo $colaborador->contr_cargo; ?></span>
        			<br />
        			<span class="fleft bold">Departamento:</span>&nbsp;<span><?php echo $colaborador->contr_departamento; ?></span>
        			<br />
        			<span class="fleft bold">Salario Atual:</span>&nbsp;R$<span><?php echo number_format($colaborador->sal_valor, 2, ".", ","); ?></span>
        			<br />
        		</div>

<div class="clearfix"></div>

<div class="fleft-10 fleftmobile">
	<table id="" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Curso</th>
                  <th>Requisito</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cursos as $key => $value) { 

                	$req = ($value->ic_tipo==1) ? "Obrigatório": "Desejável" ;
                	$cor = ($value->ic_tipo==1) ? "red": "green" ;
                	$status = (empty($value->id_status_treinamento) )? "Sem informação" : $value->descricao_status_treinamento;
                	?>
                <tr class="linha" id="<?php //echo $value->solicitacao_id; ?>" >
                  <td><?php echo $value->nomecurso; ?></td>
                  <td class="bold <?php echo $cor; ?>"><?php echo $req; ?></td>
                  <td><?php echo $status ?></td>
                </tr>
                <?php }  ?>
              </tbody>
            </table>
</div>