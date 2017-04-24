<!DOCTYPE html>
<html class="no-js" lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" bgproperties="fixed" >
	<head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>Portal RH</title>  
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
                <script src="<?php echo base_url('assets/js/ui-bootstrap-tpls-1.3.3.min.js') ?>" type="text/javascript"></script>
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript" src="<?php echo base_url('js/jquery.complexify.js') ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('js/k.js') ?>"></script>


                
	</head>
    <body class='gradent' style="height: 100%">

        
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



