<div class="page-title">                    
  <h2><span class="fa fa-file-text"></span> Confirmação de férias</h2>
  
</div>

<div class="row">
  <div class="fleft-10" style="min-height: 800px;">
  <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

  <div class="col-md-3" >
      <div class="content-frame-left ">
          <div class="list-group border-bottom">
            <a href="#conferias" aria-controls="conferias" role="tab" data-toggle="tab" class="list-group-item active aba">
              <span class="fa fa-thumbs-o-up"></span> <span class="desc">Confirmação de férias</span>
            </a>

            <a href="#progferias" aria-controls="addcurso" role="tab" data-toggle="tab" class="list-group-item aba">
              <span class="fa fa-tags"></span> <span class="desc">Programação de férias</span> <span class="badge badge-success"></span>
            </a>

          </div>                        
      </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->

<div class="col-md-9">
    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="conferias">

        <div class="widget widget-default">

          <table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
            <thead>
              <tr>
                <th>Funcionário</th>
                <th>Data de início</th>            
              </tr>
            </thead>
            <tbody>
              <?php
              
              if ( !empty($ferias) && count($ferias[0])>0 ) {
               
              foreach ($ferias as $key => $value) {
                if ($value->fer_status==0) {

                  $data = date('d/m/Y', strtotime($value->fer_datainicio));

                  ?>
                  <tr id="ferias<?php echo $value->fer_idferias; ?>" data-titulo="Férias de <?php echo $value->fun_nome; ?>" data-id="<?php echo $value->fer_idferias; ?>" class="ferias" >
                    <td><?php echo $value->fun_nome; ?></td>
                    <td><?php echo $data; ?></td>
                  </tr>
                  <?php } } } ?>
                </tbody>

              </table>

            </div>
      </div><!--aba conferias-->

      <div role="tabpanel" class="tab-pane" id="progferias">
        <div class="widget widget-default">
          <form id="formprogferias" method="post" name="progferias">
          <div class="form-group">
            <label class="col-md-2 control-label font-sub">Funcionário</label>
            <div class="col-md-4">
              <select name="idfun" id="idfun" required="">
                <option value="">Selecione</option>
                <?php foreach ($equipe as $key => $value) { ?>
                <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option> 
                <?php } ?>
              </select>
            </div>
            </div>
            <!--<div class="form-group">
              <label class="col-md-2 control-label font-sub">Escolha o período</label>
              <div class="col-md-4">

                <select name="periodos" id="periodos" required="">
                  <option value="">Selecione</option>
                  <?php foreach ($periodos as $key => $value) { ?>
                  <option value="<?php echo $value->Per_idperiodos; ?>"><?php echo $this->Log->alteradata1($value->Per_dataini). " a " . $this->Log->alteradata1($value->Per_dataFim); ?> - <?php echo "Direito " . $value->Per_QtdDir. " dias"; ?> </option> 
                  <?php } ?>
                </select>

              </div>
            </div>-->

            <div class="separador"></div>

            <label class="col-md-2 control-label font-sub">Período</label>
            <label id="conteudo" class="col-md-3 bold font-sub"></label>

            <div class="separador"></div>

            <div class="form-group">
              <label class="col-md-2 control-label font-sub">Data de início</label>
              <div class="col-md-3" style="margin-right: 10px;">
                <div class='input-group date' >
                  <input type="text" class="data fleft" data-date-start-date="+2d" name="data_inicio" id="data_inicio" placeholder="Data" style="max-width: 90px;" required=""/>              
                  <span class="input-group-addon fleft">
                    <span class="fa fa-calendar" id=''></span>
                  </span>
                </div> 
              </div>
            </div>        

            <div class="separador"></div>

            <div class="form-group">
              <label class="col-md-2 control-label font-sub">Dias de Férias</label>
              <div class="col-md-4">
                <select class="fleft" name="dias" id="dias" required="">
                    <option value="20">20 dias</option>
                    <option value="30" selected >30 dias</option>
                  </select>

                  <span class="col-md-5 font-sub" id="txtabono" style="margin-top: 7px;display: none;">Abono 10 dias</span>

                </div>
              </div>

              <div class="separador"></div>

              <div class="form-group">
                <label class="col-md-2 control-label text-left font-sub">Receber 13&ordm; salario</label>
                <div class="col-md-4">                                    
                  <label class="check">
                    <input type="radio" class="icheckbox" name="decterceiro" id="decnao" checked="checked" value="0" /> Não
                  </label>
                  <label class="check">
                    <input type="radio" class="icheckbox" name="decterceiro" id="decsim" value="1" /> Sim
                  </label>
                </div>

              </div>


              <div class="separador"></div>

              <div class="form-group">
                <label class="col-md-2 control-label font-sub">Sugestão de pagamento</label>
                <div class="col-md-3" style="margin-right: 10px;">
                  <div class='input-group date' >
                    <input type="text" class="fleft" name="data_pagto" id="data_pagto" placeholder="Data" style="max-width: 90px;" required="" readonly="true" />              
                    <span class="input-group-addon fleft">
                      <span class="fa fa-calendar" id='data1'></span>
                    </span>
                  </div> 
                </div>
              </div>        

              <div class="separador"></div>

              <div class="form-group">
                <label class="col-md-2 control-label text-left font-sub">Gerar Adiantamento</label>
                <div class="col-md-4">                                    
                  <label class="check">
                    <input type="radio" class="icheckbox" name="adiantamento" id="adnao" checked="checked" value="0" /> Não
                  </label>
                  <label class="check">
                    <input type="radio" class="icheckbox" name="adiantamento" id="adsim" value="1" /> Sim
                  </label>
                </div>

              </div>

              <div class="separador"></div>

              <div class="col-md-2">
                <input class="btn btn-primary" type="submit" name="salvar" id="salvar" value="Aprovar" >
              </div>
              <input type="hidden" name="fer_abono" id="fer_abono" value="0" />
              <input type="hidden" name="periodos" id="periodos" />
              <input type="hidden" name="status" id="status" value="1" />
              <input type="hidden" name="gestor" id="gestor" value="<?php echo $funcionario[0]->fun_idfuncionario; ?>" />
            </form>
          </div>

       </div><!--aba prog ferias-->

