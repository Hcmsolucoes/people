
<div class="page-title">                    
  <h2><span class="fa fa-cubes"></span>&nbsp;Integrações</h2>
</div>

<div class="col-md-12">
 <h3><span class="fa fa-search"></span>&nbsp;&nbsp;Solicitações Efetivadas
   <img id="load_sol" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
 </h3>
 
 <table id="tabelasolicitacoes" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Colaborador</th>
      <th>Natureza</th>
      <th>Data da solicitação</th>
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

      $integrado = "Não integrado";
      $cor = "#cf0606";
      if($value->ic_integrado==1){
        $integrado ="Integrado";
        $cor = "#09b705";
      }
      ?>

      <tr id="<?php echo $value->solicitacao_id; ?>" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" style="cursor: pointer;">

        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $value->fun_nome; ?></td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $value->descricao_solicitacao; ?></td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $data." ".$hora;  ?></td>
        <td class="ver bold" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>" style="color: <?php echo $cor; ?>;"><?php echo $integrado; ?></td>
      </tr>
      <?php }  ?>
    </tbody>
  </table>



  <h3 class="fleft" style="margin: 60px 0px 0px 0px;">
    <span class="fa fa-plane"></span>&nbsp;&nbsp;Lista de férias
  </h3>
  <table id="tabelaferias" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Colaborador</th>
        <th>Natureza</th>
        <th>Data de início</th>
        <th>Status</th>                  
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ferias as $key => $value) { 
        $integrado = "Não integrado";
        $cor = "#cf0606";
        if($value->fer_integrado==1){
          $integrado ="Integrado";
          $cor = "#09b705";
        }
        ?>
        <tr class="ferias" data-titulo="Férias: <?php echo $value->fun_nome; ?>" data-id="<?php echo $value->fer_idferias; ?>">
          <td><?php echo $value->fun_nome; ?></td>
          <td>Férias</td>
          <td><?php echo $this->Log->alteradata1($value->fer_datainicio); ?></td>
          <td class="bold" style="color: <?php echo $cor; ?>;"><?php echo $integrado; ?></td>
        </tr>

        <?php }  ?>
      </tbody>
    </table>


    <h3 class="fleft" style="margin: 60px 0px 0px 0px;">
    <span class="fa fa-plane"></span>&nbsp;&nbsp;Lista de Admissões
  </h3>
  <table id="tabelaadmissoes" class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Colaborador</th>
        <th>Data da Admissão</th>
        <th>Cargo</th>
        <th>Status</th>                  
      </tr>
    </thead>
    <tbody>
      <?php foreach ($admissoes as $key => $value) { 
        $integrado = "Não integrado";
        $cor = "#cf0606";
        if($value->ic_integrado==1){
          $integrado ="Integrado";
          $cor = "#09b705";
        }
        ?>
        <tr class="admi" data-titulo="Admissão: <?php echo $value->nome_admissao; ?>" data-id="<?php echo $value->id_admissao; ?>">
          <td><?php echo $value->nome_admissao; ?></td>
          <td><?php echo $this->Log->alteradata1($value->data_admissao); ?></td>
          <td><?php echo $value->descricao; ?></td>
          <td class="bold" style="color: <?php echo $cor; ?>;"><?php echo $integrado; ?></td>
        </tr>

        <?php }  ?>
      </tbody>
    </table>


  </div><!--col-md-12-->

  <script type="text/javascript">
    $('#tabelasolicitacoes, #tabelaferias').DataTable({
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

    $('.iradio').on("ifChecked", function(){

      var id = $(this).data("id");
      $.ajax({             
        type: "POST",
        url: '<?php echo base_url('rh/efetivar') ?>',
        secureuri:false,
        cache: false,
        data:{
          id : id
        },              
        success: function(msg) 
        {

          if (msg==1) {
            $("#"+id).slideUp("slow");
          }                  
        } 
      });

    });

    $(".ver").click(function(){
      var id = $(this).data("id");
      var tipo = $(this).data("tipo");
      var titulo = $(this).data("titulo");
      $('#titulomodal').text(titulo);
      $( "#dadosedit" ).html("<img id='load' src='<?php echo base_url('img/loaders/default.gif') ?>' >");
      $("#myModal").modal('show');
      $.ajax({            
        type: "POST",
        url: '<?php echo base_url('gestor/minhaSolicitacao') ?>',
        secureuri:false,
        cache: false,
        data:{
          id: id,
          tipo: tipo
        },              
        success: function(msg) 
        {

          $( "#dadosedit" ).html(msg);

        } 
      });
    });

    $(".cancelarobs").click(function(){
      var id = $(this).data("id");
      $("#box"+id).slideUp("slow");
      $("[name='iradio["+id+"]']").iCheck('uncheck');
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
          id: id,
          pagina: "integracao"
        },              
        success: function(msg) 
        {    

          $( "#dadosedit" ).html(msg);

        } 
      });
    });

  </script>