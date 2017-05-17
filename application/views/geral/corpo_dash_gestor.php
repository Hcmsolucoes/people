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

<!--<div id="equipemodal" class="modal fade" tabindex="-1" role="document" >
   <div class="modal-dialog">
    <div class="modal-content" style="max-height:595px; overflow:scroll;">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="">Minha Equipe</h4>
    </div>
     <div class="modal-body" id="">
        <div class="panel-body list-group list-group-contacts">
      <?php foreach ($equipe as $key => $value) { 
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
      ?>

      <a href="<?php echo base_url("/perfil/pessoal_publico"."/".$value->fun_idfuncionario); ?>" class='list-group-item'>
        <img src="<?php echo $foto; ?>" class="pull-left" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
        <p><b>Cargo:</b> <?php echo $value->contr_cargo; ?></p>
      </a>     

     <?php }?>
     </div>
     </div>

     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>

   </div>

 </div>
</div>--><!--Equipe modal -->


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

<!--barra -->
<ul class="breadcrumb">
<div class="btn-group fleft fleftmobile" id="menudashboard" >
  <a href="#" data-toggle="dropdown" class="btn btn-primary fleftmobile">Dashboards<span class="caret"></span></a>
  <ul class="dropdown-menu" id="menudash" >
    <li>
      <a href="#botao1" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Adm de Pessoal</a>
    </li>

    <li>
      <a href="#botao2" role="tab" data-toggle="tab"><i class="fa fa-signal"></i> Estratégia Ocupacional</a>
    </li>

    <li>
      <a href="#botao3" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-globe"></i> Absenteísmo e rotatividade</a>
    </li>                                                    
  </ul>
</div>


<span  class="btn btn-info fleft fleftmobile botoesanalise" style="padding: 4px 10px;" data-toggle="modal" data-target="#analisemodal"><i class="glyphicon glyphicon-home"></i> Minha Análise</span>

<a id="veranalise" href="#<?php //echo base_url("gestor/analise"); ?>" class="btn btn-info fleft fleftmobile botoesanalise" style="padding: 4px 10px;" ><i class="fa fa-bar-chart-o"></i> Ver Análise</a>
</ul><!-- fim da barra-->

 <!-- START WIDGETS -->
  <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="botao3">
  
<!-- Turn Over Admissões e Demisssão-->

     <div class="col-md-12">
            <div class="panel panel-default" style="float: left;">
                <div class="panel-heading">

                    <div class="panel-title-box">
                    <h3 style="text-align:center;">Turnover - Minha Equipe
                      </h3>
                     </div>                                   
                   <ul class="panel-controls" style="margin-top: 2px;">
                     <!--<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>-->
                     <li><a href="#" class="panel-fullscreen3" role="button" title=""><i class="glyphicon glyphicon-resize-full"></i></a></li>
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

                <div class="panel-body">

                 <!-- CORPO DO DASHBOARD -->                          
                 <div id="dashboard_turnover" >
                  <!-- <div>
                      <h5>5-digit values, step 1000</h5>
                      <input class="knob" data-width="150" data-min="0" data-displayPrevious=true data-max="400" data-step="45" value="45" data-fgColor="#81C500"/>                                         
                   </div> -->
                 <div class="table-responsive"  width="100%">
                    <table class="table table-bordered table-striped table-actions">
                      <thead class="theadresponsive" style="display: none;">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="tbodyt">    
                          <tr>                         
                          <td width="20%"><div id="turnover_emp" ></div></td>
                          <td width="30%"><div id="turnover_ccu" ></div></td>
                          <td width="70%" colspan="2"><div id="turnover_mes"> </div></td>
                         <!-- <th width="10%"><div>  <label>Mostrar Tabela</label>
                                                 <label class="switch"><input type="checkbox" class="check" /><span></span></label> </div></th> -->
                          </tr>                                             
                    
                       <tr>
                        <td width="100%" colspan="4"><div id="chart_turnover" style="padding-top: 15px"></div></td>
                        </tr>
                   <!--    <tr>
                        
                        <td width="100%" colspan="4">
                       <div id="table_turnover" style="padding-top: 20px"></div></td> 
                        </tr> -->
                      </tbody> 
                    </table>   
                  </div>
                 </div>
                </div>
            
            </div>
        </div>

  <!-- Turn Over -->
      <div class="col-md-3">
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
      
     
    <!-- Inicio Admitidos no mês -->

    <?php 
      $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$mes = $meses[date("n")]; 
