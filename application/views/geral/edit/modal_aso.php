<div class="panel-body list-group list-group-contacts">
<?php 

foreach ($vencer as $key => $value) {

	$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
    $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
  ?>
   <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class="list-group-item">
   	<img src="<?php echo $foto; ?>" class="fleft imgcirculo_p" style="width: auto;" />
    <span class="contacts-title fleft"><?php echo $value->fun_nome; ?></span>
    <br />
    <span><b>Cargo:</b> <?php echo $value->contr_cargo; ?></span>
    <br />
    <span><b><?php echo $tipo; ?>:</b> <?php echo $this->Log->alteradata1( $value->fun_proximoexame); ?></span>
   </a>

<?php } ?>
</div>
