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
<style type="text/css">
    .bordadir{
        border-right: 1px solid #ccc;
padding: 0px 5px;
    }
</style>

<div class="panel panel-default" style="padding: 5px;">

<form>
             
    <?php foreach ($funcionarios_edit as $value) { ?>
    <?php foreach ($ponto_parametros as $dados) { ?>

  <ul class="nav nav-tabs" style=" height: 41px">
    <li class="active"><a data-toggle="tab" href="#home">1º Etapa</a></li>
    <li><a data-toggle="tab" href="#menu1">2º Etapa</a></li>
    <li><a data-toggle="tab" href="#menu2">3º Etapa</a></li>
  </ul>

    <div class="tab-content" >

    <div id="home" class="tab-pane fade in active"> 
             <div class="row" style=" margin-top: 20px; font-size: 13px">                 
                 <div class="fleft" >
                     <div class="form-group">
                        <label for="for_tipoeq" class="font-sub">Equipamento</label><br>
                        <select class="form-control" id="for_tipoeq" name="for_tipoeq" disabled="">
                            <?php foreach ($ponto_equipamentos as $equi) { ?>
                            <option value="<?php echo $equi->equi_idequipamentos?>"><?php echo $equi->equi_nome ?></option>
                            <?php } ?>                
                          </select>
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_netamin" class="font-sub">Meta Mínima</label>
                        <input class="form-control" id="for_netamin" name="for_netamin" required="" type="text" value="<?php echo $dados->para_metamin ?>" readonly>
                        
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_fatura" class="font-sub">Fat. Realizado</label>
                        <input class="form-control" id="for_fatura" name="for_fatura" required="" readonly type="text" value="<?php if (isset($faturamento)){echo $faturamento;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_apro" class="font-sub">% Aproveitamento</label>
                        <input class="form-control" id="for_apro" name="for_apro" required="" type="text" value="<?php if (isset($aproveita1)){echo $aproveita1;}else{ echo '0';} ?>" readonly>
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_comi" class="font-sub">% Comissão</label>
                        <input class="form-control" id="for_comi" name="for_comi" required="" readonly type="text" value="<?php if (isset($comissao)){echo $comissao;}else{ echo '0';} ?>">
                    </div>
                 </div>
                 <div class="fleft">
                     <div class="form-group">
                        <label for="for_ajust" class="font-sub">Valor do Ajuste</label>
                        <input class="form-control" id="for_ajusth" name="for_ajusth" required=""  readonly type="hidden" value="<?php if (isset($ajust)){echo $ajust;}else{ echo '0';} ?>">
                        <input class="form-control" id="for_ajust" name="for_ajust" required="" readonly type="text" value="<?php if (isset($ajust)){echo $ajust;}else{ echo '0';} ?>">
                    </div>
                 </div>                 
            
             
                <div class="fleft" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_valpre1" class="font-sub">Total 1ª Etapa: </label><br>
                        <span class="green bold"><?php if (isset($pon_e1_valpre)){echo $pon_e1_valpre;}else{ echo '0';} ?></span>
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
                 <span class="font-sub"><?php if (isset($macro)){echo $macro;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Jornada</span>
                 <br>
                 <span class="font-sub"><?php if (isset($jornada)){echo $jornada;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>20,00</span>
                 <br><br>
                    <span class="bold font-sub">Interst.</span>
                 <br>
                 <span class="font-sub"><?php if (isset($intersticio)){echo $intersticio;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Dir.Cont.</span>
                 <br>
                 <span class="font-sub"><?php if (isset($direccontinua)){echo $direccontinua;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">Almoço</span>
                 <br>
                 <span class="font-sub"><?php if (isset($almoco)){echo $almoco;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Semanal</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e1_descsemanal)){echo $pon_e1_descsemanal;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Faltas</span>
                 <br>
                 <span class="font-sub"><?php if (isset($faltasjust)){echo $faltasjust;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>100,00</span>
                 <br><br>
                    <span class="bold font-sub">Advert.</span>
                 <br>
                 <span class="font-sub"><?php if (isset($advertencia)){echo $advertencia;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>Eliminado</span>
                 <br><br>
                    <span class="bold font-sub">Suspens</span>
                 <br>
                 <span class="font-sub"><?php if (isset($suspensao)){echo $suspensao;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>10,00</span>
                 <br><br>
                    <span class="bold font-sub">P.Leve</span>
                 <br>
                 <span class="font-sub"><?php if (isset($picoleve)){echo $picoleve;}else{ echo '0';} ?></span>
                 </div>


                 <div class="fleft acenter bordadir">
                    <span>50,00</span>
                 <br><br>
                    <span class="bold font-sub">P.Grave</span>
                 <br>
                 <span class="font-sub"><?php if (isset($picogrande)){echo $picogrande;}else{ echo '0';} ?></span>
                 </div>

<!--
                 <div class="fleft acenter bordadir">
                    <span></span>
                 <br><br>
                    <span class="bold font-sub">Total de Violações: </span>
                 <br>
                 <span class="bold red"><?php if (isset($totviola)){echo $totviola;}else{ echo '0';} ?></span>
                 </div>-->

                 <div class="fleft" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_valpre1" class="font-sub">Total 1ª Etapa: </label><br>
                        <span class="red bold"><?php if (isset($totviola)){echo $totviola;}else{ echo '0';} ?></span>
                    </div>
                </div>

               
             </div>
         
  </div>

  <div id="menu1" class="tab-pane fade">
      
             
             <div class="row" style=" margin-top: 20px; font-size: 11px">
                 

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">CT-E/NFComp. Descarga</span>
                 <br>
                 <span class="font-sub">sim</span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">CT-E/NF</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_ctenf)){echo $pon_e2_ctenf;}else{ echo '0';} ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Tacógrafo</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_tacografo)){echo $pon_e2_tacografo;}else{ echo '0';} ?></span><br>
                 </div>


                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Jornada</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_fichajornada)){echo $pon_e2_fichajornada;}else{ echo '0';} ?></span><br>
                 </div>


                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Acidente</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_acidente)){echo $pon_e2_acidente;}else{ echo '0';} ?></span><br>
                 </div>


                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Documento</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_docuvencido)){echo $pon_e2_docuvencido;}else{ echo '0';} ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Suspensão</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_suspensao)){echo $pon_e2_suspensao;}else{ echo '0';} ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Uniformes</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e2_uniformes)){echo $pon_e2_uniformes;}else{ echo '0';} ?></span><br>
                 </div>


                 <div class="fleft" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_valpre1" class="font-sub">Total 2ª Etapa: </label><br>
                        <span class="red bold"><?php if (isset($dados->para_proventoe2)){echo $dados->para_proventoe2;}else{ echo '0';} ?></span>
                    </div>
                    <!--
                        <span class="green bold"><?php if (isset($dados->para_proventoe2)){echo $dados->para_proventoe2;}else{ echo '0';} ?></span>-->
                </div>                
                 
                 
             </div>
             
  </div>
  <div id="menu2" class="tab-pane fade">
 
             
             <div class="row" style=" margin-top: 20px; font-size: 11px">

             <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Meta</span>
                 <br>
                 <span class="font-sub"><?php echo $dados->para_metacombustivel ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Realizado</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e3_realizado)){echo $pon_e3_realizado;}else{ echo '0';} ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Resultado</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e3_resultado)){echo $pon_e3_resultado;}else{ echo '0';} ?></span><br>
                 </div>

                 <div class="fleft acenter bordadir">                   
                    <span class="bold font-sub">Total</span>
                 <br>
                 <span class="font-sub"><?php if (isset($pon_e3_valpre)){echo $pon_e3_valpre;}else{ echo '0';} ?></span><br>
                 </div>


                 <div class="fleft acenter" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_valpre1" class="font-sub">Total 3ª Etapa: </label><br>
                        <span class="green bold"><?php if (isset($pon_e3_valpre)){echo $pon_e3_valpre;}else{ echo '0';} ?></span>
                    </div>
                </div>
                
             </div>
              
        </div>
      </div>            
           
             <div class="separador"></div>
             
            <div class="row">
                <div class="fleft" style="font-size: 16px;">
                    <div class="form-group">
                        <label for="for_totalprem" class=""><strong>Prêmio Total: </strong></label>
                        <span class="green bold"><?php if (isset($pon_totalpremio)){echo $pon_totalpremio;}else{ echo '0';} ?></span>
                    </div>
                </div>
               
            </div>

             <?php } ?>
             <?php } ?>
    </form>
</div>    <script type="text/javascript">
        $(".form-control").css("max-width", "100px");
        $(".fleft").css("margin-right", "10px");
    </script>