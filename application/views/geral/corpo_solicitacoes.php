
<style type="text/css">
  .form-group{
    margin: 25px 0px;
  }
  .autocomplete{
    width: 100%;
    min-height: 33px;
    border: 1px solid #ccc;
    border-radius: 3px;
    float: left;
  }
  .autocomplete input, .autocomplete span{
    width: auto;
    float: left;
    border: none;
  }
  .divcombocolab{
    margin-top: 20px;
  }
  @media (max-width: 400px) 
{
  .hcm 
   {
    width: 60%;
   }
}
</style>
<?php


?>

<div class="message-box animated fadeIn" data-sound="alert" id="mb-exclembrete">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-times"></span> Excluir Lembrete ?</div>
      <div class="mb-content">
        <p>Deseja excluir esse lembrete?</p>                    
        <p>Clique em Não para continuar trabalhando. Clique em Sim apagá-lo.</p>
      </div>
      <div class="mb-footer">
        <div class="pull-right">
          <a id="exclembrete" href="#" data-id="" class="btn btn-danger btn-lg mb-control-close ">Sim</a>
          <button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-title">                    
  <h2><span class="fa fa-retweet"></span> Solicitações</h2>
  <!-- <div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div> -->
  <div class="pull-right">                                                                                    
    <button class="btn btn-default"><span class="fa fa-print"></span> Imprimir </button>
  </div>
</div>                                                                   

