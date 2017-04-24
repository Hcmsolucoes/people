<?php 
$total_pessoas = count($equipe);
$total_m=0;
$total_f=0;
foreach ($equipe as $key => $value) { 
strcasecmp($value->fun_sexo, "Feminino") ? $total_m++ : $total_f++;
}

if(isset($funcionario)){
    foreach ($funcionario as $value) {
        $nome = $value->fun_nome;
        $cargo = $value->fun_cargo;
        $matricula = $value -> fun_matricula;
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
        $email = $value-> fun_email;
        $endereco1 = $value->end_rua.", ".$value->end_numero. " ".$value->end_complemento ;
        $endereco2 = "Bairro: ". $value->bair_nomebairro." - ".$value->cid_nomecidade. " / ".$value->est_nomeestado  ;
        $cep = $value->end_cep;
    }
}
?>
 
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-users"></span> Minha Equipe de Trabalho <small><?php echo $total_pessoas; ?> subordinados</small></h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Use a pesquisa para localizar colaboradores. Você pode pesquisar por nome, cargo, email etc...</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-search"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Quem você está procurando?"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary">Pesquisar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>                                    
                </div>
            </div>

        </div>
    </div>
<!--
   <div class="row">
   <div class="col-md-3">
     <div class="panel panel-default">
        <div class="panel-body profile">
            <div class="profile-image">
                <img src="<?php echo $value->fun_foto; ?>" alt="Hellen"/>
           
            </div>
            <div class="profile-data">
                <div class="profile-data-name"><?php echo $nome; ?></div>
                <div class="profile-data-title"><?php echo $cargo; ?></div>
            </div>
            <div class="profile-controls">
                <a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>
                <a href="#" class="profile-control-right"><span class="fa fa-phone"></span></a>
            </div>
        </div>                                
        <div class="panel-body">                                    
            <div class="contact-info">
                <p><small>Telefone</small><br/>(+55) 5555-4465</p>
                <p><small>Email</small><br/><?php echo $email; ?></p>
                <p><small>Endereço</small><br/><?php echo $endereco1 ; ?></p>
                <p><?php echo $endereco2 ; ?></p> 
                <p><small>CEP</small><br/><?php echo $cep ; ?></p>                                   
            </div>
        </div>                                
     </div>
   </div>
      -->


  <div class="col-md-12" >     
<div id="conteudo">

<?php 
$starray[0]="online";
$starray[1]="offline";
$starray[2]="away";

foreach ($equipe as $key => $value) {
  $admissao = $this->Log->alteradata1($value->contr_data_admissao); 
  $st = $starray[array_rand($starray)];
  $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
  $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
  ?>
  
<div class="col-md-4 btn-default list-group-item pessoa" id="<?php echo $value->fun_idfuncionario; ?>" style="height: 100px;">
   <div class="list-group-status status-<?php echo $st; ?>"></div>
   <img src="<?php echo $foto; ?>" class="imgcirculo_m fleft" style="margin: 0px 5px 25px 0px;" >
  <span class="font-sub bold corsec"><?php echo $value->fun_nome; ?></span><br>
  <span class="font-sub bold corsec">Cargo: </span><span class="font-sub"><?php echo $value->fun_cargo; ?></span><br>
  <span class="font-sub bold corsec">Departamento: </span><span class="font-sub"><?php echo $value->contr_cargo; ?></span><br>
  <span class="font-sub bold corsec">Situação: </span><span class="font-sub"><?php echo $value->contr_situacao; ?></span>
</div>

<?php } ?>
</div><!--conteudo-->
<div style="float:left; min-height: 600px;" ></div>
</div><!--colmd12-->


</div>



<script>
$(".pessoa").click(function(){
  
  var id = $(this).attr("id");

  $.ajax({          
      type: "POST",
      url: '<?php echo base_url()."ajax/jsonHierarquia";?>',
      dataType : 'html',
      secureuri:false,
      cache: false,
      data:{
        corpo: 2,
        chefe: id
      },
      success: function(msg){

        if(msg === 'erro'){
          alert("Houve um erro");
        }else{

          $("#conteudo").html(msg);

         }
         $("#load").fadeOut("slow");
       } 
     });
 });



  $(document).ready(function(){

  });
</script>