</div><!--col-md-9-->
</div><!--tab content-->
</div><!--fleft10-->
</div><!--row-->

<script type="text/javascript">
$("a").click(function(){

      $(".aba").removeClass("active");

      if( $(this).hasClass("list-group-item") ){        

        $(this).addClass("active");

      }
    });

  $('#tabela').DataTable({
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

  $(".ferias").click(function(){
      var id = $(this).data("id");
      var titulo = $(this).data("titulo");
      $("#titulomodal").text(titulo);
      $( "#dadosedit" ).html("");
      $("#myModalTamanho").removeClass("modal-lg");
      $('#myModal').modal('show');

      $.ajax({             
        type: "POST",
        url: '<?php echo base_url('home/modalConFerias') ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          id: id
        },              
        success: function(msg) 
        {    
          
          $( "#dadosedit" ).html(msg);

        } 
      });
  });

  $('.data').datepicker({
      
      format: 'dd/mm/yyyy',
      
    });

  $("#data_inicio").blur(function(){
    if( $(this).val().length == 10){
      var data = $(this).val();
      $.ajax({
        type: "POST",
        url: '<?php echo base_url("home/datapagamento"); ?>',
        cache: false,
        data: {
          data: data
        },
        success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else{
            $("#data_pagto").val(msg);
          }
        }
      });

    }//if
  });

  $("#formprogferias").submit(function(e){
    e.preventDefault();

    if ($("#periodos").val()==0 || $("#periodos").val()=="") {
      
      $("#idfun, #data_inicio, #dias, #data_pagto, #fer_abono").val("");
      return;
    }

    $.ajax({
      type: "POST",
      url: '<?php echo base_url("home/salvarProgFerias"); ?>',
      cache: false,
      data: $( this ).serialize(),

      success: function(msg){

        if(msg === 'erro'){

          $(".alert").addClass("alert-danger")
          .html("Houve um erro. Contate o suporte.")
          .slideDown("slow");
          $(".alert").delay( 3500 ).hide(500);

        }else{


          $(".alert").addClass("alert-success")
          .html("Programação efetuada com sucesso")
          .slideDown("slow");
          $(".alert").delay( 2500 ).hide(500, function(){
            window.location.reload();
          });
          
        }
      }
    });
  });

  $("#dias").change(function(){
    if ($(this).val()==20) {
      $("#txtabono").show("slow");
      $("#fer_abono").val(10);
    }else{
      $("#fer_abono").val(0);
      $("#txtabono").hide("slow");
    }
  });

  $("#idfun").change(function(){
    var id = $(this).val();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url("home/periodoLivre"); ?>',
      secureuri:false,
      cache: false,
      data:{
        idfun: id
        },
      success: function(msg){
      
        if(msg.texto === 'erro'){
          
          $(".alert").addClass("alert-danger")
          .html("Erro: contate o administrador do sistema")
          .slideDown("slow");
          $(".alert").delay( 2500 ).hide(500);

        }else{

          $("#conteudo").html(msg.texto);
          $("#periodos").val(msg.id);

        }
        //$("#load").fadeOut("slow");
      } 
    });
  });

 
</script>