<div class="widget widget-default">
   <h3 class="" style="margin-bottom: 30px;">Recuperação de Senha </h3>
   <p class="msg"></p>
   <form>
      <div class="col-md-10">
         <div class="form-group">
            <label for="for_natual" class="control-label">Seu e-mail:</label>
            <input class="form-control" id="usu_email" type="email" name="usu_email" required>
         </div>
      </div>

      <div class="col-md-10" style="margin-top: 20px">
          <div class="loader"><img src="<?= base_url('img/4.gif') ?>" alt=""></div>
         <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Enviar</button>
         <span class="btn btn-danger" id="btcancela"><span class="fa fa-times"></span>
         Cancelar</span>
      </div>

   </form>
</div>
<script type="text/javascript">
    $(function () {
        
        $( "#btcancela" ).click(function(e) {
        $('#myModal').modal('hide');
    		$( "#dadosedit" ).html("");		 
        });

        $('form').on('submit', function(e){
            
            e ? e.preventDefault() : false;
                $('.btn-primary').hide();
                $('.loader').show(300);
                r = app.post('<?php echo base_url().'perfil_edit/recu_senha' ?>', $( this ).serialize(), 'JSON');
                  r.then(function(r){
                    
                    if(!r.success){
                      $('.loader').hide(300);                           
                      $(".alert").removeClass('alert-success');
                      $(".msg").addClass('error-bg');
                      $(".msg").html(r.msg);
                      $(".msg").show(300);
                      $(".msg").delay( 3500 ).hide(500);   
                      return false;
                    }

                $('.loader').hide();
                $('#btn-primary').show(300);
                    $(".alert").removeClass('error-bg');
                    $(".alert").removeClass('alert-danger');
                    $(".alert").addClass('alert-success');
                    $(".alert").html(r.msg);
                    $(".alert").show(300);
                    $(".alert").delay( 3500 ).hide(500);                              
                })

        });
    });
</script>

