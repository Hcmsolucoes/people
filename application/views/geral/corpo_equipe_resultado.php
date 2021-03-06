
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
<div class="fleft-2" id="basic_perfil" style="top: auto;">
   <div class="fleft">
     <div class="panel panel-default" >
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
                <!--<p><small>Endere�o</small><br/><?php echo $endereco1 ; ?></p>
                <p><?php echo $endereco2 ; ?></p> 
                <p><small>CEP</small><br/><?php echo $cep ; ?></p>-->                                
            </div>
        </div>                                
     </div>
   </div>


   

<div class="fleft-10">
   <div class="list-group border-bottom" style="text-align: left;">
   <a href="#info" aria-controls="info" role="tab" data-toggle="tab" class="list-group-item ">
      <span class="fa fa-bar-chart-o"></span> Informa��es
    </a>

    <a href="#subordinados" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item ">
      <span class="fa fa-sitemap"></span> Subordinados
    </a>
  <?php if (!empty($parametros)) {
          if($parametros->ic_gestorponto == 1){ ?>
    <a href="#espelho" aria-controls="espelho" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-clock-o"></span> Cart�o de ponto
    </a>
  <?php } } ?>
    <a href="#holerite" aria-controls="holerite" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-file-text-o "></span> Holerite
    </a>

    <a href="#feedbacks" aria-controls="feedbacks" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-comments"></span> Feedbacks
    </a>

    <a href="#consulta" aria-controls="consulta" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-search"></span> Consulta
    </a>

    <a id="voltar" href="#" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
      <span class="fa fa-arrow-left"></span> Voltar
    </a>
  </div>
</div>

   
</div>

<?php } ?>

<div class="fleft-7 fleftmobile">
  <div class="tab-content">

  <div role="tabpanel" class="tab-pane" id="info">

    <div class="col-md-7 fleftmobile">

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Evolu��o Salarial</h3>
            <span>Hist�ricos salariais</span>
          </div>
        </div>
        <div class="panel-body padding-0">
          <div class="chart-holder" id="dashboard-line-1" style="height: 256px;"></div>
        </div>
      </div>
    </div>

  </div>

    <div role="tabpanel" class="tab-pane" id="subordinados">
      <div class="widget widget-default" >

<h3 class="fleft" style="width: 90%;">Liderados por <?php echo $nome; ?></h3>

<div class="clearfix"></div>

<?php foreach ($subordinados as $key => $value) {
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); ?>
  
<div class="col-md-4 btn-default list-group-item" style="min-height: 120px;">
  <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 0px 0px;" >
  <span class="font-sub bold "><?php echo $value->fun_nome; ?></span><br>
  <span class="bold ">Matricula: </span><span class="font-sub "><?php echo $value->fun_matricula; ?></span><br> 
  <span class="bold ">Admiss�o: </span><span class="font-sub "><?php echo $admissao; ?></span><br>
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
                                      <option>Selecione a compet�ncia</option>
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
                    <input type="hidden" name="colab" id="colab" value="<?php echo $id; ?>">
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

      <div role="tabpanel" class="tab-pane" id="feedbacks">
      <div class="widget widget-default" >
          <div class="timeline">                                
          <!-- START TIMELINE ITEM -->
          <?php 

          $i = 0;

          foreach ($feedbacks as $value) {

            $lado = ( ($i % 2)==0)? "" : "timeline-item-right" ;
            $i++;
            $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
            $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
            ?>
            <div class="timeline-item <?php echo $lado; ?>">
              <div class="timeline-item-info"><?php echo $this->Log->alteradata1($value->feed_data)?></div>
              <div class="timeline-item-icon"><span class="fa fa-comments-o"></span></div>
              <div class="timeline-item-content">

                <div class="timeline-body">
                 <img src="<?php echo $foto ?>" class="imgcirculo_m " align="left" style="margin: 0px 10px 0px 0px;" />
                 <span class="font_sub bold"><?php echo $value->fun_nome ?></span>
                 <p><?php echo $value->feed_depoimento ?></p>
                 <div class="fleft">
                 <span><?php echo $value->desc_pergunta; ?></span>

                   <?php if (!empty($value->rating_competencia)) { ?>
                   <img src="<?php echo base_url("assets/img")."/".$value->rating_competencia."star.png"; ?>" style="max-width: 60px;" />
                   <?php } ?>
                   
                   <div class="clearfix"></div>
                  
                 </div>
                                      
              </div>                                     
            </div>
          </div><!-- END TIMELINE ITEM -->
          <?php } ?>
          <!-- START TIMELINE ITEM -->
          <div class="timeline-item timeline-main">
            <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
          </div><!-- END TIMELINE ITEM -->
        </div><!-- END TIMELINE -->
      </div>
    </div>

      <div role="tabpanel" class="tab-pane" id="consulta" data-acesso="0">
        <img id="loadconsulta" src="<?php echo base_url('img/loaders/default.gif') ?>" >
      </div>

      <div role="tabpanel" class="tab-pane" id="ferias"></div>

  </div><!--tab content-->


</div><!--col md 8-->

<div style="clear: both;"></div>

<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

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

$('a[href="#consulta"').on('shown.bs.tab', function (e) {

  if($( "#consulta" ).data("acesso")=="0"){
    $.ajax({
      type: "POST",
      url: '<?php echo base_url("perfil/linhahistorico") ?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        colab: <?php echo $id; ?>
      },              
      success: function(msg) 
      {
        $( "#consulta" ).html(msg);
        $( "#consulta" ).data("acesso", 1);
      }
    });
  }
});

$("a.list-group-item").click(function(){
    $('a.list-group-item').removeClass("active");
    $(this).addClass("active");
});

function drawChart() {
  var cor = "#1CAF9A";//$(".bg-primary").css("background-color");
  var dados = new google.visualization.DataTable();
  var chart = new google.visualization.LineChart(document.getElementById('dashboard-line-1'));

  dados.addColumn('string', 'data');
  dados.addColumn('number', 'valor');
  dados.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
  var options = {
    title: 'Evolu��o Salarial',
    curveType: 'function',
    pointsVisible: true ,
    series: {
      0: { color: cor }
    }      

  };
  
  $.ajax({            
    type: "post",
    url: '<?php echo base_url("ajax/evsalarial");?>',
    dataType : 'json',
    secureuri:false,
    cache: false,
    data:{
     limit : 1
   },              
   success: function(msg){

    if(msg === 'erro'){
      alert("Houve um erro");
    }else{

      dados.addRows( msg.rows);
      chart.draw(dados, options);

    }
  } 
  });

}
</script>
