
<?php 

$starray[0]="online";
$starray[1]="offline";
$starray[2]="away";

foreach ($dadoschefe as $key => $value) {
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); 
  $nome = $value->fun_nome; 
  $cargo = $value->fun_cargo;
  $matricula = $value -> fun_matricula;
  $email = $value-> fun_email;
        $endereco1 = $value->end_rua.", ".$value->end_numero. " ".$value->end_complemento ;
        $endereco2 = "Bairro: ". $value->bair_nomebairro." - ".$value->cid_nomecidade. " / ".$value->est_nomeestado  ;
        $cep = $value->end_cep;
  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
  $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
  $id = $value->fun_idfuncionario;

  $opts = "";
  foreach ($tipodecalculo as $value) {
    $data = $value->tipo_mesref;
    $data = explode("-", $data);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->tipo_idtipodecalculo."'>".$mes.'/'.$ano."</option>";
  }

?>
<div class="fleft-3" id="basic_perfil" style="top: auto;">
   <div class="fleft">
     <div class="panel panel-default">
        <div class="panel-body profile">
            <div class="profile-image">
                <img src="<?php echo $foto; ?>" alt=""/>
           
            </div>
            <div class="profile-data">
                <div class="profile-data-name"><?php echo $nome; ?></div>
                <div class="profile-data-title"><?php echo $cargo; ?></div>
            </div>
          
        </div>                                
        <div class="panel-body">                                    
            <div class="contact-info">
                <!--<p><small>Telefone</small><br/>(+55) 5555-4465</p>-->
                <p><small>Email</small><br/><?php echo $email; ?></p>
                <!--<p><small>Endereço</small><br/><?php echo $endereco1 ; ?></p>
                <p><?php echo $endereco2 ; ?></p> 
                <p><small>CEP</small><br/><?php echo $cep ; ?></p>-->                                
            </div>
        </div>                                
     </div>
   </div>


   

<div class="fleft-10">
   <div class="list-group border-bottom" style="text-align: left;">
    <a href="#subordinados" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item active">
      <span class="fa fa-bar-chart-o"></span> Subordinados
    </a>
  <?php if (!empty($parametros)) {
          if($parametros->ic_gestorponto == 1){ ?>
    <a href="#espelho" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-clock-o"></span> Cartão de ponto
    </a>
  <?php } } ?>
    <a href="#holerite" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-book "></span> Holerite
    </a>

    <a href="#consulta" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-search"></span> Consulta
      </a>    
     <!--<a href="#ferias" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-tachometer"></span> Recibo de férias
      </a>-->
  </div>
</div>

   
</div>

<!--
<div class="col-md-4 btn-default list-group-item" style="height: 130px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold corsec"><?php echo $value->fun_nome; ?></span><br>
  <span class="bold">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admissão: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
  <span class="bold ">Cargo: </span><span class="font-sub "><?php echo $value->fun_cargo; ?></span><br> 
  <span class="bold ">Departamento: </span><span class="font-sub "><?php echo $value->contr_departamento; ?></span> 


<div id="voltar" class="fright" style="font-size: 25px; cursor: pointer;">
  <i class="fa fa-arrow-left" aria-hidden="true"></i>
</div>

</div>-->
<?php } ?>

<div class="col-md-8">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="subordinados">
      <div class="widget widget-default" >

<h3 class="fleft" style="width: 90%;">Liderados por <?php echo $nome; ?>
  <div id="voltar" class="fright" style="font-size: 25px; cursor: pointer;">
  <i class="fa fa-arrow-left" aria-hidden="true"></i>
</div>
</h3>

<div class="clearfix"></div>

<?php foreach ($subordinados as $key => $value) {
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); ?>
  
<div class="col-md-6 btn-default list-group-item" style="min-height: 120px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold "><?php echo $value->fun_nome; ?></span><br>
  <span class="bold ">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admissão: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
  <span class="bold ">Cargo: </span><span class="font-sub "><?php echo $value->fun_cargo; ?></span><br> 
  <span class="bold ">Departamento: </span><span class="font-sub "><?php echo $value->contr_departamento; ?></span> 
</div>

<?php } ?>
</div>

    </div>
