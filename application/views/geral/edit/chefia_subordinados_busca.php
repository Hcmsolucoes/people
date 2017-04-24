<?php 


?>
<div class="message-box animated fadeIn" data-sound="alert" id="alertbox">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span><span id="boxtitulo">Desvincular</span> </div>
            <div class="mb-content">
                <p id="boxmsg">Deseja desvincular este colaborador como subordinado?</p>                    
                <p id="boxdescricao">Clique em Não para continuar trabalhando. Clique em Sim desvinculá-lo.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a id="btsim" href="#" data-valor="" class="btn btn-danger btn-lg mb-control-close ">Sim</a>
                    <button id="btnao" class="btn btn-default btn-lg mb-control-close">Não</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget widget-default">

<h3 id="">Liderados diretos
<a href="#" id="addsubor" class="add fright btn btn-info" >
  Adicionar
</a>

</h3>

<table id="tabela" class="table table-striped table-hover table-condensed table-responsive">
<thead>
		<tr>
     <th>Nome</th>
     <th>Matricula</th>
     <th>Admissão</th>
     <th>Cargo</th>
     <th>Departamento</th>
     <th>Centro Custo</th>
     <th></th>

  </tr>
	</thead>
	<tbody>
<?php

foreach ($subordinados as $key => $value) {
	$admissao = $this->Log->alteradata1($value->contr_data_admissao);
?>
<tr id="colab<?php echo $value->fun_idfuncionario; ?>" >
	<td><?php echo $value->fun_nome; ?></td>
	<td><?php echo $value->fun_matricula; ?></td>
	<td><?php echo $admissao; ?></td>
	<td><?php echo $value->fun_cargo; ?></td>
  <td><?php echo $value->contr_departamento; ?></td>
  <td><?php echo $value->contr_centrocusto; ?></td>
  <td><a href="#" class="subor_exc mb-control" data-box="#alertbox" data-idfun="<?php echo $value->fun_idfuncionario; ?>">
  <i class="fa fa-times"></i></a>
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

    $(".subor_exc").click(function(){

      var id = $(this).data("idfun");
      $("#btsim").data("valor", id);

    });

    $("#btnao").click(function(){

      $("#btsim").data("valor", "");
      
    });


    $("#btsim").click(function(){

        var idcolab = $(this).data("valor");
        var chefe = $("#chefe").val();
        var operacao = 0;

        $.ajax({
          type: "POST",
          url: '<?php echo base_url()."ajax/chefia_edit_subor";?>',
          dataType : 'html',
          secureuri:false,
          cache: false,
          data:{
            chefe : chefe,
            colab: idcolab,
            operacao: operacao
          },              
          success: function(msg){

            if(msg === 'erro'){
              $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o suporte.")
              .slideDown("slow");
              $(".alert").delay( 3500 ).hide(500);
            }else{
              $("#colab"+idcolab).slideUp("slow");
              $(".alert").addClass("alert-success")
              .html("Subordinado alterado com sucesso")
              .slideDown("slow"); 
            }
            $(".alert").delay( 3500 ).hide(500);

          } 
        });

     });        
   
    $("#addsubor").click(function(){

      var idchefe = $("#chefe").val();

      $.ajax({
        type: "POST",
        url: '<?php echo base_url()."ajax/buscaColabSubor";?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          chefe: idchefe
        },                  
        success: function(msg){

          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
            $("#titulocolab").text("Gerenciar Subordinados");
            $("#corpomodalsubor").html(msg);
            $('#modalcolab').modal("show");

          }

        } 
      });
     });

   $(".mb-control").on("click",function(){
        var box = $($(this).data("box"));
        if(box.length > 0){
            box.toggleClass("open");
            
            var sound = box.data("sound");
            
            if(sound === 'alert')
                playAudio('alert');
            
            if(sound === 'fail')
                playAudio('fail');
            
        }        
        return false;
    });

   $(".mb-control-close").on("click",function(){
       $(this).parents(".message-box").removeClass("open");
       return false;
    }); 

});
</script>