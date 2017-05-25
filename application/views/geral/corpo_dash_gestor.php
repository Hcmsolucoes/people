<?php

$arr = array();
$esc = "";

foreach ($escolaridade as $key => $value) {  

  if (!isset($arr[$value->escolaridade_descricao])) {

    $arr[$value->escolaridade_descricao]["qtd"]=1;

  }else{

    $arr[$value->escolaridade_descricao]["qtd"]++;

  }
  $arr[$value->escolaridade_descricao]["ids"][]=$value->fun_idfuncionario;

}

foreach ($arr as $key => $value) {

  $ids="";
  foreach ($value['ids'] as $k => $v) {
   $ids .= $v.",";
 } 

 $esc .= "{label: '".$key."', value: ".$value["qtd"].", ids: '".rtrim($ids,",")."' },";

}

//carga dashboard de tunover
$dadostabletunover ="";
$ticks ="[";
foreach ($turnovertotal as $key => $value) { 

  $dadostabletunover .=  "['".$value['Ano']."','".$key."',".$value['Admissao'].",".$value['Demissao'].",'".$key."'],";
  $ticks .=  "new Date('".$value['mesano']."'),";

}
$ticks .="]";

$filtrostabelas ="";

foreach ($turnoveradm as $key => $value) { 
  $dataadmissao = (!empty($value['Admissão']))? $value['Admissão'] : "";
  $datademisao = (!empty($value['Demissão']))? $value['Demissão'] : "";

  $filtrostabelas .=  "['".$value['Ano']."',new Date('".$value['mesano']."'),'".$value['mes']."','".$value['Movimentacao']."','".$value['colaborador']."','".$value['cargo']."','".$dataadmissao."','".$datademisao."','".$value['empresa']."','".$value['Centro de Custo']."'],";


}

$arr_situacao = array();
foreach ($situacao as $key => $value) {  

  if (!isset($arr_situacao[$value->contr_situacao])) {

    $arr_situacao[$value->contr_situacao]["qtd"]=1;

  }else{

    $arr_situacao[$value->contr_situacao]["qtd"]++;

  }
  $arr_situacao[$value->contr_situacao]["ids"][]=$value->fun_idfuncionario;

}

//Monta array salario por sexo
$arr_salariosexo = array();
$arr_salariosexo = "['Nome', 'Sexo', 'Idade', 'Salario','Cargo','Centro de Custo','Departamento','Admissão','Empresa'],";
foreach ($salariosexo as $key => $value) {  

  $arr_salariosexo .= "['".$value->fun_nome."','".$value->sexo."',".$value->idadefun.",".$value->sal_valor.",'".$value->fun_cargo."','".$value->contr_centrocusto."','".$value->contr_departamento."','".date("d/m/Y",strtotime(str_replace('-','/', $value->contr_data_admissao)))."','".$value->em_nome."'],";

//  if (!isset($arr[$value->escolaridade_descricao])) {


}
//echo $arr_salariosexo;

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


<div id="admitidosmodal" class="modal fade" tabindex="-1" role="document" >
 <div class="modal-dialog">
  <div class="modal-content" style="max-height:595px; overflow:scroll;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Admitidos no mês</h4>
    </div>
    <div class="modal-body" id="">
      <div class="panel-body list-group list-group-contacts">
        <?php foreach ($admitidos as $key => $value) { 
          $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
          $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
          ?>
          <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class="list-group-item">

            <img src="<?php echo $foto; ?>" class="pull-left" />
            <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
            <p>Data de Admissão <?php echo $this->Log->alteradata1($value->contr_data_admissao); ?></p>

          </a>
          <?php }?>
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
     </div>
   </div>

 </div>
</div>

