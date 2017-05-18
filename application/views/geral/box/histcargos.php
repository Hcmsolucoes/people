<div  class="fleft-7 fleftmobile histajax" >
    <div class="panel-group accordion" style="margin-bottom: 0px">
        <div class="panel panel-primary" >
            <div class="panel-heading ui-draggable-handle">
                <h4 class="panel-title">
                    <a href="#hcar">
                        Histórico de Cargos
                    </a>
                </h4>
            </div>

            <div class="panel-body panel-body-open" id="hcar" style="display: block;">

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