<?php 

?>

<div class="page-title">
  <h2><span class="fa fa-lock"></span> Redefinir Acessos</h2>
</div>

<div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

<div class="col-md-12">
<div class="widget widget-default">
   <p class="msg"></p>
   <form>

      <div class="col-md-3">
        <label for="colaboradores" class="control-label">Colaborador</label>
              <select name="colaborador" required="true" id="colaborador" class="selectpicker combocolab" data-live-search="true" data-div="deslig_result">
               <option value="">Colaborador</option>
               <?php foreach ($colaboradores as $key => $value) { ?>
               <option value="<?php echo $value->fun_idfuncionario; ?>"><?php echo $value->fun_nome; ?></option>
               <?php } ?>
             </select>
             <img id="coload" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" >
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3" style="margin-top: 20px">
         <div class="form-group">
            <label for="for_natual" class="control-label">Nova Senha</label>
            <input class="form-control" id="fun_senhav" name="for_senha" required type="password">
         </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3" style="margin-top: 20px">
         <small class="hidden segu">Segurança de senha:</small>
         <small class="error"></small>
         <div id="progressbar"></div>
        <br>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
         <div class="form-group">
            <label for="for_natual" class="control-label">Confirmar Senha</label>
            <input class="form-control" name="for_senhaconfirma" required type="password">
         </div>
      </div>

      <div class="clearfix"></div>

        <div class="col-md-3" style="margin-top: 20px">
         <div class="form-group">
            <label for="for_natual" class="control-label">Perfil</label>
            <select name="usu_perfil" id="usu_perfil" class="form-control">
              <option value="">Nivel de acesso</option>
              <option value="1">Colaborador</option>
              <option value="2">Gestor</option>
              <option value="3">Admin</option>
              <option value="4">Gestor + Admin</option>
              <option value="5">RH</option>
              <option value="6">RH + Gestor</option>
              <option value="7">RH + Gestor + Admin</option>
            </select>
         </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3" style="margin-top: 20px">
         <div class="form-group">
            <label for="usu_email" class="control-label">E-mail</label>
            <input type="text" class="form-control" id="usu_email" name="usu_email" required >
         </div>
      </div>
      
      <div class="clearfix"></div>

      <div class="col-md-3" style="margin-top: 20px">
         <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Salvar</button>
         <span class="btn btn-danger" id="btcancela"><span class="fa fa-times"></span>
         Cancelar</span>
      </div>
   </form>
</div>
</div>

<script type="text/javascript">
    $(function () {
        
        $( "#btcancela" ).click(function(e) {
          $('#myModal').modal('hide');
    		  $( "#dadosedit" ).html("");		 
        });

        $("#colaborador").change(function(){
          var idcolab = $(this).val();
          $("#coload").show();

          $.ajax({
            type: "POST",
            url: '<?php echo base_url("admin/acessocampos"); ?>',
            cache: false,
            dataType: "json",
            data: {
              colab: idcolab
            },
            success: function(msg){

              if( msg.usu_email !="" ){

                $("#usu_email").val(msg.usu_email);
                $("#usu_perfil").val(msg.usu_perfil).change();

              }else{

                
              }
              $("#coload").hide();
            }
          });
        });

        $('form').on('submit', function(e){
          $("#coload").show();
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: '<?php echo base_url("perfil_edit/alterar_senha_salva"); ?>',
            cache: false,
            data: $( this ).serialize(),

            success: function(msg){

              $(".alert").html(msg.msg);

              if( !msg.success ){
                $(".alert").removeClass("alert-success");
                $(".alert").addClass("alert-danger")
                .slideDown("slow");
                $(".alert").delay( 3500 ).hide(500);

              }else{

                $(".alert").removeClass("alert-danger");
                $(".alert").addClass("alert-success")
                .slideDown("slow");
                $(".alert").delay( 2500 ).hide(500);

              }
              $("#coload").hide();
            }
          });
        });

        $("#fun_senhav").on('click', function(){
                $('.segu').removeClass('hidden');
                $("#progressbar").progressbar({
                  value:  0
                });
            });

        $('#fun_senhav').on('input', function(){
               
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

