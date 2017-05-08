<li class="<?php echo ($menupriativo=="inicio")? "active":"" ?>">
<a href="<?php echo base_url('admin') ?>">
  <span class="fa fa-home"></span>
  <span class="xn-text">Início</span></a>
</li>

<li class="<?php echo ($menupriativo=="chefia")? "active":"" ?>">
<a href="<?php echo base_url('admin/chefia') ?>">
  <span class="fa fa-cogs"></span>
  <span class="xn-text">Chefia</span></a>
</li>     

<li class="<?php echo ($menupriativo=="parametros")? "active":"" ?>">
<a href="<?php echo base_url('admin/parametros') ?>">
  <span class="fa fa-sitemap"></span>
  <span class="xn-text">Parâmetros Empresa</span></a>
</li>

<li class=" <?php echo ($menupriativo=="acesso")? "active":"" ?>">
<a href="<?php echo base_url('admin/acesso') ?>">
  <span class="fa fa-cogs"></span>
  <span class="xn-text">Redefinir Acessos</span></a>
</li>