$mes_ano = $mes."/".date("Y");

    ?>
    <div class="col-md-2">                        
        <a id="admitidos" href="#" data-toggle="modal" data-target="#admitidosmodal" class="tile tile-info tile-valign">
            <?php echo count($admitidos); ?>
            <div class="informer informer-default">Admitidos no mês</div>
            <div class="informer informer-default dir-br"><?php echo $mes_ano; ?> <span class="fa fa-users"></span></div>
        </a>                            
    </div>
    <!-- Fim do Admitidos no mês -->  

      
    <!-- Inicio Demitidos no mês -->  
    <div class="col-md-2">                        
        <a href="#" data-toggle="modal" data-target="#demitidosmodal" class="tile tile-default">
            <?php echo count($demitidos); ?>
            <p>Demitidos no mês</p>
            <div class="informer informer-primary"><?php echo $mes_ano; ?></div>
            <div class="informer informer-danger dir-tr"><span class="fa fa-caret-down"></span></div>
        </a>                        
    </div>
    <!-- Fim do Demitidos no mês -->  
      
    <div class="col-md-2">                        
        <a href="<?php echo base_url("gestor/equipe"); ?>" data-toggle="" data-target="" class="tile tile-default">
        <?php echo count($equipe); ?>
            <p>Colaboradores</p>
            <div class="informer informer-primary">Minha Equipe</div>
            <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a>                        
    </div>
        </div><!--tab botao3-->

        <div role="tabpanel" class="tab-pane active" id="botao2">

    <div class="col-md-12">
            <div class="panel panel-default" style="float: left;">
                <div class="panel-heading">

                    <div class="panel-title-box">
                    <h3 style="text-align:center;">Headcount - Perfil Salarial
                      </h3>
                     </div>                                   
                   <ul class="panel-controls" style="margin-top: 2px;">
                     <!--<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>-->
                     <li><a href="#" class="panel-fullscreen3" role="button" title=""><i class="glyphicon glyphicon-resize-full"></i></a></li>
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

                <div class="panel-body">

                 <!-- CORPO DO DASHBOARD -->                          
                 <div id="dashboard_div" >
                  <!-- <div>
                      <h5>5-digit values, step 1000</h5>
                      <input class="knob" data-width="150" data-min="0" data-displayPrevious=true data-max="400" data-step="45" value="45" data-fgColor="#81C500"/>                                         
                   </div> -->
                 <div class="table-responsive"  width="100%">
          <table class="table table-bordered table-striped table-actions">
              <thead class="theadresponsive" style="display: none;">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="tbodyt">      
                          <tr>                         
                          <td width="20%"><div id="categoryPicker_emp" ></div></td>
                          <td width="30%"><div id="categoryPicker_ccu" ></div></td>
                          <td width="20%"><div id="categoryPicker_div"> </div></td>
                          <td width="40%"><div id="slider_div">         </div></td>
                         <!-- <th width="10%"><div>  <label>Mostrar Tabela</label>
                                                 <label class="switch"><input type="checkbox" class="check" /><span></span></label> </div></th> -->
                          </tr>
                       <tr>
                        <td width="100%" colspan="2"><div id="chart_div" style="padding-top: 15px"></div></td>
                        <td width="100%" colspan="2">
                       <div id="table_div" style="padding-top: 15px"></div></td>
                        </tr>
                    
 
                        </tbody>  
                    </table>   
                  </div>
                 </div>
                </div>
            
            </div>
        </div>



      <div class="col-md-4">
      <!-- START USERS ACTIVITY BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Absenteísmo da Minha Equipe</h3>
            <span>4 últimos meses</span>
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
          <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
        </div>                                    
      </div>
      <!-- END USERS ACTIVITY BLOCK -->
    </div>

     
    <div class="col-md-4">

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
          <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
        </div>
      </div>
      <!-- END VISITORS BLOCK -->

      <!-- GOOGLE CHARTS SEXO E IDADE -->
    </div>
       
            <div class="col-md-4">

            <!-- START SALES & EVENTS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Horas Trabalhadas x HExtras</h3>
                        <span>Comparativo de Minha Equipe</span>
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
                    <div class="chart-holder" id="morris-line-example" style="height: 200px;"></div>
                </div>
            </div>
            <!-- END SALES & EVENTS BLOCK -->

        </div>      



     <!-- END USERS ACTIVITY BLOCK -->      

        </div><!--botao 2-->

        <div role="tabpanel" class="tab-pane active" id="botao1">

          <div class="row scRow">

     <!-- Grafico de custos x Faturamento -->
      <div class="col-md-12">
            <div class="panel panel-default" style="float: left;">
                <div class="panel-heading">

                    <div class="panel-title-box">
                    <h3 style="text-align:center;">Receita x Folha de Pagamento
                      </h3>
                     </div>                                   
                   <ul class="panel-controls" style="margin-top: 2px;">
                     <!--<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>-->
                     <li><a href="#" class="panel-fullscreen3" role="button" title=""><i class="glyphicon glyphicon-resize-full"></i></a></li>
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

                <div class="panel-body">

                 <!-- CORPO DO DASHBOARD -->                          
                 <div id="dashboard_receita" >
                  <!-- <div>
                      <h5>5-digit values, step 1000</h5>
                      <input class="knob" data-width="150" data-min="0" data-displayPrevious=true data-max="400" data-step="45" value="45" data-fgColor="#81C500"/>                                         
                   </div> -->
                 <div class="table-responsive"  width="100%">
                    <table class="table table-bordered table-striped table-actions">
                      <thead class="theadresponsive" style="display: none;">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="tbodyt">    
                          <tr>                         
                          <td width="20%"><div id="receita_emp" ></div></td>
                          <td width="30%"><div id="receita_ccu" ></div></td>
                          <td width="20%"><div id="receita_ano"> </div></td>
                          <td width="50%"><div id="receita_mes"> </div></td>
                         <!-- <th width="10%"><div>  <label>Mostrar Tabela</label>
                                                 <label class="switch"><input type="checkbox" class="check" /><span></span></label> </div></th> -->
                          </tr>                                                               
                       <tr>
                        <td width="100%" colspan="4"><div id="chart_receita" style="padding-top: 15px"></div></td>
                      
                        </tr>
                       
                      </tbody> 
                    </table>   
                  </div>
                 </div>
                </div>
            
            </div>
        </div>


    <div class="col-md-3 scCol">
      <div class="widget widget-default widget-item-icon" id="grid1">
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
      <div class="col-md-3">
      <div class="widget widget-default widget-carousel">

      <span class="bold corsec acenter fleft" style="width: 100%;">Situação Atual da Equipe</span>

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
  
  
  <!-- banco de horas da Equipe -->
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
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
</div>


