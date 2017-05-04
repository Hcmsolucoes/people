<?php // ver se tem o modulo ponto a ponto


?>

<!-- menu dashboard -->
<li class="<?php echo ($menupriativo=="painel")? "active":"" ?>" >
  <a href="<?php echo base_url('rh') ?>">
    <span class="fa fa-home"></span><span class="xn-text">Início</span>
  </a>               
</li>

<!-- menu ponto a ponto -->
<li class="xn-openable <?php echo ($menupriativo=="ponto")? "active":"" ?>">
  <a href="#"><span class="fa fa-database"></span>
    <span class="xn-text">Gestão de Dados</span>
  </a>
  <ul>
    <li><a href="<?php echo base_url('rh/') ?>">
      <span class="fa fa-upload"></span>
      <span class="xn-text">Importar Dados</span></a>
    </li>
    <li><a href="<?php echo base_url('rh/') ?>">
      <span class="fa fa-download"></span>
      <span class="xn-text">Exportar Dados</span></a>
    </li>
  </ul>
</li>


<li class="xn-openable <?php echo ($menupriativo=="tabela")? "active":"" ?>">
  <a href="<?php echo base_url('rh/') ?>">
    <span class="fa fa-table"></span>
    <span class="xn-text">Cadastro de Tabelas</span></a>

    <ul>
      <li><a href="<?php echo base_url('rh/eventos') ?>">
        <span class="fa fa-money"></span>
        <span class="xn-text">Eventos</span></a>
      </li>
      <li><a href="<?php echo base_url('rh/cursos') ?>">
        <span class="fa fa-book"></span>
        <span class="xn-text">Cursos</span></a>
      </li>
    </ul>
  </li>

<li class="xn-openable <?php echo ($menupriativo=="")? "active":"" ?>">
    <a href="#">
      <span class="fa fa-briefcase"></span>
      <span class="xn-text">Gestão do dia a dia</span></a>
  <ul>
        <li class="<?php echo ($menupriativo=="aprovacoes")? "active":"" ?>">
          <a href="<?php echo base_url('rh/aprovacoes'); ?>">
            <span class="fa fa-thumbs-o-up"></span>
            <span class="xn-text">Efetivação de Solicitação</span></a>
          </li>
          <li class="<?php echo ($menupriativo=="integracoes")? "active":"" ?>">
            <a href="<?php echo base_url('rh/integracoes'); ?>">
              <span class="fa fa-cubes"></span>
              <span class="xn-text">Consulta Integrações</span></a>
            </li>

  </ul>
</li>

<li class="<?php echo ($menupriativo=="mensagem")? "active":"" ?>">
  <a href="<?php echo base_url('rh/mensagem') ?>">
    <span class="fa fa-comments-o"></span> <span class="xn-text">Mensagens</span>
  </a>                  
</li>

<li class="<?php echo ($menupriativo=="newsletter")? "active":"" ?>">
  <a href="<?php echo base_url('home/newsletter') ?>">
    <span class="fa fa-rss"></span> <span class="xn-text">Boletim Informativo</span>
  </a>
</li>