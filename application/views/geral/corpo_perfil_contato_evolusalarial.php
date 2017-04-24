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
                     <p class="tit">Evolução salarial</p>
                     <div class="divisao_pontim"></div>
                     
                     <form >
                         <div class="row">
                             <div class="col-sm-6 col-md-3">
                                 <div class="form-group">
                                     <label class="form-label">Data Inicial</label>
                                     <input placeholder="__/__/____" class="form-control date-picker" name="startDate" ui-mask="99/99/9999" required="" type="text"> 
                                 </div>
                             </div>
                             <div class="col-sm-6 col-md-3">
                                 <label class="form-label ">Data Final</label>
                                 <input placeholder="__/__/____" class="form-control date-picker" name="startDate" ui-mask="99/99/9999" required="" type="text"> 
                             </div>
                             <div class="col-sm-12 col-md-6">
                                 <div class="form-group">
                                     <label class="form-label" for="">Motivos da alteração salarial</label>
                                 </div>
                             </div>
                         </div>
                 
                        <hr>
                        <div class="row"><div class="col-md-12"><button type="submit" class="btn btn-primary ng-binding" ng-disabled="vm.salaryEvolutionFilterForm.$invalid">Visualizar Gráfico</button> <a class="btn btn-link ng-binding" ng-click="vm.clear()">Limpar</a></div></div></form>
                      
            
             </div>
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