<div class="row scRow">

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
    <div class="col-md-2 scCol">                        
        <span class="tile tile-info tile-valign" id="grid2">
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
  
    <div class="col-md-2 scCol">                        
        <span class="tile tile-success tile-valign" id="grid3">
        <span style="line-height: 30px;float: center; margin: 19px 0px;"><?php echo number_format($media, 1, ",", ""); ?></span>
            <div class="informer informer-default">Tempo médio de Empresa</div>
      <div class="informer informer-default dir-br">Minha Equipe <span class="fa fa-users"></span></div>
        </span>                                                    
    </div>

  
      
  <div class="col-md-3">
    <div class="widget widget-default widget-item-icon" onclick="#';">
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
                            
      <div class="col-md-3">
      <div class="widget widget-default widget-item-icon" onclick="#';">
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
  
  
    <div class="col-md-2">                        
    <a href="#" class="tile tile-default">
      32<p>EPIs Distribuídos</p>
      <div class="informer informer-primary">Minha Equipe</div>
      <div class="informer informer-success dir-tr"><span class="fa fa-users"></span></div>
    </a>
  </div>
</div>


<div class="row scRow">
    <div class="col-md-2">                        
        <a href="#" class="tile tile-default">
      09<p>Incidentes</p>
      <div class="informer informer-primary">Últimos 12 meses (Equipe)</div>
      <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a> 
    </div>      
    
    
  <div class="col-md-2">                        
    <a href="#" class="tile tile-default">
      03<p>Acidentes (CAT)</p>
      <div class="informer informer-primary">Últimos 12 meses (Equipe)</div>
      <div class="informer informer-success dir-tr"><span class="fa fa-caret-up"></span></div>
        </a> 
    </div>
</div>
        
        </div>
        </div><!--tab content -->

<!--<script src="https://www.google.com/jsapi?fake=.js"></script>
  <script src="https://google-developers.appspot.com/_static/fc5017f606/js/framebox.js?hl=pt-br"></script>-->
<script type="text/javascript">

