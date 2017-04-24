<?php 
$arr_situacao = array();
foreach ($situacao as $key => $value) {  

  if (!isset($arr_situacao[$value->contr_situacao])) {

    $arr_situacao[$value->contr_situacao]["qtd"]=1;

  }else{

    $arr_situacao[$value->contr_situacao]["qtd"]++;

  }
  $arr_situacao[$value->contr_situacao]["ids"][]=$value->fun_idfuncionario;

}

$arr_deficiencia = array();
foreach ($deficienciarh as $key => $value) {  

  if (!isset($arr_deficiencia[$value->descricaodeficiencia])) {

    $arr_deficiencia[$value->descricaodeficiencia]["qtd"]=1;

  }else{

    $arr_deficiencia[$value->descricaodeficiencia]["qtd"]++;

  }
  $arr_deficiencia[$value->descricaodeficiencia]["ids"][]=$value->fun_idfuncionario;

}

//escolaridade
foreach ($escolaridade as $key => $value) {  

  if (!isset($arr[$value->escolaridade_descricao])) {

    $arr[$value->escolaridade_descricao]["qtd"]=1;

  }else{

    $arr[$value->escolaridade_descricao]["qtd"]++;

  }
  $arr[$value->escolaridade_descricao]["ids"][]=$value->fun_idfuncionario;

}
$esc = "";
foreach ($arr as $key => $value) {

  $ids="";
  foreach ($value['ids'] as $k => $v) {
   $ids .= $v.",";
  } 

 $esc .= "{label: '".$key."', value: ".$value["qtd"].", ids: '".rtrim($ids,",")."' },";

}
//fim escolaridade


$idcomsubor = "";
foreach ($subordinados as $key => $value) {
   $idcomsubor .= $value->fun_idfuncionario.",";
 }
$graficosubor = "{label: 'Colaboradores com chefia', value: ".count($subordinados).", ids: '".$idcomsubor."'},";
$idnaosubor = "";
foreach ($naosubordinados as $key => $value) {
   $idnaosubor .= $value->fun_idfuncionario.",";
 }
 $graficosubor .= "{label: 'Colaboradores sem chefia', value: ".count($naosubordinados).", ids: '".$idnaosubor."'},";


?>
 <div id="vencimentosmodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
        <div class="modal-header" style="text-align: center;">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Contratos a vencer em até 90 dias</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($vencimentos as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>

      <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class="list-group-item">
    
        <img src="<?php echo $foto; ?>" class="imgcirculo_m pull-left fleft" style="width: auto;" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p><b>Vencimento: </b><?php echo $this->Log->alteradata1($value->vnccontr); ?></p>
        <p><b>Cargo: </b><?php echo $value->fun_cargo; ?></p>
        <p><b>Departamento: </b><?php echo $value->contr_cargo; ?></p>
   </a>

     <?php }?>
     </div>
     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>
   </div>

 </div>
</div><!--vencimentos-->

<div class="page-content-wrap">
<div class="page-title">

<img id="loadempresa" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading..." style="display: none;position: relative;top: 30%;left: 40%;" >

<form action="" method="post" id='selempresa' >
  <select class="fright" id="selectempresas" name="empresa">
        <option value="">Todos</option>
    <?php foreach ($empresas as $key => $value) { 

      $selected = ($value->em_idempresa==$this->input->post("empresa"))?"selected" : "" ;

      ?>

        <option value="<?php echo $value->em_idempresa ?>" <?php echo $selected; ?>><?php echo $value->em_nome; ?></option>
    <?php } ?>
    </select>
</form>                   

</div>  
    <div class="row" id="dash">

  <div class="col-md-3" data-toggle="modal" data-target="#vencimentosmodal">
      <!-- START WIDGET REGISTRED -->
      <div class="widget widget-default widget-item-icon" style="cursor: pointer;">
            <div class="widget-item-left">
                <span class="fa fa-file-text"></span>
            </div>
        <div class="widget-data">
            <div class="widget-int num-count"><?php echo count($vencimentos); ?></div>
            <div class=""><h3>Contrato Trabalho</h3></div>
            <div class="widget-subtitle">Vencimento próximos 90 dias</div>
        </div>
        <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div>


    <!-- Indicadores de Situação -->
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">

      <span class="bold corsec acenter fleft" style="width: 100%;">Situação Atual</span>

        <div class="owl-carousel" id="">     

        <?php foreach ($arr_situacao as $key => $value) { 

          $colabs="";
          foreach ($value['ids'] as $k => $v) {
            $colabs .= $v.",";
          }

        ?>        
          <div data-titulo="<?php echo $key; ?>" data-ids="<?php echo rtrim($colabs, ","); ?>" class="sit" style="cursor: pointer;">                                    
            <div class="widget-title"><?php echo $key; ?></div>                                            
            <div class="widget-int"><?php echo $value["qtd"]; ?></div>
          </div>

        <?php } ?>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>
    <!-- Fim do Indicadores de Situação -->