<div class="row">
  <div class="fleft-10">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <!-- START CONTENT FRAME LEFT -->
    <div class="col-md-3" >
      <div class="content-frame-left">

        <div class="fleft-10" style="margin-bottom: 10px;">
          <div class="list-group border-bottom">
            <a href="#deslig" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-times"></span> <span class="desc">Desligamento</span></a>
            <a href="#quadro" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-users"></span> <span class="desc">Aumento de Quadro</span></a>
            <a href="#altsal" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-money"></span> <span class="desc">Alteração Salarial</span></a>
            <a href="#mudcar" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-random"></span> <span class="desc">Mudança de Cargo</span></a>
                                   
            <a href="#treina" aria-controls="abacalendario" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-thumbs-o-up"></span> <span class="desc">Treinamento</span></a>
          </div>                        
        </div>

		<div class="fleft-10" style="margin-bottom: 10px;">
		  <a href="#msol" aria-controls="abacalendario" role="tab" data-toggle="tab" class="btn btn-info btn-block btn-lg"><span class="fa fa-search"></span> Consultar Minhas Solicitações </a>
        </div>
		

      </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->

    <div class="col-md-9">


      <div class="tab-content">

        <!-- desligamento -->
        <div role="tabpanel" class="tab-pane" id="deslig">
         <div class="widget widget-default">
          
             <h3><span class="fa fa-times"></span> Desligamento</h3>
             <form name="form_desligamento" id="form_desligamento">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaborador" class="selectpicker combocolab" data-live-search="true" data-div="deslig_result">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>


             <div class="fleft-7 divcombocolab">
             <label for="dt_desligamento" class="control-label">Data do desligamento</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="" data-date-start-date="+0d">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

           </div> 

            <div id="deslig_result"></div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo do desligamento</label>
             <div class="clearfix" ></div>
               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="min-width: 105px;" id="salvar_desligamento" name="salvar_desligamento" value="Salvar" class="btn btn-primary">
               <span style="min-width: 105px;display: none;" id="btnenc" class="btn btn-primary" >Encaminhar</span>
               <span style="min-width: 105px;display: none;" id="limpar" class="btn btn-default" >OK</span>
               <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="1">
             <input type="hidden" id="acao_desl" name="acao_desl" value="0">
             </form>
         </div>
       </div>
		<!-- fim desligamento -->

        <!-- aumento de quadro -->
        <div role="tabpanel" class="tab-pane" id="quadro">
         <div class="widget widget-default">
         
             <h3><span class="fa fa-users"></span> Aumento de Quadro</h3>
             <form name="form_quadro" id="form_quadro">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaborador" class="selectpicker combocolab" data-live-search="true" data-div="aum_result">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>
            
            <div class="fleft-7 divcombocolab">
             <label for="dt_desligamento" class="control-label">Data Aumento de Quadro</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_aumento_quadro" id="dt_aumento_quadro" placeholder="Data do Aumento" required="" data-date-start-date="+0d">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

           </div>
           <div id="aum_result"></div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo do Aumento</label>

             <div class="clearfix" ></div>

               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_aumento" value="Salvar" class="btn btn-primary">
               <img id="load_quadro" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="2">
             </form>
           
         </div>
       </div>
		<!-- fim aumento de quadro -->

        <!-- alteração salarial -->
		<div role="tabpanel" class="tab-pane" id="altsal">
			<div class="widget widget-default">
      
         <h3><span class="fa fa-money"></span> Alteração Salarial</h3>
         <form name="form_aumento" id="form_aumento">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             

             <div class="fleft-7 ">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaboradorsal" class="selectpicker combocolab" data-live-search="true" data-div="alt_result" data-opt="salario">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>
             </div>

             <div class="fleft-7 divcombocolab">
             <label for="dt_desligamento" class="control-label">Data da alteração</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_aumento" id="dt_aumento" placeholder="Data da alteração" required="" data-date-start-date="+0d">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

             <div class="fleft-7" style="margin-top: 20px;">
              <label for="" class="control-label">Motivo do alteração</label>
               <select name="motivo_aumento" required="true" id="motivo_aumento" class="form-control" >
               <option value="">Selecione</option>
               <?php foreach ($motivos as $key => $value) { ?>
               <option value="<?php echo $value->mot_idmotivos; ?>"><?php echo $value->motivo; ?></option>
               <?php } ?>
               </select>
             </div>

             <div class="fleft-8" style="margin-top: 20px;">
             <label for="" class="control-label">Novo Valor Proposto</label>

             <div class="input-group">                                            
              <span class="input-group-addon">R$</span>
              <input type="text" name="novovalor" id="novovalor" class="form-control campomoeda" placeholder="Novo Valor">
              <span id="porcentagem" class="input-group-addon"></span>
            </div>
             </div>

           </div>

           <div id="alt_result"></div>
            <div id="alt_hist"></div>

           <div class="clearfix"></div>

           <div class="fleft-5" style="margin-top: 20px;">             
             <label for="sal_obs" class="control-label">Motivo do Aumento</label>

             <div class="clearfix" ></div>

               <textarea required="true" class="form-control" name="sal_obs" id="sal_obs" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="min-width: 105px;" name="salvar_aumento" id="salvar_aumento" value="Salvar" class="btn btn-primary">
               <span style="min-width: 105px;display: none;" id="enc_sal" class="btn btn-primary" >Encaminhar</span>
               <span style="min-width: 105px;display: none;" id="limpar_sal" class="btn btn-default" >OK</span>
               <img id="load_aumento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
               
             </div>

             <input type="hidden" name="tipo" value="3">
             <input type="hidden" id="acao_aumento" name="acao_aumento" value="0">
             </form>

      
     </div>
        </div>
		<!-- fim alteração salarial -->		

        <!-- mudança de cargo -->
		<div role="tabpanel" class="tab-pane" id="mudcar">
			<div class="widget widget-default">

         <h3><span class="fa fa-random"></span> Mudança de Cargo</h3>
         <form name="form_mudanca" id="form_mudanca">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaboradormud" class="selectpicker combocolab" data-live-search="true" data-div="mud_result" data-opt="cargo">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>

             <div class="fleft-7 divcombocolab" style="margin-bottom: 20px;">
             <label for="" class="control-label">Data da mudança</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_mudanca" id="dt_mudanca" placeholder="Data da mudança" required="" data-date-start-date="+0d">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

             <div class="fleft-7 " style="margin-bottom: 20px;">
             <label for="" class="control-label">Motivo da mudança</label>
             <select name="motivo_aumento" required="true" id="mud_motivo" class="form-control" >
               <option value="">Selecione</option>
               <?php foreach ($motivos as $key => $value) { ?>
               <option value="<?php echo $value->mot_idmotivos; ?>"><?php echo $value->motivo; ?></option>
               <?php } ?>
               </select>
             </div>

             <div class="fleft-7 ">
             <label for="" class="control-label">Novo Cargo</label>
             <select name="fk_cargo" required="true" id="fk_cargo" class="form-control" >
               <option value="">Selecione</option>
               <?php foreach ($cargos as $key => $value) { ?>
               <option value="<?php echo $value->idcargo; ?>"><?php echo $value->descricao; ?></option>
               <?php } ?>
             </select>
             </div>

           </div>
           <div id="mud_result"></div>
           <div id="mud_hist"></div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo da mudança</label>

             <div class="clearfix" ></div>

               <textarea required="true" class="form-control" name="obs_mudanca" id="obs_mudanca" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_aumento" value="Salvar" class="btn btn-primary">
               <span style="min-width: 105px;display: none;" id="enc_mud" class="btn btn-primary" >Encaminhar</span>
               <span style="min-width: 105px;display: none;" id="limpar_mud" class="btn btn-default" >OK</span>
               <img id="load_mudanca" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="4">
             <input type="hidden" id="acao_mudanca" name="acao_mudanca" value="0">
             </form>
       
     </div>
        </div>
		<!-- fim mudança de cargo -->				
		
        <!-- solicitação férias
        <div role="tabpanel" class="tab-pane" id="ferias">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-plane"></span> Solicitação Férias</h3>
             <form name="form_ferias" id="form_ferias">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="" class="selectpicker combocolab" data-live-search="true" data-div="ferias_result">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>


             <div class="fleft-7 divcombocolab">
             <label for="dt_desligamento" class="control-label">Data das férias</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_desligamento" id="dt_desligamento" placeholder="Data do desligamento" required="" >
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

           </div> 

            <div id="ferias_result"></div>

             <div class="clearfix"></div>

             <div class="fleft" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo</label>
             <div class="clearfix" ></div>
               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_desligamento" value="Salvar" class="btn btn-primary">
               <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="1">
             </form>
           </div>
         </div>
       </div> -->
		<!-- fim solicitação férias -->					

        <!-- treinamento -->
        <div role="tabpanel" class="tab-pane" id="treina">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-thumbs-o-up"></span> Treinamento</h3>
             <form name="form_treinamento" id="form_treinamento">
             <span class="bold">Solicitante: </span><span><?php echo $funcionario[0]->fun_nome; ?></span>
             <div class="clearfix" style="margin-bottom: 20px;"></div>

             <div class="fleft-3 hcm">
             <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaboradortrei" class="selectpicker combocolab" data-live-search="true" data-div="trei_result">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>


             <div class="fleft-9 divcombocolab">
             <label for="" class="control-label">Data do treinamento</label>
             <div class='input-group' >
                <input class="form-control txleft campodata" type="text" name="dt_treinamento" id="dt_treinamento" placeholder="Data do treinamento" required="">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
             </div>

             <div class="fleft-9 divcombocolab">
             <label for="" class="control-label">Nome do treinamento</label>
                <input class="form-control" type="text" name="nome_treinamento" id="nome_treinamento" placeholder="Nome do treinamento" required="">
             </div>


             <div class="fleft-9" style="margin-top: 20px;">             
             <label for="" class="control-label">Descreva o treinamento</label>
             <div class="clearfix" ></div>
               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
             </div>

           </div> 

            <div id="trei_result"></div>

             <div class="clearfix"></div>

             <div class="fleft-5" style="margin-top: 20px;">             
             <label for="motivo" class="control-label">Motivo do treinamento</label>
             <div class="clearfix" ></div>
               <textarea required="true" class="form-control" name="motivo" id="motivo" cols="70" rows="5" style="width: 100%"></textarea>
               <input type="submit" style="" name="salvar_desligamento" value="Salvar" class="btn btn-primary">
               <img id="load_desligamento" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </div>
             <input type="hidden" name="tipo" value="5">
             </form>
           </div>
         </div>
       </div>
		<!-- fim treinamento -->				
		
    <!-- Minhas Solicitações -->
        <div role="tabpanel" class="tab-pane" id="msol">
         <div class="widget widget-default">
           <div class="col-md-12">
             <h3><span class="fa fa-search"></span> Minhas Solicitações 
             <img id="load_sol" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
             </h3>
             
             <table id="tabelasolicitacoes" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Colaborador</th>
                  <th>Natureza</th>
                  <th>Data da solicitação</th>
                  <th>Data para efetivar</th>
                  <th>Status</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($solicitacoes as $key => $value) { 
                  $datahora = date('Y-m-d H:m:s' , strtotime($value->data_hora_solicitacao) );
                  list($data, $hora) = explode(" ", $datahora);
                  $data = $this->Log->alteradata1( $data );

                  $datahora_efetiva = date('Y-m-d H:m:s' , strtotime($value->data_efetiva) );
                  list($data2, $hora2) = explode(" ", $datahora_efetiva);
                  $data2 = $this->Log->alteradata1( $data2 );
                ?>
                <tr class="linha" id="<?php echo $value->solicitacao_id; ?>" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" style="cursor: pointer;">
                  <td><?php echo $value->fun_nome; ?></td>
                  <td><?php echo $value->descricao_solicitacao; ?></td>
                  <td><?php echo $data." ".$hora;  ?></td>
                  <td><?php echo $data2;  ?></td>
                  <td><?php echo $value->descricao_status_solicitacao; ?></td>
                </tr>
                <?php }  ?>
              </tbody>
            </table>


           </div>
         </div>
       </div>
    <!-- Minhas Solicitações -->

      </div><!-- tab content -->

      </div><!--md 9-->

  </div><!--fleft-10 abas-->

