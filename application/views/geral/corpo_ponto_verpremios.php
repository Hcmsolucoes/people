
<?php foreach ($pontoaponto as $ponto) {
      $faturamento = $ponto->pon_e1_faturarealizado;$equipamento = $ponto->pon_idparametros;$comissao = $ponto->pon_e1_ganhocomissao;$aproveita1 = $ponto->pon_e1_aproveitament;
      $ajust = $ponto->pon_e1_ajust; $macro = $ponto->pon_e1_macros;$jornada = $ponto->pon_e1_jornada;$intersticio = $ponto->pon_e1_intersticio;$direccontinua = $ponto->pon_e1_direccontinua;
      $almoco = $ponto->pon_e1_almoco;$pon_e1_descsemanal = $ponto->pon_e1_descsemanal;$faltasjust = $ponto->pon_e1_faltasjust;$advertencia = $ponto->pon_e1_advertencia;
      $suspensao = $ponto->pon_e1_suspensao;$picoleve = $ponto->pon_e1_picoleve;$picogrande = $ponto->pon_e1_picogrande; $totviola = $ponto->pon_e1_totviola;$pon_e2_ctenf = $ponto->pon_e2_ctenf;
      $pon_e2_tacografo = $ponto->pon_e2_tacografo;$pon_e2_fichajornada = $ponto->pon_e2_fichajornada;$pon_e2_acidente = $ponto->pon_e2_acidente;
      $pon_e2_docuvencido = $ponto->pon_e2_docuvencido;$pon_e2_suspensao = $ponto->pon_e2_suspensao;$pon_e2_uniformes = $ponto->pon_e2_uniformes;
      $pon_e3_realizado = $ponto->pon_e3_realizado;$pon_e3_resultado = $ponto->pon_e3_resultado;
      $pon_uso = $ponto->pon_uso; $pon_id = $ponto->pon_idpontoaponto; $pon_e1_valpre = $ponto->pon_e1_valpre;$pon_e2_valpre = $ponto->pon_e2_valpre;
      $pon_e3_valpre = $ponto->pon_e3_valpre; $pon_totalpremio = $ponto-> pon_totalpremio;
      
} ?>
 
<div class="content-frame-top">                        
<div class="page-title">                    
    <h2><span class="fa fa-gift"></span> Consulta de Prêmios</h2>
</div>                                      

<div class="row" style=" font-size: 13px; margin-bottom: 20px">
<div class="col-md-12">
    <div class="widget widget-default">
      
      <!-- <h3 class="">Consultar Prêmios</h3> -->

      <?php foreach ($funcionarios_edit as $value) { 

        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
         $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
        ?>
      <?php foreach ($ponto_parametros as $dados) { ?>
    
     
        <div class="col-sm-5" style=" margin-top: 8px">
            <div style=" float: left"><img src="<?php echo $foto ?>" 
                 class="" style="border-radius: 20%;border:1px solid #000000;width: 65px;">
            </div>
            
            <div style=" float: left; margin-left: 20px;  padding-top: 8px"><?php echo $value->fun_nome ?><br>
                <span style=" color: #888">Matricula:</span> <?php echo $value->fun_matricula ?><br>
                <span style=" color: #888">Admissão:</span> <?php echo $this->Log->alteradata1($value->contr_data_admissao)?><br>
                <span style=" color: #888">Cargo:</span> <?php echo $value->contr_cargo ?><br>
            </div>
            <input id="for_idfuncio" name="for_idfuncio" type="hidden" value="<?php echo $value->fun_idfuncionario ?>">
            <input id="for_idponto" name="for_idponto" type="hidden" value="<?php if (isset($pon_id)){echo $pon_id;}?>">
            <input id="for_idpparame" name="for_idpparame" type="hidden" value="<?php echo $dados->para_idparametros ?>">
        </div>
        
        <div class="col-sm-3" style=" margin-top: 15px">
          <div class="form-group">
            <label for="for_comp" class="control-label">Competência</label>
            <select class="form-control" id="for_comp" name="for_comp" style="max-width: 120px;">
              <option>Selecione ...</option>
                <?php foreach ($parametros as $value) {
                $data = $this->Log->alteradata1($value->para_datacompentencia); $data = explode("/", $data);                         list($dia, $mes, $ano ) = $data;
                echo "<option value=".$value->para_idparametros.">".$mes.'/'.$ano."</option>";
                }?>           
            </select>
          </div>
        </div>

      </div>

      <div class="clearfix"></div>
      <div id="resulcomp"></div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
    
    
    
    

<script type="text/javascript">
$('#collapseTwoponto').collapse();

$( '#for_comp' ).change(function(e) {
    e.preventDefault(); 
    
    idcomp = $(this).val();
    
    $.ajax({             
            type: "POST",
             url: '<?php echo base_url().'pontoaponto/verpremios_comp' ?>',
       dataType : 'html',
       secureuri: false,
            data: {idcomp : idcomp },                
            success: function(msg) 
                  { 
                      //location.reload(); 
                      //
                      //alert(msg);
                      $('#resulcomp').html(msg);
                  } 
            });
});

</script>

