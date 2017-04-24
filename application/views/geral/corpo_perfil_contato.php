<div class="container-fluid">

         <div class="menuclasse">
          <div class="box" id="menu_principal">                   
                 <?php 
                    if($this->session->userdata('perfil_atual') == '1'){
                        $this->load->view('/geral/box/menu_colab',$menupriativo);
                    }
                    if($this->session->userdata('perfil_atual') == '2'){
                        $this->load->view('/geral/box/menu_gestor',$menupriativo);
                    }
                 ?>
             </div>
    </div>
    <div class="conteudomarg">
     
            <div class="menuclasse">  
                <div class="box">
                 <div  style="padding: 10px">
                     <img class="circuloM center-block" style=" margin-top: 10px;" src="<?php echo $this->session->userdata('foto') ?>"> 
                     <br/>
                     <p style="text-align: center; font-size: 20px; color: #337ab7"><?php echo $this->session->userdata('nome') ?></p>
                     <p style="text-align: center; font-size: 14px; color: #86a0b7; margin-top: -10px"><?php echo $this->session->userdata('cargo') ?></p>
                     <div class="divisao_pontim"></div>
                  </div>                 
                  <?php $this->load->view('/geral/box/menu_colab_perfil',$menu_colab_perfil); ?>    
                     
                
             </div>
         </div>
         <div class="conteudomarg">              
             <div class="box">
                 <div class="padding">
                     <div class="row" >
                                <div class="col-sm-8" ><p class="tit">Contrato</p></div>
                                <div class="col-sm-4 text-right"><a href="<?php echo base_url().'perfil_edit/pessoal_info' ?>" class=" btn btn-sm btn-default " id="editdados"><span class="glyphicon glyphicon-pencil"></span> Editar</a></div>
                            </div>
              
                     <div class="divisao_pontim"></div>
                     teste
                 </div>
             </div>
             <div class="box">
                 <div class="padding">
                     <p class="tit">Minhas Competências</p>
                     <div class="divisao_pontim"></div>
                     teste
                 </div>
             </div>
         </div>
    </div>
</div> 
    
<script>
    $('#collapseTwo').collapse();
</script>


