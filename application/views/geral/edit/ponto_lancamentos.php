<style></style>
<?php if(isset($pontoaponto)){foreach ($pontoaponto as $ponto) {
      $faturamento = $ponto->pon_e1_faturarealizado;$equipamento = $ponto->pon_idparametros;$comissao = $ponto->pon_e1_ganhocomissao;$aproveita1 = $ponto->pon_e1_aproveitament;
      $ajust = $ponto->pon_e1_ajust; $macro = $ponto->pon_e1_macros;$jornada = $ponto->pon_e1_jornada;$intersticio = $ponto->pon_e1_intersticio;$direccontinua = $ponto->pon_e1_direccontinua;
      $almoco = $ponto->pon_e1_almoco;$pon_e1_descsemanal = $ponto->pon_e1_descsemanal;$faltasjust = $ponto->pon_e1_faltasjust;$advertencia = $ponto->pon_e1_advertencia;
      $suspensao = $ponto->pon_e1_suspensao;$picoleve = $ponto->pon_e1_picoleve;$picogrande = $ponto->pon_e1_picogrande; $totviola = $ponto->pon_e1_totviola;$pon_e2_ctenf = $ponto->pon_e2_ctenf;
      $pon_e2_tacografo = $ponto->pon_e2_tacografo;$pon_e2_fichajornada = $ponto->pon_e2_fichajornada;$pon_e2_acidente = $ponto->pon_e2_acidente;
      $pon_e2_docuvencido = $ponto->pon_e2_docuvencido;$pon_e2_suspensao = $ponto->pon_e2_suspensao;$pon_e2_uniformes = $ponto->pon_e2_uniformes;
      $pon_e3_realizado = $ponto->pon_e3_realizado;$pon_e3_resultado = $ponto->pon_e3_resultado;
      $pon_uso = $ponto->pon_uso; $pon_id = $ponto->pon_idpontoaponto; $pon_e1_valpre = $ponto->pon_e1_valpre;$pon_e2_valpre = $ponto->pon_e2_valpre;
      $pon_e3_valpre = $ponto->pon_e3_valpre; $pon_totalpremio = $ponto-> pon_totalpremio;       $competencia = $ponto->para_datacompentencia;
$pon_e1_metamim = $ponto->pon_e1_metamim; $pon_e1_aproveitament = $ponto->pon_e1_aproveitament; $pon_e3_meta = $ponto->pon_e3_meta;}} ?>


