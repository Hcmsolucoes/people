
<?php 

?>

<div id="modalchefia" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg">
   <div class="modal-content" style="max-height:595px; overflow:scroll;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="titulochefia"></h4>
    </div>
     <div class="modal-body" id="">      

       <div class="input-group" style="max-width: 250px;">
        <input type="text" class="form-control" placeholder="Buscar Gestor" id="campobusca">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" id="">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </span>
      </div>

      <div id="corpomodal"></div>

    </div>

    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>

  </div>
</div>
</div>


<div id="modalcolab" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg">
   <div class="modal-content" style="max-height:595px; overflow:scroll;">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-titl bold" id="titulocolab"></h4>
    </div>

     <div class="modal-body" id="" style="display: inline;">      

      <div id="corpomodalsubor"></div>

    </div>

    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
    </div>

  </div>
</div>
</div>


<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Chefia</h2>
</div> 


<div class="row">

	<div class="col-md-12">

<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

<div class="widget widget-default">
  
  <div id="result" style="" ></div>

  <div class="clearfix"></div>

  <div class="fleft" style="">
    <a id="selgestor" class="bold btn btn-default" href="#" style="color: #787878;">Clique para selecionar um gestor</a>
    </div>
  

  <img id="load" style="display: none;position: absolute;left: 45%;" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">

    <div class="clearfix"></div>

  </div>

<div class="clearfix"></div>

<div id="resultado" style="display: none;" >

<div class="clearfix"></div>

<div id="result_subor" ></div>

</div>



</div><div class="clearfix"></div>
<input type="hidden" name="chefe" id="chefe" />
<script type="text/javascript">

  $("#campobusca").on("change", function(){

    var busca = $(this).val();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url("ajax/buscaColabChefia");?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        busca : busca
      },              
      success: function(msg) 
      {

        if(msg === 'erro'){
          alert("Houve um erro");
        }else{
          $("#corpomodal").html(msg);
           // $("#result").slideDown();

         }
         $("#load").fadeOut("slow");
       } 
     });

   });

  $("#sexo").on("change", function(){

    var busca = $(this).val();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url("ajax/buscaColabChefia");?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        busca : busca
      },              
      success: function(msg) 
      {

        if(msg === 'erro'){
          alert("Houve um erro");
        }else{
          $("#corpomodal").html(msg);
           // $("#result").slideDown();

         }
         $("#load").fadeOut("slow");
       } 
     });

   });



  $("#buscasubor").on("change", function(){

    var busca = $(this).val();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url("ajax/buscaColabChefia");?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        busca : busca
      },              
      success: function(msg) 
      {

        if(msg === 'erro'){
          alert("Houve um erro");
        }else{
          $("#corpomodal").html(msg);
           // $("#result").slideDown();

         }
         $("#load").fadeOut("slow");
       } 
     });

   });


  $("#selgestor").click(function(){

    $("#load").show();

    $.ajax({          
      type: "POST",
      url: '<?php echo base_url("ajax/buscaColabChefia");?>',
      dataType : 'html',
      secureuri:false,
      cache: false,              
      success: function(msg) 
      {

        if(msg === 'erro'){
          alert("Houve um erro");
        }else{
          $("#titulochefia").text("Selecione o Gestor");
          $("#corpomodal").html(msg);
          $("#modalchefia").modal();
        }
        $("#load").fadeOut("slow");
      } 
    });
   });

  
	
</script>