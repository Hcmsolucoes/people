<?php 


?>
<style type="text/css">
    .timeline:before{
        left: 80%;
    }
    .timeline .timeline-item.timeline-main{
        width: 80%;
    }
    .timeline .timeline-item{
        width: 80%;
    }
    .pad10{
        padding: 10px;
    }
</style>
<div class="fleft-10">

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