<div class="col-md-3" id="examesmodal">
      <div class="widget widget-default widget-carousel">

      <div class="" style="position: absolute;">
        <img src="<?php echo base_url("img/icons/iconaso.png"); ?>" style="width: 55%;" >
      </div>
        <div class="owl-carousel" id="">     

          <div data-titulo="ASO - A vencer" data-tipo="1" class="aso" style="cursor: pointer;">                                    
            <h2 class="bold acenter"><?php echo $aso1->vencimento; ?></h2>
            <div class="widget-subtitle">Vence à 15 dias</div>
          </div>

          <div data-titulo="ASO - Vencidos" data-tipo="2" class="aso">
            <h2 class="bold acenter" ><?php echo $aso2->vencidos; ?></h2>
            <div class="widget-subtitle">Vencidos</div>
          </div>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>


    <div class="col-md-3" id="sexos">
      <div class="widget widget-default widget-carousel">

      <div class="" style="position: absolute;">
        <img style="width: 23%;" src="<?php echo base_url("img/icons/sexo.png"); ?>">
      </div>
        <div class="owl-carousel" id="">     

          <div >                                    
            <h2 class="bold acenter"><?php echo $masc->masc; ?></h2>
            <div class="widget-subtitle">Sexo Masculino</div>
          </div>

          <div >
            <h2 class="bold acenter" ><?php echo $fem->fem; ?></h2>
            <div class="widget-subtitle">Sexo Feminino</div>
          </div>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div>

<div class="fleft-2 fleftmobile">
  <!-- Inicio media de idade -->  
    <?php $soma=0;
    foreach ($idade as $key => $value) {

      $date = new DateTime( $value->fun_datanascimento );
      $interval = $date->diff( new DateTime() );
      $soma += $interval->format( '%Y' );     

    }
    $c = (count($idade)==0)? 1 : count($idade);
     $media = $soma / $c;

    ?>
    <div class="col-md-12 scCol">                        
        <a href="#" class="tile tile-info tile-valign" id="grid2">
           <span style="line-height: 30px;float: center;margin: 19px 0px;">
             <?php echo number_format($media, 1, ",", ""); ?>
           </span> 
            <div class="informer informer-default">Média de idade (anos)</div>
        </a>                            
    </div>
    <!-- Fim do media de idade -->  

  
    <!-- Inicio media de Tempo Serviço -->  
    <?php $soma=0;
    foreach ($tempo_trabalhado as $key => $value) {

      $date = new DateTime( $value->contr_data_admissao );
      $interval = $date->diff( new DateTime() );
      $soma += $interval->format( '%Y' );
    }
    $d = (count($tempo_trabalhado)==0)? 1 : count($tempo_trabalhado);
     $media = $soma / $d;
    ?>
  
    <div class="col-md-12 scCol">                        
        <a href="#" class="tile tile-success tile-valign" id="grid3">
        <span style="line-height: 30px;float: center; margin: 19px 0px;"><?php echo number_format($media, 1, ",", ""); ?></span>
            <div class="informer informer-default">Tempo médio de Empresa</div>
        </a>                                                    
    </div>

  </div>


    <div class="col-md-3">
      <!-- START VISITORS BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Escolaridade Colaboradores</h3>
            <span>Nível de Escolaridade</span>
          </div>
          <ul class="panel-controls" style="margin-top: 2px;">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
              <ul class="dropdown-menu">
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
              </ul>                                        
            </li>                                        
          </ul>
        </div>
        <div class="panel-body padding-0">
          <div class="chart-holder" id="dashescolaridade" style="height: 200px;"></div>
        </div>
      </div>
      <!-- END VISITORS BLOCK -->
    </div>

    <div class="col-md-3" id="deficientes">
      <div class="widget widget-default widget-carousel">

      <div class="" style="position: absolute;">
        <img style="width: 39%;" src="<?php echo base_url("img/icons/deficiente.png"); ?>">
      </div>
        <div class="owl-carousel" id="">     

        <?php foreach ($arr_deficiencia as $key => $value) { 

          $colabs="";
          foreach ($value['ids'] as $k => $v) {
            $colabs .= $v.",";
          }

        ?>        
          <div data-titulo="<?php echo $key; ?>" data-ids="<?php echo rtrim($colabs, ","); ?>" class="def" style="cursor: pointer;">                                    
            <div class="widget-title"><?php echo $key; ?></div>                                            
            <div class="widget-int"><?php echo $value["qtd"]; ?></div>
          </div>

        <?php } ?>

        </div>                            
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
        </div>                             
      </div>         
    </div><!--dash deficiente -->

                      <div class="col-md-3">

                        <!-- START DONUT CHART -->
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Colaboradores Chefia</h3>                                
                                </div>
                                <div class="panel-body">
                                    <div id="subordinados" style="height: 300px;"></div>
                                </div>
                            </div>
                            <!-- END DONUT CHART -->                        

                        </div>

