<?php  
if ($modal) { ?>
<div style="padding: 10px;">
  <?php if (!empty($newsletter->url_imagem_newsletter)){ ?>
  
    <img src="<?php echo $newsletter->url_imagem_newsletter; ?>" style="max-width: 100%" >
  <?php } ?>
  <br><br>
<?php echo $newsletter->descricao_newsletter; ?>
  
    <br>
    <span class="font-sub">Fonte: <?php echo $newsletter->fonte_newsletter; ?></span>
    <br>
    <?php 
    $datahora = date('Y-m-d H:m:s', strtotime($newsletter->data_newsletter) );
    list($data, $hora) = explode(" ", $datahora);
    $data = $this->Log->alteradata1( $data );
    ?>
    <span class="font-sub"><?php echo $newsletter->descricao_categoria_newsletter; ?></span>
    <span class="font-sub bold"><?php echo $data; ?></span>
  </div>  
<?php }else{  
foreach ($newsletter as $key => $value) { ?> 

<div class="boletim" data-id="<?php echo $value->id_newsletter; ?>" style="height: 230px;">
  <?php if (!empty($value->url_imagem_newsletter)){ ?>
  <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
    <img src="<?php echo $value->url_imagem_newsletter; ?>" style="" >
  </div>
  <?php } ?>

  <div class="" style="padding: 0px 5px;">
    <span class="bold" id="tit<?php echo $value->id_newsletter; ?>"><?php echo $value->titulo_newsletter; ?></span>
    <br>
    <?php 
    $datahora = date('Y-m-d H:m:s', strtotime($value->data_newsletter) );
    list($data, $hora) = explode(" ", $datahora);
    $data = $this->Log->alteradata1( $data );
    ?>
    <span class="font-sub"><?php echo $value->descricao_categoria_newsletter; ?></span>
    <span class="font-sub bold"><?php echo $data; ?></span>
    <br><br>

    <?php echo substr(strip_tags($value->descricao_newsletter), 0, 100).'...' ; ?>
    
  </div>

</div>
<?php } } ?>