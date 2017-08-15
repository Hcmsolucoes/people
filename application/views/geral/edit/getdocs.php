<table id="tbdocs" class="table table-striped table-hover" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Arquivo</th>
            <th>Ações</th>            
       </tr>
  </thead>
  <tbody>
   <?php foreach ($docs as $key => $value) { 
       //$data = $this->Log->alteradata1( $value->nascimento_depadmissao );
       //$sexo = ($value->sexo_depadmissao==1)? "Masculino" :"Feminino" ;
       ?>

       <tr class="" id="trdoc<?php echo $value->id_admissaodoc; ?>" style="cursor: pointer;">

           <td class="" "><?php echo $value->arquivo_admissao ?></td>
           <td >
            <span data-id="<?php echo $value->id_admissaodoc; ?>" data-arq="<?php echo $value->arquivo_admissao ?>"" class="fa fa-eye verdoc" style="cursor: pointer;margin-right: 7px;"></span>

           <span data-id="<?php echo $value->id_admissaodoc; ?>" class="fa fa-times excdoc" style="cursor: pointer;"></span>
           </td>

      </tr>
      <?php } ?>
 </tbody>
</table>