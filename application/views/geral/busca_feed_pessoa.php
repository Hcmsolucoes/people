
<div class="col-md-6">
<div class="panel-body list-group list-group-contacts"> 

<?php 
foreach ($funcionarios as $key => $value) {

$prinome = explode(" ", $value->fun_nome);

    ?>
                               
    <div class="list-group-item itembusca" data-nome="<?php echo $prinome[0]; ?>" id="<?php echo $value->fun_idfuncionario; ?>" data-foto="<?php echo $value->fun_foto; ?>" style="line-height: 45px;">                                    
        <img src="<?php echo $value->fun_foto; ?>" class="pull-left" />
        <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
    </div>

<?php } ?>

</div>
</div>
<script type="text/javascript">
    $(".itembusca").on("click", function(){
   
    var nome = $(this).data("nome");
    var id = $(this).attr("id");
    var foto = $(this).data("foto");
    
    $("#busca").val("");
    $("<div class='btn btn-default' id='foto"+id+"'>"+nome+" <span rm='"+id+"' class='fa fa-times exc'> </span></div>").appendTo("#selecionados");
/*
    $("<div class='fleft ' id='foto"+id+"' style='text-align: center;'>"+
        "<span class='fa fa-times-circle exc' rm='"+id+"' style='position: absolute;font-size: 20px;cursor:pointer;'></span><img src='"+foto+"' class='imgcirculo_p' /><br><span>"+nome+"</span></div>").appendTo("#selecionados");
*/
    $("<input type='hidden' name='colabs[]' id='colab"+id+"' value='"+id+"' >").appendTo("#selecionados");
    
    $("#res_busca").html(""); 
  });

   
</script>