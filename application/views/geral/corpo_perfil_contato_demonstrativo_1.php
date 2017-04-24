<div class="container-fluid">

         <div class="menuclasse">
          <div class="box" id="menu_principal">                   
                 <?php 
                    if($this->session->userdata('perfil_atual') == '1'){
                        $this->load->view('/geral/box/menu_colab',$menupriativo);
                    }
                    if($this->session->userdata('perfil_atual') == '2'){
                        $this->load->view('/geral/box/menu_gestor',$menupriativo);
                    }
                 ?>
             </div>
    </div>
    <div class="conteudomarg">
     
            <div class="menuclasse">  
                <div class="box">
                 <div  style="padding: 10px">
                     <img class="circuloM center-block" style=" margin-top: 10px;" src="<?php echo $this->session->userdata('foto') ?>"> 
                     <br/>
                     <p style="text-align: center; font-size: 20px; color: #337ab7"><?php echo $this->session->userdata('nome') ?></p>
                     <p style="text-align: center; font-size: 14px; color: #86a0b7; margin-top: -10px"><?php echo $this->session->userdata('cargo') ?></p>
                     <div class="divisao_pontim"></div>
                  </div>                  
                  <?php $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>    
                     
                
             </div>
         </div>
         <div class="conteudomarg">              
             <div class="box">
                 <div class="padding">
                     <p class="tit">Demonstrativos de Pagamento</p>
                     <div class="divisao_pontim"></div>
                      <?php  foreach ($tipodecalculo as $value) { 
                             
                             switch ($value->tipo_tipocal) {
                                case '11':
                                    $tipocal = 'Cálculo Mensal';
                                    break;
                                case '12':
                                    $tipocal = 'Folha Complementar';
                                    break;
                                case '13':
                                    $tipocal = 'Complementar de Dissídio';
                                    break;
                                case '14':
                                    $tipocal = 'Pagamento de Dissídio';
                                    break;
                                case '15':
                                    $tipocal = 'Complementar Rescisão';
                                    break;
                                case '21':
                                    $tipocal = 'Primeira Semana';
                                    break;
                                case '22':
                                    $tipocal = 'Semana Intermediária';
                                    break;
                                case '23':
                                    $tipocal = 'Última semana';
                                    break;
                                case '31':
                                    $tipocal = 'Adiantamento 13º Salário';
                                    break;
                                case '32':
                                    $tipocal = '13º Salário Integral';
                                    break;
                                case '41':
                                    $tipocal = 'Primeira Quinzena';
                                    break;
                                case '42':
                                    $tipocal = 'Segunda Quinzena';
                                    break;
                                case '91':
                                    $tipocal = 'Adiantamento Salárial';
                                    break;
                                case '92':
                                    $tipocal = 'Participação dos Lucros';
                                    break;
                                case '93':
                                    $tipocal = 'Especiais';
                                    break;
                                case '94':
                                    $tipocal = 'Reclamatória Trabalhista';
                                    break;
                            }?>
                     <div class="boxborda radious4">
                         <div  class="row" >
                             <a data-toggle="collapse" class="abrefech" data-parent="#accordion" href="#dvcomple<?php echo $value->tipo_idtipodecalculo ?>">
                                 <div class="col-xs-11 col-sm-11 tit2" style=" font-size: 18px">
                                     <?php $data = $value->tipo_mesref;    $data = explode("-", $data);    list($ano, $mes, $dia ) = $data;  
                                     echo $mes.'/'.$ano.' - '.$tipocal;?>
                                 </div>
                                 <div class="col-xs-1 col-sm-1 text-right dvmais" style=" font-size: 20px">+</div>
                             </a>
                         </div>
                         
                        
                                <div id="dvcomple<?php echo $value->tipo_idtipodecalculo ?>" class="panel-collapse collapse">
                                    <div  class="row" >
                                        <div class="col-sm-6 cinza">Tipo de pagamento: <strong>Depósito bancário</strong></div>
                                        <div class="col-sm-6 cinza">Data de pagamento: <strong><?php echo $this->Log->alteradata1($value->tipo_datapag)?></strong></div>                             
                                    </div>
                                    <ul class="nav nav-tabs" style=" height: 10px; display: table; width: 100%; margin-top: 40px">
                                        <li class="active"><a href="#rubricas<?php echo $value->tipo_idtipodecalculo ?>" aria-expanded="false" data-toggle="tab">Rubricas</a></li>
                                        <li><a href="#graficos<?php echo $value->tipo_idtipodecalculo ?>" aria-expanded="false" data-toggle="tab">Gráfico</a></li>
                                    </ul>

                                    
                                    <div class="tab-content">
                                        <div id="rubricas<?php echo $value->tipo_idtipodecalculo ?>" class="tab-pane fade active in">                                          
                                            <div style=" min-width: 200px;	overflow: auto; ">
                                            <table class="table table-striped table-condensed" style=" margin-top: 20px; background: #fff; ">
                                              <thead>
                                                <tr>
                                                  <th style=" width: 20px"> </th>
                                                  <th>Descrição</th>
                                                  <th>Referência</th>
                                                  <th>Descontos</th>
                                                  <th>Proventos</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                               <?php $this->db->where('even_idtipodecalculo',$value->tipo_idtipodecalculo);
                                                     $eventos = $this->db->get('eventoscalculo')->result();
                                                     $totaldesconto = 0;
                                                     $totalproventos = 0;
                                                     $totalliquido = 0;
                                                     foreach ($eventos as $dados) { 
                                                         $valorevento = $dados->even_valor;
                                                         $valorevento = str_replace(',' , '.', $valorevento);
                                                         
                                                         if($dados->even_tipoevento == '-'){
                                                             $totaldesconto = $totaldesconto + $valorevento;
                                                         }
                                                         if($dados->even_tipoevento != '-'){
                                                             if($dados->even_tipoevento != '#'){
                                                                $totalproventos = $totalproventos + $valorevento;
                                                             }
                                                         }                                                     
                                                         $totalliquido = 0;                                                         
                                                         ?>
                                                        <tr>
                                                          <td>
                                                              <?php switch ($dados->even_tipoevento) {
                                                                case '+':echo '<span class="glyphicon glyphicon-plus" style="color: #40b764"></span>';break;
                                                                case '-':echo '<span class="glyphicon glyphicon-minus" style="color: #e91b23"></span>';break;
                                                                case '#':echo '<span class="glyphicon glyphicon-info-sign" style="color: #00a4e0"></span>';break;
                                                                }?>
                                                          </td>
                                                          <td><?php echo $dados->even_descrievento ?></td>
                                                          <td><?php echo $dados->even_referencia ?></td>
                                                          <td style="color:#e91b23"><?php if($dados->even_tipoevento == '-'){echo 'R$ '.$dados->even_valor.'';}?></td>
                                                          <td style=" <?php if($dados->even_tipoevento == '#'){echo 'color:#00a4e0';}else{echo 'color:#3fb663';}?>">
                                                              <?php if($dados->even_tipoevento != '-'){echo 'R$ '.$dados->even_valor;}?>
                                                          </td>
                                                        </tr>
                                               <?php }?>
                                                        <tr>
                                                            <td></td>
                                                            <td><strong><i>Total</i></strong></td>
                                                            <td></td>
                                                            <td style="color:#e91b23"><strong><i>R$ <?php echo $totaldesconto ?></i></strong></td>
                                                            <td style="color:#3fb663"><strong><i>R$ <?php echo $totalproventos ?></i></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><strong><i>Valor líquido a receber:</i></strong></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="color:#3fb663"><strong><i>R$ <?php echo ($totalproventos - $totaldesconto) ?></i></strong></td>
                                                        </tr>
                                              </tbody>
                                            </table>
                                            </div>
                                            
                                            
                                            <div  class="row" >
                                                <div class="col-sm-4 cinza" style=" margin-top: 20px">
                                                    Dependentes IRRF: <strong><?php echo $value->tipo_impostorenda ?></strong> <br/>
                                                    Base Cálculo IRRF: <strong><?php echo $value->tipo_basecalculoirrf ?></strong>
                                                </div>
                                                <div class="col-sm-4 cinza" style=" margin-top: 20px">
                                                    Dependentes Salário Família: <strong><?php echo $value->tipo_ndependente_salariofami ?></strong> <br/>
                                                    Base Cálculo FGTS: <strong><?php echo $value->tipo_basefgts ?></strong>
                                                </div>  
                                                <div class="col-sm-4 cinza" style=" margin-top: 20px">
                                                    Salário base: <strong><?php echo $value->tipo_salariobase ?></strong> <br/>
                                                    Base Cálculo INSS: <strong><?php echo $value->tipo_baseinss ?></strong>
                                                </div>  
                                            </div>


                                        </div>
                                        <div id="graficos<?php echo $value->tipo_idtipodecalculo ?>" class="tab-pane fade" style=" width: 100%">
                                            <imput ridem val graficos<?php echo $value->tipo_idtipodecalculo ?>
                                            <div id="columnchart_values<?php echo $value->tipo_idtipodecalculo ?>" style="width:100%; height:400px"></div>
                                        </div>

                                    </div>
                                </div>                        
                        
                    </div>  
                      <?php } ?>
                      
            
             </div>
         </div>
     </div>
    </div>

</div> 

   <script type="text/javascript">
    // abrir o menu pefil 
    $('#collapseTwo').collapse();
    $( ".abrefech" ).click(function(e) {
        e.preventDefault();
        
        if ($(this).find(".dvmais").html() === "+") {
            $(this).find(".dvmais").html("-");
        }
        else {
            $(this).find(".dvmais").html("+");
        }
       
    }); 
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    target = $(e.target).attr("href");
    <?php  
    //switch ($i) {
    foreach ($tipodecalculo as $value) { ?>
    google.charts.load("current", {packages:['corechart']});    
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Valor", { role: "style" } ],
        ["Provento", 3542, "#337ab7"],
        ["Desconto", 2587, "#337ab7"],
        ["Vantagem", 2140, "#337ab7"]        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {

        vAxis: { gridlines: { count: 4 } },
        bar: {groupWidth: "40%"},
        legend: { position: "none" }
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
      }
    <?php } ?>
  
});
 


  </script>

