<?php 

$z = explode(".", $fundoimagem);
$fundomobile = $z[0]."-mobile.".$z[1];

?>	
<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head> 

<title>hcm people</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?php echo base_url('assets/img/hcm.ico') ?>" type="image/x-icon" />


<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/theme-default.css') ?>"/>
<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/style.css') ?>"/>
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/less.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/plugins/jquery/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/plugins/bootstrap/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.complexify.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/k.js') ?>"></script> 

</head>

<style type="text/css">
    #forprim, #esquecisenhatl, .load, .alert{ display: none}
</style>

<body>
    
    <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
           <div class="modal-content" style="max-height:595px; overflow:scroll;">
             
              <div class="modal-body" id="dadosedit">                       
              </div>
              
           </div>
        </div>
   </div>
  
        <div class="login-container lightmode" data-mobile="<?php echo base_url('/img/backgrounds/'.$fundomobile ); ?>" style="background-image: url(<?php echo base_url('/img/backgrounds/'.$fundoimagem ); ?>); ">
        
            <div class="login-box animated fadeInDown">
                <!--<div class="login-logo">
                    <h3>HCM People</h3>
                    <span>Portal Corporativo</span>
                </div>-->
                <div class="login-body" style="background: <?php echo $fundologin; ?>;">                    

                    <div class="login-title"><strong>Acesse</strong> sua conta.
                        <img class="load" style=" width: 20px; height: 20px;float: right; " src="<?php echo base_url('img/loaders/default.gif') ?>" >
                    </div>

                    <div class="alert alert-dismissible" role="alert" id="forprim2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div id="fornomal">
                    <form action="" class="form-horizontal" method="post" id="for_auten">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="E-mail" id="for_email" required style="color: #000; background-color: #fff;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Senha" id="for_senha" required style="color: #000; background-color: #fff;"/>
                        </div>
                    </div>
                    <div id="empresas" style="display: none;"></div>
                    <div class="form-group">
                        
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-info btn-block" id="auten1" value="Autenticar" />
                        </div>
                    </div>
                    <input type="hidden" name="ins" id="instancia" value="<?php echo $instancia; ?>" />            
                     </form>

                    <div class="login-or">OU</div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <span id="primeiroacess" class="btn btn-info btn-block btn-twitter"><span class="fa fa-unlock-alt"></span> Primeiro Acesso ?</span>
                        </div>
                        <div class="col-md-6">                            
                            <span id="esquecisenha" class="btn btn-info btn-block btn-google"><span class="fa fa-exclamation-circle"></span> Esqueci a Senha</span>
                        </div>
                    </div>


                    </div>
                    <div id="forprim" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="for_nascimento" placeholder="Data de Nascimento ex: 00/00/0000" required style="color: #000; background-color: #fff;"/>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="for_cpf" placeholder="Seu CPF (somente números)" required style="color: #000; background-color: #fff;"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block" id="auten2">Buscar Funcionário</button>
                    </div>
                    <div class="col-md-6">                            
                        <span class="btn btn-info btn-block btn-google privolta"><span class="fa fa-arrow-left "></span>Voltar</span>
                    </div>
                        

                    </div>
                    <div id="esquecisenhatl" class="form-horizontal">
                       <form id="recusenha">
                       <p class="msg"></p>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Seu e-mail" id="usu_email" name="usu_email" required style="color: #000; background-color: #fff;opacity: 0.7;"/>
                            </div>
                        </div>


                          <div class="col-md-8">
                             <div class="loader"><img src="<?= base_url('img/4.gif') ?>" alt=""></div>
                             <button type="submit" class="btn btn-primary btn-info btn-block" id="enviasenha">Enviar credenciais por email</button>
                        </div>
                        <div class="col-md-4">
                             <span class="btn btn-info btn-block btn-google privolta"><span class="fa fa-arrow-left "></span>Voltar</span>
                          </div>

                    </form>


                    <div class="clearfix"></div>

                    <div class="alert-icon alert-close" id="forprim2"><i class="glyph-icon icon-check"></i></div>

                    <div class="login-subtitle acenter">
                        Não consegue acessar?<a href="#" id="recusenha">  Entre em contato</a>
                    </div>
                   
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2016 hcm people
                    </div>
                    <div class="pull-right">
                        <a href="#">Sobre</a> |
                        <a href="#">Privacidade</a> |
                        <a href="#">Contato</a>
                    </div>
                </div>
            </div>
            
        </div>
   
