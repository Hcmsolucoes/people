<?php 
foreach ($chefe as $key => $value) {
  $nome = $value->fun_nome;
  $matricula = $value->fun_matricula;
  $admissao = $this->Log->alteradata1( $value->contr_data_admissao);
  $cargo = $value->fun_cargo;
  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
  $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
}

$total_subordinados = count($subordinados);
$total_m=0;
$total_f=0;

foreach ($subordinados as $key => $value) {

  ($value->fun_sexo ==1) ? $total_m++ : $total_f++;
 
}

?>

<div class="fleft" style="margin:0px 10px 0px 0px;">
    <img src="<?php echo $foto; ?>" style="border: 3px solid #ccc;max-width: 90px;border-radius: 20%;" >
    </div>

    <div class="fleft" style="line-height: 25px;">
    <span class="bold">Gestor: </span><span class="font-sub bold"><?php echo $nome; ?></span><br>
    <span class="bold">Matricula: </span><span class="font-sub bold"><?php echo $matricula; ?></span> 
    <span class="bold">Admissão: </span><span class="font-sub bold"><?php echo $admissao; ?></span><br>
    <span class="bold">Cargo: </span><span class="font-sub bold"><?php echo $cargo; ?></span> 
    </div>

    <div class="fright aright">
      <span class="bold">Total Subordinados: </span><span class="font-sub bold" ><?php echo $total_subordinados; ?></span><br>
      <span class="bold ">Masculinos: </span><span class="font-sub bold" ><?php echo $total_m; ?></span><br>
      <span class="bold">Femininos: </span><span class="font-sub bold" ><?php echo $total_f; ?></span><br>
    </div>