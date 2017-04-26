
<?php foreach ($analises as $key => $value) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-target="#analise<?php echo $value->id_analise; ?>" >
        <span class="font-sub bold">
          <?php 
          $datahora = date('Y-m-d H:m:s' , strtotime($value->data_analise) );
          list($data, $hora) = explode(" ", $datahora);
          $data = $this->Log->alteradata1( $data );
          echo $data . " " . $hora; ?>
        </span>
    </div>
    <div id="analise<?php echo $value->id_analise; ?>" class="panel-collapse collapse " role="tabpanel" >
      <div class="panel-body lg-img"><?php echo $value->descricao_analise; ?></div>
    </div>
  </div>
 <?php } ?>
