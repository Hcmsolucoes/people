<?php
    $opts = "";
    foreach ($informes as $value) {
    $data = explode("-", $value->inf_ano);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->inf_idinforme."'>".$ano."</option>";
    }


 ?>

<div class="content-frame-top">                        
<div class="page-title">                    
    <h2><span class="fa fa-tachometer"></span> Informe de Rendimentos</h2>
    <img id="loadinforme" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Pesquisando...">
</div>                                      
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Use a pesquisa para localizar seu informe de rendimento</p>
                <form id="forminforme" class="form-horizontal" method="post" action="<?php echo base_url('perfil/soapferias') ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="informeespelho" name="informeespelho" class="form-control cinza">
                                      <option>Selecione o ano</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                 <input type="submit" class="btn btn-primary" id="informepesquisar" value="Pesquisar" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>                                    
            </div>
        </div>
    </div>
</div>

<div class="row">
  
    <div id="informeresult" class="fleft-10"></div>
   
</div>

<script type="text/javascript">
    $( "#forminforme" ).on("submit", function(e) {
        e.preventDefault();

       $("#loadinforme").fadeIn("slow");

        $("#informepesquisar").prop("disabled", true);
       
        $.ajax({           
            type: "POST",
            url: '<?php echo base_url("perfil/soapinforme"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data: $( this ).serialize(),            
            success: function(msg) 
            {
                $("#informepesquisar").prop("disabled", false);
                $("#informeresult").html(msg);
                $("#loadinforme").fadeOut("slow");
            } 
        });
           

     });
</script>