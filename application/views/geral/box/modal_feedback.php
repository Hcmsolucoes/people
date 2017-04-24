<?php 

  $avatar = ( $feedback->fun_sexo==1 )?"avatar1":"avatar2";
  $foto = ($feedback->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $feedback->fun_foto;
?>

<div class="fleft" style="margin:0px 10px;">
    <img src="<?php echo $foto; ?>" style="border: 3px solid #ccc;max-width: 90px;border-radius: 20%;" >
    </div>

    <div class="fleft" style="line-height: 25px;">
   <span class="bold"><?php echo $feedback->fun_nome; ?></span><br>
   <span class="bold font-sub"><?php echo $feedback->desc_pergunta; ?></span> 
   <img src="<?php echo base_url("assets/img")."/".$feedback->rating_competencia."star.png"; ?>" style="max-width: 60px;" /><br>
    <span class="font-sub"><?php echo $this->Log->alteradata1($feedback->feed_data); ?></span><br>

    </div>

<div class="clearfix"></div>

  <div class="fleft fleftmobile" style="margin:10px;">
  <h3>Feedback</h3>
    <span class=""><?php echo $feedback->feed_depoimento; ?></span><br>
  </div>

<div class="clearfix"></div>

  <?php if ( !empty($feedback->feed_resposta)) { ?>
  
  <div class="fleft fleftmobile" style="margin:10px;">
  <h3>Resposta</h3>
    <span class=""><?php echo $feedback->feed_resposta; ?></span><br>
  </div>
  <?php } ?>

    <div class="clearfix"></div>
