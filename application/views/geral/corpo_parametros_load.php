<?php

$idparam = "";
$ckind="";
$cklocal="";
$ckf0 = "";
$ckf1 = "";
$ckf2 = "";
$aprh ="";
$apdir ="";

if (!empty($parametros)) {
   

($parametros->Param_chefia==1) ? $cklocal="checked" : $ckind="checked";

switch ($parametros->Param_feed) {
        case '0':$ckf0="checked"; break;
        case '1':$ckf1="checked"; break;
        case '2':$ckf2="checked"; break;        
    }

}


?>
<div class="row">
    <div class="col-md-12">
        <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>
        
<ul class="nav nav-tabs" role="tablist" style="padding: 0px;" >
  <li class="active"><a href="#gerais" aria-controls="gerais" role="tab" data-toggle="tab">Parâmetros Gerais</a></li>
  <li ><a href="#funciona" aria-controls="funciona" role="tab" data-toggle="tab">Controle Funcionalidades</a></li>
  <li ><a href="#relat" aria-controls="relat" role="tab" data-toggle="tab">Relatórios</a></li>
  <li ><a href="#aprov" aria-controls="aprov" role="tab" data-toggle="tab">Aprovadores</a></li>
  <li ><a href="#rh" aria-controls="rh" role="tab" data-toggle="tab">RH</a></li>
  <li ><a href="#lanc" aria-controls="lanc" role="tab" data-toggle="tab">Lançamentos</a></li>
  <!--<li ><a href="#admissoes" aria-controls="admissoes" role="tab" data-toggle="tab">Admissões</a></li>-->
</ul>        

   
<div class="tab-content">
        
<div role="tabpanel" class="tab-pane active" id="gerais">
  <div class="row" >
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-2">
                <span class="bold">Rotina Chefia: </span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_chefia"  class="rdchefia" value="0" <?php echo $ckind; ?> />
                <span>Chefia Individual</span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_chefia"  class="rdchefia" value="1" <?php echo $cklocal; ?> />
                <span>Chefia por local</span>
            </div>
        </div><!--Painel da chefia -->

      
        <div class="panel panel-default" style="padding: 7px 0px;margin-bottom: 1px">
            <div class="col-md-2">
                <span class="bold">Feedbacks: </span>
            </div>
            <div class="col-md-2">
                <input type="radio"  name="Param_feed" value="0" class="rdchefia" <?php echo $ckf0; ?> />
                <span>Somente gestores</span>
            </div>
            <div class="col-md-2">
                <input type="radio"  name="Param_feed" value="1" class="rdchefia" <?php echo $ckf1; ?> />
                <span>Colaboradores Local</span>
            </div>
            <div class="col-md-2">
                <input type="radio" name="Param_feed" value="2" class="rdchefia" <?php echo $ckf2; ?> />
                <span>Todos</span>
            </div>
        </div><!--Painel de Feedbacks -->


        <!--<div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicitações RH: </span>
            </div>
            <div class="col-md-2">
            <select name="fun_id_aprovadorRH" id="rh" class="rdchefia">
                <option value="">Selecione</option>
                <?php foreach ($gestores as $key => $value) { 
                $selected = ($parametros->fun_id_aprovadorRH == $value->fun_idfuncionario)?"selected" : "" ; ?>
                <option value="<?php echo $value->fun_idfuncionario; ?>" <?php echo $selected; ?> ><?php echo $value->fun_nome; ?></option>
            <?php } ?>
            </select>
            </div>
        </div>Painel Aprovador RH -->      
      

        <!--<div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Aprovador Solicitações Direção: </span>
            </div>
            <div class="col-md-2">
                <select name="fun_id_aprovador_Direcao" id="direcao" class="rdchefia" >
                <option value="">Selecione</option>
                <?php foreach ($gestores as $key => $value) { 
                $selected = ($parametros->fun_id_aprovador_Direcao == $value->fun_idfuncionario)?"selected" : "" ; ?>
                    <option value="<?php echo $value->fun_idfuncionario; ?>" <?php echo $selected; ?> ><?php echo $value->fun_nome; ?></option>
                <?php } ?>
                </select>
            </div>
        </div>Painel Aprovador Diretor -->
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Colaborador Solicitar Férias: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="solicitarferias" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->solicitarferias == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Colaborador Solicitar Férias -->

       
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Gestor Solicitar Férias Equipe:</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="feriasequipe" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->feriasequipe == 1)?"checked" : "" ; 
                    }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Férias Equipe Gestor -->     
      
      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px;">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Férias Necessita Aprovação RH: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_ferias" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_ferias == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Aprovação RH -->           

      
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Disponibilizar Opção Abonar Férias: </span>
            </div>
            
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="abonar_ferias" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->abonar_ferias == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Abonar Férias -->

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Colaborador visualiza cartão de ponto: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_visualizarponto" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->ic_visualizarponto == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div> 

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Gestor emite cartão de ponto: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_gestorponto" type="checkbox" class="check" <?php 
                    if (!empty($parametros)) {
                    echo ($parametros->ic_gestorponto == 1)?"checked" : "" ; 
                    } ?> />
                    <span></span>
                </label>
            </div>
        </div>

      
      
  </div>
