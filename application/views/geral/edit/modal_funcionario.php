<div class="col-md-12">
<table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
<thead>
    <tr>
     <th>Nome</th>
     <th>Cargo</th>
     <th></th>
  </tr>
  </thead>
<tbody>
<?php

foreach ($usuarios as $key => $value) {
  
?>
<tr id="<?php echo $value->fun_idfuncionario; ?>">
  <td><?php echo $value->fun_nome; ?></td>
  <td><?php echo $value->fun_cargo; ?></td>
  <td>
    <input type="checkbox" name="colabs[]" class="incluir" value="<?php echo $value->fun_idfuncionario; ?>" >
  </td>
</tr>
  <?php } ?>
</tbody>
</table>


</div>
<script type="text/javascript">
  $( document ).ready(function() {

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

  });
</script>