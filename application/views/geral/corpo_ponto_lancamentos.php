<?php 
$mes="";
$ano="";
foreach ($ponto_parametros as $value) {
  $data = $this->Log->alteradata1($value->para_datacompentencia); 
  $data = explode("/", $data);                                          
  list($dia, $mes, $ano ) = $data;
} ?>


<div class="page-title">                    
  <h2><span class="fa fa-check-square-o"></span> Lançamentos</h2>
</div>

<div class="row">
<div class="col-md-12">
  <div class="widget widget-default">
    <h3 class="">Lançamentos - <?php echo $mes.'/'.$ano ?></h3>
    <div class="separador"></div>

    <div class="txright " style="width: 320px; margin-bottom: 20px;" >
      <form>
        
        <div class="input-group"> 
          <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="nomebus">Nome</span> <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li class="mebu"><a href="#">Nome</a></li>
              <li class="mebu"><a href="#">Matricula</a></li>
              <li class="mebu"><a href="#">Admissão</a></li>
              <li class="mebu"><a href="#">Cargo</a></li>
            </ul>
          </div>
          <input type="text" class="form-control" id="nomefun" name="nomefun" placeholder="Buscar funcionario">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"> <span class="fa fa-search "></span></button>
          </span>
        </div>    
      </form>
    </div>
    
    
    <ul class="nav nav-tabs" style=" height: 41px;margin: 0px 0px 20px 0px;">
      <li class="active"><a href="<?php echo base_url() ?>pontoaponto/lancamentos_feito"">Lançamentos feitos</a></li>
      <li><a  href="<?php echo base_url() ?>pontoaponto/lancamentos_fazer">Lançamento a fazer</a></li>

    </ul>

    <p style=" margin-bottom: 0px;margin-top: 40px; width: 100%; display: table">
      <?php echo $links; ?></p>
      <div class="clearfix"></div>

      <div id="resbusca"  style=" min-width: 200px;  overflow: auto; ">
        <table class="table table-hover table-condensed" id="tableemail" style="text-align: left;min-width: 450px;">
         <thead>
           <tr style=" font-size: 12px">
             <th style=" width: 30px"></th>
             <th>Nome</th>
             <th>Matricula</th>
             <th>Admissão</th> 
             <th>Cargo</th>
             <th>Prêmio</th>
             <th></th> 
           </tr>
         </thead>
         <tbody>
           <?php if($results){ foreach ($results as $value) { ?>                                                  
           <tr style=" font-size: 12px;">
             <td style=" width: 30px" ><a href="<?php echo base_url().'perfil/pessoal_publico/'.$value->fun_idfuncionario ?>"><img class="imgcirculo_xp borda"  src="<?php echo $value->fun_foto ?>"></a></td>
             <td><?php echo $value->fun_nome ?></td>
             <td><?php echo $value->fun_matricula ?></td>
             <td><?php echo $this->Log->alteradata1($value->contr_data_admissao)?></td>
             <td><?php echo $value->contr_cargo ?></td>
             <td><?php echo $value->pon_totalpremio ?></td>
             <td>
              <a href="#">
                <span class="fa fa-pencil editlancamento" id="<?php echo $value->fun_idfuncionario ?>" data-toggle="modal" > </span>
              </a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#">
                <span class="fa fa-times excluirlancamento" id="<?php echo $value->pon_idpontoaponto ?>"></span>
              </a>
            </td>
          </tr>
          <?php  }} ?>
        </tbody>
      </table>
      
    </div>


  </div>
</div>


</div>
<script>

  $('td').css("vertical-align", "middle");


  $('#collapseTwoponto').collapse();
  $('.mebu').click(function() {
    $('#nomebus').text($(this).text());
  });
  $( "form" ).on( "submit", function(e ) {
    e.preventDefault();  
    
    param =   $('#nomebus').text();        
    pesquisa = $('#nomefun').val();     
    
    $.ajax({             
      type: "POST",
      url: '<?php echo base_url().'pontoaponto/lancamentos_usuario' ?>',
      dataType : 'html',
      secureuri: false,
      data:{param : param, pesquisa : pesquisa},               
      success: function(msg) 
      {         
        $('#resbusca').html(msg);                        
      } 
    });
  }); 


  $( ".editlancamento" ).click(function(e) {
    e.preventDefault();
    
    id = $(this).attr('id');
    
    $.ajax({             
      type: "POST",
      url: '<?php echo base_url().'pontoaponto/lancamentos_edit' ?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{id : id },               
      success: function(msg) 
      {                    
       $( "#dadosedit" ).html(msg);
       $('#myModal').modal('show');                                                                     
     } 
   });
  });
  
  $( ".excluirlancamento" ).click(function(e) {
    e.preventDefault();
    if(confirm("Deseja excluir?")){
      id = $(this).attr('id');

      $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'pontoaponto/lancamentos_del' ?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{id : id },               
        success: function(msg) 
        {                    
         location.reload();                                                                
                                                             //alert(msg);
                                                           } 
                                                         });
    }
    
    
  });
</script>