</div> 

<div role="tabpanel" class="tab-pane" id="funciona">
    <div class="row" >        
  
        
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3">
                <span class="bold">Funcionalidade</span>
            </div>
            <div class="col-md-2">
                <span class="bold">Disponível</span>
            </div>
            <div class="col-md-2">
                <span class="bold">Aprovação RH</span>
            </div>
        </div><!--Painel da chefia -->

        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Dados Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_dadospessoais" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_dadospessoais == 1)?"checked" : "" ; 
                        }
                        ?> class="check"  />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_dadopessoais" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_dadopessoais == 1)?"checked" : "" ; 
                        }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Dados Pessoais -->            
        

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Documentos</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_documentos" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_documentos == 1)?"checked" : "" ; 
                        }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" name="aprovar_documentos" class="check" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_documentos == 1)?"checked" : "" ; 
                        }?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Documentos -->            
        

        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Endereços</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_endereco" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_endereco == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_endereco" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_endereco == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Endereços -->            
        
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Pessoais</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_contatos" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_contatos == 1)?"checked" : "" ; 
                        }?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_contatos" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->aprovar_contatos == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Contatos Pessoais -->            
        
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Ficha Familiar</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_fichafamiliar" class="check" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_fichafamiliar == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input type="checkbox" class="check" name="aprovar_familiar" <?php if (!empty($parametros)) {
                        echo ($parametros->aprovar_familiar == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Ficha Familiar -->          
    
        
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Contatos Telefônicos</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_telefones" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_telefones == 1)?"checked" : "" ; }
                        ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Contatos Telefônicos -->             
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Perfil Profissional</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_perfilprofissional" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_perfilprofissional == 1)?"checked" : "" ;
                        } ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Experiência Profissional -->               
        
            
        <div class="panel panel-default" style="padding: 7px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-3" style="padding: 7px;">
                <span class="bold">Permitir Alterar Formação Acadêmica</span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_academico" class="check" type="checkbox" <?php if (!empty($parametros)) {
                        echo ($parametros->ic_academico == 1)?"checked" : "" ;}
                         ?> />
                    <span></span>
                </label>
            </div>
        </div><!--Permitir Alterar Formação Acadêmica -->                
            
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="relat">
    <div class="row" >
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">URL Ponto</label>
            </div>
            <div class="col-md-5">
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->endwsdl;} ?>" id="endwsdl" name="endwsdl" placeholder="Digite a URL...">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="endwsdl" type="button">ok</button>
                </span>
            </div>
            </div>
                
        </div><!--url-->
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">URL Holerite</label>
            </div>
            <div class="col-md-5">
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->wsdlholerite;} ?>" id="wsdlholerite" name="wsdlholerite" placeholder="Digite a URL...">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="wsdlholerite" type="button">ok</button>
                </span>
            </div>
            </div>
                
        </div><!--urlholerite-->
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">URL Informe</label>
            </div>
            <div class="col-md-5">
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->wsdlinforme;} ?>" id="wsdlinforme" name="wsdlinforme" placeholder="Digite a URL...">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="wsdlinforme" type="button">ok</button>
                </span>
            </div>
            </div>
                
        </div><!--url informe-->
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">URL Férias</label>
            </div>
            <div class="col-md-5">
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->wsdlferias;} ?>" id="wsdlferias" name="wsdlferias" placeholder="Digite a URL...">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="wsdlferias" type="button">ok</button>
                </span>
            </div>
            </div>
                
        </div><!--urlferias-->

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px;">
                <label class="control-label">Usuário</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->userwsdl;} ?>" id="userwsdl" name="userwsdl" placeholder="Login do webservice">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="userwsdl" type="button">ok</button>
                </span>
                </div>
            </div>
                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px;">
                <label class="control-label">Senha</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->senhawsdl;} ?>" id="senhawsdl" name="senhawsdl" placeholder="Senha do webservice">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="senhawsdl" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Ponto</label>
            </div>
            <div class="col-md-2">
            <div class="input-group"> 
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relponto;} ?>" id="relponto" name="relponto" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relponto" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Holerite</label>
            </div>
            <div class="col-md-2">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relholeri;} ?>" id="relholeri" name="relholeri" placeholder="" >
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relholeri" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Informe</label>
            </div>
            <div class="col-md-2">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relinforme;} ?>" id="relinforme" name="relinforme" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relinforme" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Nome do Recibo</label>
            </div>
            <div class="col-md-2">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->relrecibo;} ?>" id="relrecibo" name="relrecibo" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="relrecibo" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Ponto</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradaponto;} ?>" id="entradaponto" name="entradaponto" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradaponto" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Holerite</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradaholerite;} ?>" id="entradaholerite" name="entradaholerite" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradaholerite" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Informe</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradainformes;} ?>" id="entradainformes" name="entradainformes" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradainformes" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>        
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
                <label class="control-label">Entrada do Recibo</label>
            </div>
            <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" value="<?php if (!empty($parametros)) {echo $parametros->entradarecibo;} ?>" id="entradarecibo" name="entradarecibo" placeholder="">
                <span class="input-group-btn">
                    <button class="btn btn-default btnrel" botao="entradarecibo" type="button">ok</button>
                </span>
                </div>
            </div>                
        </div>
        

    </div><!--row-->
