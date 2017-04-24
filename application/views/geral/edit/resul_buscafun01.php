<table class="table table-hover table-condensed" id="tableemail" style=" min-width: 450px;">
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
    <?php  foreach ($funcionarios as $value) { ?>                                                  
    <tr style=" font-size: 12px;">
      <td style=" width: 30px" ><a href="<?php echo base_url().'perfil/pessoal_publico/'.$value->fun_idfuncionario ?>"><img class="imgcirculo_m borda"  src="<?php echo $value->fun_foto ?>"></a></td>
      <td><?php echo $value->fun_nome ?></td>
      <td><?php echo $value->fun_matricula ?></td>
      <td><?php echo $this->Log->alteradata1($value->contr_data_admissao)?></td>
      <td><?php echo $value->contr_cargo ?></td>
      <td><?php echo $value->pon_totalpremio ?></td>
      <td>
       <a href="#">
         <span class="editlancamento fa fa-pencil" id="<?php echo $value->fun_idfuncionario ?>" data-toggle="modal" data-target="#myModal" ></span>
       </a>
     </td>
   </tr>
   <?php  } ?>
 </tbody>
</table>

<script>
  $('td').css("vertical-align", "middle");

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
</script>