</body>
</html>
<script type='text/javascript' src="<?php echo base_url('js/plugins/maskedinput/jquery.maskedinput.min.js') ?>"></script>
<script>

        $('#recusenha').on('submit', function(e){
            
            e ? e.preventDefault() : false;
                $('.btn-primary').hide();
                $('.loader').show(300);
                r = app.post('<?php echo base_url().'perfil_edit/recu_senha' ?>', $( this ).serialize(), 'JSON');
                  r.then(function(r){
                    
                    if(!r.success){
                      $('.loader').hide(300);                           
                      $('.btn-primary').show();
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
                    $( "#myModal" ).delay( 3000 ).modal('hide');
                })

        });

function delmsg(){
    $('.alert').delay(4000).slideUp(function(){

        $(this).html("")
    })
}

    $('#primeiroacess').click( function(){
        $('#forprim').show("slow", function() {  });
        $('#fornomal').hide("slow", function() {  });
    });
    $('.privolta').click( function(){
        $('#fornomal').show("slow", function() {  });
        $('#forprim').hide("slow", function() {  });
        $('#esquecisenhatl').hide("slow", function() {  });
    });
    $('#esquecisenha').click( function(){
        $('#fornomal').hide("slow", function() {  });
        $('#forprim').hide("slow", function() {  });
        $('#esquecisenhatl').show("slow", function() {  });
    });
    
    $("#for_nascimento").mask('99/99/9999');
    $("#for_cpf").mask('99999999999');

    /* entrando com a senha*/
    $( "#for_auten" ).submit(function( e ) {
        e.preventDefault();        
     
        email = $('#for_email').val();
        senha = $('#for_senha').val();
        empresa = $('#empresa').val();
        instancia = $('#instancia').val();
        $(".load").show();
        $.ajax({             
            type: "POST",
             url: '<?php echo base_url()."ajax/logar";?>',
       dataType : 'html',
        secureuri:false,
       cache: false,
            data:{
                    email : email,
                    senha : senha,
                    empresa : empresa, 
                    instancia: instancia
                },              
            success: function(msg) 
                  {
                    
                      if(msg === 'erro'){

                        $('.alert').append('E-mail ou senha incorretos')
                        .addClass("alert-danger")
                        .slideDown("slow", delmsg);

                      }else if(msg=="ok"){

                        $('#fornomal').hide("slow", function() { 
                          window.location.href = "<?php echo base_url('home'); ?>";
                        });
                        
                       
                    }else{

                        $("#empresas").html(msg);
                        $("#empresas").slideDown();

                    }
                    $(".load").hide();
                  } 
            });        
    });
    
     /* entrando com primeiro acesso*/
    $( "#auten2" ).click(function(e) {
        e.preventDefault();        
     
        nascimento = $('#for_nascimento').val();
        cpf = $('#for_cpf').val();
        instancia = $('#instancia').val();
 
        $.ajax({             
            type: "POST",
             url: '<?php echo base_url()."ajax/primeiroacesso";?>',
       dataType : 'html',
        secureuri:false,
       cache: false,
            data:{
                    nascimento : nascimento,
                    cpf : cpf,
                    instancia: instancia
                },              
            success: function(msg) 
                  {
         //console.log(msg);
                      if(msg === 'erro'){
                        $('.alert').append('Dados não encontrados')
                        .addClass("alert-danger")
                        .slideDown("slow", delmsg);
                      }else if(msg==1){
                            $('.alert').append('Usuário já possui senha')
                        .addClass("alert-danger")
                        .slideDown("slow", delmsg);
                      }else{
                          $( "#forprim2" ).append(msg)
                            .removeClass("alert-danger")
                          .addClass("alert-success")
                          .slideDown("slow");
                      }
                  } 
            });        
    });


    $(document).ready(function(){
        if ($( window ).width()<=500) {
            $(".login-body").css("background-color", "transparent");
            var mobile = $(".login-container").data("mobile");
            $(".login-container").css("background-image", "url("+mobile+")") ;

        }
    })

</script>