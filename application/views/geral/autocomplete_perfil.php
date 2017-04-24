
<div class="panel-body list-group list-group-contacts" > 

    <?php
    foreach ($lista as $key => $value) {

        $prinome = explode(" ", $value->fun_nome);
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = (empty($value->fun_foto) )? base_url("/img/".$avatar.".jpg") : $value->fun_foto;

        ?>

        <a href="<?php echo base_url("perfil/pessoal_publico/".$value->fun_idfuncionario); ?>" class="list-group-item fleft" data-nome="<?php echo $prinome[0]; ?>" id="<?php echo $value->fun_idfuncionario; ?>" data-foto="<?php echo $foto; ?>" style="line-height: 45px;width: 100%;cursor: pointer;">                                    
            <img src="<?php echo $foto; ?>" class="pull-left" />
            <p class="contacts-title"><?php echo $value->fun_nome; ?></p>
        </a>

        <?php } ?>

    </div>