$("li").click(function(){

  $(".dropdown-menu").find("li").removeClass("active");
});

  Morris.Bar({
    element: 'dashboard-bar-1',
    data: [
    { y: 'Ago', a: 78, b: 95, c: 20 },
    { y: 'Set', a: 65, b: 72, c: 32 },
    { y: 'Out', a: 91, b: 60, c: 20 },
    { y: 'Nov', a: 58, b: 45, c: 12 }
    ],
    xkey: 'y',
    ykeys: ['a','b','c'],
    labels: ['Faltas', 'Atrasos','Atestados'],
    barColors: ['#33414E', '#1caf9a','#FF8C00'],
    gridTextSize: '10px',
    hideHover: true,
    resize: true,
    gridLineColor: '#E5E5E5'
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
    
    var morrisCharts = function() {

      Morris.Line({
        element: 'morris-line-example',
        data: [
        { y: '2016-05-01', a: 220, b: 30, c: 10 },
        { y: '2016-06-01', a: 200, b: 32, c: 11 },
        { y: '2016-07-01', a: 180, b: 15, c: 08 },
        { y: '2016-08-01', a: 220, b: 25, c: 40 },
        { y: '2016-09-01', a: 220, b: 18, c: 20 },
        { y: '2016-10-01', a: 180, b: 50, c: 14 },
        { y: '2016-11-01', a: 220, b: 19, c: 10 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Horas Trab.', 'H.Extra 100%','H.Extra 50%'],
        resize: true,
        lineColors: ['#33414E', '#95B75D','#1caf9a']
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

  }();    
    
    $(document).ready(function(){
      $("#botao2, #botao3").removeClass("active");
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
    
  //GOOGLE CHARTS SEXO E IDADE
   google.charts.load('current', {'packages':['corechart', 'table', 'gauge', 'controls']});
   google.charts.setOnLoadCallback(drawMainDashboard);
   google.charts.setOnLoadCallback(drawMainTurnover);
   google.charts.setOnLoadCallback(drawMainReceita);
 
//bind a resizing function to the window
//$(window).resize(function() {
 //   if(this.resizeTO) clearTimeout(this.resizeTO);
  //  this.resizeTO = setTimeout(function() {
     //   $(this).trigger('resizeEnd');
//}, 500);
//});
//usage of resizeEnd

//$(window).bind('resizeEnd', function() {
  //  drawMainDashboard();
 //   drawMainTurnover();
//});

  function drawMainDashboard(operacao) {


    var dashboard = new google.visualization.Dashboard(
        document.getElementById('dashboard_div'));
    var slider = new google.visualization.ControlWrapper({
      'controlType': 'NumberRangeFilter',
      'containerId': 'slider_div',
      'state': {'lowValue': 1, 'highValue': 80},
      'options': {
        'filterColumnIndex': 2,
        'ui': {
          'labelStacking': 'horizontal',
          'cssClass': 'sliderClass',
          'label': 'Idade:',
           'format': { 'fractionDigits':'0',
                            'groupingSymbol':'' }
        },
        'state': {'lowValue': 1, 'highValue': 80} 
      }

    });
    var categoryPicker = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'categoryPicker_div',
      'options': {
        'filterColumnIndex': 1,
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Sexo:',
          'allowTyping': false,
          'allowMultiple': false,
         // 'selectedValuesLayout': 'belowStacked'
          'caption' : 'Selecione'
        }
      }
    });

     var categoryPickeremp = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'categoryPicker_emp',
      'options': {
        //'filterColumnIndex': 8,
        'filterColumnLabel': 'Empresa',
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Empresa:',
          'allowTyping': false,
          'allowMultiple': true,
          'selectedValuesLayout': 'belowWrapping',
          'caption' : 'Selecione'
        }
      }
    });

     var categoryPickerccu = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'categoryPicker_ccu',
      'options': {
       // 'filterColumnIndex': 5,
       'filterColumnLabel': 'Centro de Custo',
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Centro de Custo:',
          'allowTyping': false,
          'allowMultiple': true,
          'selectedValuesLayout': 'aside',
          'caption' : 'Selecione'
        }
      }
    });
    var pie = new google.visualization.ChartWrapper({
      'chartType': 'PieChart',
      'containerId': 'chart_div',
      'options': {
        'width': '100%',
        'height': 250,
        //'legend': 'none',
         'is3D': true,
        'chartArea': {'left': 20, 'top': 30, 'right': 0, 'bottom': 0,width:'100%'},
        'pieSliceText': 'percentage'
      },
      'view': {'columns': [0, 3]}
    });
    
  var cssClassNames = {
              'headerRow': 'cssHeaderRow',
              'tableRow': 'cssTableRow',
              'oddTableRow': 'cssOddTableRow',
              'selectedTableRow': 'cssSelectedTableRow',
              'hoverTableRow': 'cssHoverTableRow',
              'headerCell': 'cssHeaderCell',
              'tableCell': 'cssTableCell',
              'rowNumberCell': 'cssRowNumberCell'
          };

    var table = new google.visualization.ChartWrapper({
      chartType: 'Table',
      containerId: 'table_div',
      options: {allowHtml: true,
        width: '100%',
        height: '50%',
        page: 'enable',
        cssClassNames: cssClassNames,
        pageSize: 5
      },
      view: {
        columns: [ 0,4,5,7,2,3]
      }

    });

    var data1 = google.visualization.arrayToDataTable([
     <?php echo $arr_salariosexo; ?>
    ]);

    var formatter1 = new google.visualization.NumberFormat({pattern: 'R\u00A4 #,###0.00'});

    formatter1.format(data1,3);

   // dashboard.bind([slider, categoryPicker], [pie, table]);

    dashboard.bind(categoryPickeremp,categoryPickerccu);
    dashboard.bind(categoryPickerccu,categoryPicker);
    dashboard.bind(categoryPicker,slider);
    dashboard.bind(slider, [pie, table]);
   // dashboard.bind(categoryPickeremp, pie);
 
  if(operacao==2){
    //$(".trshow").show();
    // pie.setOptions({'width': '100%', 'height':'100%', 'is3D': true,
     //   'chartArea': {'left': 20, 'top': 30, 'right': 0, 'bottom': 0,width:'100%'},
      //  'pieSliceText': 'percentage'});
    // table.setOptions({'width': 300, 'height':200});

     }
     else{
     $(".trshow").hide();
     }
     dashboard.draw(data1);
  }


