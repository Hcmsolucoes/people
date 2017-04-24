<div class="widget widget-default">
   
<form name="addacademico" class="form-group">
        <div class="col-md-4 ">
        	<input class="form-control" type="text" name="curso" id="curso" placeholder="Nome do curso" required="">
        </div>
        <div class="col-md-2">
    		<div class="form-group">
                    <select class="form-control" id="interesse" name="inter_area" required="">
                        <option value="Graduação">Graduação</option>
                        <option value="Bacharelado">Bacharelado</option>
                        <option value="MBA">MBA</option>
                        <option value="Técnico">Técnico</option>
                        <option value="Doutorado">Doutorado</option>
                        <option value="Mestrado">Mestrado</option>                        
                        <option value="Especialização">Especialização</option>                     
                    </select>
             </div>
         </div>
         <div class="col-md-4 ">
        	<input class="form-control" type="text" name="universidade" id="universidade" placeholder="Nome da universidade" required="">
        </div>


        <div class="clearfix" style="margin: 25px 0px;"></div>


        <div class="col-md-4 ">
        	<select class="form-control" name="area" id="area" required="">
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Administração">Administração</option>
                        <option value="T.I/Software">T.I/Software</option>
                        <option value="Gestão">Gestão</option>
                        <option value="Contabilidade">Contabilidade</option> 
                        <option value="Automação">Automação</option>
                        <option value="Engenharia Civil">Engenharia Civil</option>                        
                        <option value="Biologia">Biologia</option> 
                        <option value="Medicina">Medicina</option>
                        <option value="Matemática">Matemática</option> 
                        <option value="Análise Numérica">Análise Numérica</option>
                        <option value="Transporte de Produtos Perigosos">Transporte de Produtos Perigosos</option> 
                        <option value="Mecânica/Motores">Mecânica/Motores</option>
                        <option value="Marketing">Marketing</option> 
                        <option value="Varejo">Varejo</option>                     
             </select>
        </div>
        <div class="col-md-5 " >
        	<div class='input-group' style="width: 50%;float: left;">
                <input class="form-control txleft" type="text" name="inicio" id="inicio" placeholder="Início" required="">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>

             <div class='input-group' style="width: 50%;float: left;">
                <input class="form-control txleft" type="text" name="fim" id="fim" placeholder="Conclusão" required="">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
             </div>
        </div><!--
         <div class="col-md-4 " >
          <input type="checkbox" name="cursando" id="cursando" value="cursando" />Cursando
         </div>-->

         <div class="clearfix" style="margin: 15px 0px"></div>

         <div class="col-md-6" >             
            <button class="btn btn-primary" name="save" type="submit" >Salvar <span class="fa fa-check"> </span></button>
            <span id="cancela" class=" btn btn-danger" >Cancelar <span class="fa fa-times"></span> </span>            
         </div>

</form>



<div class="clearfix"></div>
     

 </div>

 <script type="text/javascript">
 	$('#inicio, #fim').datepicker({
            format: 'dd/mm/yyyy'
        });

 	$( "#cancela" ).click(function(e) {
          $('#myModal').modal('hide');
		$( "#dadosedit" ).html(""); 
    });

 	$('#cursando').change(function(){
 		console.log($(this).is(":checked"));
 		if($(this).is(":checked")){
 			$('#inicio, #fim').val("").prop( "disabled", true );
 		}else{
 			$('#inicio, #fim').prop( "disabled", false );
 		}
 	});


 	$( 'form[name="addacademico"]' ).submit( function( event ) {
        event.preventDefault();
        $.ajax({             
                type: "POST",
                 url: '<?php echo base_url().'perfil_edit/academico_add' ?>',
           dataType : 'html',
           secureuri: false,
                data: $( this ).serialize(),              
                success: function(msg) 
                      {                         
                        console.log(msg);
                        if(msg=="ok"){
                        	location.reload(); 
                        }
                         
                      } 
     	});
     }); 
         



 </script>