</div> <!-- fim tab relatorios-->  

<div role="tabpanel" class="tab-pane" id="aprov">
  <div class="row" >
    <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
        <div class="fleft-1" style="padding: 7px 0px 7px 7px;">
            <span class="bold">Solicitação: </span>
        </div>
        <div class="col-md-2">
            <select name="tipo_solicitacao" id="tipo_solicitacao" class="">
                <option value="">Selecione</option>
                <?php foreach ($tipo_solicitacoes as $key => $value) { ?>
                
                <option value="<?php echo $value->id_tipo_solicitacao; ?>"><?php echo $value->descricao_solicitacao; ?></option>

                <?php } ?>
            </select>
        </div>
        <div class="fleft-2">
            <div class="autocomplete" >
              <input type="text" id="busca_colab" data-campo="colab" data-classe="itemcolab" data-div="lista" class="autocompletar form-control" placeholder="" style="background: transparent;border: none;width: 90px;"/>
              <div id="lista"></div>
          </div>
          <div id="selecionados"></div>
      </div>
      <div class="fleft-1">
          <button id="salvar_solicitacao" class="btn btn-primary">Salvar</button>
      </div>

      <div class="clearfix" style="margin-bottom: 10px;"></div>

      <div class="fleft-4" >
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <span class="bold">Aprovadores</span>
            </div>
            <div class="panel-body list-group list-group-contacts" id="aprovadores"></div>
        </div>
    </div>

    <img id="loadap" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading..." style="display: none;" >
    </div>
    </div>
</div><!-- Fim tab Aprovadores -->

