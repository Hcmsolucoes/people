<?php
	foreach ($funcionario as $value) {
		$nome = $value->fun_nome;
		$nacionalidade = $value->fun_nacionalidade;
		$sexo = ($value->fun_sexo==1)? "Masculino":"Feminino";
		$estadocivil = $value->estciv_descricao;
		$cargo = $value->fun_cargo;
		$datanascimento = $value->fun_datanascimento;
		$racacor = $value->etnia_descricao;
		$escolaridade = $value->escolaridade_descricao;
		$naturalidade = $value->fun_naturalidade;
		$email = $value->fun_email;
		$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
		$foto = (empty($value->fun_foto) )? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
		$nasc = (strtolower($sexo)=="feminino")? "nascida em " : "nascido em ";
		$endereco =  $value->end_rua.', '.$value->end_numero.' '.$value->end_complemento.' '.$value->bair_nomebairro.' '.$value->cid_nomecidade.'  '.$value->est_nomeestado.'  '.$value->end_pais;
	}
	//print_r($parametros);
	$this->load->model('Log');
	
?>
<style type="text/css">
    .altfoto{
	text-align: center;
	position: absolute;
	background-color: rgba(8, 8, 8, 0.29);
	z-index: 99;
	width: 100%;
	color: #fff;
	padding: 7px;
	cursor: pointer;
	font-weight: bold;
	display: none;
    }
    .altfoto [type=file]{
	
	filter: alpha(opacity=0);
	opacity: 0;
	top: 0px;
	position: absolute;
    }