<?php if (!empty($parametros)) {
          if($parametros->ic_gestorponto == 1){ ?>
      <div role="tabpanel" class="tab-pane" id="espelho">
        <div class="panel panel-default">
       <div class="panel-body">
                <p>Use a pesquisa para localizar o espelho do ponto</p>
                <form id="formespelho" class="form-horizontal" method="post" action="<?php echo base_url('perfil/soap') ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="calcespelho" name="calcespelho" class="form-control cinza">
                                      <option>Selecione a competência</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                 <input type="submit" class="btn btn-primary" id="espelhopesquisar" value="Pesquisar" />
                                </div>
                            </div>
                            <img id="loadespelho" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" >
                            <!--<span class="btn btn-default" id="esconder" style="display: none;">Mostrar/Esconder espelho do ponto</span>-->

                        </div>
                    </div>
                    <input type="hidden" name="colab" value="<?php echo $id; ?>">
                </form>                                    
            </div>
     </div>
     <div id="espelhoresult" class="fleft-10"></div>
      </div> 
<?php } } ?>

      <div role="tabpanel" class="tab-pane" id="holerite">
        <div class="widget widget-default">

          <div id="holerith" data-acesso="0">
            <img id="loadholerite" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
          </div>

        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="consulta">
        <div class="col-md-12">
                            
                            <!-- START TIMELINE -->
                            <div class="timeline">
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date">2014</div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item">
                                    <div class="timeline-item-info">Yesterday</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading">
                                            <img src="assets/images/users/user2.jpg"/> <a href="#">John Doe</a> added article <a href="#">Lorem ipsum dolor sit amet</a>
                                        </div>
                                        <div class="timeline-body">
                                            <img src="assets/images/gallery/nature-4.jpg" class="img-text" width="150" align="left"/>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempus dolor id orci lacinia, eget aliquam velit consequat.</p>
                                            <p>Vivamus at tincidunt lectus, faucibus condimentum quam. Duis facilisis sem sed eros malesuada, vel dignissim diam ornare. Etiam rhoncus, nibh non auctor mattis, ligula diam mattis dolor, non tincidunt lectus velit nec metus. 
                                               Phasellus dictum justo vitae ornare lobortis. Integer ut lectus vel mauris tempor ultricies eget vitae turpis. Sed eleifend odio quis rutrum volutpat.</p>
                                            <ul class="list-tags">                                            
                                                <li><a href="#"><span class="fa fa-tag"></span> tempor</a></li>
                                                <li><a href="#"><span class="fa fa-tag"></span> eros</a></li>
                                                <li><a href="#"><span class="fa fa-tag"></span> suspendisse</a></li>
                                                <li><a href="#"><span class="fa fa-tag"></span> dolor</a></li>
                                            </ul>                                            
                                        </div>
                                        <div class="timeline-body comments">
                                            <div class="comment-item">
                                                <img src="assets/images/users/user4.jpg"/>
                                                <p class="comment-head">
                                                    <a href="#">Brad Pitt</a> <span class="text-muted">@bradpitt</span>
                                                </p>
                                                <p>Awesome, man, that is awesome...</p>
                                                <small class="text-muted">10h ago</small>
                                            </div>                                            
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>                                        
                                        <div class="timeline-footer">
                                            <a href="#">Read more</a>
                                            <div class="pull-right">
                                                <a href="#"><span class="fa fa-comment"></span> 35</a> 
                                                <a href="#"><span class="fa fa-share"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info">29 Sep 2014</div>
                                    <div class="timeline-item-icon"><span class="fa fa-image"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading">
                                            <img src="assets/images/users/user.jpg"/> <a href="#">Dmitry Ivaniuk</a> posted <a href="#">@Nature</a> images
                                        </div>
                                        <div class="timeline-body" id="links">                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="assets/images/gallery/nature-1.jpg" title="Nature Image 1" data-gallery>
                                                        <img src="assets/images/gallery/nature-1.jpg" class="img-responsive img-text"/>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="assets/images/gallery/nature-2.jpg" title="Nature Image 2" data-gallery>
                                                        <img src="assets/images/gallery/nature-2.jpg" class="img-responsive img-text"/>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="assets/images/gallery/nature-3.jpg" title="Nature Image 3" data-gallery>
                                                        <img src="assets/images/gallery/nature-3.jpg" class="img-responsive img-text"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-body comments">
                                            <div class="comment-item">
                                                <img src="assets/images/users/user2.jpg"/>
                                                <p class="comment-head">
                                                    <a href="#">John Doe</a> <span class="text-muted">@johndoe</span>
                                                </p>
                                                <p>Amazing! Where did you get it?</p>
                                                <small class="text-muted">10h ago</small>
                                            </div>                                            
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>                                                                                
                                    </div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item">
                                    <div class="timeline-item-info">06 Oct 2014</div>
                                    <div class="timeline-item-icon"><span class="fa fa-star"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="assets/images/users/user2.jpg"/> 
                                            <a href="#">John Doe</a> joined group <a href="#">Web Developers</a>
                                        </div>     
                                        <div class="timeline-body comments">
                                            <div class="comment-item">
                                                <img src="assets/images/users/user.jpg"/>
                                                <p class="comment-head">
                                                    <a href="#">Dmitry Ivaniuk</a> <span class="text-muted">@Aqvatarius</span>
                                                </p>
                                                <p>You r welcome my friend :)</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <div class="comment-item">
                                                <img src="assets/images/users/user2.jpg"/>
                                                <p class="comment-head">
                                                    <a href="#">John Doe</a> <span class="text-muted">@johndoe</span>
                                                </p>
                                                <p>Thank you, Dmitry!!! ;)</p>
                                                <small class="text-muted">1 min ago / to @Aqvatarius</small>
                                            </div>
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info">5 Sep 2014</div>
                                    <div class="timeline-item-icon"><span class="fa fa-map-marker"></span></div>
                                    <div class="timeline-item-content">                                        
                                        <div class="timeline-body padding-0">
                                            <div id="google_ptm_map" style="width: 100%; height: 150px;"></div>
                                        </div>                         
                                        <div class="timeline-heading">
                                            <img src="assets/images/users/user2.jpg"/> <a href="#">John Doe</a> invite you to <a href="#">@Event</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item">
                                    <div class="timeline-item-info">06 Oct 2014</div>
                                    <div class="timeline-item-icon"><span class="fa fa-users"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="assets/images/users/user3.jpg"/>
                                            <a href="#">Nadia Ali</a> added to friends 
                                            <img src="assets/images/users/user.jpg"/>
                                            <img src="assets/images/users/user2.jpg"/>
                                            <img src="assets/images/users/user4.jpg"/>
                                        </div>                                        
                                        <div class="timeline-body comments">
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date">2013</div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info">30 Dec 2013</div>
                                    <div class="timeline-item-icon"><span class="fa fa-user"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading padding-bottom-0" style="padding-bottom: 10px;">
                                            <img src="assets/images/users/user2.jpg"/>
                                            <a href="#">John Doe</a> update user image                                            
                                        </div>                                        
                                        <div class="timeline-body text-center">
                                            <img src="assets/images/users/user2.jpg" width="100" class="img-circle img-thumbnail"/>
                                        </div>
                                        <div class="timeline-body comments">
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->
                            </div>
                            <!-- END TIMELINE -->
                            
                        </div>

      </div>

      <div role="tabpanel" class="tab-pane" id="ferias">

      </div>

  </div><!--tab content-->


