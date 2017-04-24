<div id="page-content-wrapper" class="rm-transition">
	<div id="page-content">
<?php 

$arr[] = "aniversario.jpg";
$arr[] = "aniversario1.jpg";
$arr[] = "aniversario2.jpg";
$arr[] = "aniversario3.jpg";
$arr[] = "aniversario4.jpg";
$bg = $arr[array_rand($arr)];


?>
	 <div class="col-md-12">
            <h3 class="content-box-header bg-primary">Aniversariantes do mês</h3>
	 <div class="content-box" >

           <div class="panel-content image-box" style="height: 200px;padding: 0px;background-image: url(http://localhost/lucas/assets/dummy-images/<?php echo $bg; ?>);background-size: 100%;">
                
                </div>
               <div class="content-box-wrapper">
               		<?php foreach ($aniversariantes as $key => $value) {?>
               	 <div class="col-md-3">
               		<div class="panel-layout">
                        <div class="panel-box">

                            <div class="" style="background: rgba(255, 255, 255, 0.8); border-radius: 3px;">

                                <div class="col-md-5">
                                    <img src="<?php echo $value->fun_foto; ?>" alt="" class="imgcirculo_p">
                                    
                                </div>
                                <div class="col-md-7">
                                 <h5 class="font-bold"><?php echo $value->fun_nome; ?></h5>
                                 <h5 class="font-sub"><?php echo $this->Log->alteradata1($value->fun_datanascimento); ?></h5>
                                 </div>
                                <div class="clearfix"></div>

                            </div>
                            <div class="">
                                <textarea class="form-control textarea-xs"></textarea>
                                <input type="button" class="btn btn-primary" value="Enviar"  />
                            </div>

                        </div>
                      </div>
                    </div><?php }?>

<div class="clearfix"></div>
                </div>
         </div>
      </div>






	 </div><!-- #page-content -->


</div>