<div id="demitidosmodal" class="modal fade" tabindex="-1" role="document" >
 <div class="modal-dialog">
  <div class="modal-content" style="max-height:595px; overflow:scroll;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Demitidos no mês</h4>
    </div>
    <div class="modal-body" id="">
      <div class="panel-body list-group list-group-contacts">
        <?php foreach ($demitidos as $key => $value) { 
          $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
          $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
          ?>

          <a href="#" class="list-group-item">
            <img src="<?php echo $foto; ?>" class="pull-left" />
            <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
            <p>Data de Demissão <?php echo $this->Log->alteradata1($value->datdem); ?></p>
          </a>

          <?php }?>
        </div>
      </div>

      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
     </div>

   </div>

 </div>
</div><!--demitidos modal -->

<div id="analisemodal" class="modal fade" tabindex="-1" role="document" >
 <div class="modal-dialog">
  <div class="modal-content" style="max-height:595px; overflow:scroll;">
    <div class="modal-header" style="text-align: center;">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="" >Minha análise do Dashboard atual</h4>
    </div>
    <div class="modal-body" id="">
      <img id='loadanalise' src='<?php echo base_url('img/loaders/default.gif') ?>' style="display: none;">

      <textarea id="txtanalise" name="analise" class="form-control" style="height: 100px;"></textarea>
      <span id="btnanalise" class="btn btn-info" data-st="0" >Salvar Análise</span>
      <input type="hidden" id="urlimg" >

    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal" >OK</button>
   </div>
 </div>

</div>
</div>

