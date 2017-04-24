<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Parâmetros da Competência</h2>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="widget widget-default">
            <form>
               <div class="col-md-2 col-sm-2">
                   <div class="form-group">
                       <label for="for_datacomp" class="control-label ">Mês de Competência</label>
                       <div class='input-group date' id='datetimepicker1'>
                           <input type='text' name="for_datacomp" id="for_datacomp" class="form-control" value="" />
                           <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                   <label for="for_datapaga" class="control-label ">Data do pagamento</label>
                   <div class='input-group date' id='datetimepicker2'>
                       <input type='text' name="for_datapaga" id="for_datapaga" class="form-control" value="" />
                       <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
           <div class="form-group">
               <label for="for_metamin" class="control-label">Meta Mínima</label>
               <input class="form-control" id="for_metamin" name="for_metamin" required="" type="text" value="">
           </div>
       </div>
       <div class="col-md-2 col-sm-2">
           <div class="form-group">
               <label for="for_proe2" class="control-label">Valor Provento 2ª Etapa</label>
               <input class="form-control" id="for_proe2" name="for_proe2" required="" type="text" value="">
           </div>
       </div>
       <div class="col-md-2 col-sm-2">
           <div class="form-group">
               <label for="for_metacom" class="control-label">Meta Combustível</label>
               <input class="form-control" id="for_metacom" name="for_metacom" required="" type="text" value="">
           </div>
       </div>
       <div class="col-md-2 col-sm-2" style="margin-top: 20px;">
           <button type="submit" class="btn btn-primary"><span class="glyph-icon icon-check"></span> Salvar</button>
       </div>    
     </form>
   

</div>

<div class="widget widget-default">
    <h3 class="">Parametros já adicionados</h3>
    <p style=" margin-bottom: 0px;"><?php echo $links; ?></p> <br />

    <div class="clearfix"></div>

    <div style=" min-width: 200px; overflow: auto; ">
        <table class="table " id="tableemail" style=" min-width: 400px;text-align: left;">
         <thead>
             <tr style=" font-size: 12px">
                 <th>Competência</th>
                 <th>Meta Mínima</th>
                 <th>Provento 2ª Etapa</th> 
                 <th>Meta Combustível</th>
                 <th>Ativar / Excluir</th> 
             </tr>
         </thead>
         <tbody>
           <?php 

           if ($results) {
            
           foreach ($results as $value) { ?>                                                  
           <tr id="para<?php echo $value -> para_idparametros ?>" >
            <td><?php $data = $this->Log->alteradata1($value->para_datacompentencia); $data = explode("/", $data);                                          
                list($dia, $mes, $ano ) = $data;echo ($mes.'/'.$ano);?></td>
                <td>R$ <?php echo $value -> para_metamin ?></td>
                <td>R$ <?php echo $value -> para_proventoe2 ?></td>
                <td><?php echo $value -> para_metacombustivel ?> Km</td>
                <td><a href="#">
                    <span class="<?php if($value -> para_ativo == 1){ echo 'btn-success'; }else{echo 'btn-default';}?> btn-xs ativaparame" id="<?php echo $value -> para_idparametros ?>"><span class="fa fa-check"></span>
                </span></a> &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#">
                    <span class="btn-default btn-xs removeparame" id="<?php echo $value -> para_idparametros ?>"><span class="fa fa-times-circle"></span></span>
                </a>
            </td>
        </tr>
        <?php  } } ?>
    </tbody>
</table>
</div>

</div>


</div>
<script>

    $(function () {
      
        $('#for_datacomp').datepicker({format: 'dd/mm/yyyy'});
        $('#for_datapaga').datepicker({format: 'dd/mm/yyyy'});

    });


    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        $.ajax({             
            type: "POST",
            url: '<?php echo base_url().'pontoaponto/parametro_edit' ?>',
            dataType : 'html',
            secureuri: false,
            data: $( this ).serialize(),              
            success: function(msg) 
            {

              if(msg === 'ok'){
                location.reload(); 
            }else{
               alert('Essa competência já existe!'); 
           }
       } 
   });
    });

    $( ".removeparame" ).click(function(e) {
       e.preventDefault();
       id = $(this).attr('id');
       tremove = '#para'+id;
       $(tremove).hide(200);
       $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'pontoaponto/parametro_remove' ?>',
        dataType : 'html',
        secureuri: false,
        data: {id : id },             
        success: function() {  } 
    });         
   });
    $( ".ativaparame" ).click(function(e) {
       e.preventDefault();
       id = $(this).attr('id');
       $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'pontoaponto/parametro_ativa' ?>',
        dataType : 'html',
        secureuri: false,
        data: {id : id },             
        success: function() {  location.reload();  } 
    });         
   });
</script>