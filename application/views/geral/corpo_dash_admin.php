<?php 

foreach ($funcionario as $value) {
        $nome = $value->fun_nome;
		$cargo = $value->fun_cargo;
		$matricula = $value -> fun_matricula;
		$foto = $value -> fun_foto;
   
    }



 $totalcolab = "{label: 'Ativos', value: ".$total1->ativo." }, 
 {label: 'Inativos', value: ".$total2->inativo." }";

//echo $totalcolab;

   


?>

<div class="page-content-wrap">
    <div class="row">

  <div class="col-md-4">

      <!-- START VISITORS BLOCK -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title-box">
            <h3>Geral</h3>
            <span>Total de colaboradores</span>
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
          <div class="chart-holder" id="dashcolab" style="height: 200px;"></div>
        </div>
      </div>
      <!-- END VISITORS BLOCK -->

    </div>

</div>

</div>


<script type="text/javascript">
	



$(document).ready(function(){

	Morris.Donut({
        element: 'dashcolab',
        data: [<?php echo $totalcolab; ?>],
        colors: ['#33414E', '#1caf9a'],
        resize: true
    });

	
  });

    
</script>