<div class="content-frame">

  <div class="content-frame-top">                        
    <div class="page-title">                    
    <h2><span class="fa fa-bar-chart-o"></span> Dashboards</h2>
    </div>                                      
    <div class="pull-right">
      <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
    </div>                        
  </div>

  <div class="content-frame-left">

    <div class="fleft-10">
      <!-- START VISITORS BLOCK -->
      <div class="panel panel-default">
      <a href="<?php echo base_url("gestor/relatorios"); ?>" style="text-decoration: none;" >
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Relatórios</h3>           
          </div>          
        </div>
        <div class="panel-body padding-0">
          <div class="owl" id="" style="height: 230px;" >


            <div class="boletim " style="height: 200px;">
              <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
                <img src="<?php echo base_url("assets/img/gr1.png"); ?>" style="" >
              </div>
              <div class="" style="padding: 0px 5px;">
                <span class="bold" >Acompanhe os Gráficos</span>
                <br><br>
                <p>Teste 1</p>
              </div>
            </div> 


            <div class="boletim " style="height: 200px;">
              <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
                <img src="<?php echo base_url("assets/img/gr2.jpg"); ?>" style="" >
              </div>
              <div class="" style="padding: 0px 5px;">
                <span class="bold" >Tome melhores decisões</span>
                <br><br>
                <p>Teste 2</p>
              </div>
            </div>

            <div class="boletim " style="height: 200px;">
              <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
                <img src="<?php echo base_url("assets/img/gr3.png"); ?>" style="" >
              </div>
              <div class="" style="padding: 0px 5px;">
                <span class="bold" >Seja mais eficiente</span>
                <br><br>
                <p>Teste 3</p>
              </div>
            </div>

            <div class="boletim " style="height: 200px;">
              <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
                <img src="<?php echo base_url("assets/img/gr4.jpg"); ?>" style="" >
              </div>
              <div class="" style="padding: 0px 5px;">
                <span class="bold" >Mantenha o foco nos negócios</span>
                <br><br>
                <p>Teste 4</p>
              </div>
            </div>

            <div class="boletim " style="height: 200px;">
              <div class="panel-body panel-body-image" style="text-align: center; overflow: hidden;max-height: 120px;">
                <img src="<?php echo base_url("assets/img/gr5.jpg"); ?>" style="" >
              </div>
              <div class="" style="padding: 0px 5px;">
                <span class="bold" >Não perca de vista suas metas</span>
                <br><br>
                <p>Teste 5</p>
              </div>
            </div>


          </div>
        </div>
        </a>
      </div>
      <!-- END VISITORS BLOCK -->
    </div><!--fim relatorio-->

    <div class="fleft-10">
      <span  class="btn btn-info fleft fleftmobile botoesanalise" style="padding: 4px 10px;" data-toggle="modal" data-target="#analisemodal"><i class="glyphicon glyphicon-home"></i> Minha Análise</span>

      <a id="veranalise" href="#<?php //echo base_url("gestor/analise"); ?>" class="btn btn-info fleft fleftmobile botoesanalise" style="padding: 4px 10px;" ><i class="fa fa-bar-chart-o"></i> Ver Análise</a>
    </div>

  </div><!--fim frame-left-->


  <div class="content-frame-body" style="padding-top: 0px;" id="widgetgestor">

    <div class="linha fleft-10">
      <!-- Turn Over -->
      <div class="fleft-3 meuwidget fleftmobile " id="w1">
        <div class="widget widget-default widget-carousel">
          <div class="owl" id="owl-example">
            <img id='loadturn' src='<?php echo base_url('img/loaders/default.gif') ?>' style="left: 40%;position: relative;">
          </div>                            
          <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
          </div>   
        </div>         
      </div>
      <!-- Fim do TurnOver -->

      <div class="fleft-3 meuwidget fleftmobile " id="w2">
        <div class="widget widget-default widget-item-icon" >
          <div class="widget-item-left">
            <span class="fa fa-users"></span>
          </div>
          <div class="widget-data">
            <div class="widget-int num-count"><?php echo number_format($taxasaida, 1, ",", "") . "%"; ?></div>
            <div class=""><h3>Taxa de Saídas</h3></div>
            <div class="widget-subtitle">Recém Admitidos (1º ano)</div>
          </div>
          <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
          </div>                            
        </div>                            
      </div>


      <!-- Indicadores de Situação -->
      <div class="fleft-3 meuwidget fleftmobile" id="w3">
        <div class="widget widget-default widget-carousel">
          <span class="bold corsec acenter fleft" style="width: 100%;">Situação Atual da Equipe</span>
          <div class="owl-carousel" id="">
            <?php foreach ($arr_situacao as $key => $value) { 

              $colabs="";
              foreach ($value['ids'] as $k => $v) {
                $colabs .= $v.",";
              }

              ?>        
              <div data-titulo="<?php echo $key; ?>" data-ids="<?php echo rtrim($colabs, ","); ?>" class="sit acenter" style="cursor: pointer;font-size: 1.3em;">                                    
                <div class="bold" style="line-height: 30px;"><?php echo $key; ?></div>
                <div class="bold" style="line-height: 30px;"><?php echo $value["qtd"]; ?></div>
              </div>

              <?php } ?>

            </div>                            
            <div class="widget-controls">                                
              <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
            </div>                             
          </div>         
        </div>
        <!-- Fim do Indicadores de Situação -->
      </div><!--fim do row -->


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

      <div class="linha fleft-10">
      <div class="fleft-3 meuwidget fleftmobile " id="w4">                        
          <span class="tile tile-info tile-valign widgetaltura" id="grid2">
           <span style="line-height: 30px;float: center;margin: 19px 0px;">
             <?php echo number_format($media, 1, ",", ""); ?>
           </span> 
           <div class="informer informer-default">Média de idade (anos)</div>
           <div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
         </span>                            
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

      <div class="fleft-3 meuwidget fleftmobile" id="w5">                        
        <span class="tile tile-success tile-valign widgetaltura" >
          <span style="line-height: 30px;float: center; margin: 19px 0px;"><?php echo number_format($media, 1, ",", ""); ?></span>
          <div class="informer informer-default">Tempo médio de Empresa</div>
          <div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
        </span>                                                    
      </div>


      <!--vencimentos-->
      <div class="fleft-3 meuwidget fleftmobile" id="w6" data-toggle="modal" data-target="#vencimentosmodal">
        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" style="cursor: pointer;">
          <div class="widget-item-left">
            <span class="fa fa-file-text"></span>
          </div>
          <div class="widget-data">
            <div class="widget-int num-count"><?php echo count($vencimentos); ?></div>
            <h4 class="bold">Contrato Trabalho</h4>
            <div class="widget-subtitle">Vencimento próximos 90 dias</div>
          </div>
          <div class="widget-controls">                                
            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remover este Quadro"><span class="fa fa-times"></span></a>
          </div>
        </div>                            
      </div>
    </div><!--fim da segunda linha-->

    <!-- Inicio Admitidos no mês -->
    <?php 
    $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
    $mes = $meses[date("n")]; 
    $mes_ano = $mes."/".date("Y");

    ?>
    <div class="linha fleft-10">
      <div class="fleft-3 meuwidget fleftmobile" id="w7">                        
        <a id="admitidos" href="#" data-toggle="modal" data-target="#admitidosmodal" class="tile tile-info tile-valign widgetaltura">
          <?php echo count($admitidos); ?>
          <div class="informer informer-default">Admitidos no mês</div>
          <div class="informer informer-default dir-br"><?php echo $mes_ano; ?> <span class="fa fa-users"></span></div>
        </a>                            
      </div>
      <!-- Fim do Admitidos no mês -->  


      <!-- Inicio Demitidos no mês -->  
      <div class="fleft-3 meuwidget fleftmobile" id="w8">                        
        <a href="#" data-toggle="modal" data-target="#demitidosmodal" class="tile tile-default widgetaltura">
          <?php echo count($demitidos); ?>
          <p>Demitidos no mês</p>
          <div class="informer informer-primary"><?php echo $mes_ano; ?></div>
          <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
        </a>                        
      </div>
      <!-- Fim do Demitidos no mês -->


      <div class="fleft-3 meuwidget fleftmobile" id="w9">                        
        <a href="<?php echo base_url("gestor/equipe"); ?>" data-toggle="" data-target="" class="tile tile-default widgetaltura">
          <?php echo count($equipe); ?>
          <p>Colaboradores</p>
          <div class="informer informer-primary">Minha Equipe</div>
          <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a>                        
      </div>
    </div><!--fim da terceira linha-->


    <div class="linha fleft-10">
      <div class="fleft-3 meuwidget fleftmobile"  id="w10">
        <!-- START VISITORS BLOCK -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title-box">
              <h3>Escolaridade Colaboradores</h3>
              <span>Nível de Escolaridade Minha Equipe</span>
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
            <div class="chart-holder" id="dashboard-donut-1" style="height: 185px;"></div>
          </div>
        </div>
        <!-- END VISITORS BLOCK -->
      </div>


      <!-- banco de horas da Equipe -->
      <div class="fleft-3 meuwidget fleftmobile" id="w11">
        <div class="widget widget-default widget-item-icon" >
          <div class="widget-item-left">
           <span class="fa fa-clock-o"></span>
         </div>
         <div class="widget-data">
          <div class="widget-title">220h:15m</div>
          <div class="widget-title">Banco Horas</div>
          <div class="widget-subtitle">Saldo Atual da Equipe</div>
          <div class="widget-subtitle">Data Fechamento: 30/07/2017</div>
        </div>
        <div class="widget-controls">                                
          <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
        </div>                            
      </div>                            
    </div> 


    <div class="fleft-3 meuwidget fleftmobile" id="examesmodal">
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
  </div><!--fim da quarta linha-->



  <div class="linha fleft-10">

    <div class="fleft-3 meuwidget fleftmobile" id="w12">
      <div class="widget widget-default widget-item-icon" >
        <div class="widget-item-left">
          <span class="fa fa-user"></span>
        </div>
        <div class="widget-data">
         <div class="widget-title">Membros Cipa</div>
         <div class="widget-int num-count">05</div>
         <div class="widget-subtitle">Eleição: 01/01/2017</div>
         <div class="widget-subtitle">Estabilidade: 01/01/2019</div>
       </div>
       <div class="widget-controls">                                
        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
      </div>                            
    </div>                            
  </div>    

  <div class="fleft-3 meuwidget fleftmobile" id="w13">
    <div class="widget widget-default widget-item-icon" >
      <div class="widget-item-left">
        <span class="glyphicon glyphicon-fire"></span>
      </div>
      <div class="widget-data">
       <div class="widget-title">Brigadistas</div>
       <div class="widget-int num-count">08</div>
       <div class="widget-subtitle">Engagamento: 01/01/2017</div>
       <div class="widget-subtitle">EPI's Brigada: 03</div>
     </div>
     <div class="widget-controls">                                
      <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
    </div>                            
  </div>                            
