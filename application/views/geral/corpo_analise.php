<div class="page-title">                    
	<h2><span class="fa fa-bar-chart-o"></span> Minhas Análises</h2>	
</div>
<div class="col-md-12">
	<?php

foreach ($analises as $key => $value) {
	echo $value->descricao_analise . "<br>";
}

?>

</div>


