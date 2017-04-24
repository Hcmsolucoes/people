<?php 

$n = rand(1,12);

if (is_object($privacidade)) {
   $icestado = ($privacidade->ic_estadocivil==1)? TRUE : FALSE;
   $icnasc = ($privacidade->ic_nascimento==1)? TRUE : FALSE;
   $icetnia = ($privacidade->ic_etnia==1)? TRUE : FALSE;
   $icescol = ($privacidade->ic_escolaridade==1)? TRUE : FALSE;
   $ictel = ($privacidade->ic_telefones==1)? TRUE : FALSE;
   $icelet = ($privacidade->ic_eletronicos==1)? TRUE : FALSE;
   $icinter = ($privacidade->ic_interesses==1)? TRUE : FALSE;
   $icender = ($privacidade->ic_endereco==1)? TRUE : FALSE;
}else{
    $icestado = FALSE;
   $icnasc = FALSE;
   $icetnia = FALSE;
   $icescol = FALSE;
   $ictel = FALSE;
   $icelet = FALSE;
   $icinter = FALSE;
   $icender = FALSE;
}


?>
<style type="text/css">
  .timeline:before{
  /*  left: 53%;*/
  }
</style>
<!--<div class="page-title">                    
  <h2><span class="fa fa-profile"></span> Perfil Público</h2>
</div>-->
<div class="row">
  <div class="col-md-12 panel panel-default">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <div class="panel-content image-box" style="background-image: url('<?php echo base_url("/img/fundoperfil.jpg") ?>');">

<?php foreach ($funcionario_visita as $value) {
                                  $sexo = ($value->fun_sexo==1)? "Masculino" : "Feminino" ;
                                  ?>             
                             
                    <div class="col-md-4" id="dadospessoais">
                        <h5 class="bold" style="color: #fff;">Dados pessoais</h5>
                          
                            <!--<h4><?php echo $value->fun_nome?></h4>-->
                            <span class=""><?php echo $value->fun_nacionalidade ?>, 
                            <?php if($icestado){ echo $value->estciv_descricao; } ?>, 
                            <?php echo $sexo ?></span>
                        <div class="clearfix"></div>

                        <span class="">Natural de <?php echo $value->fun_naturalidade ?>, </span>

                        <div class="clearfix"></div>
                        <?php if($icetnia){ ?>
                        <span class="">Etnia <?php echo $value->etnia_descricao ?></span>
                        <?php } ?>
                        <?php if($icescol){ ?>
                        <span class="">e escolaridade <?php echo $value->escolaridade_descricao; ?></span>
                          <?php } ?>
                          <br>
                          <?php if($icnasc){ ?>
                          <span class="">Faz aniversário em 
                                        <?php 
                                        list($ano, $mes, $dia ) = explode("-", $value->fun_datanascimento);    
                                        echo $dia.'/'.$mes;
                                        ?>
                                </span>                                                    
                           <?php } ?>          
                    </div>                
              
            <?php } ?>

      <div id="basic_perfil">

                          <?php foreach ($funcionario_visita as $value) { 
                            $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
                            $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
                            ?>  

                         <img style="height: 100px;" src="<?php echo $foto; ?>" alt="" class=" imgcirculo" />
                          <h4 class="meta-heading bold"><?php echo $value->fun_nome ?></h4>
                          <h4 class="meta-subheading font-size-13 cinza"><?php echo $value->fun_cargo ?></h4>
                     <?php } ?>
        </div>
     </div>
                                 

<div class="separador"></div>



<div class="col-md-12 perfilmobile">
<?php foreach ($perfil_profissional as $value) {?>             
                             
                     
                        <h5 class="bold">Resumo profissional</h5>
                            <div class="font-sub"><?php echo $value->perfil_resumo; ?></div>                                                    
                                      
                
            <?php } ?> 
</div>


<div class="separador"></div>

<div class="col-md-5">
            <h5 class="bold">Formação acadêmica</h5>
                                
                            <?php foreach ($formacao_academica as $value) {?>
                            
                                <div class="fleft formacaomobile fleftmobile" >

                                    <h5 class="bold cinza"><?php echo $value->for_graduacao_curso?></h5>
                                    <h5 class=""><?php echo $value->for_educacao_nivel?></h5>
                                        <span class="font-sub"><?php echo $value->for_nome_facu?></span>                                 
                                        <div class="clearfix"></div>

                                        <span class="font-sub bold">Área de conhecimento:</span> 
                                        <span class="font-sub"><?php echo $value->for_areaconhecimento?></span>

                                        <div class="clearfix"></div>


                                        <span class="font-sub">
                                            <?php $hoje = date("Y-m-d"); $data2 = date( $value->for_datafim );
                                            if( $hoje < $data2 ){ ?>
                                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> com previsão de conclusão em <?php echo $this->Log->alteradata1($value->for_datafim)?>                                                        
                                            <?php }else{ ?>
                                                Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> finalizado em <?php echo $this->Log->alteradata1($value->for_datafim)?>
                                            <?php } ?>                                                    
                                        </span>                                                    
                                                                              
                                </div>                                         
           
                            <?php } ?>
