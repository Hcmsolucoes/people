

<?php 
if ( isset( $_SESSION['img'] ) ) {
	$img = $_SESSION['img']; ?>

	<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/cropper.css') ?>"/>

	<script type="text/javascript" src="<?php echo base_url('/js/cropper.js'); ?>"></script>
	
	<script type="text/javascript">

	$(document).ready(function(){

		var image = document.getElementById('imagem');
		var cropper = new Cropper(image, {
			aspectRatio: 1 / 1,
			minContainerWidth: 400,
			minContainerHeight: 400, 
			crop: function(e) {
				$("#x").val(e.detail.x);
				$("#y").val(e.detail.y);
				$("#tam").val(e.detail.width);				
			}
		});

		$("form").on('submit', function(){
			$("#loadimg").show();
		});


	});
		
	</script>

	

	<form method="post" enctype="multipart/form-data" action="<?php echo base_url('/perfil_edit/foto_edit'); ?>" >

		<button type="submit" name="" class="btn btn-primary" ><span class="fa fa-check"></span> Cortar</button>
		<span class="btn btn-danger" data-dismiss="modal" ><span class="fa fa-times"></span>Cancelar</span>
		
		<img id="imagem" src="<?php echo $img; ?>" style="max-width: 500px;" />

		<input type="hidden" name="tam" id="tam" />
		<input type="hidden" name="x" id="x" />
		<input type="hidden" name="y" id="y" />
	</form>

	<?php }else{ ?>

	<form method="post" enctype="multipart/form-data" action="<?php echo base_url('/perfil_edit/foto_edit'); ?>" >
		<input type="file" name="fotoperfil" id="fotoperfil" accept="image/*" />
		<br />
		<img id="loadimg" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
		<button type="submit" name="" class="btn btn-primary" ><span class="fa fa-check"></span> Salvar</button>
		<span class="btn btn-danger" data-dismiss="modal" ><span class="fa fa-times"></span>Cancelar</span>
	</form>

	<?php } ?>