<?php foreach ($funcionarios_edit as $value) { ?>
    <?php foreach ($ponto_parametros as $dados) { ?>
<div class="" style="margin: 0px 0px 0px 15px;">
    <form>
    <div class="fleft-10 acenter bold panel"><span> Editar lançamentos: </span>
    <span class="" >Competência <?php if(isset($competencia)){$data = $this->Log->alteradata1($competencia); $data = explode("/", $data);  list($dia, $mes, $ano ) = $data; echo ($mes.'/'.$ano);}else{$data = $this->Log->alteradata1($dados->para_datacompentencia); $data = explode("/", $data);  list($dia, $mes, $ano ) = $data;echo ($mes.'/'.$ano);} ?>
    </span>
    </div>
    
    <div class="row" style=" font-size: 13px; margin-bottom: 20px">
<div class="panel panel-default">
    <div class="fleft" style="margin:0px 10px 0px 0px;">
    <img src="<?php echo $value->fun_foto; ?>" class="imgcirculo_m" >
    </div>

    <div class="fleft" style="line-height: 25px;">
    <span class="bold">Nome: </span><span class="font-sub bold"><?php echo $value->fun_nome; ?></span><br>
    <span class="bold">Matricula: </span><span class="font-sub bold"><?php echo $value->fun_matricula; ?></span> 
    <span class="bold">Admissão: </span><span class="font-sub bold"><?php echo $this->Log->alteradata1($value->contr_data_admissao); ?></span><br>
    <span class="bold">Cargo: </span><span class="font-sub bold"><?php echo $value->contr_cargo; ?></span> 
    </div>

    </div><!--panel-->

<input id="for_idfuncio" name="for_idfuncio" type="hidden" value="<?php echo $value->fun_idfuncionario ?>">
               <input id="for_idponto" name="for_idponto" type="hidden" value="<?php if (isset($pon_id)){echo $pon_id;}?>">
               <input id="for_idpparame" name="for_idpparame" type="hidden" value="<?php echo $dados->para_idparametros ?>">
           

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">1º Etapa</a></li>
    <li><a data-toggle="tab" href="#menu1">2º Etapa</a></li>
    <li><a data-toggle="tab" href="#menu2">3º Etapa</a></li>
  </ul>

  <div class="tab-content">

    <div id="home" class="tab-pane fade in active"> 
             <div class="row" style=" margin-top: 20px; font-size: 13px">                 
                 <div class="fleft"  >
                     <div class="form-group">
                        <label for="for_tipoeq" class="control-label">Equipamento</label>
                        <select class="form-control" id="for_tipoeq" name="for_tipoeq">
                            <?php foreach ($ponto_equipamentos as $equi) { ?>
                            <option value="<?php echo $equi->equi_idequipamentos?>"><?php echo $equi->equi_nome ?></option>
                            <?php } ?>                
                          </select>
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_netamin" class="control-label">Meta Mínima</label>
                        <input class="form-control" id="for_netamin" name="for_netamin" required="" type="text" value="<?php if(isset($pon_e1_metamim)){echo $pon_e1_metamim;}else{echo $dados->para_metamin;} ?>" readonly>
                        
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_fatura" class="control-label">Fat. Realizado</label>
                        <input class="form-control" id="for_fatura" name="for_fatura" required="" type="text" value="<?php if (isset($faturamento)){echo $faturamento;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_apro" class="control-label">% Aproveitamento</label>
                        <input class="form-control" id="for_apro" name="for_apro" required="" type="text" value="<?php if (isset($aproveita1)){echo $aproveita1;}else{ echo '0';} ?>" readonly>
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_comi" class="control-label">% Comissão</label>
                        <input class="form-control" id="for_comi" name="for_comi" required="" type="text" value="<?php if (isset($comissao)){echo $comissao;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_ajust" class="control-label">Valor do Ajuste</label>
                        <input class="form-control" id="for_ajusth" name="for_ajusth" required="" type="hidden" value="<?php if (isset($ajust)){echo $ajust;}else{ echo '0';} ?>">
                        <input class="form-control" id="for_ajust" name="for_ajust" required="" type="text" value="<?php if (isset($ajust)){echo $ajust;}else{ echo '0';} ?>">
                    </div>
                 </div>                 
          
                <div class="fleft" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_valpre1" class="font-sub">Total 1ª. Etapa</label>
                        <input  style="background-color:transparent; border: none;color: #1CAF9A;" class="form-control bold" id="for_valpre1" name="for_valpre1" required="" type="text" value="<?php if (isset($pon_e1_valpre)){echo number_format($pon_e1_valpre, 2, ",", ".");}else{ echo '0';} ?>" />
                    </div>
                </div>
            </div> 
      
<div class=" separador"></div>
             
             <div class="row removenocel" style=" font-size: 11px; text-align: center">
                <div class="fleft">
                    <span class="bold">Valores</span><br><br><br>
                    <span class="red bold">Violações</span>
                </div>

                <div class="fleft acenter bordadir">
                    <span>20,00</span>
                 <br><br>
                    <span class="bold font-sub">Macros</span>
                 <br>
                 <input class=" forvio" id="for_macro" name="for_macro" maxlength="2" required="" type="text" value="<?php if (isset($macro)){echo $macro;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Jornada</span>
                 <br>
                 <input class=" forvio" id="for_jornada" name="for_jornada"  maxlength="2" required="" type="text" value="<?php if (isset($jornada)){echo $jornada;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>20,00</span>
                 <br><br>
                    <span class="bold font-sub">Interst.</span>
                 <br>
                 <input class=" forvio" id="for_interst" name="for_interst"  maxlength="2" required="" type="text" value="<?php if (isset($intersticio)){echo $intersticio;}else{ echo '0';} ?>">
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Dir.Cont.</span>
                 <br>
                 <input class=" forvio" id="for_continua" name="for_continua"  maxlength="2" required="" type="text" value="<?php if (isset($direccontinua)){echo $direccontinua;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Almoço</span>
                 <br>
                 <input class=" forvio" id="for_almoco" name="for_almoco"  maxlength="2" required="" type="text" value="<?php if (isset($almoco)){echo $almoco;}else{ echo '0';} ?>">
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Semanal</span>
                 <br>
                 <input class=" forvio" id="for_semanal" name="for_semanal"  maxlength="2" required="" type="text" value="<?php if (isset($pon_e1_descsemanal)){echo $pon_e1_descsemanal;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Faltas</span>
                 <br>
                 <input class=" forvio" id="for_faltas" name="for_faltas"  maxlength="2" required="" type="text" value="<?php if (isset($faltasjust)){echo $faltasjust;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Advert.</span>
                 <br>
                 <input class="forvio" id="for_advert" name="for_advert"  maxlength="2" required="" type="text" value="<?php if (isset($advertencia)){echo $advertencia;}else{ echo '0';} ?>">
                 </div>

                 <div class="fleft acenter bordadir">
                    <span>Eliminado</span>
                 <br><br>
                    <span class="bold font-sub">Suspens</span>
                 <br>
                 <input class=" forvio" id="for_suspens" name="for_suspens"  maxlength="2" required="" type="text" value="<?php if (isset($suspensao)){echo $suspensao;}else{ echo '0';} ?>">
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">P.Leve</span>
                 <br>
                 <input class=" forvio" id="for_pleve" name="for_pleve"  maxlength="2" required="" type="text" value="<?php if (isset($picoleve)){echo $picoleve;}else{ echo '0';} ?>">
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>50,00</span>
                 <br><br>
                    <span class="bold font-sub">P.Grave</span>
                 <br>
                 <input class=" forvio" id="for_pgrave" name="for_pgrave"  maxlength="2" required="" type="text" value="<?php if (isset($picogrande)){echo $picogrande;}else{ echo '0';} ?>">
                 </div>
               
                <div class="fleft" style="font-size: 16px; top: 15px; position: relative;">
                    <div class="form-group">
                        <label for="for_totviola" class="font-sub">Total de Violações</label>
                        <input  style="background-color:transparent; color: #ff0000; border: none;" class="form-control bold" id="for_totviola" name="for_totviola" required="" type="text" value="<?php if (isset($totviola)){echo number_format($totviola, 2, ",", ".");}else{ echo '0';} ?>" readonly>
                    </div>
                </div>
            </div>
  </div>
  <div id="menu1" class="tab-pane fade">
      
             
             <div class="row" style=" margin-top: 20px; font-size: 11px">
                 
                 <div class="fleft acenter"  >
                     <div class="form-group">
                        <label for="for_tipodesca" class="control-label">CT_E/NFComp. Descarga</label>
                        <select class="form-control" id="for_tipodesca" name="for_tipodesca">
                            <option value="1">Sim</option>
                            <option  value="0">Não</option>                   
                          </select>
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_ctenf" class="control-label">CTE/NF</label><br>
                        <input class="forvio" id="for_ctenf" name="for_ctenf"  maxlength="2" required="" type="text" value="<?php if (isset($pon_e2_ctenf)){echo $pon_e2_ctenf;}else{ echo '0';} ?>">
                        
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_topog" class="control-label">Tacógrafo</label><br>
                        <input class="forvio" id="for_topog" name="for_topog"  maxlength="2" required="" type="text" value="<?php if (isset($pon_e2_tacografo)){echo $pon_e2_tacografo;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_fichajr" class="control-label">Jornada</label><br>
                        <input class="forvio" id="for_fichajr" name="for_fichajr"  maxlength="2" required="" type="text" value="<?php if (isset($pon_e2_fichajornada)){echo $pon_e2_fichajornada;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_acidente" class="control-label">Acidente</label><br>
                        <input class="forvio" id="for_acidente" name="for_acidente"  maxlength="2"   required="" type="text" value="<?php if (isset($pon_e2_acidente)){echo $pon_e2_acidente;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_docven" class="control-label">Documento</label><br>
                        <input class="forvio" id="for_docven" name="for_docven"   maxlength="2" required="" type="text" value="<?php if (isset($pon_e2_docuvencido)){echo $pon_e2_docuvencido;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft acenter ">
                     <div class="form-group">
                        <label for="for_suspen" class="control-label">Suspensão</label><br>
                        <input class="forvio" id="for_suspen" name="for_suspen"  maxlength="2"  required="" type="text" value="<?php if (isset($pon_e2_suspensao)){echo $pon_e2_suspensao;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft acenter">
                     <div class="form-group">
                        <label for="for_unifo" class="control-label">Uniformes</label><br>
                        <input class="forvio" id="for_unifo" name="for_unifo"  maxlength="2"  required="" type="text" value="<?php if (isset($pon_e2_uniformes)){echo $pon_e2_uniformes;}else{ echo '0';} ?>">
                    </div>
                 </div>
            
                <div class="fleft" style="font-size: 16px; top: -5px; position: relative;">
                    <div class="form-group">
                        <label for="for_totaletapa2" class="font-sub">Total 2ª. Etapa</label>
                        <input style="background-color:#88ef99; color: #000; border: solid 1px #3ab24e" class="form-control" id="for_totaletapa2hd" name="for_totaletapa2hd" required="" type="hidden" value="<?php if (isset($dados->para_proventoe2)){echo $dados->para_proventoe2;}else{ echo '0';} ?>">
                        <input style="background-color:transparent; color: #1CAF9A; border: none;" class="bold form-control" id="for_totaletapa2" name="for_totaletapa2" required="" type="text" value="<?php if (isset($dados->para_proventoe2)){echo number_format($dados->para_proventoe2, 2, ",", ".");}else{ echo '0';} ?>" readonly>
                    </div>
                </div>
            </div>
  </div>
  <div id="menu2" class="tab-pane fade">
 
             
             <div class="row" style=" margin-top: 20px; font-size: 11px">
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_metac" class="control-label">Meta</label>
                        <input class="form-control" id="for_metac" name="for_metac" required="" type="text" value="<?php if (isset($pon_e3_meta)){echo $pon_e3_meta;}else{ echo $dados->para_metacombustivel;} ?>">
                        
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_realiz" class="control-label">Realizado</label>
                        <input class="form-control" id="for_realiz" name="for_realiz" required="" type="text" value="<?php if (isset($pon_e3_realizado)){echo $pon_e3_realizado;}else{ echo '0';} ?>">
                        
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_resul" class="control-label">Resultado</label>
                        <input class="form-control" id="for_resul" name="for_resul" required="" type="text" value="<?php if (isset($pon_e3_resultado)){echo $pon_e3_resultado;}else{ echo '0';} ?>" readonly>                        
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_totalep3" class="control-label">Total</label>
                        <input class="form-control" id="for_totalep3" name="for_totalep3" required="" type="text" value="<?php if (isset($pon_e3_valpre)){echo $pon_e3_valpre;}else{ echo '0';} ?>">
                        
                    </div>
                 </div>
            
                <div class="fleft" style="font-size: 16px; top: -5px; position: relative;">
                    <div class="form-group">
                        <label for="for_totalep31" class="font-sub">Total 3ª. Etapa</label>
                        <input style="background-color:transparent; color: #1CAF9A; border: none;" class="bold form-control" id="for_totalep31" name="for_totalep31" required="" type="text" value="<?php if (isset($pon_e3_valpre)){echo number_format($pon_e3_valpre, 2, ",", ".");}else{ echo '0';} ?>" readonly>
                    </div>
                </div>
            </div>
             
        </div>
      </div>
            
           
             <div class="separador"></div>
             
            <div class="row">
                <div class="fleft" style="font-size: 16px;">
                    <label for="for_totalprem" class="fleft"><strong>Prêmio Total: </strong></label>
                    <input style="background-color:transparent; color: #1CAF9A; border: none; font-size: inherit;" class="bold fleft form-control" id="for_totalprem" name="for_totalprem" required="" type="text" value="<?php if (isset($pon_totalpremio)){echo number_format($pon_totalpremio, 2, ",", ".");}else{ echo '0';} ?>" readonly>
                </div>

                <div class="col-md-3">
                    <div style=" margin-top: 25px">                        
                        <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok" style=" margin-right: 5px"> </span> Salvar</button>                        
                        <button type="button" id="btcancela" class="btn btn-danger btn-sm"><span class="fa fa-times" style=" margin-right: 5px"> </span> Cancelar</button>
                    </div>                   
                </div>
            </div>

             <?php } ?>
             <?php } ?>
    </form>
