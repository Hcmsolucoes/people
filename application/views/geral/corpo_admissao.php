<style type="text/css">
	.md10{
		margin-right: 10px;
	}
	.borda{
		border: 1px solid #ccc;
		padding: 7px;
	}
	.grande{
		width: 310px;
	}
	.pequeno{
		width: 112px;
	}
	.xgrande{
		width: 500px;
	}
	.copia{
		margin-bottom: 10px;
	}
	.excpar{
		font-size: 20px;
		cursor: pointer;
	}
	label.error{
		float: left;
    	width: auto;
	}
</style>

<div class="page-title">
	<h2><span class="fa fa-list-alt"></span> Admissão</h2>
</div>

	<div class="alert acenter bold " role="alert" style="font-size: 15px;display: none;"></div>	

<img id="loadadm" style="display: none;position: absolute;left: 40%;top: 50%;z-index: 99;" src="<?php echo base_url('img/loaders/default.gif') ?>" >


<div class="col-md-12">

	<div class=" tabs" style="margin-top: 0px;">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#pessoais" role="tab" data-toggle="tab">Dados Pessoais</a></li>
			<li><a href="#dependentes" role="tab" data-toggle="tab">Dependentes</a></li>
			<li><a href="#rascunho" role="tab" data-toggle="tab">Rascunho</a></li>
			<li><a href="#docs" role="tab" data-toggle="tab">Documentos</a></li>
		</ul>

		<div class="tab-content panel" style="padding: 15px 0px 0px 7px; min-height: 300px;">
			<div class="tab-pane active" id="pessoais">
				<form id="formadmissao" class="form" method="post" action="<?php echo base_url('home/salvar_admissao'); ?>">
					<div class="fleft md10" style="">

						<select name="adm_idfilial" required="true" id="cbofilial" class="md10" data-toggle="tooltip" data-placement="top" title="Filial">
							<option value="">Filial</option>
							<?php foreach ($filial as $key => $value) { ?>
							<option value="<?php echo $value->fil_idfilial; ?>"><?php echo $value->fil_nomefantasia; ?></option>
							<?php } ?>
						</select>

						<select name="fk_admdepartamento" required="true" id="departamento" class="md10" data-toggle="tooltip" data-placement="top" title="Departamento">
							<option value="">Departamento</option>
							<?php foreach ($departamentos as $key => $value) { ?>
							<option value="<?php echo $value->iddpto; ?>"><?php echo $value->descricao; ?></option>
							<?php } ?>
						</select>
						
					</div>

					<div class="fleft" style="margin-top: 10px;">
					
						<input type="text" name="nome_admissao" class="fleft fleftmobile md10 grande" placeholder="Nome Completo" required="true" data-toggle="tooltip" data-placement="top" title="Nome da pessoa">

						<select name="sexo_admissao" class="fleft fleftmobile md10"  required="true">
							<option value="">Sexo</option>
							<option value="1">Masculino</option>
							<option value="2">Feminino</option>
						</select>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="data_admissao" class="pequeno data fleft" placeholder="Data admissão" required="true" data-date-start-date="-15d" data-toggle="tooltip" data-placement="top" title="Data de admissão">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>

						<select name="fk_cargo_admissao" required="true" id="selectcargo" class="selectpicker " data-live-search="true" data-div="resultado" data-toggle="tooltip" data-placement="top" title="Escolha o Cargo">
							<option value="">Cargo</option>
							<?php foreach ($cargos as $key => $value) { ?>
							<option value="<?php echo $value->idcargo; ?>"><?php echo $value->codigo_cargo. " - " .$value->descricao; ?></option>
							<?php } ?>
						</select>

						<select name="ic_emprego" class="fleft fleftmobile md10" required="true" data-toggle="tooltip" data-placement="top" title="Emprego">
							<option value="">Emprego</option>
							<option value="2">Reemprego</option>
							<option value="1">Primeiro Emprego</option>
						</select>

						
					</div><!-- linha 1-->

					<!--linha3-->
					<div class="fleft" style="margin-top: 10px;">
						<div class="borda fleft md10" style="height: 155px;">
						<h4>Naturalidade</h4>
							<div class="fleft fleftmobile md10">
								<div class='input-group date' >
									<input type="text" name="dtnascimento_admissao" class="data fleft" placeholder="Data de Nascimento" required="true" data-toggle="tooltip" data-placement="top" title="Data de Nascimento">
									<span class="input-group-addon fleft">
										<span class="fa fa-calendar" id=''></span>
									</span>
								</div>
							</div>
							<div class="clearfix"></div>
							<select name="fkestadonascimento" required="true" id="estado" class="fleft fleftmobile" style="margin-top: 7px;" data-toggle="tooltip" data-placement="top" title="Estado">
								<option value="">Estado</option>
								<?php foreach ($estados as $key => $value) { ?>
								<option value="<?php echo $value->est_idestado; ?>"><?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
							</select>
							<div class="clearfix"></div>
							<select name="fkcidadenascimento" id="cidade" required="true" class="fleft fleftmobile" style="margin-top: 7px;" data-toggle="tooltip" data-placement="top" title="Cidade">
							</select>
							<div class="clearfix"></div>
							
						</div>

						<div class="fleft-2 fleftmobile md10 borda" style="height: 155px;">
							<h4>Horário</h4>
							<!--<div class="clearfix"></div>
							<div class="fleft-3 md10">
								<label>Entrada</label>
								<div class="clearfix"></div>
								<input type="text" name="horaentrada" class="hora fleft-10 fleftmobile " placeholder="" required="true">
							</div>
							<div class="fleft-3">
								<label>Saída/Intervalo</label>
								<div class="clearfix"></div>
								<input type="text" name="horasaidainter" class="hora fleft-10 fleftmobile " placeholder="" required="true">
							</div>
							
							<div class="clearfix"></div>

							<div class="fleft-4 md10" style="margin-top: 10px;">
								<label>Entr./Inter.</label>
								<div class="clearfix"></div>
								<input type="text" name="horaentradainter" class="hora fleft-10 fleftmobile " placeholder="" required="true">
							</div>
							<div class="fleft-3 " style="margin-top: 10px;">
								<label>Saída</label>
								<div class="clearfix"></div>
								<input type="text" name="horasaida" class="hora fleft-10 fleftmobile " placeholder="" required="true">
							</div>-->
							<select name="fk_horbase" required="true" id="selecthorabase" class="selectpicker " data-live-search="true" data-div="" data-toggle="tooltip" data-placement="top" title="Horário Base">
							<?php foreach ($horbase as $key => $value) { ?>
							<option value="<?php echo $value->idhorario; ?>"><?php echo $value->descricaohorario; ?></option>
							<?php } ?>
						</select>

						<div class="fleft" style="margin-top: 10px;">
						<select name="fk_horsab" required="true" id="selecthorsab" class="selectpicker " data-live-search="true" data-div="" data-toggle="tooltip" data-placement="top" title="Horário Sábado" >
							<?php foreach ($horbase as $key => $value) { ?>
							<option value="<?php echo $value->idhorario; ?>"><?php echo $value->descricaohorario; ?></option>
							<?php } ?>
						</select>
						</div>

						</div>

						<!--<div class="fleft-14 fleftmobile md10 borda" style="">
							<h4>Horário Sábado</h4>
							<div class="clearfix"></div>
							<div class="fleft">
								<label>Entrada</label>
								<div class="clearfix"></div>
								<input type="text" name="sabadoentrada" class="hora fleft-6 fleftmobile " placeholder="">
							</div>
							<div class="fleft" style="margin-top: 10px;">
								<label>Saída</label>
								<div class="clearfix"></div>
								<input type="text" name="sabadosaida" class="hora fleft-6 fleftmobile " placeholder="">
							</div>
						</div>-->

						<div class="fleft-2 fleftmobile acenter borda md10" style="height: 155px;">
							<div class="bold">
								<span>Carga Horária Semanal</span><br>
								<span id="txthrsemanal"></span>
								<input type="text" name="hrsemanal" value="" class="hora pequeno" data-toggle="tooltip" data-placement="top" title="Carga horária semanal">
							</div>
							<!--<div class="bold" style="margin-top: 19px">
								<span>Carga Horária Mensal</span><br>
								<span id="txthrmensal"></span>
								<input type="hidden" name="hrmensal">
							</div>-->
							<div class="bold" style="margin-top: 19px">
								<span>DSR</span><br>
								<span id="txthrdsr"></span>
								<input type="text" name="hrdsr" value="" class="hora pequeno" data-toggle="tooltip" data-placement="top" title="DSR">
							</div>
						</div>

						<div class="fleft-2 fleftmobile md10 borda" style="height: 155px;">
							<div class="fleft fleftmobile md10">

							<select name="adm_tipocontrato" class="fleft fleftmobile md10" required="true" style="margin-bottom: 20px;" data-toggle="tooltip" data-placement="top" title="Tipo de contrato">
							<option value="">Tipo de contrato</option>
							<option value="1">Empregado</option>
							<option value="2">Diretor</option>
							<option value="4">Aposentado</option>
							<option value="5">Estagiário</option>
							<option value="6">aprendiz</option>		
						</select>

						<select name="tiposalario_admissao" class="fleft fleftmobile md10" required="true" style="margin-bottom: 20px;" data-toggle="tooltip" data-placement="top" title="Tipo de salário">
							<option value="">Tipo de salário</option>
							<option value="1">Mensalista</option>
							<option value="2">Horista</option>
							<option value="3">Diarista</option>
							<option value="4">Comissionado</option>
							<option value="5">Tarefeiro</option>
							<option value="6">Terceiro</option>		
						</select>
						</div>

						<div class="clearfix"></div>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
							<span class="input-group-addon fleft">
									<span class="" id='' style="margin-left: -5px;">R$</span>
								</span>
								<input type="text" name="salario_admissao" class="pequeno campomoeda fleft" placeholder="Salário" required="true" data-toggle="tooltip" data-placement="top" title="Salário">
								
							</div>
						</div>
						</div>

					</div><!--linha3-->

					<!--linha 3-->
					<div class="fleft" style="margin-top: 10px;">
					<h4>Documentos</h4>
						<input type="number" name="nr_ctps" required="true" class="fleft fleftmobile md10" placeholder="CTPS N&ordm;" data-toggle="tooltip" data-placement="top" title="Número da carteira de trabalho">

						<input type="text" name="serie_ctps" required="true" class="fleft fleftmobile md10" placeholder="Série N&ordm;" data-toggle="tooltip" data-placement="top" title="Série da carteira de trabalho">

						<select name="estado_ctps" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Estado da carteira">
						<option value="">Estado da Carteira</option>
							<?php foreach ($estados as $key => $value) { ?>
								<option value="<?php echo $value->est_idestado; ?>"><?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" required="true" name="dt_emissaoctps" class="pequeno data fleft" placeholder="Emissão CTPS" data-toggle="tooltip" data-placement="top" title="Data de emissão da carteira">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>
						<input type="number" name="nr_pis" class="fleft fleftmobile md10" placeholder="PIS:" data-toggle="tooltip" data-placement="top" title="Número do PIS">

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="dt_emissaopis" class="data fleft" placeholder="Data de Emissão PIS" data-toggle="tooltip" data-placement="top" title="Data de emissão do PIS">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>
					</div>

					<!--linha 4-->
									
					<div class="fleft" style="margin-top: 10px;">
					
						<input type="number" name="reservista" class="fleft fleftmobile md10" placeholder="Reservista" data-toggle="tooltip" data-placement="top" title="Número da reservista">

						<input type="text" name="cpf" required="true" class="fleft fleftmobile md10" placeholder="CPF:" data-toggle="tooltip" data-placement="top" title="Número do CPF">

						<input type="text" name="rg" required="true" class="fleft fleftmobile md10 " placeholder="RG:" data-toggle="tooltip" data-placement="top" title="Número do RG">

						<input type="text" name="rgorgao" required="true" class="pequeno fleft fleftmobile md10" placeholder="Orgão Emissor" data-toggle="tooltip" data-placement="top" title="Orgão emissor do RG">

						<div class="fleft fleftmobile md10">
							<div class='input-group date' >
								<input type="text" name="rg_emissao" required="true" class="data fleft" placeholder="Data Emissão RG" data-toggle="tooltip" data-placement="top" title="Data de emissão do RG">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
								</span>
							</div>
						</div>

						<select name="rg_estado" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Estado do RG">
						<option value="">Estado do RG</option>
							<?php foreach ($estados as $key => $value) { ?>
								<option value="<?php echo $value->est_idestado; ?>"><?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>
					</div>

					<!--CNH-->
					<div class="fleft" style="margin-top: 10px;">
						<input type="text" name="cnh" class="fleft fleftmobile md10" placeholder="Carteira de Habilitação" data-toggle="tooltip" data-placement="top" title="Número da habilitação">

						<div class='input-group date fleft md10' >
								<input type="text" name="vencimentocnh" class="pequeno data fleft" placeholder="Vencim. CNH" data-toggle="tooltip" data-placement="top" title="Data de vencimento da CNH">
								<span class="input-group-addon fleft">
									<span class="fa fa-calendar" id='' style="margin-left: -7px;"></span>
								</span>
							</div>

						<select name="cnhcategoria" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Categoria da CNH">
							<option value="">Categoria da CNH</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="A/B">A/B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						</select>
						<input type="number" name="titulo" required="true" class="fleft fleftmobile md10" placeholder="Titulo de Eleitor:"  data-toggle="tooltip" data-placement="top" title="Titulo de eleitor">

						<input type="number" name="zona" required="true" class="fleft fleftmobile md10" placeholder="Zona" data-toggle="tooltip" data-placement="top" title="Zona do titulo">

						<input type="number" name="secao" required="true" class="fleft fleftmobile md10" placeholder="Seção" data-toggle="tooltip" data-placement="top" title="Seção do titulo">

					</div>

					<!--linha endereco-->
					<div class="fleft" style="margin-top: 10px;">
						<h4>Endereço</h4>
						<select name="fk_logradouro_admissao" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="tipo de logradouro">
							<option value="">Tipo de logradouro</option>
							<?php foreach ($logradouros as $key => $value) { ?>
								<option value="<?php echo $value->idtipologradouro; ?>"><?php echo $value->descricaologradouro; ?></option>
							<?php } ?>
						</select>

						<input type="text" name="endereco_admissao" required="true" class="grande fleft fleftmobile md10" placeholder="Endereço" data-toggle="tooltip" data-placement="top" title="Endereço" >

						<input type="number" name="endereconumero" class="pequeno fleft fleftmobile md10" placeholder="N&ordm;" data-toggle="tooltip" data-placement="top" title="Número da residência">

						<input type="text" name="enderecocomplemento" class="fleft fleftmobile md10" placeholder="Complemento" data-toggle="tooltip" data-placement="top" title="Complemento">

					</div>

					<!--contato-->
					<div class="fleft" style="margin-top: 10px;">
						<select name="fk_enderecoestado" id="estadoendereco" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Estado">
							<option value="">Estado</option>
							<?php foreach ($estados as $key => $value) { ?>
								<option value="<?php echo $value->est_idestado; ?>"><?php echo $value->est_nomeestado; ?></option>
								<?php } ?>
						</select>

						<select name="fk_enderecocidade" id="cidadeendereco" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Cidade">
						</select>

						<select name="fk_enderecobairro" id="bairro" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Bairro"></select>

						<input type="number" name="cep_admissao" required="true" class=" fleft fleftmobile md10" placeholder="CEP" data-toggle="tooltip" data-placement="top" title="CEP">

						<input type="text" name="telefone_admissao" class="fleft fleftmobile md10 tel" placeholder="Telefone" data-toggle="tooltip" data-placement="top" title="Telefone fixo">

						<input type="text" name="celular_admissao" required="true" class="cel fleft fleftmobile md10" placeholder="Celular" data-toggle="tooltip" data-placement="top" title="Celular">

					</div>	

					<!--linha 6-->
					<div class="fleft" style="margin-top: 10px;">
					<h4>Informações complementares</h4>
					<select name="fkestadocivil" required="true" class="md10 fleft fleftmobile" style="" data-toggle="tooltip" data-placement="top" title="Estado Civil">
						<option value="">Estado Civil</option>
						<?php foreach ($estadocivis as $key => $value) { ?>
						<option value="<?php echo $value->id_estciv; ?>"><?php echo $value->estciv_descricao; ?></option>
						<?php } ?>
					</select>

						<select name="fk_escolaridade_admissao" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Escolaridade">
							<option value="">Grau de Instrução</option>
							<?php foreach ($escolaridade as $key => $value) { ?>
								<option value="<?php echo $value->id_escolaridade; ?>"><?php echo $value->escolaridade_descricao; ?></option>
							<?php } ?>
						</select>

						<select name="fk_etnia_admissao" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Etnia">
							<option value="">Etnia</option>
							<?php foreach ($etnia as $key => $value) { ?>
								<option value="<?php echo $value->id_etnia; ?>"><?php echo $value->etnia_descricao; ?></option>
							<?php } ?>
						</select>

						<select name="fk_deficiencia_admissao" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Deficiência">
							<option value="">Deficiência</option>
							<option value="0">Nenhuma</option>
							<?php foreach ($deficiencia as $key => $value) { ?>
								<option value="<?php echo $value->id_tipodeficiencia; ?>"><?php echo $value->descricaodeficiencia; ?></option>
							<?php } ?>	
						</select>

						<div class="fleft fleftmobile md10">
							<select name="ic_reabilitado" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Reabilitação">
								<option value="">Reabilitado</option>
								<option value="1">Sim</option>
								<option value="0">Não</option>
							</select>
						</div>

					</div>

					<!--linha 10-->
					
						<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10">Recolheu contribuição sindical nesse ano? Verificar na CTPS</span>
						<label class="md10"><input type="radio" class="icheckbox" value="1" name="ic_contribuicaosindical" required="true">Sim</label>
						<label><input type="radio" class="icheckbox" value="0" name="ic_contribuicaosindical" required="true" checked="">Não</label>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Periculosidade</span>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="1" name="ic_periculosidade" required="true">Sim</label>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="0" name="ic_periculosidade" required="true" checked="">Não</label>
						<select name="valorpericulosidade" class="fleft fleftmobile md10" placeholder="Percentual:" disabled="true">
							<option value="">Percentual</option>
							<option value="0">0%</option>
							<option value="30">30%</option>
						</select>
					</div>
					
				</div><!--linha1-->

				<div class="fleft" style="margin-top: 10px;">
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10 fleft">Insalubridade</span>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="1" name="ic_insalubridade" required="true">Sim</label>
						<label class="fleft md10"><input type="radio" class="icheckbox" value="0" name="ic_insalubridade" required="true" checked="">Não</label>
						<!--<input type="text" name="insa_perc" class="fleft fleftmobile md10 pequeno" placeholder="Percentual:" disabled="true">-->
						<select name="valorinsalubridade" required="true" class="fleft fleftmobile md10" disabled="true" data-toggle="tooltip" data-placement="top" title="Percentual">
							<option value="">Percentual</option>
							<option value="20">20%</option>
							<option value="40">40%</option>
						</select>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<select name="contratoexperiencia" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Contrato por experiência">
							<option value="">Contrato por experiência</option>
							<option value="0">0</option>
							<option value="30">30</option>
							<option value="45">45</option>
							<option value="60">60</option>
						</select>

						<select name="contratoprorrogacao" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Prorrogação do contrato">
							<option value="">Prorrogação do Contrato</option>
							<option value="0">0</option>
							<option value="30">30</option>
							<option value="45">45</option>
							<option value="60">60</option>
						</select>
					</div>
				</div>

				<div class="fleft borda" style="margin-top: 10px;">
				<select name="ic_adiantamento" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Adiantamento salário">
					<option value="">Adiantamento Salarial</option>
					<option value="1">Sim</option>
					<option value="0">Não</option>
				</select>

				<select name="ic_decimoterceiro" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Décimo Terceiro">
					<option value="">13&ordm; Salario</option>
					<option value="1">Sim</option>
					<option value="0">Não</option>
				</select>
				</div>


				<!--linha 2-->
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<select name="tipopagamento" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Modo de pagamento">
							<option value="">Modo de pagamento</option>
							<option value="1">Cheque</option>
							<option value="2">Dinheiro</option>
							<option value="3">Ordem de pagamento</option>
							<option value="4">Relação Bancária</option>
						</select>

						<select name="fk_idbanco" class="fleft md10" required="true" id="selectbanco" data-toggle="tooltip" data-placement="top" title="Banco">
							<option value="">Banco</option>
							<?php foreach ($bancos as $key => $value) { ?>
							<option value="<?php echo $value->id_banco; ?>"><?php echo $value->nome_banco; ?></option>
							<?php } ?>
						</select>

						<input type="text" name="bancoagencia" required="true" class="pequeno fleft fleftmobile md10" placeholder="Agencia:" data-toggle="tooltip" data-placement="top" title="Agência">

						<input type="text" name="bancoconta" required="true" class="pequeno fleft fleftmobile md10" placeholder="Conta:" data-toggle="tooltip" data-placement="top" title="Número da Conta">

						<input type="number" name="contadigito" required="true" class="pequeno fleft fleftmobile md10" placeholder="Digito"  data-toggle="tooltip" data-placement="top" title="Dígito da conta">

						<select name="tipoconta" required="true" class="fleft fleftmobile md10" data-toggle="tooltip" data-placement="top" title="Tipo de conta">
							<option value="">Tipo de Conta</option>
							<option value="1">Corrente</option>
							<option value="2">Poupança</option>
							<option value="3">Salario</option>
							<option value="4">Outros</option>
						</select>
					</div>
				</div>

				<!--vale transporte-->
				<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="md10 fleft">Vale Transporte</span>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="1" name="ic_vt" required="true">Sim</label>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="0" name="ic_vt" required="true" checked>Não</label>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Vale Refeição</span>
						<label class="md10"><input type="radio" class="icheckbox" value="1" name="ic_vr" required="true">Sim</label>
						<label><input type="radio" class="icheckbox" value="0" name="ic_vr" required="true" checked>Não</label>
					</div>

					<div class="fleft fleftmobile md10 borda" style="">
						<span class="fleft md10">Assistencia Médica</span>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="1" name="ic_assistenciamedica" required="true">Sim</label>
						<label class="md10 fleft"><input type="radio" class="icheckbox" value="0" name="ic_assistenciamedica" required="true" checked>Não</label>
						
					</div>
					</div>

					<div class="fleft" style="margin-top: 10px;">
					<div class="fleft fleftmobile md10 borda" style="">
						<span class="">Recebendo seguro desemprego</h4>
						<label class="md10"><input type="radio" class="icheckbox" value="1" name="ic_segurodesemprego" required="true">Sim</label>
						<label><input type="radio" class="icheckbox" value="0" name="ic_segurodesemprego" required="true" checked>Não</label>
					</div>

				</div>

				<!--linha3-->
				<div class="fleft" style="margin-top: 10px;">
					<input type="text" name="emailcomercial" class="fleft fleftmobile md10 grande" placeholder="Email Empresa" data-toggle="tooltip" data-placement="top" title="Email empresa">
					<input type="text" name="emailparticular" class="fleft fleftmobile md10 grande" placeholder="e-mail particular" data-toggle="tooltip" data-placement="top" title="Email particular">
				</div>
					</div>
					<div class="clearfix"></div>
					<button class="btn btn-primary" style="margin-top: 7px;">Concluir</button>
					</form>
			</div><!--fim da aba pessoais-->

			<div class="tab-pane " id="dependentes">
			<form id="formdep" class="form" method="post" action="<?php echo base_url('home/salvar_dependente'); ?>">
				<div class="fleft" style="margin-top: 10px;">
					<span class="btn btn-primary" id="add">Salvar</span>
				</div>

				<div class="clearfix"></div>

				<!--linha 1-->
				<div id="linha" class="fleft" style="margin-top: 10px;">

					<input type="text" name="nome_depadmissao" class="fleft fleftmobile md10 grande" placeholder="Nome Completo:" required data-toggle="tooltip" data-placement="top" title="Nome completo">

					<input type="number" name="cpf_depadmissao" class="fleft fleftmobile md10" placeholder="CPF:" data-toggle="tooltip" data-placement="top" title="CPF do dependente" >

					<div class="fleft fleftmobile md10">
						<div class='input-group date' >
							<input type="text" name="nascimento_depadmissao" class="data fleft" placeholder="Data de Nascimento" required data-toggle="tooltip" data-placement="top" title="Data de Nascimento" >
							<span class="input-group-addon fleft">
								<span class="fa fa-calendar" id='' style="margin-left: -5px;"></span>
							</span>
						</div>
					</div>

					<select name="sexo_depadmissao" class="fleft fleftmobile md10" required data-toggle="tooltip" data-placement="top" title="Sexo">
						<option value="">Sexo</option>
						<option value="1">Masculino</option>
						<option value="2">Feminino</option>
					</select>

					<select name="ic_ir_depadmissao" class="fleft fleftmobile md10" required data-toggle="tooltip" data-placement="top" title="Imposto de renda">
						<option value="">Imposto de Renda</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
					</div>

					<div class="clearfix"></div>

					<div style="margin-top: 10px;">		
					<select name="fk_idparentesco" class="fleft fleftmobile md10" required data-toggle="tooltip" data-placement="top" title="Parentesco">
						<option value="">Parentesco</option>
						<?php foreach ($parentesco as $key => $value) { ?>
							<option value="<?php echo $value->tipdep; ?>"><?php echo $value->descricao; ?></option>
						<?php } ?>
					</select>

					<select name="ic_auxfamilia" class="fleft fleftmobile md10" required data-toggle="tooltip" data-placement="top" title="Auxilio familia">
						<option value="">Auxilio Familia</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>

					<input type="text" name="nomemae" class="fleft fleftmobile md10 grande" placeholder="Nome da Mãe:" data-toggle="tooltip" data-placement="top" title="Nome da mãe" >
					</div>
					</form>

				<div class="clearfix"></div>

				<div id="rascdep"></div>
				
			</div><!-- tab dependentes-->

			<div class="tab-pane" id="rascunho">

				<table id="tabelarascunho" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Colaborador</th>
							<th>Filial</th>
							<th>Data da admissão</th>
							<th>Cargo</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rascunho as $key => $value) { 

							$data = $this->Log->alteradata1( $value->data_admissao );

							?>

							<tr class="rasc" id="<?php echo $value->id_admissao; ?>" style="cursor: pointer;">

								<td ><?php echo $value->nome_admissao ?></td>
								<td ><?php echo $value->fil_nomefantasia; ?></td>
								<td ><?php echo $data; ?></td>
								<td ><?php echo $value->descricao; ?></td>
							</tr>
							<?php }  ?>
					</tbody>
				</table>

			</div>

			<div class="tab-pane " id="docs">
				<form id="documento" action="<?php echo base_url("home/salvarDocAdmissao"); ?>" class="dropzone">
					<div class="fallback">
						<input name="file" type="file" multiple />
					</div>
				</form>
				<div class="clearfix"></div>
				<div id="docsalvos"></div>

			</div>
		
		</div><!--tab content-->
		
	</div><!--tabs-->
	<input type="hidden" name="id_admissao" id="id_admissao" value="0">
	
	
</div><!--col-md-12-->
<script type="text/javascript" src="<?php echo base_url("js/plugins/dropzone/dropzone.min.js"); ?>"></script>
<script type="text/javascript">

	$(document).on("ready", function(){

		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("#documento", {
			url: '<?php echo base_url("home/salvarDocAdmissao"); ?>',
			maxFilesize: 5,
			dictFileTooBig: "Arquivo muito grande ({{filesize}}MB). Tamanho máximo: {{maxFilesize}}MB.",

			init: function() {
    			this.on("success", function(r, x){

    				getdocs($("#id_admissao").val());
    			});

    			this.on("sending", function(file, xhr, formData){

    				formData.append('idadmissao', $("#id_admissao").val());
    				
    			});

    			this.on("error", function(arg, erro, xmlhttp){

    				console.log(erro);
    			});
  			}
			
		});
		
	});
	
  	$('a[href="#docs"]').on("shown.bs.tab", function(){
  		if ($("#id_admissao").val()==0) {
  			$(".alert").addClass("alert-danger")
  			.html("Preencha os dados pessoais primeiro")
  			.slideDown("slow");
  			$(".alert").delay( 3500 ).hide(500);
  			$("#documento").fadeOut();
  		}else{
  			$("#documento").show();
  		}
  	});

	$("#pessoais input, #pessoais select").blur(function(){
		var id = $("#id_admissao").val();
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
					$("#id_admissao").val(msg.id);
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

	$("[name='ic_periculosidade']").on('ifToggled', function(event){
		
		if ($(this).val()==1 ) {
  			$("[name='valorpericulosidade']").attr("disabled", false);
  		}else{
  			$("[name='valorpericulosidade']").val("").change();
  			$("[name='valorpericulosidade']").attr("disabled", true);
  		}
  		$(this).focus();
	});

	$("[name='ic_insalubridade']").on('ifToggled', function(event){
		
		if ($(this).val()==1 ) {
  			$("[name='valorinsalubridade']").attr("disabled", false);
  		}else{
  			$("[name='valorinsalubridade']").val("").change();
  			$("[name='valorinsalubridade']").attr("disabled", true);
  		}
  		$(this).focus();		
	});

	$("[name='ic_contribuicaosindical'], [name='vt'], [name='vr'], [name='ic_assistenciamedica'], ic_segurodesemprego").on('ifToggled', function(event){
	
		$(this).focus();
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
	$("[name='fk_horbase']").change(function(){
		
		$(this).focus();
		if ($(this).val() != ""){
			$('[data-id="selecthorabase"]').css({
				"background-color":"#f0fff1", 
				"border-color": "#13da28"
			});
		}else{
			$('[data-id="selecthorabase"]').css({
				"background-color":"#ffcccc",
				"border-color": "red"
			});
		}
	});
	$("[name='fk_horsab']").change(function(){
		
		$(this).focus();
		if ($(this).val() != ""){
			$('[data-id="selecthorsab"]').css({
				"background-color":"#f0fff1", 
				"border-color": "#13da28"
			});
		}else{
			$('[data-id="selecthorsab"]').css({
				"background-color":"#ffcccc",
				"border-color": "red"
			});
		}
	});

	$('.tel').mask("(99)9999-9999");
	$('.cel').mask("(99)99999-9999");
	$('.cep').mask("99999999");
	$('.hora').mask("99:99");
	/*$('.hora').keyup(function(){
		var hora = $(this).val().substr(0, 2);
		if (hora>24) {
			$(this).val("");
		}
		var min = $(this).val().substr(3, 2);
		if (min>59) {
			var h = $(this).val().substr(0, 3);
			$(this).val(h + "59");
		}
	});*/

	$(".campomoeda").maskMoney({thousands:'.',decimal:','});

	$("#add").click(function(){
		
		$("#formdep").submit();
		return;

	});

	$(document).on("click",".excpar", function(){
		var n = $(this).attr("del");
		$("#"+n).remove();
	});

	$(document).on("click",".excdep", function(){
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
				$("#tr"+id).remove();
			} 
		});
	});

	$(document).on("click",".excdoc", function(){
		var id = $(this).data("id");
		$.ajax({         
			type: "POST",
			url: '<?php echo base_url('home/excluirdoc') ?>',
			secureuri:false,
			cache: false,
			data:{
				id : id
			},              
			success: function(j){
				$("#trdoc"+id).remove();
			} 
		});
	});

	$(document).on("click",".verdoc", function(){
		var arq = $(this).data("arq");
		window.open('<?php echo base_url("home/lerdoc"); ?>?arq='+arq, '_blank');
		
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

      	/*var options = "<option value=''>Cidade</option>";
      	
      	for (var i = 0; i < j.length; i++) {
      		options += '<option value="' + j[i].cid_idcidade + '">' + j[i].cid_nomecidade + '</option>';
      	}*/
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
      	/*var options = "<option value=''>Cidade</option>";
      	for (var i = 0; i < j.length; i++) {
      		options += '<option value="' + j[i].cid_idcidade + '">' + j[i].cid_nomecidade + '</option>';
      	}*/
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
      	/*var options = "<option value=''>Bairro</option>";
      	for (var i = 0; i < j.length; i++) {
      		options += '<option value="' + j[i].bair_idbairro + '">' + j[i].bair_nomebairro + '</option>';
      	}*/
      	$('#bairro').html(j);  
      	$('#loadest').remove();  
      } 
    	});
		
	});

	$("[name='sabadoentrada']").focusin(function(){

		calcular();
	});

	function calcular(){
		var entradah = (parseInt($("[name='entrada']").val().substr(0,2)));	
		var saidainterH	  = (parseInt($("[name='saidaintervalo']").val().substr(0,2)));	
		var entradainterH	 = (parseInt($("[name='entradaintervalo']").val().substr(0,2)));	
		var saidah	   = (parseInt($("[name='saida']").val().substr(0,2))); 

		var thm = (saidainterH - entradah);	
		var tht = (saidah  - entradainterH);

		var th = saidah - entradah;
		var thx = entradainterH - saidainterH;
		var x = (th - thx) * 5;
		console.log(x);

		var entradam	 = (parseInt($("[name='entrada']").val().substr(3,4)));	
		var saidainterm	  = (parseInt($("[name='saidaintervalo']").val().substr(3,4)));	
		var entradainterm	 = (parseInt($("[name='entradaintervalo']").val().substr(3,4)));	
		var saidam	   = (parseInt($("[name='saida']").val().substr(3,4))); 

		//console.log(Math.floor(entradam / 60));

		var thm = Math.floor(thm - (entradam / 60));	
		//console.log(thm);	
		var tht = Math.floor(tht - (saidam / 60));
		//console.log(tht);
		//alert (tht);	
		/*****************************************************/	
		// conta os minuto a soma da hora do almoço	
		//var somam = (60 - entradam);	
		//alert (somam);	
		//var somam = (somam + iniciom);	
		//alert (somam);	
		// conta os minuto a soma da hora depois do almoço	
		//var somat = (60 - terminom);	
		//alert (somat);	
		//var somat = (somat + saidam);		
		//	alert (somat);
		/*****************************************************/	
		//var totalm = ( somam + somat );		
		//alert (totalm);	
		/*if (totalm > 60){
			var hora = (totalm / 60);
			var hora = (hora + thm + tht);
			var phora = hora.substring(0, 2);
			var pminuto = hora.substring(2, 3);
			var total = ( phora + ':' + pminuto );
			alert (hora);
		}else{
			var hora = (thm + tht);
			var total = ( hora + ':' + totalm );
			alert (total);
		}	*/
	}

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
          reservista: {number:true, maxlength: 20},
          nr_pis: {number:true, maxlength: 11},
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
        var id = $("#id_admissao").val();

        $.ajax({           
				type: "POST",
				url: '<?php echo base_url('home/salvar_admissao') ?>',
				secureuri:false,
				cache: false,
				dataType: "json",
				data:{
					id: id,
					campo: "admissao_status",
					valor: 1
				},              
				success: function(msg) 
				{
					$(".alert").removeClass("alert-danger")
						.addClass("alert-success")
						.html("Salvo com sucesso.")
						.slideDown("slow");

					$('html, body').animate({scrollTop:0}, 'slow');

					$(".alert").delay( 3000 ).hide(500, function(){
						location.reload();
					});

				},
				error: function(msg){
					$(".alert").addClass("alert-danger")
						.html("Houve um erro. Contate o suporte.")
						.slideDown("slow");
						$(".alert").delay( 3500 ).hide(500);
				}
			});
      }
   });

	$("#formdep").validate({
		submitHandler:function(form) {
			var id = $("#id_admissao").val();
			
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
						$("#loadadm").hide();
						return;
					}else{
						$("#formdep input").val("");
						$("#formdep select").val("").change();
						getdependentes(id);
					}
					$("#loadadm").hide();			

				},
				error: function(msg){
					$("#loadadm").hide();
				}
			});

		}
	});

	$(".rasc").click(function(){
		var rasc = $(this).attr("id");
		$("#loadadm").show();
		Dropzone.forElement("#documento").removeAllFiles(true);

		$.ajax({      
			type: "POST",
			url: '<?php echo base_url('home/rascunhoadmissao') ?>',
			secureuri:false,
			cache: false,
			dataType:"json",
			data:{
				id: rasc
			},
			success: function(j){
				Object.keys(j).forEach(function(key) {
					$("[name="+key+"]").val(j[key]);
					if($("[name="+key+"]").is('select')){
						$("[name="+key+"]").change();
					}
				});
				$('a[href="#pessoais"]').tab('show');
				$("#loadadm").hide();
				getdependentes(rasc);
				getdocs(rasc);
			} 
		});
	});

	function getdependentes(id){
		$.ajax({      
			type: "POST",
			url: '<?php echo base_url('home/getDependentes') ?>',
			secureuri:false,
			cache: false,
			data:{
				id: id
			},
			success: function(j){
				$("#rascdep").html(j);	
			} 
		});
	}

	function getdocs(id){
		$.ajax({      
			type: "POST",
			url: '<?php echo base_url('home/getDocs') ?>',
			secureuri:false,
			cache: false,
			data:{
				id: id
			},
			success: function(j){
				$("#docsalvos").html(j);	
			} 
		});
	}

</script>