</style>
<div class="row">
	<div class="alert alert-success acenter bold" role="alert" style="display: none;font-size: 20px;"></div>
	
    <div class="col-md-3">
		
        <div class="panel panel-default" id="pictureprofile">
			
            <div class="altfoto">Alterar Foto </div>
			
            <div class="panel-body profile" style="background: url(<?php echo base_url('img/fundoperfil2.jpg'); ?> ) center center no-repeat;">
                <div class="profile-image" id="foto_perfil">
                    <img class="imgcirculo_r" src="<?php echo $foto ?>" alt=""/>
				</div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $nome ?></div>
                    <div class="profile-data-title" style="color: #FFF;"><?php echo $cargo ?></div>
                    <div class="profile-data-title" style="color: #FFF;"><?php echo $email ?></div>
				</div>
			</div>                                
			
            <div class="panel-body list-group border-bottom">
                <a href="#pessoal" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item active">
				<span class="fa fa-bar-chart-o"></span> Dados Pessoais
                </a>
                <a href="#familiar" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-users"></span> Ficha Familiar
                </a>
                <a href="#hist" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-book "></span> Históricos
                </a>
                <a href="#prof" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-male"></span> Perfil Profissional
                </a>
                <a href="#acad" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-graduation-cap"></span> Perfil Acadêmico
                </a>
                <a href="#treinamento" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-book"></span> Treinamento
                </a>
                <a href="#trab" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-file-text-o"></span> Contrato de Trabalho
                </a>
                <a href="#holerite" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-money"></span> Demonstrativo de Pagamento
                </a> 
                <?php if (!empty($parametros)) { 
                    if($parametros->ic_visualizarponto == 1){ ?>
					<a href="#tabespelho" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
                    <span class="fa fa-clock-o"></span> Espelho do Ponto
					</a>
				<?php } } ?>
                
                <a href="#tabrecibo" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-paper-plane"></span> Recibo de Férias
                </a>
                <a href="#tabinforme" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-tachometer"></span> Informe de Rendimento
                </a>
                <!--<a href="#beneficios" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
					<span class="fa fa-heart"></span> Meus Benefícios
				</a>-->
                <a href="#privacidade" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-lock"></span> Privacidade
                </a>
                <a id="alterarsenha" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">
				<span class="fa fa-key"></span> Alterar Senha
                </a>
				
			</div>
			
			<!--<div class="panel-body">
                <h4 class="text-title">Equipe de Trabalho</h4>
                
                <?php 
					
					foreach ($equipe as $key => $value) {
						$arrnome = explode(" ", $value->fun_nome);
						$nomeeq = $arrnome[0];
						$avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
						$fotoeq = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
						$id = $value->fun_idfuncionario;
					?>
					
                    <div class="col-md-4 col-xs-4">
					<a href="<?php echo base_url("/perfil/pessoal_publico"."/".$id); ?>" class="friend">
					<img src="<?php echo $fotoeq; ?>" style="width: 60px;height: 60px;" />
					<span><?php echo $nomeeq; ?></span>
					</a>                                            
                    </div>
				<?php } ?>
				
				
			</div> -->
		</div>                            
		
	</div>
	
    <div class="col-md-9">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="pessoal">
                
                <div class="widget widget-default">
                    <h3 class=""><span class="fa fa-bar-chart-o"></span> Dados Pessoais
						<?php if ($parametros->ic_dadospessoais==1) { ?>
							<a href="#" id="editdados" class="fright"><i class="fa fa-edit"></i></a>
						<?php } ?>
					</h3>
					
                    <div class="">
                        <span class="bold"><?php echo $nome ?></span>
                        <div class="clearfix"></div>
                        
                        <span class="fleft"><?php echo $nacionalidade ?>, <?php echo $estadocivil ?>, <?php echo $sexo ?></span>
                        <div class="clearfix"></div>
						
                        <span class="fleft">Naturalidade: <?php echo $naturalidade ?>,&nbsp;</span>
                        <span class="fleft"><?php echo $nasc . $this->Log->alteradata1($datanascimento) ?></span>
						
                        <div class="clearfix"></div>
						
                        <span class="fleft">Etnia <?php echo $racacor ?> </span>
                        <span class="fleft">&nbsp;e escolaridade <?php echo $escolaridade ?></span>
						
					</div>
				</div>
                
                <div class="widget widget-default">
                    <h3 class=""><span class="glyphicon glyphicon-phone-alt"></span> Contatos Telefônicos
						<?php if ($parametros->ic_telefones==1) { ?>
                            <a href="#" id="editcontatosemer" class="fright"><i class="fa fa-plus-circle"></i></a>
						<?php } ?>
					</h3>
					<?php  foreach ($contato as $value) { ?>
						
						<div class="fleft">
							<?php echo $value-> con_nome ?> (<?php echo $value->con_parentesco ?>)
						</div>
						<div class="col-sm-6 text-right fright" >
							<?php
								if($value-> con_ramal){ $ramal = 'ramal '.$value-> con_ramal;}else{$ramal ='';}
							echo $value-> con_ddi. ' '.$value-> con_ddd. ' '.$value-> con_telefone.' '.$ramal.' '.$value->con_operadora ?>
							
							<?php if ($parametros->ic_telefones==1) { ?>
								<i type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm editarconto" id="<?php echo $value->con_idcontato?>">
									<span class="fa fa-pencil"></span>
								</i>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					<?php } ?>
				</div>
				
                <div class="widget widget-default">
                    <h3 class=""><span class="fa fa-envelope-o"></span> Contatos Eletrônicos
						<?php if ($parametros->ic_contatos==1) { ?>
							<a href="#" id="editcontatos" class="fright">
							<i class="fa fa-edit"></i>
                            </a>
						<?php } ?>
					</h3>
                    <div class="col-sm-6">
                        <span class="bold">E-mails:</span>
                        <div class="clearfix"></div>
                        <?php  foreach ($emails as $value) { ?>                                
							<a id="e<?php echo $value->ema_idemail; ?>" class="" href="mailto:<?php echo $value->ema_email ?>"><?php echo $value->ema_email ?>
							</a>
							<div class="clearfix"></div>
						<?php } ?>
					</div>
                    <div class="col-sm-6">
                        <span class="bold">Redes Sociais</span>
                        <div class="clearfix"></div>
                        <?php  foreach ($redesocial as $value) { ?>
							<div class="" id="r<?php echo $value->rede_idredesocial; ?>">
								<?php echo $value->rede_tipo.' '.$value->rede_nomeuser ?>                               
							</div>
						<?php } ?>
					</div>
                    <div class="clearfix"></div>
				</div>
				
                <div class="widget widget-default">
                    <h3 class="content-box-header"><span class="fa fa-gamepad"></span> Interesses Pessoais
						<a href="#" id="interesse" class="fright">
						<i class="fa fa-edit"></i>
						</a>
					</h3>
                    <div class="content-box-wrapper">
                        <ul class="list-group ">
							<?php foreach ($interessepessoal as $value) {?>
								
								<li class="list-group-item naosel inter<?php echo $value->inter_idinteressepessoal?>">
									<span class="bold"><?php echo $value->inter_area?></span>
									<div class="">
										<span class="">
											<?php echo $value->inter_areadetalhe?>
										</span>                                                    
									</div>                                                                               
								</li>                                            
								
							<?php } ?>
						</ul>                      
						
					</div>
				</div>
				
                <div class="widget widget-default">
					
					<h3 class=""><span class="fa fa-globe"></span> Endereços
						<?php if ($parametros->ic_endereco==1) { ?>
							<!--<a href="#" id="editenderecos" class="fright">
                                <i class="fa fa-edit"></i>
							</a>-->
						<?php } ?>
					</h3>
					
					<span>
						<?php echo $endereco; ?>                           
					</span><div class="clearfix"></div>                   
					
				</div>
				
                <div class="widget widget-default">
					<?php foreach ($documentos as $value) {?>   
						
						<h3 class=""><span class="fa fa-file-text-o"></span> Documentos
							<?php if ($parametros->ic_documentos==1) { ?>
								<!--<a href="#" id="editdocumentos" class="fright">
									<i class="fa fa-edit"></i>
								</a>-->
							<?php } ?>
						</h3>                     
						
						<table class="table table-condensed table-responsive table-no-border-top">
							<tbody>
								<tr class="" style=" border: none">
									<th class="text-right col-md-3 col-xs-4" style="border: none">RG</th>
									<td class="col-md-9 col-xs-6" style=" border: none">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_rg ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Órgão Emissor/UF</span><br>
												<span class="font-sub"><?php echo $value->doc_rg_orgaoemissor ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_rg_dataemis)?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4">NIS</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_nis ?></p>
											</div>
											<div class="col-sm-6">
												<span class="font-sub ">Data de Registro</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_nis_dataregistro)?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4">CTPS
										</th><td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_ctps ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Série</span><br>
												<span class="font-sub"><?php echo $value->doc_ctps_serie ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Dígito</span><br>
												<span class="font-sub"><?php echo $value->doc_ctps_digito ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">UF</span><br>
												<span class="font-sub"><?php echo $value->doc_ctps_uf ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_ctps_dataemis)?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4">CNH</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_cnh ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Categoria</span><br>
												<span class="font-sub"><?php echo $value->doc_cnh_categoria ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Órgão Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_cnh_orgaoemissor ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_cnh_dataemis)?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Expiração</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_cnh_dataexpira)?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4 ">Passaporte</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4"><span class="font-sub ">Número</span><br>
											<span class="font-sub"><?php echo $value->doc_passaporte ?></p></div>
											<div class="col-sm-4">
												<span class="font-sub ">Emissor</span><br>
											<span class="font-sub"><?php echo $value->doc_passaporte_emissor ?></p></div>
											<div class="col-sm-4" >
												<span class="font-sub ">Órgão Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_passaporte_orgaoemissor ?></p>
											</div>
											<div class="col-sm-4 ng-hide">
												<span class="font-sub ">Estado Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_passaporte_estadoemis ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">País Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_passaporte_paisemis ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_passaporte_dataemissao)?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Data de Expiração</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_passaporte_dataexpira)?></p>
											</div>
										</div>
									</td>
									</tr><tr class="" >
									<th class="text-right col-md-3 col-xs-4 ">Visto</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_visto ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_visto_dataemissao)?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Data de Expiração</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_visto_dataexpira)?></p>
											</div>
											<div class="col-sm-12" >
												<span class="font-sub ">Tipo de Visto</span><br>
												<span class="font-sub"><?php echo $value->doc_visto_tipo ?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="" >
									<th class="text-right col-md-3 col-xs-4">RNE</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_rne ?></p>
												</div><div class="col-sm-4">
												<span class="font-sub ">Órgão Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_rne_orgaoemissor ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_rne_dataemissao)?></p>
											</div>
										</div>
									</td>
									</tr><tr class="">
									<th class="text-right col-md-3 col-xs-4 ">Certidão e Outros</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4" >
												<span class="font-sub ">Nº do Livro</span><br>
												<span class="font-sub"><?php echo $value->doc_certidaooutros_livro ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Nº da Folha</span><br>
												<span class="font-sub"><?php echo $value->doc_certidaooutros_folha ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Nome do Cartório</span><br>
												<span class="font-sub"><?php echo $value->doc_cert_nomecartorio ?></p>
												</div><div class="col-sm-4">
												<span class="font-sub ">Nº do Termo</span><br>
												<span class="font-sub"><?php echo $value->doc_certidaooutros_termo ?></p>
												</div><div class="col-sm-4" >
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_certidaooutros_dataemissor)?></p>
												</div><div class="col-sm-4" >
												<span class="font-sub ">Localidade</span><br>
												<span class="font-sub"><?php echo $value->doc_certidaooutros_localidade ?></p>
											</div>                                         
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4">RIC</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_ric ?></p>
											</div>
											<div class="col-sm-4" >
												<span class="font-sub ">Órgão Emissor</span><br>
												<span class="font-sub"><?php echo $value->doc_ric_orgaoemissor ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Data de Emissão</span><br>
												<span class="font-sub"><?php echo $this->Log->alteradata1($value->doc_ric_dataemissao)?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="" >
									<th class="text-right col-md-3 col-xs-4 ">Título de Eleitor</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-4">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_titulo ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Seção Eleitoral</span><br>
												<span class="font-sub"><?php echo $value->doc_titulo_secao ?></p>
											</div>
											<div class="col-sm-4">
												<span class="font-sub ">Zona Eleitoral</span><br>
												<span class="font-sub"><?php echo $value->doc_titulo_zona ?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4 ">Certificado de Reservista</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-sm-6">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_reservista ?></p>
												</div><div class="col-sm-6">
												<span class="font-sub ">Categoria</span><br>
												<span class="font-sub"><?php echo $value->doc_reservista_categoria ?></p>
											</div>
										</div>
									</td>
								</tr>
								<tr class="">
									<th class="text-right col-md-3 col-xs-4 ">Cartão Nacional de Saúde</th>
									<td class="col-md-9 col-xs-6">
										<div class="row">
											<div class="col-xs-12">
												<span class="font-sub ">Número</span><br>
												<span class="font-sub"><?php echo $value->doc_cartaosaude ?></p>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>                
					<?php } ?>
				</div>
				
				<div class="widget widget-default">
					<h3 class=""><span class="fa fa-usd"></span> Dados Bancários</h3>
					<?php foreach ($dadosbancarios as $value) { 
						$banc = (empty($value->banc_nome))?"Sem informação" : $value->banc_nome ; 
					?>   
					
					<table class="table table-condensed table-responsive">
						<thead>
							<tr>
								<th class="text-left no-border-top ">Banco</th>
								<th class="text-left no-border-top ">Agência</th>
								<th class="text-left no-border-top ">Conta</th>
							</tr>
						</thead>
						<tbody>
							<tr class="">
								<td class="text-left "><?php echo $banc ?></td>
								<td class="text-left "><?php echo $value->banc_agencia ?></td>
								<td class="text-left "><?php echo $value->banc_conta ." - ".$value->banc_contadig ?></td>
							</tr>
						</tbody>
					</table>
					<?php } ?>
				</div>
				
				
			</div><!--panel pessoal-->
            
            <div role="tabpanel" class="tab-pane" id="familiar">
                <div class="widget widget-default">
                    <h3 class=""><span class="fa fa-users"></span> Ficha Familiar</h3>
					<div class="list-group">
						<?php foreach ($dependentes as $key => $value) {  
							
							$sexo = ($value->TipSex=="M")? "masculino" : "feminino" ;
							$nascido = ($value->TipSex=="M")? "nascido" : "nascida" ;
							$datanasc = new DateTime( $value->nascimento ); // data de nascimento
							$idade = $datanasc->diff( new DateTime() ); // data definida
							$avatar = ( $value->TipSex=="M" )?"avatar1":"avatar2";
							$foto = ($value->depfoto=="")? base_url("/img/".$avatar.".jpg") : $value->depfoto;
							
						?>
						<a href="#" class="meuitem">
                        <div class="fleft" >
							<img class=" imgcirculo_p" style="margin: 25px 20px 0px 0px" src="<?php echo $foto; ?>">
						</div>
						
						<div class="fleft font-sub" >
							<h4 class="bold"><?php echo $value->dep_nome; ?></h4>
							<span class="font-sub"><?php echo $value->descricao." - "; ?></span>
							<span class="font-sub">sexo <?php echo $sexo.","; ?></span>
							<span class="font-sub"><?php echo $value->estadocivil.","; ?></span>
							<span class="font-sub"><?php echo $nascido." em ". $this->Log->alteradata1($value->nascimento).$idade->format( ' (%Y anos), ' ); ?></span>
							
							<div class="clearfix"></div>
							
							<span class="font-sub"><?php echo $value->escolaridade; ?></span>
							
							<div class="clearfix"></div>
							
							<span class="font-sub">Cálculos inclusos: </span>
							<?php if ($value->depirf=="S") { ?><span class=" colorprimary"><b>IRRF, </b></span><?php } ?>
							
							<?php if ($value->depsal=="S") { ?><span class=" colorprimary">Salário Família </span><?php } ?>
							<div class="clearfix"></div>
							
							<span class="font-sub">Deficiência: <?php echo $value->deficiencia; ?></span>
						</div>
                        <div class="clearfix"></div>
						
						</a>
						<?php }  ?>
					</div>
				</div>
			</div>
			
			
            <div role="tabpanel" class="tab-pane" id="hist">
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico de Cargos</h3>
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Cargo</th>
								<th>Empresa</th>
								<th>Início</th>
								<th>Motivo</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histcargos as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value->descricao; ?></td>
                                    <td><?php echo $value->em_nomefantasia  ?></td>
                                    <td><?php echo $this->Log->alteradata1( $value->car_inicio ) ?></td>
                                    <td><?php echo $value->motivo  ?></td>
								</tr>
							<?php }  ?>
						</tbody>
					</table>
				</div>
				
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico Salarial</h3>
					
					<table class="table table-striped table-hover" >
						<thead>
							<tr>
								<th>Motivo</th>
								<th>Valor</th>
								<th>Percentual</th>
								<th>Data</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                $porc="";
                                if (count($histsalarios)>1) {
									/*   $ult_salario = $histsalarios[count($histsalarios) -1]->sal_valor;
										$pri_salario = $histsalarios[0]->sal_valor;
										$porcentagem = 100 - (($pri_salario * 100) / $ult_salario);
										$porc = number_format($porcentagem, 2). "%";                                  
									*/ }
									
									$sal =0;
									foreach ($histsalarios as $key => $value) {
										
										$porcentagem = 100 - (($sal * 100) / $value->sal_valor);
										$porc = number_format($porcentagem, 2). "%";
										$sal = $value->sal_valor;
										
										$valor = number_format($value->sal_valor, 2,".", ",");
										$datadeinicio = $this->Log->alteradata1( $value->sal_dataini );
									?>
									<tr>
										<td><?php echo $value->motivo; ?></td>
										<td><?php echo "R$ " . $valor;  ?></td>
										<td><?php echo $porc;  ?></td>
										<td><?php echo $datadeinicio; ?></td>
									</tr>
							<?php }  ?>
							<!--<tr>
								<td></td>
								<td class="green bold"><?php echo $porc; ?> <span class="fa fa-arrow-up"></span> </td>
								<td></td>
							</tr>-->
						</tbody>
					</table>
				</div>
				
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico de Afastamentos</h3>
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Motivo</th>
								<th>Início</th>
								<th>Fim</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histafastamento as $key => $value) { 
								$afainicio = $this->Log->alteradata1($value->afa_inicio); 
								$afafim = $this->Log->alteradata1($value->afa_fim);
							?>
							<tr>
								<td><?php echo $value->descricao; ?></td>
								<td><?php echo $afainicio;  ?></td>
								<td><?php echo $afafim;  ?></td>
							</tr>
							<?php }  ?>
							<!--<tr>
								<td>Total de <span class="red bold"><?php echo count($histafastamento); ?></span> afastamentos</td>
								<td></td>
								<td></td>
							</tr>-->
						</tbody>
					</table>
				</div>
				
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico de Centro Custo</h3>
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Descrição</th>                                    
								<th>Empresa</th>
								<th>Início</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histcentrocusto as $key => $value) { 
								$centroinicio = $this->Log->alteradata1($value->hiscus_inicio); 
							?>
							<tr>
								<td><?php echo $value->descricao; ?></td>
								<td><?php echo $value->em_nomefantasia;  ?></td>
								<td><?php echo $centroinicio;  ?></td>
							</tr>
							<?php }  ?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico de Escalas</h3>
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Data de início</th>
								<th>Empresa</th>
								<th>Descrição</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histescalas as $key => $value) { 
								$inicio = $this->Log->alteradata1($value->hisesc_inicio); 
								//$afafim = $this->Log->alteradata1($value->afa_fim);
							?>
							<tr>
								<td><?php echo $inicio; ?></td>
								<td><?php echo $value->em_nomefantasia;  ?></td>
								<td><?php echo $value->descricao;  ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				
				
                <div class="widget widget-default">
					<h3 class=""><span class="fa fa-book "></span> Histórico de Departamentos</h3>
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Empresa</th>
								<th>Departamento</th>
								<th>Data de início</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histdepartamento as $key => $value) { 
								$inicio = $this->Log->alteradata1($value->hisdep_inicio); 
								//$afafim = $this->Log->alteradata1($value->afa_fim);
							?>
							<tr>
								<td><?php echo $value->em_nomefantasia;  ?></td>
								<td><?php echo $value->descricao;  ?></td>
								<td><?php echo $inicio; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				
				
				
			</div><!-- tab historicos -->
			
			<div role="tabpanel" class="tab-pane" id="prof">
				<div class="widget widget-default">
					<h3 class=""><span class="fa fa-male"></span> Resumo do Perfil Profissional
						<?php if ($parametros->ic_perfilprofissional==1) { ?>
							<a href="#" id="editresumo" class="fright">
							<i class="fa fa-edit"></i>
							</a>
						<?php } ?>
					</h3>
					<div class="">
						
						<?php foreach ($perfil_profissional as $value) { ?>
							<span class="texto"><?php echo $value -> perfil_resumo; ?></span>
						<?php  } ?>
						
					</div>
				</div>
			</div>
			
            <div role="tabpanel" class="tab-pane" id="acad">
                <div class="widget widget-default">
                    <h3 class=""><span class="fa fa-graduation-cap"></span> Perfil Acadêmico
                        <?php if ($parametros->ic_academico==1) { ?>
							<a href="#" id="editacad" class="fright">
                            <i class="fa fa-edit"></i>
							</a>
						<?php  } ?>
					</h3>
                    <div class="list-group ">
                        <?php foreach ($formacao_academica as $value) {?>
							<a class="meuitem" id="aca<?php echo $value->for_idformacao?>">
                            <h5 class="bold"><?php echo $value->for_graduacao_curso?></h5>
                            <h5 class=" "><?php echo $value->for_educacao_nivel?></h5>
                            <div class="font-sub txleft">
								<span><?php echo $value->for_nome_facu?></span>
								<br>                               
								<span>Área de conhecimento: <?php echo $value->for_areaconhecimento?></span>
								<br>
								<span><?php $hoje = date("Y-m-d"); $data2 = date( $value->for_datafim );
									if( $hoje < $data2 ){ ?>
									Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> com previsão de conclusão em <?php echo $this->Log->alteradata1($value->for_datafim)?>            
									<?php }else{ ?>
									Iniciado em <?php echo $this->Log->alteradata1($value->for_datainicio)?> finalizado em <?php echo $this->Log->alteradata1($value->for_datafim)?>
								<?php } ?>
								</span>                                                    
								
								
							</div>
							<div class="fright" style="position: relative;bottom: 70px;">
								<span class="btn btn-default exc" id="<?php echo $value->for_idformacao?>">Excluir 
									<span class="fa fa-times"></span>
								</span>
							</div>                                           
							</a>
							
							<div class="clearfix"></div>
							
						<?php } ?>
					</div>
				</div>
			</div>
			
            <!--tab treinamentos-->
            <div role="tabpanel" class="tab-pane" id="treinamento">
				<div class="widget widget-default">
					<h3 class=""><span class="fa fa-book"></span> Histórico de Treinamentos</h3>
					
					<table class="table table-striped table-hover table-condensed">
						<thead>
							<tr>
								<th>Curso</th>
								<th>Data de início</th>
								<th>Data de término</th>
								<th>Carga horária</th>
								<th>Frequencia</th>
								<th>Situação</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($histrein as $key => $value) { 
								$inicio = $this->Log->alteradata1($value->hist_inicio); 
								$fim = $this->Log->alteradata1($value->hist_final);
								$horas = $this->util->minutosToHoras($value->hist_cargahoraria);
								
							?>
							<tr>
								<td><?php echo $value->nomecurso;  ?></td>
								<td><?php echo $inicio; ?></td>
								<td><?php echo $fim;  ?></td>
								<td><?php echo $horas;  ?></td>
								<td><?php echo $value->hist_frequencia . "%";  ?></td>
								<td><?php echo $value->descricao_status_treinamento;  ?></td>                                    
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div> <!--tab treinamentos-->
			
			
			<div role="tabpanel" class="tab-pane" id="trab">
				<div class="widget widget-default">
					<h3 class=""><span class="fa fa-file-text-o"></span> Contrato de Trabalho</h3>
					
					<?php foreach ($contratos as $value) {?>
						
						
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<span class="bold">Situação do contrato</span>
								<p class="cinza"><?php echo $value->contr_situacao?> </p>
							</div>
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Tipo de contrato</span >
								<p class="cinza"><?php echo $value->contr_tipo_contrato ?></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Data de admissão</span >
								<p class="cinza"><?php echo $this->Log->alteradata1($value->contr_data_admissao)?></p>
							</div>
						</div>
						
						<div class="row ng-scope">
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Matrícula</span >
								<p class="cinza"><?php echo $value->fun_matricula ?></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Ficha de registro</span >
								<p class="cinza"><?php echo $value->fun_registro ?></p>
							</div>
 							<div class="col-md-4 col-sm-6">
								<span  class="bold">Estabilidade provisória</span >
								<p class="cinza"><?php echo $value->contr_estabi_provisoria ?></p>
							</div>
						</div>
						
						<div class="clearfix separador"></div>
						
						<div class="row ng-scope">
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Cargo</span >
								<p class="cinza"><?php echo $value->contr_cargo ?><span  class="ng-binding ng-scope"><br></span ></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Código do CBO do cargo</span >
								<p class="cinza"><?php echo $value->contr_codigocbo_cargo ?></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<span  class="bold">Departamento</span >
							<p class="cinza"<?php echo $value->contr_departamento ?><span  class="ng-binding ng-scope"><br></span ></p>
						</div>
					</div>
					
					<div class="row ng-scope">
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Centro de custo</span >
							<p class="cinza"><?php echo $value->contr_centrocusto ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Escala de trabalho</span >
							<p class="cinza"><?php echo $value->contr_escala_trabalho ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Vínculo empregatício</span >
							<p class="cinza"><?php echo $value->contr_vinculo_empregaticio ?></p>
						</div>
					</div>
					
					<div class="clearfix separador" ></div>
					
					<div class="row ng-scope">
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Posto de trabalho</span >
							<p class="cinza"><?php echo $value->contr_posto_trabalho ?><span  class="ng-binding ng-scope"><br></span ></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Endereço</span >
							
							<p class="cinza"><?php echo $value->end_rua ?>, <?php echo $value->end_numero ?>, <?php echo $value->end_complemento ?><br>
							<?php echo $value->bair_nomebairro.', '.$value->cid_nomecidade.', '.$value->est_nomeestado.', '.$value->end_pais ?> - CEP <?php echo $value->end_cep ?></p>
							
						</div>
					</div>
					
					<div class="clearfix separador" ></div>
					
					<h4 class="ng-binding ng-scope">Empregador</h4>
					<div class="row ng-scope">
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Razão social</span >
							<p class="cinza"><?php echo $value->em_razaosocial ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Nome fantasia</span >
							<p class="cinza"><?php echo $value->em_nomefantasia ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Tipo do estabelecimento</span >
							<p class="cinza"><?php echo $value->em_tipo_estabelicimento ?></p>
						</div>
					</div>
					<div class="row ng-scope">
						<div class="col-md-4 col-sm-6">
							<span  class="bold">CNPJ</span >
							<p class="cinza"><?php echo $value->contr_cnpj ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">CNAE</span >
							<p class="cinza"><?php echo $value->contr_cnae ?></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<span  class="bold">Endereço</span >
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
			
			
		</div><!--tab contrato-->
		
		<div role="tabpanel" class="tab-pane" id="holerite">
			<div class="widget widget-default">
				
				<div id="holerith" data-acesso="0">
					<img id="loadholerite" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
				</div>
				
			</div>
			
		</div>
		<?php if (!empty($parametros)) { 
			if($parametros->ic_visualizarponto == 1){ ?>
			<div role="tabpanel" class="tab-pane" id="tabespelho">
				<div class="widget widget-default">
					
					<div id="espelho" data-acesso="0">
						<img id="loadespelho" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
					</div>
					
				</div>
				
			</div><?php } } ?>
			
			<?php  ?>
			<div role="tabpanel" class="tab-pane" id="tabrecibo">
				<div class="widget widget-default">
					
					<div id="espelhorecibo" data-acesso="0">
						<img id="loadespelho" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
					</div>
					
				</div>
				
			</div><?php ?>
			<?php  ?>
			<div role="tabpanel" class="tab-pane" id="tabinforme">
				<div class="widget widget-default">
					
					<div id="espelhoinforme" data-acesso="0">
						<img id="loadespelho" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading...">
					</div>
					
				</div>
				
			</div><?php ?>
			
			
			<?php
				
				if (is_object($privacidade)) {
					$icestado = ($privacidade->ic_estadocivil==1)? "checked" : "";
					$icnasc = ($privacidade->ic_nascimento==1)? "checked" : "";
					$icetnia = ($privacidade->ic_etnia==1)? "checked" : "";
					$icescol = ($privacidade->ic_escolaridade==1)? "checked" : "";
					$ictel = ($privacidade->ic_telefones==1)? "checked" : "";
					$icelet = ($privacidade->ic_eletronicos==1)? "checked" : "";
					$icinter = ($privacidade->ic_interesses==1)? "checked" : "";
					$icender = ($privacidade->ic_endereco==1)? "checked" : "";
					}else{
					$icestado = "";
					$icnasc = "";
					$icetnia = "";
					$icescol = "";
					$ictel = "";
					$icelet = "";
					$icinter = "";
					$icender = "";
				}
				
			?>
			<div role="tabpanel" class="tab-pane" id="privacidade">
				<div class="widget widget-default">
					<h3 class=""><span class="fa fa-lock"></span> Privacidade
					</h3>
					<div style="margin: 0px 0px 30px 0px">
						<span class="font-sub">Defina o que as pessoas poderão em seu perfil público.</span>
					</div>
					<div class="fleft-4">
						<form name="formprivacidade" id="formprivacidade">
							
							<div class="fleft-5" >
								<span class="bold">Exibir estado civil:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_estadocivil" <?php echo $icestado; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							
							<div class="fleft-5" >
								<span class="bold">Exibir data do aniversário:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_nascimento" <?php echo $icnasc; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="fleft-5" >
								<span class="bold">Exibir etnia:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_etnia" <?php echo $icetnia; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="fleft-5" >
								<span class="bold">Exibir escolaridade:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_escolaridade" <?php echo $icescol; ?> value="1"/>
									<span></span>
								</label>
							</div>
						</div>
						<div class="fleft-5">
							<div class="fleft-5" >
								<span class="bold">Exibir telefones:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_telefones" <?php echo $ictel; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							
							<div class="fleft-5" >
								<span class="bold">Exibir contatos eletrônicos:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_eletronicos" <?php echo $icelet; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="fleft-5" >
								<span class="bold">Exibir interesses pessoais:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_interesses" <?php echo $icinter; ?> value="1"/>
									<span></span>
								</label>
							</div>
							<div class="clearfix"></div>
							<div class="fleft-5" >
								<span class="bold">Exibir endereços:</span>
							</div>
							<div class="fleft-2">
								<label class="switch switch-small">
									<input type="checkbox" class="check" name="ic_endereco" <?php echo $icender; ?> value="1"/>
									<span></span>
								</label>
							</div>
						</form>
					</div>
				</div>
				
			</div>
			
			
	</div><!--tab content -->
	
	
	
</div>

<div class="clearfix"></div>
</div>

</div>

<script>
	$(document).ready(function(){
		$('a[href="#holerite"').on('shown.bs.tab', function (e) {
			
			if($( "#holerith" ).data("acesso")=="0"){
				$.ajax({             
					type: "POST",
					url: '<?php echo base_url("perfil/contrato_demonstrativo") ?>',
					dataType : 'html',
					secureuri:false,
					cache: false,
					data:{
					},              
					success: function(msg) 
					{    
						$( "#holerith" ).html(msg);
						$( "#holerith" ).data("acesso", 1);
					} 
				});
			}
		});
		
		$('a[href="#tabespelho"').on('shown.bs.tab', function (e) {
			
			if($( "#espelho" ).data("acesso")=="0"){
				$.ajax({             
					type: "POST",
					url: '<?php echo base_url("perfil/espelho_ponto") ?>',
					dataType : 'html',
					secureuri:false,
					cache: false,
					data:{
					},              
					success: function(msg) 
					{    
						$( "#espelho" ).html(msg);
						$( "#espelho" ).data("acesso", 1);
					} 
				});
			}
		});
		
		$('a[href="#tabrecibo"').on('shown.bs.tab', function (e) {
			
			if($( "#espelhorecibo" ).data("acesso")=="0"){
				$.ajax({             
					type: "POST",
					url: '<?php echo base_url("perfil/espelho_reciboferias") ?>',
					dataType : 'html',
					secureuri:false,
					cache: false,
					data:{
					},              
					success: function(msg) 
					{    
						$( "#espelhorecibo" ).html(msg);
						$( "#espelhorecibo" ).data("acesso", 1);
					} 
				});
			}
		});
		
		$('a[href="#tabinforme"').on('shown.bs.tab', function (e) {
			
			if($( "#espelhoinforme" ).data("acesso")=="0"){
				$.ajax({             
					type: "POST",
					url: '<?php echo base_url("perfil/espelho_informe") ?>',
					dataType : 'html',
					secureuri:false,
					cache: false,
					data:{
					},              
					success: function(msg) 
					{    
						$( "#espelhoinforme" ).html(msg);
						$( "#espelhoinforme" ).data("acesso", 1);
					} 
				});
			}
		});
		
		
		$(".list-group-item").click(function(){
		$(".list-group-item").removeClass("active");
		if( !$(this).hasClass("naosel") ){
		$(this).addClass("active");
		}
		
		});
		
		$("table tr th").css("vertical-align", "middle");
		
		$(".check").change(function(){
		
		$(this).prop("disabled", true);
		var check = $(this);
		var valor = check.prop("checked");
		var campo = check.attr("name");
		
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'ajax/perfilPrivacidade' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		campo : campo,
		valor : valor
		},              
		success: function(msg) 
		{    
		
		check.prop("disabled", false);
		
		} 
		});
		
		});
		
		});
		
		$( "#editacad" ).click(function(e) {
		e.preventDefault();   
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/academico_edit' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{    
		$("#titulomodal").text("Adicionar formação acadêmica");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');
		
		} 
		});
		});
		$( ".exc" ).click(function(e) {
		
		if(!confirm("Deseja excluir a formação acadêmica?")){
		return false;
		}
		
		e.preventDefault();
		id = $(this).attr('id');
		$('#aca'+id).slideUp("slow");
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/academico_remove' ?>',
		dataType : 'html',
		secureuri: false,
		data: {id : id },             
		success: function() {  
		
		$('#aca'+id).remove();
		
		} 
		});         
		});
		
		$( "#editdados" ).click(function(e) {
		e.preventDefault();  
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/pessoal_info' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{    
		$("#titulomodal").text("Dados Pessoais");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');
		
		} 
		});
		});
		$( "#editcontatos" ).click(function(e) {
		e.preventDefault();
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/pessoal_contato' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{
		$("#titulomodal").text("Editar Contatos Socias");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');
		
		} 
		});
		});
		$( "#editcontatosemer" ).click(function(e) {
		e.preventDefault();   
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/pessoal_contatoemer' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{
		$("#titulomodal").text("Adicionar Contato");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');                                                                     
		} 
		});
		});
		$( ".editarconto" ).click(function(e) {
		e.preventDefault(); 
		id = $(this).attr('id');
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/pessoal_contato_edit' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{ id : id
		},              
		success: function(msg) 
		{  
		$("#titulomodal").text("Editar Contatos");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');                                            
		} 
		});
		});
		
		$( "#interesse" ).click(function(e) {
		e.preventDefault();     
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/interesse_edit' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{    
		$("#titulomodal").text("Adicionar Interesses");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');
		
		} 
		});
		});
		
		$( "#editresumo" ).click(function(e) {
		e.preventDefault();     
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/pessoal_profissional' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{   
		$("#titulomodal").text("Perfil Profissional");
		$( "#dadosedit" ).html(msg); 
		$( "#myModal" ).modal("show");                                
		} 
		});
		});
		
		$( "#editenderecos" ).click(function(e) {
		e.preventDefault();     
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url("perfil_edit/pessoal_endereco") ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{
		$("#titulomodal").text("Editar Endereço");
		$( "#dadosedit" ).html(msg); 
		$( "#myModal" ).modal("show");                                
		} 
		});
		});
		
		
		$( "#alterarsenha" ).click(function(e) {
		e.preventDefault();     
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/alterar_senha' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{   
		$("#titulomodal").text("Alteração de Senha");
		$( "#dadosedit" ).html(msg); 
		$( "#myModal" ).modal("show");                                
		} 
		});
		});
		
		$("#foto_perfil").click(function(){
		$(".altfoto").click();
		});
		
		$("#foto_perfil").mouseover(function(){
		$(".altfoto").slideDown("slow");
		});
		
		$(".altfoto").click(function(){
		
		$.ajax({             
		type: "POST",
		url: '<?php echo base_url().'perfil_edit/foto_edit' ?>',
		dataType : 'html',
		secureuri:false,
		cache: false,
		data:{
		},              
		success: function(msg) 
		{    
		$("#titulomodal").text("Alterar Foto");
		$( "#dadosedit" ).html(msg);
		$('#myModal').modal('show');
		
		} 
		});
		});
		<?php 
		if(isset( $_SESSION['img'] ) ){ ?>
		$(".altfoto").click();
		<?php } ?>
		
		
		</script>
				