</div>    


<div class="fleft-3 meuwidget fleftmobile" id="w14">                        
  <a href="#" class="tile tile-default widgetaltura">
    32<p>EPIs Distribuídos</p>
    <div class="informer informer-primary">Minha Equipe</div>
    <div class="informer informer-success dir-tr"><span class="fa fa-users"></span></div>
  </a>
</div>
</div><!--fim da quinta linha-->

<div class="linha fleft-10">
  <div class="fleft-3 meuwidget fleftmobile" id="w15">                        
    <a href="#" class="tile tile-default widgetaltura">
      09<p>Incidentes</p>
      <div class="informer informer-primary">Últimos 12 meses (Equipe)</div>
      <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
    </a> 
  </div>      


  <div class="fleft-3 meuwidget fleftmobile" id="w16">                        
    <a href="#" class="tile tile-default widgetaltura">
      03<p>Acidentes (CAT)</p>
      <div class="informer informer-primary">Últimos 12 meses (Equipe)</div>
      <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
    </a> 
  </div>
</div><!--fim da sexta linha-->




</div><!--fim do fram-body-->
</div>
<script type="text/javascript">

  $( ".content-frame-body .linha" ).sortable({
    items: "> .meuwidget",
    connectWith: ".linha",
    stop: function(event, ui){
      var sorted = {};
      var row = 0;
      var scid = $(".content-frame-body").attr('id');
      $(".linha").each(function(){                    
        sorted[row] = {};
        $(this).find(".meuwidget").each(function(){
          var column = $(this).index();                        
          //sorted[row][column] = {};
          sorted[row][column] = $(this).attr('id');
        });
        row++;
      });
      salvarWidgets(scid,JSON.stringify(sorted)); 
      //onload();
    }
  });
  $( ".content-frame-body" ).disableSelection();

  $("li").click(function(){

    $(".dropdown-menu").find("li").removeClass("active");
  });

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

  $(".aso").click(function(){

    var titulo = $(this).data("titulo");
    var opcao = $(this).data("tipo");
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
        dash: "gestor"
      },              
      success: function(msg) 
      {
          //console.log(msg);
          $( "#dadosedit" ).html(msg);
        } 
      });

  });

  $("#veranalise").click(function(){

    var titulo = "Minhas Análises";
    $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
    $("#titulomodal").text(titulo);
    $('#myModal').modal('show');

    $.ajax({             
      type: "POST",
      url: '<?php echo base_url('gestor/analise') ?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{

      },              
      success: function(msg) 
      {
          //console.log(msg);
          $( "#dadosedit" ).html(msg);
        } 
      });

  });


  Morris.Donut({
    element: 'dashboard-donut-1',
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
  

  $(document).ready(function(){
      //$("#botao2, #botao3").removeClass("active");
      var carousel = function(){

        if($(".owl").length > 0){
          $(".owl").owlCarousel({mouseDrag: false, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
        }            
      }

      $.ajax({             
        type: "POST",
        url: '<?php echo base_url('gestor/turnover') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{

        },              
        success: function(msg) 
        {

          $( "#owl-example" ).html(msg);
          carousel();
        }

      });


      $(window).resize(function(){
        carousel();
      });

    });

  $("#analisemodal").on('hidden.bs.modal', function (e) {

  /*console.log($("#btnanalise").data("st"));

  if ($("#btnanalise").data("st")==1 ) {

    var texto= $("#txtanalise").code();

    $.ajax({           
          type: "POST",
          url: '<?php echo base_url('gestor/salvarAnalise') ?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            texto: texto
          },              
          success: function(msg) 
          {
            //$( "#dadosedit" ).html(msg);
            $("#btnanalise").data("st", 0);
             $("#txtanalise").val("");
          } 
        });
      }*/


    });

  $("#btnanalise").click(function(e){

    $(this).data("st", 1);
    $("loadanalise").show();

    if ($(this).data("st")==1 ) {
      var texto = $("#txtanalise").code();
   //console.log(texto);
   $.ajax({
    type: "POST",
    url: '<?php echo base_url('gestor/salvarAnalise') ?>',
    dataType : 'html',
    secureuri:false,
    cache: false,
    data: {
      texto: texto,
      img: $("#urlimg").val()
    },              
    success: function(msg) 
    {
      console.log(msg);
      $("loadanalise").hide();
      $("#btnanalise").data("st", 0);
      $("#txtanalise").code("");
      $("#analisemodal").modal('hide');
    } 
  });
 }

}); 

  $(document).ready(function () {

    var scid = $(".content-frame-body").attr('id');
    var sCdata = recuperarWidgets(scid);

    if(null != sCdata){          
      for(row=0;row<Object.size(sCdata); row++){                
        for(column=0;column<Object.size(sCdata[row]);column++){                    
          for(block=0;block<Object.size(sCdata[row][column]);block++){
            $("#"+sCdata[row][column]).appendTo(".linha:eq("+row+") ");                        
          }
        }               
      }
    }


    //Toggle fullscreen
    $(".panel-fullscreen3").click(function (e) {
      e.preventDefault();

      var $this = $(this);

      if ($this.children('i').hasClass('glyphicon-resize-full'))
      {
            // $("#trshow").show();
          //  drawMainDashboard(2);
          $this.children('i').removeClass('glyphicon-resize-full');
          $this.children('i').addClass('glyphicon-resize-small');
        }
        else if ($this.children('i').hasClass('glyphicon-resize-small'))
        {
           // drawMainDashboard();
           $this.children('i').removeClass('glyphicon-resize-small');
           $this.children('i').addClass('glyphicon-resize-full');
          //  $("#trshow").hide();
        }
        $(this).closest('.panel').toggleClass('panel-fullscreen2');
      });
  });

  $("#txtanalise").summernote({height: 200,
    toolbar: [
    ["style", ["bold", "italic", "underline", "clear"]],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ["insert",["picture"]],
    ['para', ['ul', 'ol', 'paragraph']]
    ],
    onImageUpload: function(files, editor, welEditable) {
      sendFile(files[0], editor, welEditable);
    }
  });

  function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
      data: data,
      type: "POST",
      url: '<?php echo base_url("ajax/salvarMensagem");?>',
      cache: false,
      contentType: false,
      processData: false,
      success: function(url) {
                  //console.log(url); return;
                  editor.insertImage(welEditable, url);
                  $("#urlimg").val(url);
                }
              });
  }

  function salvarWidgets(id, data){
    
    if(typeof(Storage)!=="undefined"){        
        localStorage[id] = data;
    }else{
        return false;
    }
  }
  function recuperarWidgets(id){    
    if(typeof(Storage)!=="undefined"){        
      if(typeof(localStorage[id]) !== "undefined"){            
        return $.parseJSON(localStorage[id]);
      }else{
        return null;
      }
    }
  }


</script>
