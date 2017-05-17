<?php 

?>

<div class="fleft-10 fleftmobile">
  <table id="" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Treinamento para o cargo</th>
        <th>Requisito</th>
        <th>Andamento</th>
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