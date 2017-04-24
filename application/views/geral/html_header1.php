<!DOCTYPE html>
<html class="no-js" lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" bgproperties="fixed" >
	<head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>HCM Soluções</title>  
                <meta name="viewport" content="width=device-width, initial-scale=1">             
                <link href='http://fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'  media="screen"/>      
                <link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel='stylesheet' type='text/css'  media="all"/> 
                <link href="<?php echo base_url('assets/css/style.css') ?>" rel='stylesheet' type='text/css'  media="all"/>               
                <link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.css') ?>" rel='stylesheet' type='text/css'  media="all"/> 
                <!--
                <script src="<?php //echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
                <script src="<?php //echo base_url('assets/js/bootstrap.min2.js') ?>" type="text/javascript"></script>
                
                 -->

                 
               
                 
                 
                 
                <script src="<?php echo base_url('assets/js/jquery-1.9.1.js') ?>" type="text/javascript"></script> 
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
                <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js') ?>" type="text/javascript"></script> 
                <script src="<?php echo base_url('assets/js/jquery.numberformatter-1.2.4.js') ?>" type="text/javascript"></script> 
                <script src="<?php echo base_url('assets/js/ui-bootstrap-tpls-1.3.3.min.js') ?>" type="text/javascript"></script>
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript" src="<?php echo base_url('js/jquery.complexify.js') ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('js/k.js') ?>"></script>
                <link href="<?php echo base_url('assets/img/favicon.ico') ?>" rel="shortcut icon" type="image/ico">


                
	</head>
    <body class='gradent' style="height: 100%">
        <div class="alert alert-success" style=" display: none; position: absolute; z-index: 9999; width: 100%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="conteudoalert"></div>
         </div>        
        
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-body">
                  <div id="contmodal"></div>
              </div>

            </div>
          </div>
        </div>
        

        <?php $prinome = explode(" ", $this->session->userdata('nome'));
            if($this->session->userdata('id_funcionario')){ ?>
                  <nav class="navbar navbar-default" style="  z-index: 999; background: #01445d; border: none; -webkit-border-radius: 0px;  -moz-border-radius: 0px; border-radius: 0px;">
                    <div class="container-fluid">
                            <div class="row">
                              <div class="col-xs-6 col-sm-6">
                                  <div class="navbar-brand menupri" >
                                     <span class="glyphicon glyphicon-menu-hamburger icomenu"  style=" margin-right: 20px; float: left; margin-top: 10px"></span>
                                     <div style="<?php if($this->session->userdata('perfil') == '2'){ echo 'height: 40px;';}else{echo 'height: 30px; margin-top:-5px !important; ';} ?> float: right"><img style=" height: 100%; margin-right: 15px" class="logomin" src="<?php echo base_url().'assets/img/logo-min.png' ?>"> <span class="texlogo"><img style=" height: 100%" src="<?php echo base_url().'assets/img/logo-tex-br.png' ?>"></span></div>                                     
                                  </div>                                  
                              </div>
                              <div class="col-xs-6 col-sm-6 right text-right">
                                  <div class="padding text-right" style="padding: 10px;"> 
                                    <div class = "btn-group">
                                      <span style=" color: #fff; margin-right:  10px"><?php echo $prinome[0] ?></span>                                     
                                      <a href="" class="dropdown-toggle" data-toggle="dropdown" ><img class="circulologin"src="<?php echo $this->session->userdata('foto') ?>"></a> 
                                          <ul class = "dropdown-menu " role = "menu" style=" margin-left: -20px !important; left: -40px !important">
                                            <li><a href = "#"><span class="glyphicon glyphicon-cog" style=" color: #01445d"></span>Editar</a></li>
                                            <li><a href = "#"><span class="glyphicon glyphicon-briefcase" style=" color: #01445d"></span>Sobre HCM</li>      
                                            <li class = "divider"></li>
                                            <li><a href = "<?php echo base_url().'ajax/deslogar' ?>"><span class="glyphicon glyphicon-user" style=" color: #ccc"></span>Sair</a></li>
                                         </ul>
                                    </div>                                       
                                  </div>
                              </div>
                            </div>
                        <?php if($this->session->userdata('perfil') == '2'){ ?>                                     
                          <ul class="menugestor">
                              <li <?php if($this->session->userdata('perfil_atual') == '1'){ echo 'class="active"';} ?>><a href="<?php echo base_url().'home' ?>" id="men_colab">Colaborador</a></li>
                              <li <?php if($this->session->userdata('perfil_atual') == '2'){ echo 'class="active"';} ?>><a href="<?php echo base_url().'home/gestor' ?>" id="men_gest">Gestor</a></li>                               
                          </ul>                         
             
                      <?php } ?>
                    </div>
                  </nav>
        <?php } ?>
        
<script type="text/javascript">
    
$( ".menupri" ).click(function(e) {
     e.preventDefault(); 
      windowWidth = window.innerWidth;
      screenWidth = screen.width;

      if(windowWidth < 950){
          $( "#menu_principal" ).toggle(500);           
      }
});
window.addEventListener('resize', function(){
    windowWidth = window.innerWidth;
    if(windowWidth > 950){    
         $( "#menu_principal" ).css('display','block'); 
      }
	
});
</script>