</div><!--col md 8-->

<div style="clear: both;"></div>

<script type="text/javascript">
$("#voltar").on("click", function(){
  
  location.reload();
  
});


$( "#formespelho" ).on("submit", function(e) {
        e.preventDefault();

       $("#loadespelho").fadeIn("slow");

        $("#espelhopesquisar").prop("disabled", true);
       
        $.ajax({           
            type: "POST",
            url: '<?php echo base_url("perfil/soap"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data: $( this ).serialize(),            
            success: function(msg) 
            {
                $("#espelhopesquisar").prop("disabled", false);
                $("#espelhoresult").html(msg);
                $("#loadespelho").fadeOut("slow");
                $("#esconder").fadeIn("slow");
            } 
        });
           

 });

$("#esconder").click(function(){
  $("#espelhoresult").toggle("slow");
});

$('a[href="#holerite"').on('shown.bs.tab', function (e) {

        if($( "#holerith" ).data("acesso")=="0"){
            $.ajax({             
                type: "POST",
                url: '<?php echo base_url("perfil/contrato_demonstrativo") ?>',
                dataType : 'html',
                secureuri:false,
                cache: false,
                data:{
                  colab: <?php echo $id; ?>
                },              
                success: function(msg) 
                {    
                    $( "#holerith" ).html(msg);
                    $( "#holerith" ).data("acesso", 1);
                } 
            });
        }
    });

$(".list-group-item").click(function(){
    $(".list-group-item").removeClass("active");
    $(this).addClass("active");
    });
</script>
