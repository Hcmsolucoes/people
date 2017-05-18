
<?php if (count($feedbacks)>0) { 
$rand = rand(0,100);
	?>

<div class="panel-group accordion">
	<div class="panel panel-primary">
		<div class="panel-heading ui-draggable-handle">
			<h4 class="panel-title">
				<a href="#<?php echo $rand; ?>">
					Feedbacks do colaborador
				</a>
			</h4>
		</div>

		<div class="panel-body panel-body-open" id="<?php echo $rand; ?>" style="display: block;">
			<div class="messages messages-img panel-group accordion">
				<?php 

				foreach ($feedbacks as $key => $value) {
					$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
					$foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
					?>

					<div class="item item-visible">
						<div class="image">
							<img src="<?php echo $foto ?>" >
						</div>                                
						<div class="text">
							<div class="heading">
								<a href="#" style="margin: 0px 30px 0px 0px;"><?php echo $value->fun_nome; ?></a>

								<span><?php echo $value->desc_pergunta; ?></span>
								<?php if (!empty($value->rating_competencia)) { ?>
								<img src="<?php echo base_url("assets/img")."/".$value->rating_competencia."star.png"; ?>" style="max-width: 60px;" />
								<?php } ?>
								<span class="date"><?php echo $this->Log->alteradata1($value->feed_data)?></span>
							</div>                                    
							<?php echo $value->feed_depoimento ?>
						</div>
					</div>

					<?php } ?>

				</div>
			</div>                                
		</div>
	</div>


	<?php } ?>
	<script type="text/javascript">
		$(".accordion .panel-title a").on("click",function(){
        
        var blockOpen = $(this).attr("href");
        var accordion = $(this).parents(".accordion");        
        var noCollapse = accordion.hasClass("accordion-dc");
        
        
        if($(blockOpen).length > 0){
            if($(blockOpen).hasClass("panel-body-open")){
                $(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });
            }else{
                $(blockOpen).slideDown(200,function(){
                    $(this).addClass("panel-body-open");
                });
            }
            
            if(!noCollapse){
                accordion.find(".panel-body-open").not(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });                                           
            }
            
            return false;
        }
        
    });
	</script>