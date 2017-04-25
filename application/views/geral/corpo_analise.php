<style type="text/css">
	.panel-collapse img{
		max-width: 100%;
	}
</style>


<?php foreach ($analises as $key => $value) { ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" href="#analise<?php echo $value->id_analise; ?>" aria-expanded="true">
        <span class="font-sub bold">
          <?php echo $this->Log->alteradata1($value->data_analise); ?>
        </span>
    </div>
    <div id="analise<?php echo $value->id_analise; ?>" class="panel-collapse collapse " role="tabpanel" >
      <div class="panel-body"><?php echo $value->descricao_analise; ?></div>
    </div>
  </div>
 <?php } ?>