$(document).ready(function () {
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


$(".check").change(function(){

var check = $(this);
if(check.prop("checked")==true){
   $(".trshow").show();
        
        }
 else{
  $(".trshow").hide();
 }       


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

function drawMainTurnover() {
    var dashboard2 = new google.visualization.Dashboard(
        document.getElementById('dashboard_turnover'));

 
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Ano');
    data.addColumn('string', 'Mes');  
    data.addColumn('number', 'Admissões');
    data.addColumn('number', 'Demissões');
    data.addColumn('string', 'MesAno');
    data.addRows([
 <?php echo $dadostabletunover; ?>
    ]);

var data3 = new google.visualization.DataTable();
    data3.addColumn('string', 'Ano');
    data3.addColumn('date', 'Mes');  
    data3.addColumn('string', 'MesAno');
    data3.addColumn('string', 'Movimentacao');
    data3.addColumn('string', 'Colaborador');
    data3.addColumn('string', 'Cargo');
    data3.addColumn('string', 'Admissão');
    data3.addColumn('string', 'Demissão');
    data3.addColumn('string', 'Empresa');
    data3.addColumn('string', 'Centro de Custo');
data3.addRows([
 <?php echo $filtrostabelas; ?>
    ]);   

  //var categoryPicker2 = new google.visualization.ControlWrapper({
    //    controlType: 'DateRangeFilter',
      //  containerId: 'turnover_mes',
        //dataTable: data3,
        //options: {
          //  filterColumnLabel: 'Mes',
           // ui: {
             //   labelStacking: 'horizontal',
               //  'format': { 'pattern': 'MM/yyyy' },
                //allowTyping: false,
                //allowMultiple: false,
                //height: 100
            //}
        //}, 
        //state: {
          //  selectedValues: ['01/2017']
        //}
    //});

      var categoryPicker2 = new google.visualization.ControlWrapper({
      controlType: 'CategoryFilter',
      containerId: 'turnover_mes',
       dataTable: data3,
      options: {
        //'filterColumnIndex': 8,
        filterColumnLabel: 'MesAno',
         ui: {
          labelStacking: 'horizontal',
          label: 'Mes/Ano:',
          allowTyping: false,
          allowMultiple: true,
          selectedValuesLayout: 'aside',
          caption : 'Selecione'
        }
      }
    });

    var categoryPickeremp1 = new google.visualization.ControlWrapper({
      controlType: 'CategoryFilter',
      containerId: 'turnover_emp',
       dataTable: data3,
      options: {
        //'filterColumnIndex': 8,
        filterColumnLabel: 'Empresa',
         ui: {
          labelStacking: 'horizontal',
          label: 'Empresa:',
          allowTyping: false,
          allowMultiple: true,
          selectedValuesLayout: 'belowWrapping',
          caption : 'Selecione'
        }
      }
    });

     var categoryPickerccu1 = new google.visualization.ControlWrapper({
      controlType: 'CategoryFilter',
      containerId: 'turnover_ccu',
      dataTable: data3,
      options: {
       // 'filterColumnIndex': 5,
       filterColumnLabel: 'Centro de Custo',
        ui: {
          labelStacking: 'horizontal',
          label: 'Centro de Custo:',
          allowTyping: false,
          allowMultiple: true,
          selectedValuesLayout: 'aside',
          caption : 'Selecione'
        }
      }
    }); 

     
var aggregationCols = [{column: 3, aggregation: google.visualization.data.count, type: 'number',label: 'admissão'},
                       {column: 1, aggregation: google.visualization.data.count, type: 'number',label: 'Demissão'}];

//        {'column': 2, 'aggregation': google.visualization.data.sum, 'type': 'number'}];

    // Define a Bar chart
    var chart1 = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        containerId: 'chart_turnover',
        dataTable : data,
        options: {
            focusTarget: 'category',
           width: "1024",
           height: 400,
         //  isStacked: 'relative',
           //legend: {position: 'top', maxLines: 2},
            vAxis: {
                textStyle: {
                    fontSize: 12,
                    fontName: 'Arial'
                },
                viewWindow: {
                    max: 30
                }
                //viewWindowMode: 'maximized'

            },
            hAxis: {

               format: 'MM/yyyy',
               // ticks: ticks
             ticks:  <?php echo $ticks; ?> 

            },

            animation: {
                duration: 1000,
                easing: 'out'
            },
          //  series: {
            //0: {  // set the options for the first series (columns)
              //  type: "line",
                //targetAxisIndex: 3,

            //},
            //1: {  // set the options for the first series (columns)
              //  type: "line",
                //targetAxisIndex: 3,

            //},
          //},
          // colors: ["red", "green", "orange"],
           // legend: 'none',
            title: 'Turnover (Admissões, Demissões)'
        },
        // Instruct the barchart to use columns 2, 3, 4 and 5
        // from the 'data' DataTable.
        view: {
            columns: [1,2,3]
        }
    });

  var cssClassNames = {
              'headerRow': 'cssHeaderRow',
              'tableRow': 'cssTableRow',
              'oddTableRow': 'cssOddTableRow',
              'selectedTableRow': 'cssSelectedTableRow',
              'hoverTableRow': 'cssHoverTableRow',
              'headerCell': 'cssHeaderCell',
              'tableCell': 'cssTableCell',
              'rowNumberCell': 'cssRowNumberCell'
          };

    var table1 = new google.visualization.ChartWrapper({
      chartType: 'Table',
      dataTable: data3,
      containerId: 'table_turnover',
      options: {allowHtml: true,
        width: '100%',
        height: '50%',
        page: 'enable',
        cssClassNames: cssClassNames,
        pageSize: 5
      },
      view: {
        columns: [2,3,4,5,6,7,8]
      }

    });



google.visualization.events.addListener(categoryPicker2, 'statechange', setChartView);
google.visualization.events.addListener(categoryPickerccu1, 'statechange', setChartView);
google.visualization.events.addListener(categoryPickeremp1, 'statechange', setChartView);


       var formatter1 = new google.visualization.DateFormat({pattern: 'MM/yyyy'});
       formatter1.format(data,1);

    dashboard2.bind(categoryPickeremp1,categoryPickerccu1);
    dashboard2.bind(categoryPickerccu1,categoryPicker2);
    dashboard2.bind(categoryPicker2, []);
    //dashboard2.bind(categoryPickeremp1,categoryPickerccu1);
    //dashboard2.bind(categoryPickerccu1,categoryPickerano1);
   // dashboard2.bind(chart1);

    dashboard2.draw(data3);
    chart1.draw();

       google.visualization.events.addListener(chart1.getChart(), 'select', function() {
          var selection = chart1.getChart().getSelection();
           // get the data used by the chart
       
       if (selection.length) {
            // the user selected a bar
           // alert(data.getValue(selection[0].row, 1));
            var teste2 = data.getValue(selection[0].row, 1);
            var teste1 = data.getValue(selection[0].row, 2);
        }
        else {
            // the user deselected a bar
        }

               var titulo = "Exportação dados";
              $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
              $("#titulomodal").text(titulo);
              $('#myModal').modal('show');

              $.ajax({             
                  type: "POST",
                  url: '<?php echo base_url('gestor/view_tabelasdashs2') ?>',
                  dataType : 'html',
                  secureuri:false,
                  cache: false,
                  data:{
                    dashboard: 'tunover'
                  },              
                  success: function(msg) 
                  {
                    //console.log(msg);
                    $( "#dadosedit" ).html(msg);
                  } 
              });


      });


   function setChartView () {
        
        var statemes = categoryPicker2.getState();
        var stateccu = categoryPickerccu1.getState();
        var stateemp = categoryPickeremp1.getState();
      //  var stateano = categoryPickerano1.getState();
        
        //alert(valLow+" ate"+valHigh);
        var row;
        var view = {
            columns: [0]
        };      
        
        var acentrocusto = "";
        for (var i = 0; i < stateccu.selectedValues.length; i++) {
          
           
            var acentrocusto = acentrocusto + stateccu.selectedValues[i]+',';
   
         //   row = columnsTable.getFilteredRows([{column: 1, value: state.selectedValues[i]}])[0];
           // view.columns.push(columnsTable.getValue(row, 0));
        } 
        var aempresa = "";
        for (var i = 0; i < stateemp.selectedValues.length; i++) {
          
             var aempresa = aempresa + stateemp.selectedValues[i]+',';
         //   row = columnsTable.getFilteredRows([{column: 1, value: state.selectedValues[i]}])[0];
           // view.columns.push(columnsTable.getValue(row, 0));
        } 

        var aMes = ""; 
         for (var i = 0; i < statemes.selectedValues.length; i++) {
          
           var aMes = aMes + statemes.selectedValues[i]+',';

        } 
      
        // sort the indices into their original order
        view.columns.sort(function (a, b) {
            return (a - b);
        });
        var n = acentrocusto.length;
        var n = n-1;
        var resccu = acentrocusto.substring(0, n);        
      
        var n = aMes.length;
        var n = n-1;
        var resmes = aMes.substring(0, n);

        var n = aempresa.length;
        var n = n-1;
        var resemp = aempresa.substring(0, n);
        

               $.ajax({             
                  type: "POST",
                  url: '<?php echo base_url('gestor/view_cargatunover') ?>',
                  dataType : 'json',              
                  data:{
                    acentrocusto: resccu,
                    acentrocusto2: resccu,
                    aempresa: resemp,
                    aempresa2: resemp,
                    MesAno: resmes

                  },              
                   success:function(jsonData){ 
                 //  alert('dentro');            
                 //  alert(JSON.stringify(jsonData));

             //  console.log(jsonData);
               //var teste=[['2017','2017/01',1,0,'01/2017'],['2017','2017/02',2,0,'02/2017']];

      //console.log(teste);
      var data5 = new google.visualization.DataTable();
    data5.addColumn('string', 'Ano');
    data5.addColumn('string', 'Mes');  
    data5.addColumn('number', 'Admissões');
    data5.addColumn('number', 'Demissões');
    data5.addColumn('string', 'MesAno');
    data5.addRows(
    jsonData
    );
      chart1.setDataTable(data5);
      chart1.draw();
        
                  } 
              });

    }


}  

function drawMainReceita() {
    var dashboard2 = new google.visualization.Dashboard(
        document.getElementById('dashboard_receita'));


    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Ano');
    data.addColumn('date', 'Mes');  
    data.addColumn('number', 'Receita Bruta');
    data.addColumn('number', 'Valor Folha Pagamento');
    data.addColumn('number', 'Salários');  
    data.addColumn('number', 'Pró Labore');  
    data.addColumn('number', 'Hora Extra');   
    data.addColumn('number', 'Comissão');   
    data.addColumn('number', 'Benefícios');
    data.addColumn('number', 'Outros Custos');   
    data.addColumn('string', 'Cargo');
    data.addColumn('string', 'Empresa');
    data.addColumn('string', 'Centro de Custo');
    data.addRows([
['2016',new Date('2016/09/01'),225000.00, 125860.00,16780.00,5280.20,9980.20,760.20,611.20,111.20,'Assistente administrativo','HCM Consultoria','administrativo'],
['2016',new Date('2016/10/01'),325450.00, 165860.00,4780.00, 678.80,1440.20,7810.20,6721.20,121.20,'Operador de maquina','HCM Consultoria','Operacional'],
['2016',new Date('2016/11/01'),228903.20, 165840.00,46780.00,6380.20,120.00,710.20,61210.20,19.20,'Assistente administrativo','HCM Consultoria','administrativo'],
['2016',new Date('2016/12/01'),435030.00, 25860.00,56780.00,68.20,180.20,80.20,610.20,3451.20,'Assistente RH','HCM Consultoria','recursos humanos'],
['2017',new Date('2017/01/01'),545030.00, 21840.00,5568.00,6760.20,1720.10,10.20,621.20,5367.89,'Assistente administrativo','HCM Consultoria','administrativo'],
['2017',new Date('2017/02/01'),1125230.00, 12840.00,5168.00,2760.20,1320.10,110.20,421.20,567.89,'Assistente administrativo','HCM Consultoria','administrativo'],
['2017',new Date('2017/03/01'),524500.00, 155860.00,34580.00,80.20,1530.20,720.24,644.20,67655.90,'Assistente administrativo','HCM Consultoria','administrativo'],
['2017',new Date('2017/04/01'),426600.00, 11584.00,46560.00,671.20,1210.20,75.20,61919.20,2543.90,'Engenheiro','HCM Engenharia','Engenharia'],

    ]);

  var categoryPicker3 = new google.visualization.ControlWrapper({
        controlType: 'DateRangeFilter',
        containerId: 'receita_mes',
        options: {
            filterColumnLabel: 'Mes',
            ui: {
                labelStacking: 'horizontal',
                 'format': { 'pattern': 'MM/yyyy' },
                allowTyping: false,
                allowMultiple: false,
                height: 100
            }
        },
        //state: {
          //  selectedValues: ['01/2017']
        //}
    });

    var categoryPickeremp2 = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'receita_emp',
      'options': {
        //'filterColumnIndex': 8,
        'filterColumnLabel': 'Empresa',
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Empresa:',
          'allowTyping': false,
          'allowMultiple': true,
          'selectedValuesLayout': 'belowWrapping',
          'caption' : 'Selecione'
        }
      }
    });

     var categoryPickerccu2 = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'receita_ccu',
      'options': {
       // 'filterColumnIndex': 5,
       'filterColumnLabel': 'Centro de Custo',
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Centro de Custo:',
          'allowTyping': false,
          'allowMultiple': true,
          'selectedValuesLayout': 'aside',
          'caption' : 'Selecione'
        }
      }
    }); 

  var categoryPickerano2 = new google.visualization.ControlWrapper({
      'controlType': 'CategoryFilter',
      'containerId': 'receita_ano',
      'options': {
       // 'filterColumnIndex': 5,
       'filterColumnLabel': 'Ano',
        'ui': {
          'labelStacking': 'horizontal',
          'label': 'Ano:',
          'allowTyping': false,
          'allowMultiple': false,
        //  'selectedValuesLayout': 'aside',
          'caption' : 'Selecione'
        }
      }
    });      

    var dateTicks = [];
    for (var m = 1; m <= 12; m++)
        dateTicks.push(new Date('2016-' + m));

    var ticks = [];

    for (var i = 0; i < data.getNumberOfRows(); i++) {

      ticks.push(data.getValue(i, 1));

    }

    // Define a Bar chart
    var chart1 = new google.visualization.ChartWrapper({
        chartType: 'ComboChart',
        containerId: 'chart_receita',
        options: {
            focusTarget: 'category',
            width: '100%',
           height: 400,
            vAxis: {
                textStyle: {
                    fontSize: 12,
                    fontName: 'Arial'
                }
               // viewWindowMode: 'maximized'

            },
            hAxis: {

               format: 'MM/yyyy',
               // ticks: ticks
                ticks: [new Date(2016,09,01),new Date(2016,10,01), new Date(2016,11,01),new Date(2016,12,01), new Date(2017,01,01),new Date(2017,02,01),new Date(2017,03,01),new Date(2017,04,01)] 
              
            },

            animation: {
                duration: 1000,
                easing: 'out'
            },
           // legend: 'none',
            title: 'Receita x Folha de Pagamento',
             seriesType: 'bars',
             series: {
            0: {  // set the options for the first series (columns)
                type: "line",
                targetAxisIndex: 1,

            },
            1: {  // set the options for the first series (columns)
                type: "line",
                targetAxisIndex: 1,

            }
        }
        },
        // Instruct the barchart to use columns 2, 3, 4 and 5
        // from the 'data' DataTable.
        view: {
            columns: [1, 2,3,4,5,6,7,8,9]
        }
    });

  var cssClassNames = {
              'headerRow': 'cssHeaderRow',
              'tableRow': 'cssTableRow',
              'oddTableRow': 'cssOddTableRow',
              'selectedTableRow': 'cssSelectedTableRow',
              'hoverTableRow': 'cssHoverTableRow',
              'headerCell': 'cssHeaderCell',
              'tableCell': 'cssTableCell',
              'rowNumberCell': 'cssRowNumberCell'
          };

    var table1 = new google.visualization.ChartWrapper({
      chartType: 'Table',
      containerId: 'table_receita',
      options: {allowHtml: true,
        width: '100%',
        height: '50%',
        page: 'enable',
        cssClassNames: cssClassNames,
        pageSize: 5
      },
      view: {
        columns: [4,5,6,7,8]
      }

    });


    //chama o modal
  google.visualization.events.addListener(chart1, 'ready', function() {
       // grab a few details before redirecting
     google.visualization.events.addListener(chart1.getChart(), 'select', function() {
          var selection = chart1.getChart().getSelection();
           // get the data used by the chart
       
       if (selection.length) {
            // the user selected a bar
           // alert(data.getValue(selection[0].row, 1));
            var teste2 = data.getValue(selection[0].row, 1);
            var teste1 = data.getValue(selection[0].row, 2);
        }
        else {
            // the user deselected a bar
        }

               var titulo = "Exportação dados";
              $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' alt='Loading...' >");
              $("#titulomodal").text(titulo);
              $('#myModal').modal('show');

              $.ajax({             
                  type: "POST",
                  url: '<?php echo base_url('gestor/view_tabelasdashs') ?>',
                  dataType : 'html',
                  secureuri:false,
                  cache: false,
                  data:{
                    mesano: teste1,
                    testes: teste1
                  },              
                  success: function(msg) 
                  {
                    //console.log(msg);
                    $( "#dadosedit" ).html(msg);
                  } 
              });


      });
     });

    var formatter1 = new google.visualization.DateFormat({pattern: 'MM/yyyy'});
     formatter1.format(data,1);

    var formatter2 = new google.visualization.NumberFormat({pattern: 'R\u00A4 #,###########0.00'});

    formatter2.format(data,2);
    formatter2.format(data,3);
    formatter2.format(data,4);
    formatter2.format(data,5);
    formatter2.format(data,6);
    formatter2.format(data,7);
    formatter2.format(data,8);
    formatter2.format(data,9);

    dashboard2.bind(categoryPickeremp2,categoryPickerccu2);
    dashboard2.bind(categoryPickerccu2,categoryPickerano2);
    dashboard2.bind(categoryPickerano2,categoryPicker3);
    dashboard2.bind(categoryPicker3, [chart1]);
    dashboard2.draw(data); 


}  

</script>
<script type="text/javascript" src="js/plugins/rangeslider/jQAllRangeSliders-min.js"></script>       
<script type="text/javascript" src="js/plugins/knob/jquery.knob.min.js"></script>
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/rangeslider/jQAllRangeSliders-min.js"></script>       
<script type="text/javascript" src="js/plugins/knob/jquery.knob.min.js"></script>