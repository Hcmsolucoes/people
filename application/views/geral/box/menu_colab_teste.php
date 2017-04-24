
<div class="list-group" style=" border: none">
  <a href="<?php echo base_url().'home' ?>" class="list-group-item nbordlate <?php if($menupriativo == 'painel'){ echo 'active';} ?>" ><span class="glyphicon glyphicon-th-large"></span> Painel  </a>
  <a href="<?php echo base_url().'perfil/pessoal' ?>" class="list-group-item nbordlate <?php if($menupriativo == 'perfil'){ echo 'active';} ?>"><span class="glyphicon glyphicon-user"></span> Meu perfil</a>  
  
  <?php // ver se tem o modulo ponto a ponto
        $modulos = explode(",", $this->session->userdata('modulos'));
        $modpont = false;
        foreach ($modulos as $value) {
            if($value == 1){
               $modpont = true; 
            }
        }
        if($modpont){?>  
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoponto" class="list-group-item nbordlate <?php if($menupriativo == 'pontoaponto'){ echo 'active';} ?>">
              <span class="glyphicon glyphicon-bed"></span> Ponto a Ponto</a>
              <div id="collapseTwoponto" class="panel-collapse collapse" style=" font-size: 11px;">
                  <a href="<?php echo base_url().'pontoaponto/verpremios' ?>"  class="list-group-item nbordlate <?php if (isset($menuponto)) {if($menuponto == 'verpremios'){ echo 'active2';}}?>">
                  <span class="glyphicon glyphicon-list-alt" style=" padding-left: 10px"></span>Consultar Prêmios</a>

              </div>   
<?php   } ?>
  <a href="#" class="list-group-item nbordlate "><span class="glyphicon glyphicon-plane"></span> Meu Desempenho</a>
  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwogs" class="list-group-item nbordlate">
  <span class="glyphicon glyphicon-briefcase"></span> Gestão do dia</a>
        <div id="collapseTwogs" class="panel-collapse collapse" style=" font-size: 11px;">
            <a href="" class="list-group-item nbordlate">
            <span class="glyphicon glyphicon-flag" style=" padding-left: 10px"></span> Programação de Férias</a>
                
            <a href="" class="list-group-item nbordlate">
            <span class="glyphicon glyphicon-comment" style=" padding-left: 10px"></span> Mensagens e Avisos</a>
                       
            <a href="" class="list-group-item nbordlate">
            <span class="glyphicon glyphicon-star" style=" padding-left: 10px"></span>Solicitação de Benefícios</a>
        </div>
  <a href="#" class="list-group-item nbordlate"><span class="glyphicon glyphicon-asterisk"></span> Minha Equipe</a>
  <a href="#" class="list-group-item nbordlate"><span class="glyphicon glyphicon-list-alt"></span> Estrutura Organizacional</a>
</div>