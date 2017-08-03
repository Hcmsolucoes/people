<?php 

//carga dashboard de tunover
$dadostabletunover ="";
$ticks ="[";
foreach ($turnovertotal as $key => $value) { 

  $dadostabletunover .=  "['".$value['Ano']."','".$key."',".$value['Admissao'].",".$value['Demissao'].",".$value['Ativos'].",'".$key."'],";
  $ticks .=  "new Date('".$value['mesano']."'),";

  }
  $ticks .="]";

$filtrostabelas ="";

foreach ($turnoveradm as $key => $value) { 
$dataadmissao = (!empty($value['Admissão']))? $value['Admissão'] : "";
$datademisao = (!empty($value['Demissão']))? $value['Demissão'] : "";

  $filtrostabelas .=  "['".$value['Ano']."',new Date('".$value['mesano']."'),'".$value['mes']."','".$value['Movimentacao']."','".$value['colaborador']."','".$value['cargo']."','".$dataadmissao."','".$datademisao."','".$value['empresa']."','".$value['Centro de Custo']."',".$value['idccusto'].",".$value['idempresa']."],";


  }

//Monta array salario por sexo
$arr_salariosexo = array();
$arr_salariosexo = "['Nome', 'Sexo', 'Idade', 'Salario','Cargo','Centro de Custo','Departamento','Admissão','Empresa'],";
foreach ($salariosexo as $key => $value) {  

$arr_salariosexo .= "['".$value->fun_nome."','".$value->sexo."',".$value->idadefun.",".$value->sal_valor.",'".$value->fun_cargo."','".$value->contr_centrocusto."','".$value->contr_departamento."','".date("d/m/Y",strtotime(str_replace('-','/', $value->contr_data_admissao)))."','".$value->em_nome."'],";

}

?>
<style type="text/css">
	.barra {
		float: left;
		width: 100%;
		background: #e8e8e8;
		margin-bottom: 10px;
		padding: 6px 15px 7px;
		-moz-border-radius: 0px;
		-webkit-border-radius: 0px;
		border-radius: 0px;
	}

</style>
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

<ul class="barra">
	<div class="btn-group fleft fleftmobile" id="menudashboard" >
		<a href="#" data-toggle="dropdown" class="btn btn-primary fleftmobile">Relatórios<span class="caret"></span></a>
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


	<span  class="btn btn-info fright fleftmobile botoesanalise" style="padding: 4px 10px;" data-toggle="modal" data-target="#analisemodal"><i class="glyphicon glyphicon-home"></i> Minha Análise</span>

	<a id="veranalise" href="#<?php //echo base_url("gestor/analise"); ?>" class="btn btn-info fright fleftmobile botoesanalise" style="padding: 4px 10px;" ><i class="fa fa-bar-chart-o"></i> Ver Análise</a>
</ul><!-- fim da barra-->



<div class="tab-content">
	
	<div role="tabpanel" class="tab-pane " id="botao1">
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
			</div><!--col-md-12-->
		</div><!--row-->
	</div><!--botao 1-->

	<div role="tabpanel" class="tab-pane " id="botao2">	
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
										<td width="40%"><div id="slider_div"></div></td>
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
	</div><!--BOTAO2-->

	<div role="tabpanel" class="tab-pane" id="botao3">

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

									</tr>                                             

									<tr>
										<td width="100%" colspan="4"><div id="chart_turnover" style="padding-top: 15px"></div></td>
									</tr>

								</tbody> 
							</table>   
						</div>
					</div>
				</div>

			</div>
		</div>
	</div><!--BOTAO3-->

</div><!--tabcontent-->
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart', 'table', 'gauge', 'controls']});
google.charts.setOnLoadCallback(drawMainDashboard);
//google.charts.setOnLoadCallback(drawMainReceita);
google.charts.setOnLoadCallback(drawMainTurnover);

$(".breadcrumb").remove();

$("li").click(function(){
	$(".dropdown-menu").find("li").removeClass("active");
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

	}else{
		$(".trshow").hide();
	}
	dashboard.draw(data1);
}

