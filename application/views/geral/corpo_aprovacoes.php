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
  <h2><span class="fa fa-thumbs-o-up"></span>&nbsp;Aprovações</h2>
  
</div>

<div class="col-md-12">
 <h3><span class="fa fa-search"></span>&nbsp;&nbsp;Solicitações 
   <img id="load_sol" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
 </h3>

 <table id="tabelasolicitacoes" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Selecionar</th>
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
      ?>

      <tr id="<?php echo $value->solicitacao_id; ?>" style="cursor: pointer;">
        <td>
          <label class="check"><input type="radio" class="iradio icheckbox" data-id="<?php echo $value->solicitacao_id; ?>" name="iradio[<?php echo $value->solicitacao_id; ?>]" data-st="3" />Aprovar</label>
          <label class="check"><input type="radio" class="iradio icheckbox" data-id="<?php echo $value->solicitacao_id; ?>" name="iradio[<?php echo $value->solicitacao_id; ?>]" data-st="4" />Reprovar</label>
          <div class="meubox" id="box<?php echo $value->solicitacao_id; ?>" style="display: none;" >
            <textarea id="obs<?php echo $value->solicitacao_id; ?>" style="width: 100%"></textarea>
            <button class="btn btn-info okobs" data-container="body" data-trigger="focus" data-placement="top" data-id="<?php echo $value->solicitacao_id; ?>">OK</button>
            <span class="btn btn-primary cancelarobs" data-id="<?php echo $value->solicitacao_id; ?>">Cancelar</span>
          </div>
        </td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $value->fun_nome; ?></td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $value->descricao_solicitacao; ?></td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $data." ".$hora;  ?></td>
        <td class="ver" data-titulo="<?php echo $value->descricao_solicitacao;?>" data-tipo="<?php echo $value->fk_tipo_solicitacao; ?>" data-id="<?php echo $value->solicitacao_id; ?>"><?php echo $value->descricao_status_solicitacao; ?></td>
      </tr>
      <?php }  ?>
    </tbody>
  </table>


</div>

<script type="text/javascript">
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

  $('.iradio').on("ifChecked", function(){

    var id = $(this).data("id");
    $("#box"+id).slideDown("slow");
    $("#box"+id).data("st", $(this).data("st"));

  });

  $(".okobs").click(function(){

    var id = $(this).data("id");
    var st = $("#box"+id).data("st");
    var obs = $("#obs"+id).val();

    if ($.trim(obs).length==0) {
      $(this).data("toggle", "popover");
      $(this).popover({content: "Coloque sua observação"});
      $(this).popover("show");
      $("#obs"+id).css("border-color", "red");
      //$("#obs"+id).focus();
      return false;
    }
    $("#load_sol").show();
    $.ajax({         
      type: "POST",
      url: '<?php echo base_url('gestor/aprovar') ?>',
      secureuri:false,
      cache: false,
      data:{
        id : id,
        st: st, 
        obs: obs
      },              
      success: function(msg) 
      {
        console.log(msg);
        if (msg==1) {
          
        }
        $("#"+id).slideUp("slow");
        $("#load_sol").hide();                
      } 
    });

  });

  $(".cancelarobs").click(function(){
    var id = $(this).data("id");
    $("#box"+id).slideUp("slow");
    $("[name='iradio["+id+"]']").iCheck('uncheck');
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
        tipo: tipo,
        pag: "aprovacao"
      },              
      success: function(msg) 
      {

        $( "#dadosedit" ).html(msg);

      } 
    });
  });

</script>