<div role="tabpanel" class="tab-pane" id="rh">
  <div class="row" >
    <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
        <div class="col-md-2" style="padding: 7px 0px 7px 7px;">
            <span class="bold">Responsável pelo RH: </span>
        </div>
        <div class="fleft-2">
            <div class="autocomplete" >
              <input type="text" id="busca_colabrh" data-campo="colab" data-classe="itemrh" data-div="listarh" class="autocompletar form-control" placeholder="" style="background: transparent;border: none;width: 90px;"/>
              <div id="listarh"></div>
          </div>
          <div id="selecionadosrh"></div>
      </div>
      <div class="fleft-1">
          <button id="salvar_resp_rh" class="btn btn-primary">Salvar</button>
      </div>

      <div class="clearfix" style="margin-bottom: 10px;"></div>
      <img id="loadap" src="<?php echo base_url('img/loaders/default.gif') ?>" alt="Loading..." style="display: none;" >

    <div class="fleft-4 fleftmobile">
      <div class="panel panel-default">
        <div class="panel-heading ui-draggable-handle">
            <span class="bold">Responsáveis</span>
        </div>
        <div class="panel-body list-group list-group-contacts">
        <?php foreach ($resprh as $key => $value) { 
            $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
            $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>                          
            <div id="rh<?php echo $value->id_resp_rh; ?>" class="list-group-item fleft-10">                                    
                <img src="<?php echo $foto; ?>" class="pull-left" >
                <span class="contacts-title"><?php echo $value->fun_nome; ?></span>
                <div class="list-group-controls">
                    <button data-id="<?php echo $value->id_resp_rh; ?>" class="btn btn-primary btn-rounded btnexcrh"><span class="fa fa-times"></span></button>
                </div>                                    
            </div>

        <?php } ?>                             
        </div>
    </div>
    </div>
  </div>

  <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
      <div class="col-md-2" style="padding: 7px 0px 7px 7px;">
            <span class="bold">Responsável por admissões: </span>
        </div>
        <div class="fleft-2">
            <div class="autocomplete" >
              <input type="text" id="busca_colabadmissao" data-campo="colab" data-classe="itemadmissao" data-div="listadmissao" class="autocompletar form-control" placeholder="" style="background: transparent;border: none;width: 90px;"/>
              <div id="listadmissao"></div>
          </div>
          <div id="selecionadosadmissao"></div>
      </div>
      <div class="fleft-1">
          <button id="salvar_resp_admissao" class="btn btn-primary">Salvar</button>
      </div>

      <div class="clearfix" style="margin-bottom: 10px;"></div>
      <img id="loadad" src="<?php echo base_url('img/loaders/default.gif') ?>" style="display: none;" >

      <div class="fleft-4 fleftmobile">
      <div class="panel panel-default">
        <div class="panel-heading ui-draggable-handle">
            <span class="bold">Responsáveis</span>
        </div>
        <div class="panel-body list-group list-group-contacts">
        <?php foreach ($respadm as $key => $value) { 
            $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
            $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
        ?>                          
            <div id="adm<?php echo $value->id_responsavel_admissao; ?>" class="list-group-item fleft-10">                                    
                <img src="<?php echo $foto; ?>" class="pull-left" >
                <span class="contacts-title"><?php echo $value->fk_idempresa_admissao." - ".$value->fun_nome; ?></span>
                <div class="list-group-controls">
                    <button data-id="<?php echo $value->id_responsavel_admissao; ?>" class="btn btn-primary btn-rounded btnexcadm"><span class="fa fa-times"></span></button>
                </div>                                    
            </div>

        <?php } ?>                             
        </div>
    </div>
    </div>
  </div>



    </div>
</div><!-- Fim tab RH -->

