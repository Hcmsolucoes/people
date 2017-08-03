<img id="loadadm" style="display: none;position: absolute;left: 40%;top: 50%;z-index: 99;" src="<?php echo base_url('img/loaders/default.gif') ?>" >

<div class=" tabs" style="margin-top: 0px;">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#pessoais" role="tab" data-toggle="tab">Dados Pessoais</a></li>
			<li><a href="#dependentes" role="tab" data-toggle="tab">Dependentes</a></li>
		</ul>
<form id="formadmissao" class="form" method="post" action="<?php //echo base_url('home/salvar_admissao'); ?>">
		<div class="tab-content panel" style="padding: 15px 0px 0px 7px; min-height: 300px;">
			<div class="tab-pane active" id="pessoais">
				
					<div class="fleft md10" style="">

						<select name="adm_idfilial" required="true" id="cbofilial" class="md10" >
							<option value="">Filial</option>
							<?php 
							$selected = "";
							foreach ($filial as $key => $value) { 
								$selected = ($value->fil_idfilial==$admissao->adm_idfilial)? "selected":"";
								?>
							<option value="<?php echo $value->fil_idfilial; ?>" <?php echo $selected; ?>><?php echo $value->fil_nomefantasia; ?></option>
							<?php } ?>
						</select>

						<select name="fk_admdepartamento" required="true" id="departamento" class="md10" >
							<option value="">Departamento</option>
							<?php $selected = "";
							foreach ($departamentos as $key => $value) {
								$selected = ($value->iddpto==$admissao->fk_admdepartamento)? "selected":"";
							?>
							<option value="<?php echo $value->iddpto; ?>" <?php echo $selected; ?>>
							<?php echo $value->descricao; ?></option>
							<?php } ?>
						</select>						
					</div>

					<div class="fleft" style="margin-top: 10px;">
					
						<input type="text" name="nome_admissao" class="fleft fleftmobile md10 grande" placeholder="Nome Completo" required="true" value="<?php echo $admissao->nome_admissao; ?>">

						<select name="sexo_admissao" class="fleft fleftmobile md10"  required="true">
							<option value="">Sexo</option>
							<?php 
							$masc = ($admissao->sexo_admissao==1)? "selected":"";
							$fem =($admissao->sexo_admissao==2)? "selected":"";
							?>
							<option value="1" <?php echo $masc; ?>>Masculino</option>
							<option value="2" <?php echo $fem; ?>>Feminino</option>
						</select>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="data_admissao" class="pequeno data fleft" placeholder="Data admissão" required="true" data-date-start-date="+1d" value="<?php echo $this->Log->alteradata1($admissao->data_admissao); ?>">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>

						<select name="fk_cargo_admissao" required="true" id="selectcargo" class="selectpicker " data-live-search="true" data-div="resultado">
							<option value="">Cargo</option>
							<?php 
							$selected = "";
							foreach ($cargos as $key => $value) { 
								$selected = ($value->idcargo==$admissao->fk_cargo_admissao)? "selected":"";

							?>
							<option value="<?php echo $value->idcargo; ?>" <?php echo $selected; ?>>
							<?php echo $value->codigo_cargo. " - " .$value->descricao; ?></option>
							<?php } ?>
						</select>

						<select name="ic_emprego" class="fleft fleftmobile md10" required="true" >
						<?php 
							$reem = ($admissao->ic_emprego==2)? "selected":"";
							$prim =($admissao->ic_emprego==1)? "selected":"";
							?>
							<option value="">Emprego</option>
							<option value="2" <?php echo $reem; ?>>Reemprego</option>
							<option value="1" <?php echo $prim; ?>>Primeiro Emprego</option>
						</select>

						
					</div><!-- linha 1-->

					<!--linha3-->
					<div class="fleft" style="margin-top: 10px;">
						<div class="borda fleft md10" style="height: 155px;">
						<h4>Naturalidade</h4>
							<div class="fleft fleftmobile md10">
								<div class='input-group date' >
									<input type="text" name="dtnascimento_admissao" class="data fleft" placeholder="Data de Nascimento" required="true" value="<?php echo $this->Log->alteradata1($admissao->dtnascimento_admissao); ?>">
									<span class="input-group-addon fleft">
										<span class="fa fa-calendar" id=''></span>
									</span>
								</div>
							</div>
							<div class="clearfix"></div>
							<select name="fkestadonascimento" required="true" id="estado" class="fleft fleftmobile" style="margin-top: 7px;">
								<option value="">Estado</option>
								<?php 
								$selected = "";
								foreach ($estados as $key => $value) { 
									$selected = ($value->est_idestado==$admissao->fkestadonascimento)? "selected":"";
								?>
								<option value="<?php echo $value->est_idestado; ?>" <?php echo $selected; ?>>
								<?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
							</select>
							<div class="clearfix"></div>
							<select name="fkcidadenascimento" id="cidade" required="true" class="fleft fleftmobile" style="margin-top: 7px;">
							<?php 
							$selected = ""; 
							foreach ($cidades as $key => $value) { 
									$selected = ($value->cid_idcidade==$admissao->fkcidadenascimento)? "selected":"";
								?>
								<option value="<?php echo $value->cid_idcidade; ?>" <?php echo $selected; ?>>
								<?php echo $value->cid_nomecidade; ?></option>
								<?php } ?>
							</select>
							<div class="clearfix"></div>
							
						</div>

						<div class="fleft-3 fleftmobile md10 borda" style="">
							<h4>Horário Segunda a Sexta</h4>
							<div class="clearfix"></div>
							<div class="fleft-3 md10">
								<label>Entrada</label>
								<div class="clearfix"></div>
								<input type="text" name="horaentrada" class="hora fleft-10 fleftmobile " placeholder="" required="true" value="<?php echo $admissao->horaentrada; ?>">
							</div>
							<div class="fleft-3">
								<label>Saída/Intervalo</label>
								<div class="clearfix"></div>
								<input type="text" name="horasaidainter" class="hora fleft-10 fleftmobile " placeholder="" required="true" value="<?php echo $admissao->horasaidainter; ?>">
							</div>
							
							<div class="clearfix"></div>

							<div class="fleft-4 md10" style="margin-top: 10px;">
								<label>Entr./Inter.</label>
								<div class="clearfix"></div>
								<input type="text" name="horaentradainter" class="hora fleft-10 fleftmobile " placeholder="" required="true" value="<?php echo $admissao->horaentradainter; ?>">
							</div>
							<div class="fleft-3 " style="margin-top: 10px;">
								<label>Saída</label>
								<div class="clearfix"></div>
								<input type="text" name="horasaida" class="hora fleft-10 fleftmobile " placeholder="" required="true" value="<?php echo $admissao->horasaida; ?>">
							</div>
						</div>


						<div class="fleft-2 fleftmobile md10 borda" style="">
							<h4>Horário Sábado</h4>
							<div class="clearfix"></div>
							<div class="fleft">
								<label>Entrada</label>
								<div class="clearfix"></div>
								<input type="text" name="sabadoentrada" class="hora fleft-6 fleftmobile " placeholder="" value="<?php echo $admissao->sabadoentrada; ?>">
							</div>
							<div class="fleft" style="margin-top: 10px;">
								<label>Saída</label>
								<div class="clearfix"></div>
								<input type="text" name="sabadosaida" class="hora fleft-6 fleftmobile " placeholder="" value="<?php echo $admissao->sabadosaida; ?>">
							</div>
						</div>

						<div class="fleft-2 fleftmobile acenter borda md10" style="height: 155px;">
							<div class="bold">
								<span>Carga Horária Semanal</span><br>
								<span id="txthrsemanal"></span>
								<input type="hidden" name="hrsemanal" value="<?php echo $admissao->hrsemanal; ?>">
							</div>
							<div class="bold" style="margin-top: 19px">
								<span>Carga Horária Mensal</span><br>
								<span id="txthrmensal"></span>
								<input type="hidden" name="hrmensal">
							</div>
							<div class="bold" style="margin-top: 19px">
								<span>DSR</span><br>
								<span id="txthrdsr"></span>
								<input type="hidden" name="hrdsr">
							</div>
						</div>
					</div><!--linha3-->

					<div class="fleft" style="margin-top: 10px;">
					<div class="fleft-10 fleftmobile md10 borda" >
							<div class="fleft fleftmobile md10">

							<select name="adm_tipocontrato" class="fleft fleftmobile md10" required="true" style="margin-bottom: 20px;">
							
							<option value="">Tipo de contrato</option>
							<option value="1" <?php echo ($admissao->adm_tipocontrato==1)? "selected": ""; ?> >Empregado</option>
							<option value="2" <?php echo ($admissao->adm_tipocontrato==2)? "selected": ""; ?> >Diretor</option>
							<option value="4" <?php echo ($admissao->adm_tipocontrato==4)? "selected": ""; ?> >Aposentado</option>
							<option value="5" <?php echo ($admissao->adm_tipocontrato==5)? "selected": ""; ?> >Estagiário</option>
							<option value="6" <?php echo ($admissao->adm_tipocontrato==6)? "selected": ""; ?> >aprendiz</option>		
						</select>

						<select name="tiposalario_admissao" class="fleft fleftmobile md10" required="true" style="margin-bottom: 20px;">
						
							<option value="">Tipo de salário</option>
							<option value="1" <?php echo ($admissao->tiposalario_admissao==1)? "selected": ""; ?> >Mensalista</option>
							<option value="2" <?php echo ($admissao->tiposalario_admissao==2)? "selected": ""; ?>>Horista</option>
							<option value="3" <?php echo ($admissao->tiposalario_admissao==3)? "selected": ""; ?>>Diarista</option>
							<option value="4" <?php echo ($admissao->tiposalario_admissao==4)? "selected": ""; ?>>Comissionado</option>
							<option value="5" <?php echo ($admissao->tiposalario_admissao==5)? "selected": ""; ?>>Tarefeiro</option>
							<option value="6" <?php echo ($admissao->tiposalario_admissao==6)? "selected": ""; ?>>Terceiro</option>		
						</select>
						</div>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
							<span class="input-group-addon fleft">
									<span class="" id='' style="margin-left: -5px;">R$</span>
								</span>
								<input type="text" name="salario_admissao" class="pequeno campomoeda fleft" placeholder="Salário" required="true" value="<?php echo number_format($admissao->salario_admissao, 2, ",", "."); ?>">
								
							</div>
						</div>
						</div>
					</div>

					<!--linha 3-->
					<div class="fleft" style="margin-top: 10px;">
					<h4>Documentos</h4>
						<input type="number" name="nr_ctps" required="true" class="fleft fleftmobile md10" placeholder="CTPS N&ordm;" value="<?php echo trim($admissao->nr_ctps); ?>">

						<input type="text" name="serie_ctps" required="true" class="fleft fleftmobile md10" placeholder="Série N&ordm;" value="<?php echo $admissao->serie_ctps; ?>">

						<select name="estado_ctps" required="true" class="fleft fleftmobile md10" >
						<option value="">Estado</option>
							<?php 
							$selected = "";
							foreach ($estados as $key => $value) { 
								$selected = ($value->est_idestado==$admissao->estado_ctps)? "selected":"";
								?>
								<option value="<?php echo $value->est_idestado; ?>" <?php echo $selected; ?>>
								<?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" required="true" name="dt_emissaoctps" class="pequeno data fleft" placeholder="Emissão CTPS" value="<?php echo $this->Log->alteradata1($admissao->dt_emissaoctps); ?>">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>

						<input type="number" name="nr_pis" required="true" class="fleft fleftmobile md10" placeholder="PIS:" value="<?php echo $admissao->nr_pis; ?>">

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="dt_emissaopis" required="true" class="data fleft" placeholder="Data de Emissão PIS" value="<?php echo $this->Log->alteradata1($admissao->dt_emissaopis); ?>">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>
					</div>

					<!--linha 4-->
									
					<div class="fleft" style="margin-top: 10px;">
					
						<input type="number" name="reservista" required="true" class="fleft fleftmobile md10" placeholder="Reservista" value="<?php echo $admissao->reservista; ?>">

						<input type="text" name="cpf" required="true" class="fleft fleftmobile md10" placeholder="CPF:" value="<?php echo $admissao->cpf; ?>">

						<input type="text" name="rg" required="true" class="fleft fleftmobile md10 " placeholder="RG:" value="<?php echo $admissao->rg; ?>">

						<input type="text" name="rgorgao" required="true" class="pequeno fleft fleftmobile md10" placeholder="Orgão Emissor" value="<?php echo $admissao->rgorgao; ?>">

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="rg_emissao" required="true" class="data fleft" placeholder="Data Emissão RG" value="<?php echo $this->Log->alteradata1($admissao->rg_emissao); ?>">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>
						<select name="rg_estado" required="true" class="fleft fleftmobile md10" >
						<option value="">Estado</option>
							<?php 
							$selected = "";
							foreach ($estados as $key => $value) { 
								$selected = ($value->est_idestado==$admissao->rg_estado)? "selected":"";
								?>
								<option value="<?php echo $value->est_idestado; ?>" <?php echo $selected; ?>>
								<?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>
					</div>

					<!--CNH-->
					<div class="fleft" style="margin-top: 10px;">
						<input type="text" name="cnh" required="true" class="fleft fleftmobile md10" placeholder="Carteira de Habilitação" value="<?php echo $admissao->cnh; ?>">

						<div class='input-group date fleft md10' >
								<input type="text" name="vencimentocnh" class="pequeno data fleft" placeholder="Vencim. CNH" value="<?php echo $this->Log->alteradata1($admissao->vencimentocnh); ?>">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -7px;"></span>
								</span>
							</div>
						<select name="cnhcategoria" required="true" class="fleft fleftmobile md10" >
						
							<option value="">Categoria</option>
							<option value="A" <?php echo ($admissao->cnhcategoria=="A")? "selected": ""; ?> >A</option>
							<option value="B" <?php echo ($admissao->cnhcategoria=="B")? "selected": ""; ?> >B</option>
							<option value="A/B" <?php echo ($admissao->cnhcategoria=="A/B")? "selected": ""; ?> >A/B</option>
							<option value="C" <?php echo ($admissao->cnhcategoria=="C")? "selected": ""; ?> >C</option>
							<option value="D" <?php echo ($admissao->cnhcategoria=="D")? "selected": ""; ?> >D</option>
							<option value="E" <?php echo ($admissao->cnhcategoria=="E")? "selected": ""; ?> >E</option>
						</select>
						<input type="number" name="titulo" required="true" class="fleft fleftmobile md10" placeholder="Titulo de Eleitor:" value="<?php echo $admissao->titulo; ?>">

						<input type="number" name="zona" required="true" class="fleft fleftmobile md10" placeholder="Zona" value="<?php echo trim($admissao->zona); ?>">

						<input type="number" name="secao" required="true" class="fleft fleftmobile md10" placeholder="Seção" value="<?php echo trim($admissao->secao); ?>">

					</div>

					<!--linha endereco-->
					<div class="fleft" style="margin-top: 10px;">
						<h4>Endereço</h4>
						<select name="fk_logradouro_admissao" required="true" class="fleft fleftmobile md10" >
							<option value="">Tipo de logradouro</option>
							<?php 
							$selected ="";
							foreach ($logradouros as $key => $value) { 
								$selected = ($value->idtipologradouro==$admissao->fk_logradouro_admissao)? "selected":"";
								?>
								<option value="<?php echo $value->idtipologradouro; ?>" <?php echo $selected; ?>><?php echo $value->descricaologradouro; ?></option>
							<?php } ?>
						</select>

						<input type="text" name="endereco_admissao" required="true" class="grande fleft fleftmobile md10" placeholder="Endereço" value="<?php echo $admissao->endereco_admissao; ?>">

						<input type="number" name="endereconumero" class="pequeno fleft fleftmobile md10" placeholder="N&ordm;" value="<?php echo $admissao->endereconumero; ?>">

						<input type="text" name="enderecocomplemento" class="fleft fleftmobile md10" placeholder="Complemento" value="<?php echo $admissao->enderecocomplemento; ?>">

					</div>

					<!--contato-->
					<div class="fleft" style="margin-top: 10px;">
						<select name="fk_enderecoestado" id="estadoendereco" required="true" class="fleft fleftmobile md10" >
							<option value="">Estado</option>
							<?php 
							$selected = "";
							foreach ($estados as $key => $value) { 
								$selected = ($value->est_idestado==$admissao->fk_enderecoestado)? "selected":"";
								?>
								<option value="<?php echo $value->est_idestado; ?>"  <?php echo $selected; ?>>
								<?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>
						
						<select name="fk_enderecocidade" id="cidadeendereco" class="fleft fleftmobile md10" >
						<?php 
							$selected = ""; 
							foreach ($cidadesendereco as $key => $value) { 
									$selected = ($value->cid_idcidade==$admissao->fk_enderecocidade)? "selected":"";
								?>
								<option value="<?php echo $value->cid_idcidade; ?>" <?php echo $selected; ?>>
								<?php echo $value->cid_nomecidade; ?></option>
								<?php } ?>
						</select>
						
						<select name="fk_enderecobairro" id="bairro" required="true" class="fleft fleftmobile md10" >
							<?php 
							$selected = ""; 
							foreach ($bairrosendereco as $key => $value) { 
									$selected = ($value->bair_idbairro==$admissao->fk_enderecobairro)? "selected":"";
								?>
								<option value="<?php echo $value->bair_idbairro; ?>" <?php echo $selected; ?>>
								<?php echo $value->bair_nomebairro; ?></option>
								<?php } ?>
						</select>
						
						<input type="number" name="cep_admissao" required="true" class=" fleft fleftmobile md10" placeholder="CEP" value="<?php echo $admissao->cep_admissao; ?>">
						
						<input type="text" name="telefone_admissao" class="fleft fleftmobile md10 tel" placeholder="Telefone" value="<?php echo $admissao->telefone_admissao; ?>">

						<input type="text" name="celular_admissao" required="true" class="cel fleft fleftmobile md10" placeholder="Celular" value="<?php echo $admissao->celular_admissao; ?>">

					</div>	

					<!--linha 6-->
					<div class="fleft" style="margin-top: 10px;">
					<h4>Informações complementares</h4>
					<select name="fkestadocivil" required="true" class="md10 fleft fleftmobile" style="">
						<option value="">Estado Civil</option>
						<?php 
						$selected = ""; 
						foreach ($estadocivis as $key => $value) { 
							$selected = ($value->id_estciv==$admissao->fkestadocivil)? "selected":"";
							?>
						<option value="<?php echo $value->id_estciv; ?>" <?php echo $selected; ?>>
						<?php echo $value->estciv_descricao; ?></option>
						<?php } ?>
					</select>

						<select name="fk_escolaridade_admissao" required="true" class="fleft fleftmobile md10" >
							<option value="">Grau de Instrução</option>
							<?php 
							$selected = ""; 
						foreach ($escolaridade as $key => $value) { 
								$selected = ($value->id_escolaridade==$admissao->fk_escolaridade_admissao)? "selected":"";
								?>
								<option value="<?php echo $value->id_escolaridade; ?>" <?php echo $selected; ?>><?php echo $value->escolaridade_descricao; ?></option>
							<?php } ?>
						</select>

						<select name="fk_etnia_admissao" required="true" class="fleft fleftmobile md10" >
							<option value="">Etnia</option>
							<?php 
							$selected = ""; 
						foreach ($etnia as $key => $value) { 
							$selected = ($value->id_etnia==$admissao->fk_etnia_admissao)? "selected":"";
							?>
								<option value="<?php echo $value->id_etnia; ?>" <?php echo $selected; ?>><?php echo $value->etnia_descricao; ?></option>
							<?php } ?>
						</select>

						<select name="fk_deficiencia_admissao" required="true" class="fleft fleftmobile md10" >
							<option value="">Deficiência</option>
							<option value="0" selected>Nenhuma</option>
							<?php 
							$selected = ""; 
						foreach ($deficiencia as $key => $value) { 
							$selected = ($value->id_tipodeficiencia==$admissao->fk_deficiencia_admissao)? "selected":"";
							?>
								<option value="<?php echo $value->id_tipodeficiencia; ?>" <?php echo $selected; ?>><?php echo $value->descricaodeficiencia; ?></option>
							<?php } ?>	
						</select>

						<div class="fleft fleftmobile md10">
							<select name="ic_reabilitado" required="true" class="fleft fleftmobile md10" >
								<option value="">Reabilitado</option>
								<option value="1" <?php echo ($admissao->ic_reabilitado==1)? "selected": ""; ?> >Sim</option>
								<option value="0" <?php echo ($admissao->ic_reabilitado==0)? "selected": ""; ?> >Não</option>
							</select>
						</div>

					</div>

					<!--linha 10-->
					
						<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10">Recolheu contribuição sindical nesse ano? Verificar na CTPS</span>
						<label class="md10">
						<?php 
						$checked1 = $checked2="";
							if ($admissao->ic_contribuicaosindical==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
							}
						?>
						<input type="radio" class="icheckbox" value="1" name="ic_contribuicaosindical" required="true" <?php echo $checked1; ?>>Sim</label>

						<label><input type="radio" class="icheckbox" value="0" name="ic_contribuicaosindical" required="true" <?php echo $checked2; ?>>Não</label>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Periculosidade</span>
						<?php 
						$checked1 = $checked2=$disabled ="";
							if ($admissao->ic_periculosidade==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
								$disabled = "disabled";
							}

						?>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="1" name="ic_periculosidade" required="true" <?php echo $checked1; ?>>Sim</label>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="0" name="ic_periculosidade" required="true"  <?php echo $checked2; ?>>Não</label>
						<select name="valorpericulosidade" class="fleft fleftmobile md10" placeholder="Percentual:" <?php echo $disabled; ?> >
						
							<option value="">Percentual</option>
							<option value="0" <?php echo ($admissao->ic_reabilitado==0)? "selected": ""; ?>>0%</option>
							<option value="30" <?php echo ($admissao->ic_reabilitado==30)? "selected": ""; ?>>30%</option>
						</select>
					</div>
					
				</div><!--linha1-->

				<div class="fleft" style="margin-top: 10px;">
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10 fleft">Insalubridade</span>
						<?php 
						$checked1 = $checked2="";
						$disabled = "";

							if ($admissao->ic_insalubridade==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
								$disabled = "disabled";
							}

						?>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="1" name="ic_insalubridade" required="true" <?php echo $checked1; ?>>Sim</label>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="0" name="ic_insalubridade" required="true"  <?php echo $checked2; ?>>Não</label>

						<select name="valorinsalubridade" required="true" class="fleft fleftmobile md10" <?php echo $disabled; ?> >
						
							<option value="">Percentual</option>
							<option value="20" <?php echo ($admissao->valorinsalubridade==20)? "selected": ""; ?>>20%</option>
							<option value="40" <?php echo ($admissao->valorinsalubridade==40)? "selected": ""; ?>>40%</option>
						</select>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<select name="contratoexperiencia" required="true" class="fleft fleftmobile md10" >
							<option value="">Contrato por experiência</option>
							<option value="0" <?php echo ($admissao->contratoexperiencia==0)? "selected": ""; ?> >0</option>
							<option value="30"<?php echo ($admissao->contratoexperiencia==30)? "selected": ""; ?> >30</option>
							<option value="45"<?php echo ($admissao->contratoexperiencia==45)? "selected": ""; ?> >45</option>
							<option value="60"<?php echo ($admissao->contratoexperiencia==60)? "selected": ""; ?> >60</option>
						</select>

						<select name="contratoprorrogacao" required="true" class="fleft fleftmobile md10" >
							<option value="">Prorrogação do Contrato</option>
							<option value="0" <?php echo ($admissao->contratoprorrogacao==0)? "selected": ""; ?> >0</option>
							<option value="30" <?php echo ($admissao->contratoprorrogacao==30)? "selected": ""; ?> >30</option>
							<option value="45" <?php echo ($admissao->contratoprorrogacao==45)? "selected": ""; ?> >45</option>
							<option value="60" <?php echo ($admissao->contratoprorrogacao==60)? "selected": ""; ?> >60</option>
						</select>
					</div>
				</div>

				<div class="fleft borda" style="margin-top: 10px;">
				<select name="ic_adiantamento" required="true" class="fleft fleftmobile md10" >
					<option value="">Adiantamento Salarial</option>
					<option value="1" <?php echo ($admissao->ic_adiantamento==1)? "selected": ""; ?> >Sim</option>
					<option value="0" <?php echo ($admissao->ic_adiantamento==0)? "selected": ""; ?> >Não</option>
				</select>

				<select name="ic_decimoterceiro" class="fleft fleftmobile md10" >
					<option value="">13&ordm; Salario</option>
					<option value="1" <?php echo ($admissao->ic_decimoterceiro==1)? "selected": ""; ?> >Sim</option>
					<option value="0" <?php echo ($admissao->ic_decimoterceiro==0)? "selected": ""; ?> >Não</option>
				</select>
				</div>


				<!--linha 2-->
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<select name="tipopagamento" required="true" class="fleft fleftmobile md10" >
							<option value="">Modo de pagamento</option>
							<option value="1" <?php echo ($admissao->tipopagamento==1)? "selected": ""; ?> >Cheque</option>
							<option value="2" <?php echo ($admissao->tipopagamento==2)? "selected": ""; ?> >Dinheiro</option>
							<option value="3" <?php echo ($admissao->tipopagamento==3)? "selected": ""; ?> >Ordem de pagamento</option>
							<option value="4" <?php echo ($admissao->tipopagamento==4)? "selected": ""; ?> >Relação Bancária</option>
						</select>

						<?php $display = ($admissao->tipopagamento!=4)? "none": ""; ?>

						<select style="display: <?php echo $display; ?>" name="fk_idbanco" class="fleft md10" required="true" id="selectbanco" >
							<option value="">Banco</option>
							<?php 
							$selected = "";
							foreach ($bancos as $key => $value) { 
								$selected = ($value->id_banco==$admissao->fk_idbanco)? "selected":"";
								?>
							<option value="<?php echo $value->id_banco; ?>" <?php echo $selected; ?>><?php echo $value->nome_banco; ?></option>
							<?php } ?>
						</select>

						<input style="display: <?php echo $display; ?>" type="text" name="bancoagencia" required="true" class="pequeno fleft fleftmobile md10" placeholder="Agencia:" value="<?php echo $admissao->bancoagencia; ?>">

						<input style="display: <?php echo $display; ?>" type="text" name="bancoconta" required="true" class="pequeno fleft fleftmobile md10" placeholder="Conta:" value="<?php echo $admissao->bancoconta; ?>">

						<input style="display: <?php echo $display; ?>" type="number" name="contadigito" required="true" class="pequeno fleft fleftmobile md10" placeholder="Digito" value="<?php echo trim($admissao->contadigito); ?>">

						<select style="display: <?php echo $display; ?>" name="tipoconta" required="true" class="fleft fleftmobile md10" >
							<option value="">Tipo de Conta</option>
							<option value="1" <?php echo ($admissao->tipoconta==1)? "selected": ""; ?> >Corrente</option>
							<option value="2" <?php echo ($admissao->tipoconta==2)? "selected": ""; ?> >Poupança</option>
							<option value="3" <?php echo ($admissao->tipoconta==3)? "selected": ""; ?> >Salario</option>
							<option value="4" <?php echo ($admissao->tipoconta==4)? "selected": ""; ?> >Outros</option>
						</select>
					</div>
				</div>

				<!--vale transporte-->
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10 fleft">Vale Transporte</span>
						<?php 
						$checked1 = $checked2="";
							if ($admissao->ic_vt==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
							}

						?>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="1" name="ic_vt" required="true" <?php echo $checked1; ?> >Sim</label>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="0" name="ic_vt" required="true" <?php echo $checked2; ?>>Não</label>
						
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Vale Refeição</span>
						<?php 
						$checked1 = $checked2="";
							if ($admissao->ic_vr==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
							}

						?>
						<label class="md10"><input type="radio" class="icheckbox" value="1" name="ic_vr" required="true"  <?php echo $checked1; ?> >Sim</label>
						<label><input type="radio" class="icheckbox" value="0" name="ic_vr" required="true"  <?php echo $checked2; ?> >Não</label>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Assistencia Médica</span>
						<?php 
						$checked1 = $checked2="";
							if ($admissao->ic_assistenciamedica==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
							}

						?>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="1" name="ic_assistenciamedica" required="true" <?php echo $checked1; ?> >Sim</label>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="0" name="ic_assistenciamedica" required="true" <?php echo $checked2; ?> >Não</label>
						<!--<input type="text" name="medvalor" class="fleft fleftmobile md10 campomoeda" placeholder="Valor:" disabled="true">-->
					</div>
					</div>

					<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="">Recebendo seguro desemprego</h4>
						<?php 
						$checked1 = $checked2="";
							if ($admissao->ic_segurodesemprego==1) {
								$checked1 = "checked";
							}else{
								$checked2="checked";
							}

						?>
						<label class="md10"><input type="radio" class="icheckbox" value="1" name="ic_segurodesemprego" required="true" <?php echo $checked1; ?>>Sim</label>
						<label><input type="radio" class="icheckbox" value="0" name="ic_segurodesemprego" required="true" <?php echo $checked2; ?>>Não</label>
					</div>

				</div>

				<!--linha3-->
				<div class="fleft" style="margin-top: 10px;">
					<input type="text" name="emailcomercial" class="fleft fleftmobile md10 grande"  value="<?php echo $admissao->emailcomercial; ?>">
					
					<input type="text" name="emailparticular" class="fleft fleftmobile md10 grande" placeholder="e-mail particular" value="<?php echo $admissao->emailparticular; ?>">
				</div>
					</div>
					<div class="clearfix"></div>
					<button class="btn btn-primary" style="margin-top: 7px;">Aprovar</button>
			</div><!--fim da aba pessoais-->

			<div class="tab-pane " id="dependentes">
			
				<div class="fleft" style="margin-top: 10px;">
					<span class="btn btn-primary" id="add">Salvar</span>
				</div>

				<div class="clearfix"></div>

				<!--linha 1-->
				<div id="linha" class="fleft" style="margin-top: 10px;">
				
					<input type="text" name="nome_depadmissao" class="fleft fleftmobile md10 grande" placeholder="Nome Completo:" >

					<input type="number" name="cpf_depadmissao" class="fleft fleftmobile md10" placeholder="CPF:" >

					<div class="fleft fleftmobile md10">
						<div class='input-group date' >
							<input type="text" name="nascimento_depadmissao" class="data fleft" placeholder="Data de Nascimento" >
							<span class="input-group-addon fleft">
								<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
							</span>
						</div>
					</div>

					<select name="sexo_depadmissao" class="fleft fleftmobile md10" >
						<option value="">Sexo</option>
						<option value="1">Masculino</option>
						<option value="2">Feminino</option>
					</select>

					<div class="clearfix"></div>
					
					<div class="fleft" style="margin-top: 10px;">
					
					<select name="ic_ir_depadmissao" class="fleft fleftmobile md10" >
						<option value="">Imposto de Renda</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
					</div>					
					
					<select name="fk_idparentesco" class="fleft fleftmobile md10" >
						<option value="">Parentesco</option>
						<?php foreach ($parentesco as $key => $value) { ?>
							<option value="<?php echo $value->tipdep; ?>"><?php echo $value->descricao; ?></option>
						<?php } ?>
					</select>

					<select name="ic_auxfamilia" class="fleft fleftmobile md10" >
						<option value="">Auxilio Familia</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>

					<input type="text" name="nomemae" class="fleft fleftmobile md10 grande" placeholder="Nome da Mãe:" >
					</div>

					<div class="clearfix"></div>

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

                    			<tr class="" id="<?php echo $value->id_dependenteadmissao; ?>" style="cursor: pointer;">

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

			</div><!-- tab dependentes-->
		
		</div><!--tab content-->
		
	</div><!--tabs-->
<input type="hidden" name="" id="admid" value="<?php echo $admissao->id_admissao; ?>">

	<script type="text/javascript">
		$("#pessoais input, #pessoais select").blur(function(){
			var id = $("#admid").val();
			var iddep = $("#id_dp").val();
			var campo = $(this).attr("name");
			var valor = $(this).val();
			var elemento = $(this);
			var required = $(this).attr("required");

			$.ajax({           
				type: "POST",
				url: '<?php echo base_url('home/salvar_admissao') ?>',
				secureuri: false,
				cache: false,
				dataType: "json",
				data:{
					id: id,
					campo: campo,
					valor: valor,
					required: required,
					iddep: iddep
				},              
				success: function(msg) 
				{
					if (msg.acao=="insert") {
						$("#admid").val(msg.id);
					}else if (msg.acao == "erro") {
						elemento.css({
							"background-color":"#ffcccc",
							"border-color": "red"
						});
						if (msg.mensagem) {
							$(".alert").addClass("alert-danger")
							.html(msg.mensagem)
							.slideDown("slow");
							$(".alert").delay( 3500 ).hide(500);
						}
						return;
					}

					elemento.css({
						"background-color":"#f0fff1", 
						"border-color": "#13da28"
					});

				},
				error: function(msg){
					elemento.css({
						"background-color":"#ffcccc",
						"border-color": "red"
					});
				}
			});
		});

		$('.data').datepicker({

			format: 'dd/mm/yyyy'
		});
		$(".campomoeda").maskMoney({thousands:'.',decimal:','});
		$('.tel').mask("(99)9999-9999");
		$('.cel').mask("(99)99999-9999");
		$('.cep').mask("99999999");
		$('.hora').mask("99:99");
		$('.hora').keyup(function(){
			var hora = $(this).val().substr(0, 2);
			if (hora>24) {
				$(this).val("");
			}
			var min = $(this).val().substr(3, 2);
			if (min>59) {
				var h = $(this).val().substr(0, 3);
				$(this).val(h + "59");
			}
		});

		$("[name='tipopagamento']").change(function(){
			if ($(this).val()!=4) {
				$("[name='fk_idbanco'], [name='bancoagencia'], [name='bancoconta'], [name='contadigito'], [name='tipoconta']").val("").hide();
			}else{
				$("[name='fk_idbanco'], [name='bancoagencia'], [name='bancoconta'], [name='contadigito'], [name='tipoconta']").show();
			}
		});

		$("[name='fk_cargo_admissao']").change(function(){
			$(this).focus();
			if ($(this).val() != ""){
				$('[data-id="selectcargo"]').css({
					"background-color":"#f0fff1", 
					"border-color": "#13da28"
				});
			}else{
				$('[data-id="selectcargo"]').css({
					"background-color":"#ffcccc",
					"border-color": "red"
				});
			}
		});

		$("[name='ic_periculosidade']").on('ifToggled', function(event){
			$(this).focus();
			if ($(this).val()==1 ) {
				$("[name='valorpericulosidade']").attr("disabled", false);
			}else{
				$("[name='valorpericulosidade']").val("").change();
				$("[name='valorpericulosidade']").attr("disabled", true);
			}  		
		});

		$("[name='ic_insalubridade']").on('ifToggled', function(event){
			$(this).focus();
			if ($(this).val()==1 ) {
				$("[name='valorinsalubridade']").attr("disabled", false);
			}else{
				$("[name='valorinsalubridade']").val("").change();
				$("[name='valorinsalubridade']").attr("disabled", true);
			}  		
		});

		$("[name='ic_contribuicaosindical'], [name='vt'], [name='vr'], [name='ic_assistenciamedica'], ic_segurodesemprego").on('ifToggled', function(event){

			$(this).focus();
		});

		jQuery.validator.addMethod("cpf", function(value, element) {

			value = jQuery.trim(value);

			value = value.replace('.','');
			value = value.replace('.','');
			cpf = value.replace('-','');
			while(cpf.length < 11) cpf = "0"+ cpf;
			var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
			var a = [];
			var b = new Number;
			var c = 11;
			for (i=0; i<11; i++){
				a[i] = cpf.charAt(i);
				if (i < 9) b += (a[i] * --c);
			}
			if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
				b = 0;
			c = 11;
			for (y=0; y<10; y++) b += (a[y] * c--);
				if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

			var retorno = true;
			if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

			return this.optional(element) || retorno;

		}, "Informe um CPF válido");

		$("#formadmissao").validate({
			rules: {
				cpf: {cpf: true, required: true, maxlength: 11},
				nr_ctps: {required:true, number:true, maxlength: 14},
				serie_ctps: {required:true, number:true, maxlength: 5},
				reservista: {required:true, number:true, maxlength: 20},
				nr_pis: {required:true, number:true, maxlength: 11},
				rg: {required:true, number:true, maxlength: 13},
				titulo: {required:true, number:true, maxlength: 13},
				zona: {required:true, maxlength: 3},
				secao: {required:true, maxlength: 4},
				cep_admissao: {required:true, maxlength: 8},
				bancoconta: {required:true, number:true}

			},
			messages: {
				cpf: { cpf: 'CPF inválido'}
			}
			,submitHandler:function(form) {

				$("#loadadm").show();
				var id = $("#admid").val();

				$.ajax({           
					type: "POST",
					url: '<?php echo base_url('home/salvar_admissao') ?>',
					secureuri:false,
					cache: false,
					dataType: "json",
					data:{
						id: id,
						campo: "admissao_status",
						valor: 2
					},              
					success: function(msg) 
					{
						$(".alert").removeClass("alert-danger")
						.addClass("alert-success")
						.html("Salvo com sucesso.")
						.slideDown("slow");

						$('html, body').animate({scrollTop:0}, 'slow');
						$("#myModal").modal('hide');
						$(".alert").delay( 3000 ).hide(500, function(){
							location.reload();
						});

					},
					error: function(msg){

						$(".alert").addClass("alert-danger")
						.html("Houve um erro. Contate o suporte.")
						.slideDown("slow");
						$(".alert").delay( 3500 ).hide(500);
						$("#myModal").modal('hide');
					}
				});
			}
		});

		$("#estado").change(function(){

			$(this).after('<img id="loadest" style="" src="<?php echo base_url('img/loaders/default.gif') ?>" >');
			var id = $(this).val();
			$.ajax({         
				type: "POST",
				url: '<?php echo base_url('home/estadocidade') ?>',
				secureuri:false,
				cache: false,
				data:{
					id : id,
					campo: "estado"
				},
				success: function(j){

					$('#cidade').html(j);  
					$('#loadest').remove();  
				} 
			});

		});

		$("#estadoendereco").change(function(){

			$(this).after('<img id="loadest" style="" src="<?php echo base_url('img/loaders/default.gif') ?>" >');
			$(this).attr("disabled", true);
			$('#cidadeendereco').html("<option value=''>Aguarde...</option>");
			var id = $(this).val();
			$.ajax({         
				type: "POST",
				url: '<?php echo base_url('home/estadocidade') ?>',
				secureuri:false,
				cache: false,
				data:{
					id : id,
					campo: "estado"
				},              
				success: function(j){
					$("#estadoendereco").attr("disabled", false);
					$('#cidadeendereco').html(j);  
					$('#loadest').remove();  
				} 
			});
		});

		$("#cidadeendereco").change(function(){

			$(this).after('<img id="loadest" style="" src="<?php echo base_url('img/loaders/default.gif') ?>" >');
			$(this).attr("disabled", true);
			$('#bairro').html("<option value=''>Aguarde...</option>");
			var id = $(this).val();
			$.ajax({         
				type: "POST",
				url: '<?php echo base_url('home/estadocidade') ?>',
				secureuri:false,
				cache: false,
				data:{
					id : id,
					campo: "cidade"
				},              
				success: function(j){

					$("#cidadeendereco").attr("disabled", false);

					$('#bairro').html(j);  
					$('#loadest').remove();  
				} 
			});

		});

		$("#add").click(function(){
			$("#formdep").submit();
			return;
		});

		$(document).on("click",".excpar", function(){
			var n = $(this).attr("del");
			$("#"+n).remove();
		});

		$("#formdep").validate({
			submitHandler:function(form) {
				var id = $("#admid").val();

				$.ajax({           
					type: "POST",
					url: '<?php echo base_url('home/salvar_dependente') ?>',
					secureuri:false,
					cache: false,
					dataType: "json",
					data:{
						id: id,
						nome: $("[name=nome_depadmissao]").val(),
						cpf: $("[name=cpf_depadmissao]").val(),
						ir: $("[name=ic_ir_depadmissao]").val(),
						sexo: $("[name=sexo_depadmissao]").val(),
						parentesco: $("[name=fk_idparentesco]").val(),
						nasc: $("[name=nascimento_depadmissao]").val(),
						aux: $("[name=ic_auxfamilia]").val(),
						mae: $("[name=nomemae]").val(),
					},              
					success: function(msg) 
					{
						$("#loadadm").show();
						if (msg.acao == "erro") {

							if (msg.mensagem) {
								$(".alert").addClass("alert-danger")
								.html(msg.mensagem)
								.slideDown("slow");
								$(".alert").delay( 3500 ).hide(500);
							}
							return;
						}else{
							$("#formdep input").val("");
							$("#formdep select").val("").change();
						}
						$("#loadadm").hide();			

					},
					error: function(msg){
						$("#loadadm").hide();
					}
				});

			}
		});

		$(".excdep").click(function(){
			var id = $(this).data("id");
			$.ajax({         
				type: "POST",
				url: '<?php echo base_url('home/excluirdependente') ?>',
				secureuri:false,
				cache: false,
				data:{
					id : id
				},              
				success: function(j){
					$("#"+id).remove();
				} 
			});
		});

	</script>