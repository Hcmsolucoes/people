

<div class="fleft-7 fleftmobile histajax" >

    <h3 class="">Histórico Salarial</h3>

<table class="table table-striped table-hover" >
    <thead>
        <tr>
            <th>Motivo</th>
            <th>Valor</th>
            <th>Percentual</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $porc="";
        if (count($histsalarios)>1) {
                                 /*   $ult_salario = $histsalarios[count($histsalarios) -1]->sal_valor;
                                    $pri_salario = $histsalarios[0]->sal_valor;
                                    $porcentagem = 100 - (($pri_salario * 100) / $ult_salario);
                                    $porc = number_format($porcentagem, 2). "%";                                  
                               */ }

                                    $sal =0;
                                    foreach ($histsalarios as $key => $value) {

                                        $porcentagem = 100 - (($sal * 100) / $value->sal_valor);
                                        $porc = number_format($porcentagem, 2). "%";
                                        $sal = $value->sal_valor;

                                        $valor = number_format($value->sal_valor, 2,".", ",");
                                        $datadeinicio = $this->Log->alteradata1( $value->sal_dataini );
                                        ?>
                                        <tr>
                                            <td><?php echo $value->motivo; ?></td>
                                            <td><?php echo "R$ " . $valor;  ?></td>
                                            <td><?php echo $porc;  ?></td>
                                            <td><?php echo $datadeinicio; ?></td>
                                        </tr>
                                        <?php }  ?>
                                <!--<tr>
                                    <td></td>
                                    <td class="green bold"><?php echo $porc; ?> <span class="fa fa-arrow-up"></span> </td>
                                    <td></td>
                                </tr>-->
                            </tbody>
                        </table>
</div>