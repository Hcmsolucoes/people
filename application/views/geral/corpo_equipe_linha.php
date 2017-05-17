<style type="text/css">
    
    .pad10{
        padding: 10px;
    }
    @media (max-width: 500px) {

        .timeline .timeline-item .timeline-item-info{
            left: 29%;
            margin-top: 30px;

        }
        .timeline .timeline-item{
            width: 100%;
        }
        .timeline .timeline-item .timeline-item-content{
            margin: 30% 0px 20px 0px;
            width: 100%;
        }
        .timeline .timeline-item .timeline-item-icon{
            left: 42%;
            top: -15px;
            right: 0px;
        }
        .timeline-heading{
            text-align: center;
        }
    }
    @media (min-width: 1000px) {
       .timeline:before{
            left: 80%;
        }

        .timeline .timeline-item{
            width: 80%;
        }

        .timeline .timeline-item.timeline-main{
            width: 80%;
        }
    }
</style>
<div class="fleft-10">

<div class="fleft-2 fleftmobile">
<label class=" control-label font-sub">A partir da data</label>
        <div class="" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="data fleft" name="data_inicio" id="data_inicio" placeholder="" style="max-width: 90px;" required=""/>              
            <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id=''></span>
            </span>
          </div> 
        </div>
</div>

<div class="fleft-2 fleftmobile">
    <label class=" control-label font-sub">Até a data</label>
        <div class="" style="margin-right: 10px;">
          <div class='input-group date' >
            <input type="text" class="data fleft" name="data_fim" id="data_fim" placeholder="" style="max-width: 90px;" required=""/>              
            <span class="input-group-addon fleft">
              <span class="fa fa-calendar" id=''></span>
            </span>
          </div> 
        </div>
</div>

<div class="fleft" style="margin-top: 20px;">
<span class="btn btn-default" id="filtrar">Filtrar</span>
</div>

    <div class="timeline">

        <div class="timeline-item timeline-main">
            <div class="timeline-date">2017</div>
        </div>

        <?php        
        
            foreach ($lista as $key => $value) {

                switch ($value->tipohistorico) {
                    case 'C': $titulo = "Aterações de Cargo"; 
                    $icon = 'fa-briefcase';
                    $desc = "Motivo";
                    $desc1 = $value->motivo;
                    $desc2 = "Cargo";
                    $desc3 = $value->cargo;
                    $desc4 = "Data";
                    $desc5 = $this->Log->alteradata1($value->datainicio);
                    $desc6 = "";
                    $desc7 = "";
                    break;
                    case 'F': $titulo = "Afastamentos"; 
                    $icon = 'fa-stethoscope';
                    $desc = "Motivo";
                    $desc1 = $value->motivo;
                    $desc2 = "Inicio";
                    $desc3 = $this->Log->alteradata1($value->datainicio);
                    $desc4 = "Fim";
                    $desc5 = $this->Log->alteradata1($value->datafim);
                    $desc6 = "";
                    $desc7 = "";
                    break;
                    case 'S': $titulo = "Aterações de Salário";
                    $icon = 'fa-usd';
                    $desc = "Motivo";
                    $desc1 = $value->motivo;
                    $desc2 = "Valor";
                    $desc3 = "R$ " . number_format($value->valorsalario, 2,",",".");
                    $desc4 = "Data";
                    $desc5 = $this->Log->alteradata1($value->datainicio);
                    $desc6 = "";
                    $desc7 = "";
                    break;
                    case 'T': $titulo = "Treinamentos"; 
                    $icon = 'fa-mortar-board';
                    $desc = "Treinamento";
                    $desc1 = $value->treinamentocentrocusto;
                    $desc2 = "Inicio";
                    $desc3 = $this->Log->alteradata1($value->datainicio);
                    $desc4 = "Termino";
                    $desc5 = $this->Log->alteradata1($value->datafim);
                    $desc6 = "Status";
                    $desc7 = $value->motivo;
                    break;
                    case 'U': $titulo = "Centro Custo"; 
                    $icon = 'fa-flag';
                    $desc = "Centro Custo";
                    $desc1 = $value->treinamentocentrocusto;
                    $desc2 = "Inicio";
                    $desc3 = $this->Log->alteradata1($value->datainicio);
                    $desc4 = "Termino";
                    $desc5 = $this->Log->alteradata1($value->datafim);
                    $desc6 = "";
                    $desc7 = "";
                    break;                    
                    default: break;
                }

        ?>
       
        <!-- START TIMELINE ITEM -->
        <div class="timeline-item">
            <div class="timeline-item-info"><?php echo $this->Log->alteradata1($value->datainicio); ?></div>
            <div class="timeline-item-icon"><span class="fa <?php echo $icon; ?>"></span></div>
            <div class="timeline-item-content">
                <div class="timeline-heading">
                    <span class="bold"><?php echo $titulo; ?></span>
                </div>
                <div class="timeline-body">                    
                    <div class="fleft pad10">
                    <span class="font-sub"><?php echo $desc; ?></span><br>
                    <span class=""><?php echo $desc1; ?></span>
                    </div>
                    <div class="fleft pad10">
                    <span class="font-sub"><?php echo $desc2; ?></span><br>
                    <span class=""><?php echo $desc3; ?></span>
                    </div>
                    <div class="fleft pad10">
                    <span class="font-sub"><?php echo $desc4; ?></span><br>
                    <span class=""><?php echo $desc5; ?></span>
                    </div>
                    <div class="fleft pad10">
                    <span class="font-sub"><?php echo $desc6; ?></span><br>
                    <span class=""><?php echo $desc7; ?></span>
                    </div>
                </div>                                                      
                
            </div>
        </div>       
        <!-- END TIMELINE ITEM -->
        <?php } ?>

        <!-- START TIMELINE ITEM -->
        <div class="timeline-item timeline-main">
            <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
        </div>                                
        <!-- END TIMELINE ITEM -->
    </div>
    <!-- END TIMELINE -->

</div>
<script type="text/javascript">
    $('.data').datepicker({
      
      format: 'dd/mm/yyyy',
      
    });

    $("#filtrar").click(function(){
      var inicio = $("#data_inicio").val();
      var fim = $("#data_fim").val();
      var colab = $("#colab").val();
      $( "#consulta" ).html('<img id="loadconsulta" src="<?php echo base_url('img/loaders/default.gif') ?>" >');
      $.ajax({
          type: "POST",
          url: '<?php echo base_url("perfil/linhahistorico") ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            colab: colab,
            inicio: inicio,
            fim: fim
        },              
        success: function(msg){
            $( "#consulta" ).html(msg);
        }
    });
  });
</script>