<div id="page-content-wrapper" class="rm-transition"> 

		
<?php //$this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>

 <div id="page-content">
   <div class="col-md-12">
	<div class="content-box">
                    <h3 class="content-box-header bg-primary">
                     Meu contrato de trabalho
			
                    </h3>
                    <div class="content-box-wrapper">
                       

					<?php foreach ($contratos as $value) {?>
                 
                                          
                     <div class="row">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Situação do contrato</small>
                             <p class="cinza"><?php echo $value->contr_situacao?> </p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Tipo de contrato</small>
                             <p class="cinza"><?php echo $value->contr_tipo_contrato ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Data de admissão</small>
                             <p class="cinza"><?php echo $this->Log->alteradata1($value->contr_data_admissao)?></p>
                         </div>
                     </div>
                     
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Matrícula</small>
                             <p class="cinza"><?php echo $value->fun_matricula ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Ficha de registro</small>
                             <p class="cinza"><?php echo $value->fun_registro ?></p>
                         </div><div class="col-md-4 col-sm-6">
                             <small class="bold">Estabilidade provisória</small>
                             <p class="cinza"><?php echo $value->contr_estabi_provisoria ?></p>
                         </div>
                     </div>
                     
					 <div class="clearfix separador"></div>
					 
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Cargo</small>
                             <p class="cinza"><?php echo $value->contr_cargo ?><small class="ng-binding ng-scope"><br></small></p>
                         </div><div class="col-md-4 col-sm-6">
                             <small class="bold">Código do CBO do cargo</small>
                             <p class="cinza"><?php echo $value->contr_codigocbo_cargo ?></p>
                         </div><div class="col-md-4 col-sm-6">
                             <small class="bold">Departamento</small>
                             <p class="cinza"<?php echo $value->contr_departamento ?><small class="ng-binding ng-scope"><br></small></p>
                         </div>
                     </div>
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Centro de custo</small>
                             <p class="cinza"><?php echo $value->contr_centrocusto ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Escala de trabalho</small>
                             <p class="cinza"><?php echo $value->contr_escala_trabalho ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Vínculo empregatício</small>
                             <p class="cinza"><?php echo $value->contr_vinculo_empregaticio ?></p>
                         </div>
                     </div>
                    
					<div class="clearfix separador" ></div>
					
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Posto de trabalho</small>
                             <p class="cinza"><?php echo $value->contr_posto_trabalho ?><small class="ng-binding ng-scope"><br></small></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Endereço</small>
                           
                                       <p class="cinza"><?php echo $value->end_rua ?>, <?php echo $value->end_numero ?>, <?php echo $value->end_complemento ?><br>
                                           <?php echo $value->bair_nomebairro.', '.$value->cid_nomecidade.', '.$value->est_nomeestado.', '.$value->end_pais ?> - CEP <?php echo $value->end_cep ?></p>
                                      
                         </div>
                     </div>
                     
                     <div class="clearfix separador" ></div>
                     
                     <h4 class="ng-binding ng-scope">Empregador</h4>
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Razão social</small>
                             <p class="cinza"><?php echo $value->em_razaosocial ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Nome fantasia</small>
                             <p class="cinza"><?php echo $value->em_nomefantasia ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Tipo do estabelecimento</small>
                             <p class="cinza"><?php echo $value->em_tipo_estabelicimento ?></p>
                         </div>
                     </div>
                     <div class="row ng-scope">
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">CNPJ</small>
                             <p class="cinza"><?php echo $value->em_cnpj ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">CNAE</small>
                             <p class="cinza"><?php echo $value->em_cnae ?></p>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <small class="bold">Endereço</small>
                             <?php  $this->db->select('*');
                                    $this->db->from('empresa');
                                    $this->db->join('endereco', 'endereco.end_idendereco = empresa.em_idendereco');  
                                    $this->db->where('em_idempresa',$value->em_idempresa );
                                    $endempresa = $this->db->get()->result(); 
                                    foreach ($endempresa as $endp) {?>
                                        <p class="cinza"><?php echo $endp->end_rua ?>, <?php echo $endp->end_numero ?>, <?php echo $endp->end_complemento ?><br>
                                           <?php echo $value->bair_nomebairro.', '.$value->cid_nomecidade.', '.$value->est_nomeestado.', '.$value->end_pais ?> - CEP <?php echo $endp->end_cep ?></p>
                             <?php } ?>
                         </div>
                     </div>
                 </div>
                 <?php } ?>
					   
						
                    </div>
            </div>
    </div>


</div> 

    <script>
    // abrir o menu pefil 
    $('#collapseTwo').collapse();
    $( ".abrefech" ).click(function(e) {
        e.preventDefault();
        
        if ($(this).find(".dvmais").html() === "+") {
            $(this).find(".dvmais").html("-");
        }
        else {
            $(this).find(".dvmais").html("+");
        }
       
    });
    </script>

