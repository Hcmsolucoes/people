<div class="widget widget-default">
   <h3 class="" >Editar E-mails</h3>

   <table class="table " id="tableemail" style="text-align: left">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Email</th>
        <th>Ação</th>                     
    </tr>
</thead>
<tbody>
   <?php  foreach ($emails as $value) { ?>

   <tr id="email<?php echo $value->ema_idemail?>">
       <td><?php echo $value->ema_tipo ?></td>
       <td><?php echo $value->ema_email ?></td>
       <td><i type="button" class="btn btn-default btn-sm removeemail" id="<?php echo $value->ema_idemail?>"><span class="fa fa-times"></span></i></td>
   </tr>

   <?php } ?>
</tbody>
</table>

<form name="addemail">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="for_tipo" class="control-label">Tipo</label>
                <select class="form-control" id="for_tipo" name="for_tipo">
                 <option></option>
                 <option>Profissional</option>
                 <option>Pessoal</option>                     
             </select>
         </div>
     </div>
     <div class="col-md-5">
        <div class="form-group">
            <label for="for_email" class="control-label">E-mail</label>
            <input class="form-control" id="for_email" name="for_email" required="" type="text" value="">
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label  class="control-label" style=" color: #fff">.</label>
            <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Salvar e-mail</button>
        </div>
    </div>
</div>
</form>
</div>
<div class="widget widget-default">
   <h3 class="" style="margin-bottom: 20px;">Editar Redes Sociais</h3>
   <form name="addrede">
    <table class="table" id="tablerede" style="text-align: left">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Nome de usuário ou endereço</th>
            <th>Ação</th>                                        
        </tr>
    </thead>
    <tbody>


        <div class="row">
            <div class="col-md-3">  
                <div class="form-group">
                    <label for="for_tipo1" class="control-label">Tipo</label>
                    <input class="form-control" id="for_tipo1" name="for_tipo1" required="" type="text" value="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="for_usu" class="control-label">Nome de usuário ou endereço</label>
                    <input class="form-control" id="for_usu" name="for_usu" required="" type="text" value="">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label  class="control-label" style=" color: #fff">.</label>
                    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Salvar rede-social</button>
                </div>
            </div>
        </div>

    </form>
    <?php  foreach ($redesocial as $value) { ?>

    <tr id="rede<?php echo $value->rede_idredesocial?>">
       <td><?php echo $value->rede_tipo ?></td>
       <td><?php echo $value->rede_nomeuser ?></td>
       <td><i type="button" class="btn btn-default btn-sm removerede" id="<?php echo $value->rede_idredesocial?>"><span class="fa fa-times"></span></i></td>
   </tr>

   <?php } ?>
</tbody>
</table>
<p style=" font-size: 10px; color: #ccc">*Tipo exp: Facebook, Twitter ...</p>                     

<button type="buttom" class="btn btn-danger" id="btcancela2"><span class="fa fa-arrow-left"></span> Voltar</button>

</div>


<script type="text/javascript">
    $(function () {
        //$('#datetimepicker1').datetimepicker({format: 'DD/MM/YYYY'});
    });
    
    $( "#btcancela2" ).click(function(e) {
      $('#myModal').modal('hide');
      $( "#dadosedit" ).html(""); 
  });
    $( ".removeemail" ).click(function(e) {
       e.preventDefault();
       id = $(this).attr('id');
       tremove = '#email'+id;
       $(tremove).hide(200);
       $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'perfil_edit/pessoal_removeemail' ?>',
        dataType : 'html',
        secureuri: false,
        data: {id : id },             
        success: function() { 
            $('#e'+id).remove();
        } 
    });         
   });
    
    $( ".removerede" ).click(function(e) {
       e.preventDefault();
       id = $(this).attr('id');
       tremove = '#rede'+id;
       $(tremove).hide(200);
       $.ajax({             
        type: "POST",
        url: '<?php echo base_url().'perfil_edit/pessoal_removerede' ?>',
        dataType : 'html',
        secureuri: false,
        data: {id : id },             
        success: function() {  

           $('#r'+id).remove();

       } 
   });         
   });
    
    $( 'form[name="addemail"]' ).on( "submit", function( event ) {
        event.preventDefault();

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url().'perfil_edit/pessoal_addemail' ?>',
            dataType : 'html',
            secureuri: false,
            data: $( this ).serialize(),              
            success: function(msg) 
            {         
              console.log(msg); 
              $('#tableemail tr:last').after(msg);
          } 
      });
    });

    $( 'form[name="addrede"]' ).on( "submit", function( event ) {
        event.preventDefault();
        $.ajax({             
            type: "POST",
            url: '<?php echo base_url().'perfil_edit/pessoal_addrede' ?>',
            dataType : 'html',
            secureuri: false,
            data: $( this ).serialize(),              
            success: function(msg) 
            {         
              console.log(msg); 
              $('#tablerede tr:last').after(msg);
          } 
      });
    });

    
</script>

