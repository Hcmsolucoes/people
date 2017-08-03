<!--<div class="fleft-7" style="margin: 10px 0px;border-top: 1px solid #eee;">

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
                <?php foreach ($turnoverexporta as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['Admissão']; ?></td>
                    <td><?php echo $value['colaborador']  ?></td>
                    <td><?php echo $value['cargo']  ?></td>
                    <td><?php echo $value['Centro de Custo']  ?></td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>

</div> -->
  <script type='text/javascript' src='<?php echo base_url('js/plugins/icheck/icheck.min.js') ?>'></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') ?>"></script>
        
  <script type="text/javascript" src="<?php echo base_url('js/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/tableExport.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/jquery.base64.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/html2canvas.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/jspdf/libs/sprintf.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/jspdf/jspdf.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/plugins/tableexport/jspdf/libs/base64.js') ?>"></script>    

<div class="panel-body list-group list-group-contacts">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Tabela Exportação</h3>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src='<?php echo base_url('img/icons/xml.png') ?>' width="24"/> XML</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'sql'});"><img src='<?php echo base_url('img/icons/sql.png') ?>' width="24"/> SQL</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src='<?php echo base_url('img/icons/csv.png') ?>' width="24"/> CSV</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='<?php echo base_url('img/icons/txt.png') ?>' width="24"/> TXT</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='<?php echo base_url('img/icons/xls.png') ?>' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='<?php echo base_url('img/icons/word.png') ?>' width="24"/> Word</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='<?php echo base_url('img/icons/png.png') ?>' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo base_url('img/icons/pdf.png') ?>' width="24"/> PDF</a></li>
                                        </ul>
                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body">
                                    <table id="customers2" class="table datatable" style=" font-size: 08px;">
                                            <thead style=" font-size: 10px;">
                                            <tr>
                                                <th>MesAno</th>
                                                <th>Movimentação</th>
                                                <th>Colaborador</th>
                                                <th>Cargo</th>
                                                <th>Admissão</th>
                                                <th>Demissão</th>
                                                <th>Centro de Custo</th>
                                                <th>Empresa</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                   <?php foreach ($turnoverexporta as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $value['mes']; ?></td>
                                            <td><?php echo $value['Movimentacao']  ?></td>
                                            <td><?php echo $value['colaborador']  ?></td>
                                            <td><?php echo $value['cargo']  ?></td>
                                            <td><?php echo $value['Admissão']  ?></td>
                                            <td><?php echo $value['Demissão']  ?></td>
                                            <td><?php echo $value['Centro de Custo']  ?></td>
                                            <td><?php echo $value['empresa']  ?></td>
                                        </tr>
                                        <?php }  ?>
                                        </tbody>
                                    </table>                                    
                                    
                                </div>
                            </div>

</div>