</div><!-- div row -->

</div>

<script type="text/javascript">
	$(".sit").click(function(){
  var ids = $(this).data("ids");
  var titulo = "Situação: " + $(this).data("titulo");
  $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(titulo);
        $("#myModalTamanho").removeClass("modal-lg");
        $('#myModal').modal('show');

        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('ajax/view_escolaridade') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });


	Morris.Donut({
        element: 'dashescolaridade',
        data: [
        <?php echo $esc; ?>
        ],
        colors: ['#33414E', '#1caf9a', '#FEA223', '#34812E','#1cef8a'],
        resize: true
      }).on('click', function(i, row){

        $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(row.label);
        $("#myModalTamanho").removeClass("modal-lg");

        $('#myModal').modal('show');
        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('ajax/view_escolaridade') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: row.ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });


//subordinados
  Morris.Donut({
        element: 'subordinados',
        data: [
        <?php echo $graficosubor; ?>
        ],
        colors: ['#33414E', '#1caf9a', '#FEA223', '#34812E','#1cef8a'],
        resize: true
      }).on('click', function(i, row){

        $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(row.label);
        $("#myModalTamanho").removeClass("modal-lg");

        $('#myModal').modal('show');
        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('gestor/view_colabsubor') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: row.ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });

$(".def").click(function(){
  var ids = $(this).data("ids");
  var titulo = "Situação: " + $(this).data("titulo");
  $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
        $("#titulomodal").text(titulo);
        $("#myModalTamanho").removeClass("modal-lg");
        $('#myModal').modal('show');

        $.ajax({             
          type: "POST",
          url: '<?php echo base_url('gestor/view_colabsubor') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            ids: ids
          },              
          success: function(msg) 
          {
            $( "#dadosedit" ).html(msg);

          } 
        });

      });


      $(".aso").click(function(){
    
    var titulo = $(this).data("titulo");
    var opcao = $(this).data("tipo");
    var empresa = $("#selectempresas").val();

    $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
    $("#titulomodal").text(titulo);
    $("#myModalTamanho").removeClass("modal-lg");
    $('#myModal').modal('show');

    $.ajax({             
        type: "POST",
        url: '<?php echo base_url('perfil/aso') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          opcao: opcao,
          idempresa: empresa
        },              
        success: function(msg) 
        {
          $( "#dadosedit" ).html(msg);
        } 
    });

   });

      $("#selectempresas").change(function(){
        $("#loadempresa").show();
        $("#selempresa").submit();
        //return;
/*
        $("#dash").fadeOut();
       $("#loadempresa").show();
        var empresa = $(this).val();
        
        $.ajax({
          type: "POST",
          url: '<?php echo base_url("rh/dashAjax");?>',
          dataType : 'html',
          data:{
            empresa: empresa
        },
        success: function(msg){
           
            $("#loadempresa").hide();
            $("#dash").html("");
            if(msg.id === 'erro'){
                $(".alert").addClass("alert-danger")
                .html("Houve um erro. Contate o administrador do sistema")
                .slideDown("slow");
            }else{

                $("#dash").html(msg);
                $("#dash").fadeIn();

            }

         } 
        });*/
    });


</script>