</div><!--row-->


<script type="text/javascript">

  $(document).ready(function(){

    $(".campomoeda").maskMoney({thousands:'.',decimal:','});
    
    $("#novovalor").blur(function(){
      
      var sal_atual = Number($("#salario").val() );
      var sal_novo = Number( $(this).val().replace(".", "").replace(/,/g , ".") );
      var dif = sal_novo - sal_atual;
      var porc = (dif * 100) / sal_atual;
      $("#porcentagem").html(porc.toFixed(2) + "%");      
      
    });

    $("#nao").click(function(){

      $("#exclembrete").data("id", "");
      
    });

    $("#limpar").click(function(){
      $("#dt_desligamento").val("");
      $("#motivo").val("");
      $("#colaborador").val("").change();
      $("#deslig_result").html("");
      $("#acao_desl").val("");
      $(this).hide();
      $("#btnenc").hide();
      $("#salvar_desligamento").prop( "disabled", false );
      $('#deslig').removeClass("active");
      $(".aba").removeClass("active");
    });

    $("#limpar_sal").click(function(){
      $("#dt_aumento").val("");
      $("#motivo_aumento").val("").change();
      $("#colaboradorsal").val("").change();
      $("#aum_result").html("");
      $("#alt_hist").html("");
      $("#acao_aumento").val("");
      $(this).hide();
      $("#enc_sal").hide();
      $("#salvar_aumento").prop( "disabled", false );
      $('#altsal').removeClass("active");
      $(".aba").removeClass("active");
    });

    $("#limpar_mud").click(function(){
      $("#dt_mudanca").val("");
      $("#mud_motivo").val("").change();
      $("#fk_cargo").val("").change();
      $("#colaboradormud").val("").change();
      $("#mud_result").html("");
      $("#acao_mudanca").val("");
      $(this).hide();
      $("#enc_mud").hide();
      $("#salvar_mudanca").prop( "disabled", false );
      $('#mudcar').removeClass("active");
      $(".aba").removeClass("active");
    });

    $('#tabelasolicitacoes').DataTable({
      "language": {
        "paginate": {
         "next": "Avan&ccedil;ar", previous: "Voltar"
       },
       "lengthMenu": "Mostrar _MENU_ linhas por p&aacute;gina",
       "search":"Filtrar",
       "zeroRecords": "Nada encontrado",
       "info": "Exibindo _PAGE_ de _PAGES_",
       "infoEmpty": "Nenhum registro encontrado"          
     }
   });
    
    $('.data').datepicker({

      format: 'dd/mm/yyyy'
    });

    $('.hora').timepicker({

      showMeridian: false
    });


    $("a").click(function(){

      $(".aba").removeClass("active");

      if( $(this).hasClass("list-group-item") ){        

        $(this).addClass("active");

      }
    });


    $(".list-group-item").click(function(){
      var texto = $(this).find(".desc").text();
      $("#itematual").html(" > "+texto);

    });

    $('.campodata').datepicker({

            format: 'dd/mm/yyyy'
        });

    $("#btnenc").click(function(){
      var id = $("#acao_desl").val();
      $("#load_desligamento").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/acao_solicitacao"); ?>',
        dataType : 'html',
        data: {
          id: id,
          campo: "solicitacao_status",
          valor: 2
        },

        success: function(msg){      
          
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){      
          
          $(".alert").addClass("alert-success");
          $(".alert").html('Alteração realizada com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500, function(){
            window.location.href = '<?php echo base_url("gestor/solicitacoes"); ?>';
          });          
       }
     } 
     });

    });

    $("#enc_sal").click(function(){
      var id = $("#acao_aumento").val();
      $("#load_aumento").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/acao_solicitacao"); ?>',
        dataType : 'html',
        data: {
          id: id,
          campo: "solicitacao_status",
          valor: 2
        },

        success: function(msg){      
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){      
          
          $(".alert").addClass("alert-success");
          $(".alert").html('Alteração realizada com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500, function(){
            window.location.href = '<?php echo base_url("gestor/solicitacoes"); ?>';
          });          
       }
     } 
     });

    });

    $("#form_desligamento").on("submit", function(e){

      $("#load_desligamento").show();
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/salvarDesligamento"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){
          $("#btnenc").show();
          $("#limpar").show();
          $("#salvar_desligamento").prop( "disabled", true );
          $("#load_desligamento").hide();
          $(".alert").addClass("alert-success");
          $(".alert").html('Solicitação feita com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500);
          //$("#dt_desligamento").val("");
          //$("#motivo").val("");
          //$("#colaborador").val("").change();
          //$("#deslig_result").html("");
          $("#acao_desl").val(msg);
       }

     } 
     });

    });

    $("#form_aumento").on("submit", function(e){

      $("#load_aumento").show();
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/salvarAumentoSalaral"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){
          $("#enc_sal").show();
          $("#limpar_sal").show();
          $("#salvar_aumento").prop( "disabled", true );
          $("#load_aumento").hide();
          $(".alert").addClass("alert-success");
          $(".alert").html('Solicitação feita com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500);
          $("#acao_aumento").val(msg);
       }

     } 
     });

    });

    $("#form_mudanca").on("submit", function(e){

      $("#load_mudanca").show();
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/salvarMudancaCargo"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){
          $("#enc_mud").show();
          $("#limpar_mud").show();
          $("#salvar_mudanca").prop( "disabled", true );
          $("#load_mudanca").hide();
          $(".alert").addClass("alert-success");
          $(".alert").html('Solicitação feita com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500);
          $("#acao_mudanca").val(msg);
       }

     } 
     });

    });

    $("#form_treinamento").on("submit", function(e){

      $("#load_treinamento").show();
      e.preventDefault();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/salvarTreinamento"); ?>',
        dataType : 'html',
        data: $( this ).serialize(),

        success: function(msg){
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){
          $("#enc_sal").show();
          $("#limpar_sal").show();
          $("#salvar_aumento").prop( "disabled", true );
          $("#load_aumento").hide();
          $(".alert").addClass("alert-success");
          $(".alert").html('Solicitação feita com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500);
          $("#acao_aumento").val(msg);
       }

     } 
     });

    });

    $("#enc_mud").click(function(){
      var id = $("#acao_mudanca").val();
      $("#load_mudanca").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/acao_solicitacao"); ?>',
        dataType : 'html',
        data: {
          id: id,
          campo: "solicitacao_status",
          valor: 2
        },

        success: function(msg){      
         
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){      
          
          $(".alert").addClass("alert-success");
          $(".alert").html('Alteração realizada com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500, function(){
            window.location.href = '<?php echo base_url("gestor/solicitacoes"); ?>';
          });          
       }
     } 
     });

    });

    $("#tabelasolicitacoes .linha").click(function(){
      var id = $(this).attr("id");
      var tipo = $(this).data("tipo");
      var titulo = $(this).data("titulo");
      $("#myModalTamanho").removeClass("modal-lg");
      $("#load_sol").show();

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/minhaSolicitacao"); ?>',
        dataType : 'html',
        data: {
          id: id,
          tipo: tipo
        },

        success: function(msg){
       
         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else {
           $("#titulomodal").text(titulo);
           $( "#dadosedit" ).css("display", "inline-block");
          $( "#dadosedit" ).html(msg);
          $('#myModal').modal('show');
          $("#load_sol").hide();
       }

     } 
     });
    });

    $('#myModal').on('hidden.bs.modal', function (e) {

      $( "#dadosedit" ).html("");
    });

    $(document).on("click", ".acao", function(e){
      e.preventDefault();
      $("#load_acao").show();
      var id = $("#solicitacao").val();
      var campo = $(this).data("campo");
      var valor = $(this).data("valor");

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("gestor/acao_solicitacao"); ?>',
        dataType : 'html',
        data: {
          id: id,
          campo: campo,
          valor: valor
        },

        success: function(msg){
         //console.log(msg); return;
         $("#myModal").modal("hide");

         if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else if(msg>0){      
          
          $(".alert").addClass("alert-success");
          $(".alert").html('Alteração realizada com sucesso.');
          $(".alert").slideDown(300);
          $(".alert").delay( 3500 ).slideUp(500, function(){
            window.location.href = '<?php echo base_url("gestor/solicitacoes"); ?>';
          });          
       }
     } 
     });

    });

    $(".combocolab").change(function(){

      var id = $(this).val();
      var div = $(this).data("div");
      var opt = $(this).data("opt");
      $("#"+div).html( '<img id="" src="<?php echo base_url('img/loaders/default.gif') ?>">' );

      if (id=="") {
        $("#"+div).html("");
        return;
      }

      switch(opt){
          case "salario": histsalarial(id,1,"alt_hist"); break;
          case "cargo": histsalarial(id,2,"mud_hist"); break;
      }
      $.ajax({          
        type: "POST",
        url: '<?php echo base_url()."gestor/solicitacao_busca"; ?>',
        dataType : 'html',
        data: {
          id: id,
          opt: opt
        },

        success: function(msg){
         
         $("#"+div).html(msg);
       
        }
       });
    });

  });

function histsalarial(id, historico, div){
  $("#"+div).html( '<img id="" src="<?php echo base_url('img/loaders/default.gif') ?>">' );
  $.ajax({          
    type: "POST",
    url: '<?php echo base_url()."gestor/historico"; ?>',
    dataType : 'html',
    data: {
      id: id,
      historico: historico,
      div: div
    },

    success: function(msg){

     $("#"+div).html(msg);

   }
 });
}

</script>