<div class="widget widget-default">
   <p class="msg"></p>
   <form>
      <div class="col-md-10">
         <div class="form-group">
            <label for="for_natual" class="control-label">Nova Senha</label>
            <input class="form-control" id="fun_senhav" name="for_senha" required type="password">
         </div>
      </div>

      <div class="col-md-10" style="margin-top: 20px">
         <small class="hidden segu">Segurança de senha:</small>
         <small class="error"></small>
         <div id="progressbar"></div>
        <br>
      </div>
      <div class="col-md-10">
         <div class="form-group">
            <label for="for_natual" class="control-label">Confirmar Senha</label>
            <input class="form-control" name="for_senhaconfirma" required type="password">
         </div>
      </div>
      <div class="col-md-10" style="margin-top: 20px">
         <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Salvar</button>
         <span class="btn btn-danger" id="btcancela"><span class="fa fa-times"></span>
         Cancelar</span>
      </div>
   </form>
</div>
<script type="text/javascript">
        $(function () {
            $("#fun_senhav").on('click', function(){
                $('.segu').removeClass('hidden');
                $("#progressbar").progressbar({
                  value:  0
                });
            });

            $('#fun_senhav').on('input', function(){
                console.log(this.value.length);
                if(this.value.length >= 1){
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  10
                    });
                }
                if(this.value.length >= 3){
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  20
                    });
                }
                if(this.value.length >= 4){
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  40
                    });
                }
                if(this.value.length >= 6){
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  60
                    });
                }
                if(this.value.length >= 8){
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  80
                    });
                }

                var regN = new RegExp('([0-9])');
                if(this.value.length >= 8 && !regN.test(this.value)){
                    $('.error').html('Insira um digito numérico.');
                    $(".ui-widget-header").removeClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  90
                    });
                }

                var regS = new RegExp('(?=.*[!@#$%&? "])');
                if(this.value.length >= 8 && !regS.test(this.value)){
                    $('.error').html('Insira um caractere especial ex: !@#$%&?');
                    $("#progressbar").progressbar({
                      value:  90
                    });
                }

                var reg = new RegExp('(?=.*[!@#$%&? "])');
                if(this.value.length >= 10 && (regN.test(this.value) && regS.test(this.value))){
                    $('.error').html('');
                    $(".ui-widget-header").addClass('progress-bar-success');
                    $("#progressbar").progressbar({
                      value:  100
                    });
                }
            });
        });
</script>
<script type="text/javascript">
    $(function () {
        
        $( "#btcancela" ).click(function(e) {
        $('#myModal').modal('hide');
    		$( "#dadosedit" ).html("");		 
        });

        $('form').on('submit', function(e){
            
            e ? e.preventDefault() : false;
            
                r = app.post('<?php echo base_url().'perfil_edit/alterar_senha_salva' ?>', $( this ).serialize(), 'JSON');
                r.then(function(r){
                  console.log(r);
                    if(!r.success){
                      $(".msg").addClass('error-bg');
                      $(".msg").html(r.msg);
                      $(".msg").show(300);
                      $(".msg").delay( 3500 ).hide(500);                              
                      return false;
                    }

                    $(".alert").removeClass('error-bg');
                    $(".alert").html(r.msg);
                    $(".alert").show(300);
                    $(".alert").delay( 3500 ).hide(500);                              
                    $( "#myModal" ).delay( 3000 ).modal('hide');
                })

        });
    });
</script>

