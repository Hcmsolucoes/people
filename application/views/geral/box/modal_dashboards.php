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

</div> -->
    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
  <script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
  <script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
  <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>    

<div class="panel-body list-group list-group-contacts">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Tabela Exportação</h3>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src='img/icons/xml.png' width="24"/> XML</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'sql'});"><img src='img/icons/sql.png' width="24"/> SQL</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src='img/icons/csv.png' width="24"/> CSV</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='img/icons/txt.png' width="24"/> TXT</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li>
                                        </ul>
                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body">
                                    <table id="customers2" class="table datatable" style=" font-size: 08px;">
                                            <thead style=" font-size: 10px;">
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Centro de Custo</th>
                                                <th>Cargo</th>
                                                <th>Ano</th>
                                                <th>Mes</th>
                                                <th>Receita Bruta</th>
                                                <th>Valor Folha Pagamento</th>
                                                <th>Salários</th>
                                                <th>Pró Labore</th>
                                                <th>Benefícios</th>
                                                <th>Hora Extra</th>
                                                <th>Comissão</th>
                                                <th>Outros Custos</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>HCM Consultoria</td>
                                                <td>administrativo</td>
                                                <td>Assistente administrativo</td>
                                                <td>2016</td>
                                                <td>09/2016</td>
                                                <td>R$225000.00</td>
                                                <td>R$115000.00</td>
                                                <td>R$11000.00</td>
                                                <td>R$1820.00</td>
                                                <td>R$420.00</td>
                                                <td>R$3550.00</td>
                                                <td>R$4220.00</td>
                                                <td>R$49300.90</td>
                                            </tr>
                                             <tr>
                                                <td>HCM Consultoria</td>
                                                <td>operacional</td>
                                                <td>Assistente rh</td>
                                                <td>2016</td>
                                                <td>10/2016</td>
                                                <td>R$23050.00</td>
                                                <td>R$195000.00</td>
                                                <td>R$10900.00</td>
                                                <td>R$2930.00</td>
                                                <td>R$2311.00</td>
                                                <td>R$31120.00</td>
                                                <td>R$1120.00</td>
                                                <td>R$49600.90</td>
                                            </tr> 
                                               <tr>
                                                <td>HCM Consultoria</td>
                                                <td>administrativo</td>
                                                <td>Assistente administrativo</td>
                                                <td>2016</td>
                                                <td>11/2016</td>
                                                <td>R$238050.00</td>
                                                <td>R$29233.00</td>
                                                <td>R$89919.00</td>
                                                <td>R$3731.00</td>
                                                <td>R$342342.00</td>
                                                <td>R$32320.00</td>
                                                <td>R$1525.00</td>
                                                <td>R$49320.90</td>
                                            </tr> 
                                               <tr>
                                                <td>HCM Consultoria</td>
                                                <td>Recursos humanos</td>
                                                <td>Operador Maquina</td>
                                                <td>2016</td>
                                                <td>12/2016</td>
                                                <td>R$327111.00</td>
                                                <td>R$49292.00</td>
                                                <td>R$32322.00</td>
                                                <td>R$12356.00</td>
                                                <td>R$52342.00</td>
                                                <td>R$8654.00</td>
                                                <td>R$232.00</td>
                                                <td>R$3467.90</td>
                                             </tr> 
                                               <tr>
                                                <td>HCM Consultoria</td>
                                                <td>Recursos humanos</td>
                                                <td>Operador Maquina</td>
                                                <td>2017</td>
                                                <td>01/2017</td>
                                                <td>R$32124.00</td>
                                                <td>R$494322.00</td>
                                                <td>R$4522.00</td>
                                                <td>R$3525.00</td>
                                                <td>R$5223.00</td>
                                                <td>R$52432.00</td>
                                                <td>R$4222.00</td>
                                                <td>R$2342.90</td>
                                            </tr>
                                              <tr>
                                                <td>HCM Consultoria</td>
                                                <td>Recursos humanos</td>
                                                <td>gerente rh</td>
                                                <td>2017</td>
                                                <td>02/2017</td>
                                                <td>R$42324.00</td>
                                                <td>R$34223.00</td>
                                                <td>R$2121.00</td>
                                                <td>R$356.00</td>
                                                <td>R$52323.30</td>
                                                <td>R$3221.00</td>
                                                <td>R$121.00</td>
                                                <td>R$53523.90</td>
                                            </tr>
                                            <tr>
                                                <td>HCM Consultoria</td>
                                                <td>Diretoria</td>
                                                <td>Diretor geral</td>
                                                <td>2017</td>
                                                <td>03/2017</td>
                                                <td>R$42324.00</td>
                                                <td>R$34232.00</td>
                                                <td>R$3121.00</td>
                                                <td>R$22342.00</td>
                                                <td>R$2232.30</td>
                                                <td>R$233.00</td>
                                                <td>R$2232.00</td>
                                                <td>R$45.90</td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                    
                                </div>
                            </div>

</div>