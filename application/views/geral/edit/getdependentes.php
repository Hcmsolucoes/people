<table id="tbdep" class="table table-striped table-hover" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Parentesco</th>
            <th>CPF</th>
            <th>Sexo</th>
            <th>Imposto de Renda</th>
            <th>Auxilio Família</th>
            <th>Nome da Mãe</th>
            <th>Excluir</th>
       </tr>
  </thead>
  <tbody>
   <?php foreach ($dependente as $key => $value) { 
       $data = $this->Log->alteradata1( $value->nascimento_depadmissao );
       $sexo = ($value->sexo_depadmissao==1)? "Masculino" :"Feminino" ;
       ?>

       <tr class="" id="tr<?php echo $value->id_dependenteadmissao; ?>" style="cursor: pointer;">

           <td ><?php echo $value->nome_depadmissao ?></td>
           <td ><?php echo $data; ?></td>
           <td ><?php echo $value->descricao; ?></td>
           <td ><?php echo $value->cpf_depadmissao; ?></td>
           <td ><?php echo $sexo; ?></td>
           <td ><?php echo ($value->ic_ir_depadmissao==1)? "Sim" :"Não"; ?></td>
           <td ><?php echo ($value->ic_auxfamilia==1)? "Sim" :"Não"; ?></td>
           <td ><?php echo $value->nomemae; ?></td>
           <td ><span data-id="<?php echo $value->id_dependenteadmissao; ?>" class="fa fa-times excdep" style="cursor: pointer;"></span></td>

      </tr>
      <?php } ?>
 </tbody>
</table>