</div>
<script type="text/javascript">
val = 0;
totalpre = 0;

    $(".form-control").css("max-width", "100px");
    $(".forvio").css("max-width", "37px");
    $(".fleft").css("margin-right", "10px");

$( "#btcancela" ).click(function() {$('#myModal').modal('toggle');});  
$( "#for_fatura" ).keyup(function(){    
    faturament = $('#for_fatura').val().replace(".","").replace(",",".");meta = $('#for_netamin').val().replace(".","").replace(",",".");
    aprov = (faturament / meta)*1000; 
    $('#for_apro').val(aprov.toFixed(2)+'%');     
    $("#for_fatura").priceFormat({prefix: '',centsSeparator: ',',thousandsSeparator: '.'});   
    somaviola();    somatudo();
}); 
$( "#for_comi" ).keyup(function(){    somatudo();    somaviola();});
$( "#for_ajust" ).keyup(function(){somatudo();});
$( "#for_macro" ).keyup(function(){somaviola();}); $( "#for_jornada" ).keyup(function(){somaviola();}); $( "#for_interst" ).keyup(function(){somaviola();});
$( "#for_continua" ).keyup(function(){somaviola();}); $( "#for_almoco" ).keyup(function(){somaviola();}); $( "#for_semanal" ).keyup(function(){somaviola();});
$( "#for_faltas" ).keyup(function(){somaviola();}); $( "#for_advert" ).keyup(function(){somaviola();}); $( "#for_suspens" ).keyup(function(){somaviola();});
$( "#for_pleve" ).keyup(function(){somaviola();}); $( "#for_pgrave" ).keyup(function(){somaviola();});