<div role="tabpanel" class="tab-pane " id="lanc">
  <div class="row" >
        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="col-md-2">
                <span class="bold">Liberado: </span>
            </div>
            <div class="col-md-2">
                <label class="switch switch-small">
                    <input name="ic_lancamento" type="checkbox" <?php 
                    if (!empty($parametros)) {
                        echo ($parametros->ic_lancamento == 1)?"checked" : "" ; 
                        }
                        ?> class="check" />
                    <span></span>
                </label>
            </div>
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <div class="fleft-2" style="padding: 7px 0px 7px 7px;">
                <span class="bold">Responsável pelos lançamentos: </span>
            </div>
            <div class="fleft-2">
                <div class="autocomplete" >
                <input type="text" id="busca_colablanc" data-campo="colab" data-classe="itemlanc" data-div="listalanc" class="form-control" placeholder="" style="background: transparent;border: none;width: 90px;"/>
                  <div id="listalanc"></div>
              </div>
              <div id="selecionadoslanc"></div>
          </div>
          <div class="fleft-1">
              <button id="salvar_resp_lanc" class="btn btn-primary">Salvar</button>
          </div>

          <div class="clearfix" style="margin-bottom: 10px;"></div>
          <img id="loadresp" src="<?php echo base_url('img/loaders/default.gif') ?>" style="display: none;" >

          <div class="fleft-4 fleftmobile">
              <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <span class="bold">Responsáveis</span>
                </div>
                <div class="panel-body list-group list-group-contacts" id="listaresplanc">
                    <?php foreach ($resplanc as $key => $value) { 
                        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
                        $foto = (empty($value->fun_foto) )? base_url("img/".$avatar.".jpg") : $value->fun_foto;
                        ?>                          
                        <div id="lanc<?php echo $value->id_resp_lancamento; ?>" class="list-group-item fleft-10">                                    
                            <img src="<?php echo $foto; ?>" class="pull-left" >
                            <span class="contacts-title"><?php echo $value->fk_idempresa." - ".$value->fun_nome; ?></span>
                            <div class="list-group-controls">
                                <button data-id="<?php echo $value->id_resp_lancamento; ?>" class="btn btn-primary btn-rounded btnexclanc"><span class="fa fa-times"></span></button>
                            </div>                                    
                        </div>

                        <?php } ?>                             
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default" style="padding: 20px 0px 0px 0px;margin-bottom: 1px">
            <label class="col-md-2">Eventos a exibir</label>

            <div class="col-md-3">
                <select name="selectevento" required="true" id="selectevento" class="selectpicker" data-live-search="true" data-div="resultado">
                    <option value="">Evento</option>
                <?php foreach ($eventos as $key => $value) { ?>
                    <option value="<?php echo $value->idevento; ?>"><?php echo $value->CodigoEvento." - ".$value->descricao; ?></option>
                <?php } ?>
                </select>

            </div>

            <div class="col-md-3">
                <select name="selectcampo" required="true" id="selectcampo" class="" >
                    <option value="">Tipo de campo</option>
                    <option value="1">Hora</option>
                    <option value="2">Valor</option>
                    <option value="3">Ambos</option>
                </select>

                <span class="btn btn-default" id="salvar_evento">Salvar</span>
            </div>

            <div class="clearfix"></div>

            <label class="col-md-2">Eventos Salvos</label>
            <div class="col-md-5">
                <div id="ev_salvos">
                    <?php foreach ($evlancamentos as $key => $value) { 
                        switch ($value->tipo_campo) {
                            case '1': $campo = "Campo Hora";break;
                            case '2': $campo = "Campo Valor";break;
                            case '3': $campo = "Campo Hora/Valor";break;                            
                            default:$campo = "Campo Hora";break;
                        }
                        
                        ?>
                    <li class='list-group-item'>
                        <span><?php echo $value->descricao; ?></span>

                        <button data-id="<?php echo $value->idevento; ?>" class="btn btn-primary btn-rounded btnexcevento fright"><span class="fa fa-times"></span>
                        </button>

                        <span class="fright" style="margin-right: 10px;"><?php echo $campo ; ?></span>
                    </li>
                    <?php } ?>
                </div>
            </div>

           
        </div>


    </div>
</div>


</div>