function drawMainTurnover() {
    var dashboard2 = new google.visualization.Dashboard(
        document.getElementById('dashboard_turnover'));

 
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Ano');
    data.addColumn('string', 'Mes');  
    data.addColumn('number', 'Admissões');
    data.addColumn('number', 'Demissões');
    data.addColumn('number', 'Ativos');
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
    data3.addColumn('number', 'id Centro de Custo');
    data3.addColumn('number', 'id empresa');
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
               // viewWindow: {
                 //   max: 30
                //}
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
            title: 'Turnover (Admissões, Demissões, Ativos)'
        },
        // Instruct the barchart to use columns 2, 3, 4 and 5
        // from the 'data' DataTable.
        view: {
            columns: [1,2,3,4]
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

        var statemes = categoryPicker2.getState();
        var stateccu = categoryPickerccu1.getState();
        var stateemp = categoryPickeremp1.getState();
      //  var stateano = categoryPickerano1.getState();
        
        //alert(valLow+" ate"+valHigh);
        var row;
        var view;      
        
        var acentrocusto = "";
        var idcentrocusto = "";
        for (var i = 0; i < stateccu.selectedValues.length; i++) {
          
           
            var acentrocusto = acentrocusto + stateccu.selectedValues[i]+',';
        
           row = data3.getFilteredRows([{column: 9, value: stateccu.selectedValues[i]}])[0];

            var idcentrocusto = idcentrocusto+ data3.getValue(row,10)+',';

        } 
        var aempresa = "";
        var idempresa = "";
        for (var i = 0; i < stateemp.selectedValues.length; i++) {
          
             var aempresa = aempresa + stateemp.selectedValues[i]+',';

            row = data3.getFilteredRows([{column: 8, value: stateemp.selectedValues[i]}])[0];

            var idempresa = idempresa+ data3.getValue(row,11)+',';

        } 

        var aMes = ""; 
         for (var i = 0; i < statemes.selectedValues.length; i++) {
          
           var aMes = aMes + statemes.selectedValues[i]+',';

        } 
      
        // sort the indices into their original order
     
        console.log(acentrocusto);
        var n = acentrocusto.length;
        var n = n-1;
        var resccu = acentrocusto.substring(0, n);        
      
        var n = aMes.length;
        var n = n-1;
        var resmes = aMes.substring(0, n);

        var n = aempresa.length;
        var n = n-1;
        var resemp = aempresa.substring(0, n);

        var n = idcentrocusto.length;
        var n = n-1;
        var residcentro = idcentrocusto.substring(0, n);

        var n = idempresa.length;
        var n = n-1;
        var residempresa = idempresa.substring(0, n);
              
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
                    dashboard: 'tunover',
                    acentrocusto: resccu,
                    acentrocusto2: resccu,
                    aempresa: resemp,
                    aempresa2: resemp,
                    MesAno: resmes,
                    idcentro: residcentro,
                    idempresa: residempresa

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
        var view;      
        
        var acentrocusto = "";
        var idcentrocusto = "";
        for (var i = 0; i < stateccu.selectedValues.length; i++) {
          
           
            var acentrocusto = acentrocusto + stateccu.selectedValues[i]+',';
        
           row = data3.getFilteredRows([{column: 9, value: stateccu.selectedValues[i]}])[0];

            var idcentrocusto = idcentrocusto+ data3.getValue(row,10)+',';

        } 
        var aempresa = "";
        var idempresa = "";
        for (var i = 0; i < stateemp.selectedValues.length; i++) {
          
             var aempresa = aempresa + stateemp.selectedValues[i]+',';

               row = data3.getFilteredRows([{column: 8, value: stateemp.selectedValues[i]}])[0];

            var idempresa = idempresa+ data3.getValue(row,11)+',';


        } 

        var aMes = ""; 
         for (var i = 0; i < statemes.selectedValues.length; i++) {
          
           var aMes = aMes + statemes.selectedValues[i]+',';

        } 
      
        // sort the indices into their original order
     
        var n = acentrocusto.length;
        var n = n-1;
        var resccu = acentrocusto.substring(0, n);        
      
        var n = aMes.length;
        var n = n-1;
        var resmes = aMes.substring(0, n);

        var n = aempresa.length;
        var n = n-1;
        var resemp = aempresa.substring(0, n);

        var n = idcentrocusto.length;
        var n = n-1;
        var residcentro = idcentrocusto.substring(0, n);

        var n = idempresa.length;
        var n = n-1;
        var residempresa = idempresa.substring(0, n);
        
        //console.log(residcentro);
               $.ajax({             
                  type: "POST",
                  url: '<?php echo base_url('gestor/view_cargatunover') ?>',
                  dataType : 'json',              
                  data:{
                    acentrocusto: resccu,
                    acentrocusto2: resccu,
                    aempresa: resemp,
                    aempresa2: resemp,
                    MesAno: resmes,
                    idcentro: residcentro,
                    idempresa: residempresa

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
    data5.addColumn('number', 'Ativos');
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

$('a[href="#botao1"]').on('shown.bs.tab', function (e) {
   drawMainReceita();
});
</script>