

<div class="fleft-7 fleftmobile histajax" >
    <div class="panel-group accordion" style="margin-bottom: 0px">
    <div class="panel panel-primary" >
            <div class="panel-heading ui-draggable-handle">
                <h4 class="panel-title">
                    <a href="#hs">
                        Histórico Salarial
                    </a>
                </h4>
            </div>

            <div class="panel-body panel-body-open" id="hs" style="display: block;">

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

                </div>
            </div>
        </div>


        <script type="text/javascript">
            $(".accordion .panel-title a").on("click",function(){

                var blockOpen = $(this).attr("href");
                var accordion = $(this).parents(".accordion");        
                var noCollapse = accordion.hasClass("accordion-dc");

                if($(blockOpen).length > 0){
                    if($(blockOpen).hasClass("panel-body-open")){
                        $(blockOpen).slideUp(200,function(){
                            $(this).removeClass("panel-body-open");
                        });
                    }else{
                        $(blockOpen).slideDown(200,function(){
                            $(this).addClass("panel-body-open");
                        });
                    }

                    if(!noCollapse){
                        accordion.find(".panel-body-open").not(blockOpen).slideUp(200,function(){
                            $(this).removeClass("panel-body-open");
                        });                                           
                    }

                    return false;
                }

            });
        </script>