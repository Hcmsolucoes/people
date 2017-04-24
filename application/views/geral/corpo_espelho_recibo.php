<?php
    $opts = "";
    foreach ($reciboferias as $value) {
    $data = explode("-", $value->rec_datainicio);    
    list($ano, $mes, $dia ) = $data;  
    $opts .= "<option value='".$value->rec_idferias."'>".$mes.'/'.$ano."</option>";
    }


 ?>

<div class="content-frame-top">                        
<div class="page-title">                    
    <h2><span class="fa fa-plane"></span> Recibo de férias</h2>
    <img id="loadrecibo" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Pesquisando...">
</div>                                      
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Use a pesquisa para localizar seu Recibo de férias</p>
                <form id="formrecibo" class="form-horizontal" method="post" action="<?php echo base_url('perfil/soapferias') ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search" id="lupa"></span>
                                </div>
                                    <select id="reciboespelho" name="reciboespelho" class="form-control cinza">
                                      <option>Selecione a competência</option>
                                          <?php echo $opts; ?>
                                    </select>
                                <div class="input-group-btn">
                                 <input type="submit" class="btn btn-primary" id="recibopesquisar" value="Pesquisar" />
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
  
    <div id="reciboresult" class="fleft-10"></div>
   
</div>
<!--
<div class="row" style=" font-size: 13px; margin-bottom: 20px">
    <div class="col-md-12">
        <div class="widget widget-default">
      

        </div>
      <div class="clearfix"></div>
      <div id="resulcomp"></div>
    </div>
    
</div>-->

<script type="text/javascript">
    $( "#formrecibo" ).on("submit", function(e) {
        e.preventDefault();

       $("#loadrecibo").fadeIn("slow");

        $("#espelhopesquisar").prop("disabled", true);
       
        $.ajax({           
            type: "POST",
            url: '<?php echo base_url("perfil/soapferias"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data: $( this ).serialize(),            
            success: function(msg) 
            {
                $("#recibopesquisar").prop("disabled", false);
                $("#reciboresult").html(msg);
                $("#loadrecibo").fadeOut("slow");
            } 
        });
           

     });
</script>