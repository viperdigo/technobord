<?php
//Instancia Class
$obj                =   new models_T0005()                  ;

//Combos
$comboTpPessoa      =   $obj->retornaTpPessoa()             ;
$comboEstado        =   $obj->retornaEstados()              ;

$codigoFornecedor   =   $_REQUEST['codigoFornecedor']       ;
    
//Dados dos Campos
$dados          =   $obj->retornaDados($codigoFornecedor)   ;

if(!empty($_POST))
{
    //Retira mascara
    $campos         =   $obj->retiraMascaraArray($_POST)        ;
    
    $tabela         =   "T003_fornecedor"                       ;
    
    $delimitador    =   "t003_codigo    =".$codigoFornecedor    ;
    
    $alterar =   $obj->atualizar($tabela, $campos, $delimitador);
    if ($alterar)
    {
        header("Location: ".ROUTER."home");
        exit;
    }    
}
?>
<div id="barra-botoes">
    <a href="<?php echo ROUTER?>home" class="ui-state-default ui-corner-all botoes-links"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Voltar</a>
    <hr>    
</div>
<form action="" method="post" class="validar">    
    <div class="conteudo_16">
        <?php foreach($dados    as $campos  =>  $vls){?>
        <div class="grid_2">
            <p>Tipo Pessoa</p>
            <select name="T010_codigo" class="validate[required]">      
                <?php foreach($comboTpPessoa as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoTpPessoa'];?>" <?php echo $valores['CodigoTpPessoa']==$vls['CodTpPessoaFornecedor']?"selected":""?>><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoTpPessoa'], $valores['TipoTpPessoa'])?></option>
                <?php }?>
            </select>
        </div>

        <div class="clear"></div>

        <div class="grid_8">
            <p>Razão Social*</p>
            <input type="text" name="T003_razao_social"         class="validate[required] text-input"       value="<?php echo $vls['RazaoSocialFornecedor']?>"  />                  
        </div>

        <div class="grid_6">
            <p>Nome Fantasia</p>
            <input type="text" name="T003_nome_fantasia"                                                    value="<?php echo $vls['NomeFantasiaFornecedor']?>" />                  
        </div>
        
        <div class="clear"></div>
        
        <div class="grid_3">
            <p>CNPJ*</p>
            <input type="text" name="T003_cnpj"                 class="validate[required] text-input cnpj"  value="<?php echo $vls['CnpjFornecedor']?>"         />                  
        </div>
        
        <div class="grid_3">
            <p>Incrição Estadual</p>
            <input type="text" name="T003_inscricao_estadual"                                               value="<?php echo $vls['InscEstadualFornecedor']?>" />                  
        </div>
        
        <div class="grid_3">
            <p>Incrição Municipal</p>
            <input type="text" name="T003_inscricao_municipal"                                              value="<?php echo $vls['InscMunicipalFornecedor']?>"/>                  
        </div>
        
        <div class="clear"></div>

        <div class="grid_2">
            <p>Estado</p>
            <select name="T009_codigo"  class="validate[required]">   
                <?php foreach($comboEstado as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoEstado'];?>" <?php echo $valores['CodigoEstado']==$vls['CodEstadoFornecedor']?"selected":"";?>><?php echo $valores['UfEstado'];?></option>
                <?php }?>
            </select>
        </div>

        <div class="grid_3">
            <p>Cidade</p>
            <input type="text" name="T003_cidade"                                                           value="<?php echo $vls['CidadeFornecedor']?>"       />                  
        </div>

        <div class="grid_3">
            <p>Bairro</p>
            <input type="text" name="T003_bairro"                                                           value="<?php echo $vls['BairroFornecedor']?>"       />                  
        </div>

        <div class="grid_6">
            <p>Endereço</p>
            <input type="text" name="T003_endereco"                                                         value="<?php echo $vls['EnderecoFornecedor']?>"     />                  
        </div>

        <div class="clear"></div>

        <div class="grid_3">
            <p>Número</p>
            <input type="text" name="T003_numero"                                                           value="<?php echo $vls['NumeroFornecedor']?>"       />                  
        </div>

        <div class="grid_3">
            <p>CEP</p>
            <input type="text" name="T003_cep"          class="cep"                                         value="<?php echo $vls['CepFornecedor']?>"          />                  
        </div>

        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Gravar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        <?php }?>
    </div>        
</form>