</div>
</div><!--Div da ROW -->
<input type="hidden" name="paramid" id="paramid" value="<?php if (!empty($parametros)) {echo $parametros->param_id;} ?>" >

<script type="text/javascript">

    $(".selectpicker").selectpicker();
    
	$(".rdchefia").change(function(){

        var valor = $(this).val();
        var paramid = $("#paramid").val();
        var campo = $(this).attr("name");
        var empresa = $("#selectempresas").val();

        $.ajax({        
      type: "POST",
      url: '<?php echo base_url("admin/salvarparam");?>',
      dataType : 'json',
      data:{
        valor: valor,
        paramid: paramid,
        empresa: empresa,
        campo: campo
      },
      success: function(msg){
        //console.log(msg);
       
        if(msg.id === 'erro'){
           $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o administrador do sistema")
              .slideDown("slow");

        }else{

            if(msg.id){
                $("#paramid").val(msg.id);
            }           
            
             $(".alert").addClass("alert-success")
              .html("Chefia alterado com sucesso")
              .slideDown("slow");
              
         }
         //$("#load").fadeOut("slow");
         $(".alert").delay( 3500 ).hide(500);
       } 
     });

    });

    $(".check").change(function(){

        $(this).prop("disabled", true);
        var check = $(this);
        var valor = check.prop("checked")==true ? 1:0 ;
        var campo = check.attr("name");
        var paramid = $("#paramid").val();
        var empresa = $("#selectempresas").val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("admin/salvarparam");?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                campo : campo,
                valor : valor,
                empresa: empresa,
                paramid: paramid
            },              
            success: function(msg) 
            {    
                //console.log(msg);
                check.prop("disabled", false);

        } 
        });

    });

    $(".btnrel").click(function(){

        var campo = $(this).attr("botao");
        var valor = $("#"+campo).val();
        var paramid = $("#paramid").val();
        var empresa = $("#selectempresas").val();

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url("admin/salvarparam");?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                campo : campo,
                valor : valor,
                empresa: empresa,
                paramid: paramid
            },              
            success: function(msg) 
            {    
                //console.log(msg);
                //check.prop("disabled", false);
            } 
        });

    });

    $(".autocomplete").click(function(){

      $(this).find("input[type=text]").focus();
    });

    $(".autocompletar").keyup(function(){

        var empresa = $("#selectempresas").val();
      var busca = $.trim( $(this).val() );
      var campo = $(this).data("campo");
      var div = $(this).data("div");
      var classe = $(this).data("classe");
      if(busca !=""){

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("ajax/autocompleteAprovador"); ?>',
          dataType : 'html',
          cache: false,
          data: {
            busca: busca,
            empresa: empresa,
            classe: classe,
            campo: campo
          },           
          success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#"+div).html(msg);

          }

        } 
      }); 
      }else{
        $("#"+div).html("");
      }//if busca
    });

    $("#busca_colabrh").keyup(function(){

        var empresa = $("#selectempresas").val();
      var busca = $.trim( $(this).val() );
      var campo = $(this).data("campo");
      var div = $(this).data("div");
      var classe = $(this).data("classe");
      if(busca !=""){

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/autocompleteRespRH"); ?>',
          dataType : 'html',
          cache: false,
          data: {
            busca: busca,
            empresa: empresa,
            classe: classe,
            campo: campo
          },           
          success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#"+div).html(msg);

          }

        } 
      }); 
      }else{
        $("#"+div).html("");
      }//if busca
    });

    $("#busca_colablanc").keyup(function(){

        var empresa = $("#selectempresas").val();
        var busca = $.trim( $(this).val() );
        var campo = $(this).data("campo");
        var div = $(this).data("div");
        var classe = $(this).data("classe");
        if(busca !=""){

            $.ajax({          
              type: "POST",
              url: '<?php echo base_url("admin/autocompleteRespRH"); ?>',
              dataType : 'html',
              cache: false,
              data: {
                busca: busca,
                empresa: empresa,
                classe: classe,
                campo: campo,
                todos: 1
            },    
            success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

            }else {

                $("#"+div).html(msg);

            }

            } 
            }); 
        }else{
            $("#"+div).html("");
      }//if busca
    });

    $("#busca_colabadmissao").keyup(function(){

        var empresa = $("#selectempresas").val();
      var busca = $.trim( $(this).val() );
      var campo = $(this).data("campo");
      var div = $(this).data("div");
      var classe = $(this).data("classe");
      if(busca !=""){

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/autocompleteRespRH"); ?>',
          dataType : 'html',
          cache: false,
          data: {
            busca: busca,
            empresa: empresa,
            classe: classe,
            campo: campo, 
            todos: 1
          },           
          success: function(msg){
          //console.log(msg);
          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#"+div).html(msg);

          }

        } 
      }); 
      }else{
        $("#"+div).html("");
      }//if busca
    });

    $(document).on("click",".exc", function(){
      var id = $(this).attr("rm");

      $("#colabor"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabs"+id).remove();
        });

     });

    $(document).on("click",".excrh", function(){
      var id = $(this).attr("rm");
      
      $("#colrh"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabsrh"+id).remove();
        });

     });

    $(document).on("click",".exclanc", function(){
      var id = $(this).attr("rm");
      
      $("#colanc"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabslanc"+id).remove();
        });

     });

    $(document).on("click",".excadm", function(){
      var id = $(this).attr("rm");
      
      $("#coladm"+id).fadeOut("slow", function() {
        $(this).remove();
        $("#colabsadm"+id).remove();
        });

     });

    $("#salvar_solicitacao").click(function(){

        var empresa = $("#selectempresas").val();
        var solicitacao = $("#tipo_solicitacao");
        var aprovadores = [];
        var x = 0;

        if(solicitacao.val()==""){
            solicitacao.focus();
            solicitacao.css("border-color", "red");
            return;
        }
        
        $("input[name='colabs[]']").each(function() {
            aprovadores[x] = $(this).val();
            x++;
        });
        if (aprovadores.length<1) {
            return;
        }

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/salvar_aprovadores"); ?>',
          //dataType : 'html',
          cache: false,
          data: {
            empresa: empresa,
            tipo_solicitacao: solicitacao.val(),
            aprovadores: aprovadores
          },           
          success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

             //window.location.href = '<?php echo base_url()."admin/parametros"; ?>';
             $(".excolab").remove();
             $("#selecionados").html("");
             $("#tipo_solicitacao").change();

          }

        } 
      });
    });

    $("#salvar_resp_rh").click(function(){

        var empresa = $("#selectempresas").val();        
        var aprovadores = [];
        var x = 0;
        $("input[name='colabsrh[]']").each(function() {
            aprovadores[x] = $(this).val();
            x++;
        });
        if (aprovadores.length<1) {
            return;
        }

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/salvar_resp_rh"); ?>',
          //dataType : 'html',
          cache: false,
          data: {
            empresa: empresa,
            aprovadores: aprovadores
          },           
          success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else if(msg==1) {

             //window.location.href = '<?php echo base_url("admin/parametros"); ?>';
             $(".excolabrh").remove();
             $("#selecionadosrh").html("");

          }

        } 
      });
    });

    $("#salvar_resp_admissao").click(function(){

        var empresa = $("#selectempresas").val();        
        var aprovadores = [];
        var x = 0;
        $("input[name='colabsadm[]']").each(function() {
            aprovadores[x] = $(this).val();
            x++;
        });
        if (aprovadores.length<1) {
            return;
        }

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/salvar_resp_admissao"); ?>',
          cache: false,
          data: {
            empresa: empresa,
            aprovadores: aprovadores
          },           
          success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else if(msg==1) {

             $(".excolabadm").remove();
             $("#selecionadosadmissao").html("");

          }

        } 
      });
    });

    $("#salvar_resp_lanc").click(function(){


        var empresa = $("#selectempresas").val();        
        var aprovadores = [];
        var x = 0;
        $("input[name='colabslanc[]']").each(function() {
            aprovadores[x] = $(this).val();
            x++;
        });
        if (aprovadores.length<1) {
            return;
        }
        $(this).attr("disabled", true);

        $.ajax({          
          type: "POST",
          url: '<?php echo base_url("admin/salvar_resp_lancamento"); ?>',
          cache: false,
          data: {
            empresa: empresa,
            aprovadores: aprovadores
          },           
          success: function(msg){

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

             $(".excolablanc").remove();
             $("#selecionadoslanc").html("");
             $("#listaresplanc").html(msg);

          }
          $("#salvar_resp_lanc").attr("disabled", false);
        } 
      });
    });

    $("#tipo_solicitacao").change(function(){

        var empresa = $("#selectempresas").val();
        var solicitacao = $(this).val();
        $("#loadap").show();

        $.ajax({        
          type: "POST",
          url: '<?php echo base_url("admin/recuperar_aprovadores"); ?>',
          //dataType : 'html',
          cache: false,
          data: {
            empresa: empresa,
            tipo_solicitacao: solicitacao
          },           
          success: function(msg){
          
          $("#loadap").hide();

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else {

            $("#aprovadores").html(msg);

          }

        } 
      });

    });

    $(document).on("click",".exc_ap", function(){
      var id = $(this).data("id");
      var solicitacao = $("#tipo_solicitacao").val();
      var empresa = $("#selectempresas").val();
      $("#loadap").show();

      $("#apr"+id).fadeOut("slow", function() {
        $(this).remove();
        $.ajax({        
          type: "POST",
          url: '<?php echo base_url("admin/excluir_aprovador"); ?>',
          //dataType : 'html',
          cache: false,
          data: {
            id: id,
            tipo_solicitacao: solicitacao,
            empresa: empresa
          },           
          success: function(msg){
          
          $("#loadap").hide();

          if(msg === 'erro'){

            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

            }
            } 
         });
        });
     });
    
    $(".btnexcrh").click(function(){

        var id = $(this).data("id");

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url("admin/excluir_resprh"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                id: id
            },              
            success: function(msg) 
            {
                if (msg==1) {
                   $("#rh"+id).hide("slow"); 
                }
                
            } 
        });
    });

    $(".btnexclanc").click(function(){

        var id = $(this).data("id");

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url("admin/excluir_resplanc"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                id: id
            },              
            success: function(msg) 
            {
                if (msg==1) {
                   $("#lanc"+id).hide("slow"); 
                }
                
            } 
        });
    });

    $(".btnexcadm").click(function(){

        var id = $(this).data("id");

        $.ajax({             
            type: "POST",
            url: '<?php echo base_url("admin/excluir_respadmissao"); ?>',
            dataType : 'html',
            secureuri:false,
            cache: false,
            data:{
                id: id
            },              
            success: function(msg) 
            {
                if (msg==1) {
                   $("#adm"+id).hide("slow"); 
                }
                
            } 
        });
    });

    $("#salvar_evento").on("click", function(){
      
      if ($("#selectevento").val()=="" || $("#selectcampo").val()=="") {
        return false;
      }

      $("#selectevento").after('<img id="loadev" src="<?php echo base_url('img/loaders/default.gif') ?>" >');
      var idevento = $("#selectevento").val();
      var empresa = $("#selectempresas").val();
      var campo = $("#selectcampo").val();
      var operacao = 1;
     
      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("admin/addevento_lancamento");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          evento: idevento,
          empresa: empresa,
          campo: campo,
          operacao: operacao
        },              
        success: function(msg) {
        
          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
            $("#ev_salvos").html(msg);
          }
          $("#loadev").remove();
                    
        } 
      });
    });

    $(document).on("click",".btnexcevento", function(){
      var idevento = $(this).data("id");
      var empresa = $("#selectempresas").val();
      var operacao = 0;
     
      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("admin/addevento_lancamento");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          evento: idevento,
          empresa: empresa,
          operacao: operacao
        },              
        success: function(msg) {
        
          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);
          }else{
            $("#ev_salvos").html(msg);
          }
          //$("#loadev").remove();
                    
        } 
      });
     });

</script>