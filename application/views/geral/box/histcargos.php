<div class="fleft-7" style="margin: 10px 0px;border-top: 1px solid #eee;">

        <h3 class="">Histórico de Cargos</h3>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Empresa</th>
                    <th>Início</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histcargos as $key => $value) { ?>
                <tr>
                    <td><?php echo $value->descricao; ?></td>
                    <td><?php echo $value->em_nomefantasia  ?></td>
                    <td><?php echo $this->Log->alteradata1( $value->car_inicio ) ?></td>
                    <td><?php echo $value->motivo  ?></td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>

</div>