<p class="tit"><?php echo $nome; ?></p>
<p class="fontcinza">Entre com seus dados que servirão de acesso futuramente</p>
<div class="iconInput">
     <i class="glyphicon glyphicon-envelope clarearicone"></i>
     <input type="text" class="form-control" id="for_email0" placeholder="E-mail" value="<?php echo $email; ?>" />
     <input type="hidden" id="for_idfun" value="<?php echo $id_funcionario; ?>" />
     <input type="hidden" id="for_nome" value="<?php echo $nome; ?>" />
     <input type="hidden" id="for_nascimento" value="<?php echo $nascimento; ?>" />
     <input type="hidden" id="for_perfil" value="<?php echo $perfil; ?>" />
     <input type="hidden" id="for_empresa" value="<?php echo $idempresa; ?>" />
     <input type="hidden" id="for_cliente" value="<?php echo $idcliente; ?>" />
     <input type="hidden" id="for_cpf" value="<?php echo $cpf; ?>" />
 </div>
 <div class="iconInput">
     <i class="glyphicon glyphicon-lock clarearicone"></i>
     <input type="password" class="form-control" id="for_senha0" placeholder="Senha" />
 </div>
 <div class="iconInput">
     <button class="btn btn-lg btn-primary btn-sm  center-block" id="auten3"><span class="glyphicon glyphicon-play-circle"></span> Salvar Cadastro</button>
 </div>
 <input type="hidden" name="ins" id="inst" value="<?php echo $instancia; ?>" />            
<br/>


<script>
         /* entrando com primeiro acesso*/
    $( "#auten3" ).click(function(e) {
        e.preventDefault();        
     
        email = $('#for_email0').val();
        senha = $('#for_senha0').val();     
        idfun = $('#for_idfun').val();  
        nome = $('#for_nome').val();
        nasc = $('#for_nascimento').val();  
        perfil = $('#for_perfil').val();  
        empresa = $('#for_empresa').val();  
        cliente = $('#for_cliente').val();  
        cpf = $('#for_cpf').val();  
        instancia = $('#inst').val();
        
        $.ajax({             
            type: "POST",
             url: '<?php echo base_url()."ajax/primeirocadastro";?>',
       dataType : 'html',
        secureuri:false,
       cache: false,
            data:{
                    email : email,
                    senha : senha,
                    idfun : idfun,
                    nome   : nome,
                    nasc : nasc,
                    perfil : perfil,
                    empresa : empresa,
                    cliente : cliente,
                    cpf : cpf,
                    instancia : instancia
                },              
            success: function(msg) {

                 //console.log(msg);

                    if (msg=="ok") {
                        
                        $('#forprim2').hide("slow", function() {
                            $(this).html("");
                            $(".privolta").click();
                            $( ".alert" ).html("Senha cadastrada com sucesso")
                            .removeClass("alert-danger")
                          .addClass("alert-success")
                          .slideDown("slow", delmsg);
                           //window.location.href = "<?php echo base_url() ?>";
                        });
                        
                    }else{
                        $( ".alert" ).append("Houve um erro inesperado")
                            .removeClass("alert-success")
                          .addClass("alert-danger")
                          .slideDown("slow", delmsg);
                    }
         
                      
                  } 
            });        
    });
</script>