function somaviola() {
    faturament = $('#for_fatura').val().replace(".","").replace(",",".").replace("R$","").replace(" ","");
    comi = $('#for_comi').val(); ajust = $('#for_ajust').val().replace(".","").replace(",","").replace("R$","").replace(" ","");
    tot3 = $('#for_totalep3').val().replace(".","").replace(",","").replace("R$","").replace(" ","");
    comi = comi*100;    val1 = (faturament*comi)/100;
    val = parseInt(val1)+parseInt(ajust); //+parseInt(tot3); 
    
    totaletapa2 = $('#for_totaletapa2').val().replace(".","").replace(",","").replace("R$","").replace(" ","");
    for_macro = $('#for_macro').val(); for_jornada=$('#for_jornada').val(); for_interst=$('#for_interst').val(); for_continua=$('#for_continua').val();
    for_almoco=$('#for_almoco').val(); for_semanal=$('#for_semanal').val(); for_faltas=$('#for_faltas').val(); for_advert=$('#for_advert').val();
    for_suspens=$('#for_suspens').val(); for_pleve=$('#for_pleve').val(); for_pgrave=$('#for_pgrave').val(); 
    total = (parseInt(for_macro)*2)+parseInt(for_jornada)+(parseInt(for_interst)*2)+parseInt(for_continua)+parseInt(for_almoco)+(parseInt(for_semanal)*10)+(parseInt(for_faltas)*10)+
            (parseInt(for_advert)*10)+parseInt(for_suspens)+parseInt(for_pleve)+(parseInt(for_pgrave)*5);
    total = total * 1000;$('#for_totviola').val(total);
    totalpre = (parseInt(val) - parseInt(total))+parseInt(totaletapa2);    
    $("#for_totviola").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    if($('#for_suspens').val() > 0){$("#for_totalprem").val('Eliminado');$('#for_totalprem').css( "background-color", "#f27d81" );}else{
        valpremio = parseInt(totalpre) + parseInt(tot3); 
        if(valpremio < 0 ){valpremio = 0; }
        $("#for_totalprem").val(valpremio);$('#for_totalprem').css( "background-color", "#88ef99" );
        $("#for_totalprem").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    }   
};
function somatudo() {
    faturament = $('#for_fatura').val().replace(".","").replace(",",".").replace("R$","").replace(" ","");
    comi = $('#for_comi').val(); ajust = $('#for_ajust').val().replace(".","").replace(",","").replace("R$","").replace(" ","");
    tot3 = $('#for_totalep3').val().replace(".","").replace(",",".").replace("R$","").replace(" ","");
    comi = comi*100;    val1 = (faturament*comi)/100;
    val = parseInt(val1)+parseInt(ajust);    $("#for_valpre1").val(val); $("#for_totalprem").val(parseInt(val)+parseInt(tot3)); 
    
    $("#for_valpre1").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    $("#for_totalprem").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    $("#for_ajust").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    if($('#for_suspens').val() > 0){$("#for_totalprem").val('Eliminado');$('#for_totalprem').css( "background-color", "#f27d81" );}else{
        $("#for_totalprem").val(val);$('#for_totalprem').css( "background-color", "#88ef99" );
        $("#for_totalprem").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    }
}
$( "#for_ctenf" ).keyup(function(){etapa2();});
$( "#for_topog" ).keyup(function(){etapa2();});
$( "#for_fichajr" ).keyup(function(){etapa2();});
$( "#for_acidente" ).keyup(function(){etapa2();});
$( "#for_docven" ).keyup(function(){etapa2();});
$( "#for_suspen" ).keyup(function(){etapa2();});
$( "#for_unifo" ).keyup(function(){etapa2();});
function etapa2(){
    fud = 0;
    if($('#for_ctenf').val() > 0){fud = 1;}    if($('#for_topog').val() > 0){fud = 1;}    if($('#for_fichajr').val() > 0){fud = 1;}    
    if($('#for_acidente').val() > 0){fud = 1;}     if($('#for_docven').val() > 0){fud = 1;}    if($('#for_suspen').val() > 0){fud = 1;}    
    if($('#for_unifo').val() > 0){fud = 1;}    
    if(fud===0){deixaprovento();}else{zeraprovento2();} 
    somaviola();
}
function zeraprovento2(){$("#for_totaletapa2").val('R$ 0,00').css( "background-color", "#f27d81" );}
function deixaprovento(){ 
    valor = $('#for_totaletapa2hd').val(); $("#for_totaletapa2").val(valor).css( "background-color", "#88ef99" );
    $("#for_totaletapa2").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    }

$( "#for_realiz" ).keyup(function(){    
    realizado = $('#for_realiz').val().replace(",",".");
    metam = $('#for_metac').val().replace(",",".");
    aprovc = (realizado / metam)*100; 
    $('#for_resul').val(aprovc.toFixed(2)+'%');    
}); 

$( "#for_totalep3" ).keyup(function(){    
    tot3 = $('#for_totalep3').val().replace(".","").replace(",",".").replace("R$","").replace(" ","");
    $('#for_totalep31').val(tot3);
    $("#for_totalep3").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    $("#for_totalep31").priceFormat({prefix: 'R$ ',centsSeparator: ',',thousandsSeparator: '.'});
    somaviola();
   
}); 

$( 'form' ).on( "submit", function( event ) {
    event.preventDefault();
     
    $.ajax({             
            type: "POST",
             url: '<?php echo base_url().'pontoaponto/lancamentos_cad' ?>',
       dataType : 'html',
       secureuri: false,
            data: $( this ).serialize(),              
            success: function(msg) 
                  { 
                      location.reload(); 
                      //alert(msg);
                  } 
            });
});

 


</script>