<div class="separador"></div>



<div class="fleft-10"><!--contatos-->
<?php if($ictel){ ?>
      <h5 class="bold">Contatos Telefônicos</h5>
                     <?php  foreach ($contato as $value) { ?>
                        
      
                               <div class="fleft-5 font-sub">
                                  <?php echo $value-> con_nome ?>
                                   <div class="clearfix"></div>
                                  <?php echo $value->con_parentesco ?>
                               </div>
                                <div class="font-sub col-md-5 text-right txright" >
                                  <?php echo $value-> con_ddi. ' '.$value-> con_ddd. ' '.$value-> con_telefone.' ramal'.$value-> con_ramal.' '.$value->con_operadora ?>
                               </div>
                               <div class="separador"></div>
                     
                     <?php } ?>
<?php } ?>

<?php if($icelet){ ?>
                            <div class="fleft-10" style=" margin-bottom: 20px">
                            <h5 class="bold">Contatos Eletrônicos</h5>
                                <span class="">E-mails:</span>
                                <?php  foreach ($emails as $value) { ?>
                                <div style="color: #777">
                                    <a class="ng-binding" href="mailto:<?php echo $value->ema_email ?>"><?php echo $value->ema_email ?></a>                                    
                                </div>
                                <?php } ?>
                            </div>
                            <div class="fleft-10">
                                <span class="">Endereços eletrônicos</span>
                                <?php  foreach ($redesocial as $value) { ?>
                                <div class="font-sub">
                                    <?php echo $value->rede_tipo.' '.$value->rede_nomeuser ?>                               
                                </div>
                                <?php } ?>
                            </div>
<?php } ?>
</div><!--contatos-->

<div class="separador"></div>

<div class="fleft-10">
 <?php if($icender){ ?>
                    <h5 class="bold">Endereços</h5>
        
                     <?php  foreach ($funcionario_visita as $value) { ?>
                     
                         <span class="font-sub" style=""><?php echo $value->end_rua.', '.$value->end_numero.' '.$value->end_complemento.' '.$value->bair_nomebairro.' '.$value->cid_nomecidade.'  '.$value->est_nomeestado.'  '.$value->end_pais ?></span>
                
                     <?php } ?>
<?php } ?>
<div class="separador"></div>
<?php if($icinter){ ?>
                            <h5 class="bold">Interesses Pessoais</h5>
        
                     <?php  foreach ($interessepessoal as $value) { ?>
                     
                         <span class="bold"><?php echo $value->inter_area ?></span>
                         <br>
                         <span class="font-sub">
                                    <?php echo $value->inter_areadetalhe ?>
                                    </span>
                        <br>
                
                     <?php } ?>
<?php } ?>
</div>

</div>

<!--timeline-->
<div class="col-md-7">

<h4 id="feedrecebidos" class="bold" align="center">Feedbacks Recebidos</h4>

<div class="timeline">                                
            <!-- START TIMELINE ITEM -->
            <?php 

            $i = 0;

            foreach ($feedbacks as $value) {

              if( ($i % 2)==0){
                $lado = "";
                $float = "left: 114%";
              }else{
                $float = "right: 114%";
                $lado = "timeline-item-right" ;
              }
              $i++;
              $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
              $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
              ?>
              <div class="timeline-item <?php echo $lado; ?>">
                <div class="timeline-item-info" style="<?php echo $float; ?>" ><?php echo $this->Log->alteradata1($value->feed_data); ?></div>
                <div class="timeline-item-icon"><span class="fa fa-comments-o"></span></div>
                <div class="timeline-item-content">

                  <div class="timeline-body">
                   <img src="<?php echo $foto ?>" class="imgcirculo_m " align="left" style="margin: 0px 10px 0px 0px;" />
                   <span class="font_sub bold"><?php echo $value->fun_nome ?></span>
                   <p><?php echo $value->feed_depoimento ?></p>
                   <div class="fleft">
                     <?php foreach ($competencias[$value->feed_idfeedback] as $k => $v) { ?>

                          <?php if (!empty($v->rating_competencia)) { ?>
                          <img src="<?php echo base_url("assets/img")."/".$v->rating_competencia."star.png"; ?>" style="max-width: 60px;" />
                          <?php } ?>
                          <span><?php echo $v->desc_competencia; ?></span>
                          <div class="clearfix"></div>
                    <?php } ?>
                   </div>                                       
                </div>                                     
              </div>
            </div><!-- END TIMELINE ITEM -->
            <?php } ?>
            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
              <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
            </div><!-- END TIMELINE ITEM -->
          </div><!-- END TIMELINE -->



</div>


<div class="clearfix"></div>   




</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $(".timeline .timeline-item").css("width", "47%");
    //$(".timeline-item-info, .timeline .timeline-item.timeline-item-right .timeline-item-info").css(, "114%");
    $(".timeline-item-icon").css("right", "-38px");
    $(".timeline .timeline-item.timeline-item-right .timeline-item-icon").css("left", "-38px");
    $(".timeline:before").css("left", "53%");
    $(".timeline .timeline-item .timeline-date").css("right", "-70px");


  });
</script>

