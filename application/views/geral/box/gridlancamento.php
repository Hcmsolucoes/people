<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $lancamentos[0]->fun_nome; ?></h3>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Evento</th>
					<th>Horas</th>
					<th>Valor</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$total_horas = "00:00:00";
			$valor_total = 0;
			foreach ($lancamentos as $key => $value) { 
				$valor="";
				$horas="";
					if (!empty($value->valor)) {
						$valor = "R$ " . number_format($value->valor, 2, ",", ".");
						$valor_total += $value->valor;
					}
					if (!empty($value->horas)) {
						$horas = $value->horas." Hrs";
						$total_horas = $this->util->somaHora($value->horas, $total_horas);
					}
			?>
				<tr>
					<td><?php echo $value->descricao; ?></td>
					<td><?php echo $horas; ?></td>
					<td><?php echo $valor; ?></td>
					<td><i id="<?php echo $value->id_lancamento; ?>" style="cursor: pointer;" class="glyphicon glyphicon-remove delanc"></i></td>
				</tr>
			<?php }  ?>
			<tr>
				<td class="bold">Totais</td>
				<td class="bold"><?php echo $total_horas." Hrs"; ?></td>
				<td class="bold"><?php echo "R$ " . number_format($valor_total, 2, ",", "."); ?></td>
				<td></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>