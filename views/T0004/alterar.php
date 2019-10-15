<?php
//Instancia Class
$obj            =   new models_T0004()                  ;

//Combos
$comboTpPessoa  =   $obj->retornaTpPessoa()             ;
$comboEstado    =   $obj->retornaEstados()              ;

$codigoCliente  =   $_REQUEST['codigoCliente']          ;
    
//Dados dos Campos
$dados          =   $obj->retornaDados($codigoCliente)  ;

if(!empty($_POST))
{
    //Retira mascara
    $campos         =   $obj->retiraMascaraArray($_POST)        ;
    
    $tabela         =   "T002_cliente"                          ;
    
    $delimitador    =   "t002_codigo    =".$codigoCliente       ;
    
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
                <option value="<?php echo $valores['CodigoTpPessoa'];?>" <?php echo $valores['CodigoTpPessoa']==$vls['CodTpPessoaCliente']?"selected":""?>><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoTpPessoa'], $valores['TipoTpPessoa'])?></option>
                <?php }?>
            </select>
        </div>

        <div class="clear"></div>

        <div class="grid_7">
            <p>Nome/Razão Social*</p>
            <input type="text" name="T002_nome"         class="validate[required] text-input"       value="<?php echo $vls['NomeCliente']?>"/>
        </div>
        
        <div class="grid_3">
            <p>CPF/CNPJ*</p>
            <input type="text" name="T002_cnpj_cpf"     class="validate[required] text-input cpf"   value="<?php echo $vls['CpfCliente']?>"/>
        </div>
        
        <div class="grid_3">
            <p>RG/Incrição Estadual*</p>
            <input type="text" name="T002_insc_rg"      class="validate[required] text-input rg"    value="<?php echo $vls['RgCliente']?>"/>
        </div>
        
        <div class="clear"></div>

        <div class="grid_2">
            <p>Estado</p>
            <select name="T009_codigo">      
                <?php foreach($comboEstado as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoEstado'];?>" <?php echo $vls['EstadoCliente']==$valores['CodigoEstado']?"selected":"";?>><?php echo $valores['UfEstado'];?></option>
                <?php }?>
            </select>
        </div>

        <div class="grid_3">
            <p>Cidade</p>
            <input type="text" name="T002_cidade"                                                   value="<?php echo $vls['CidadeCliente']?>"/>
        </div>

        <div class="grid_3">
            <p>Bairro</p>
            <input type="text" name="T002_bairro"                                                   value="<?php echo $vls['BairroCliente']?>"/>
        </div>

        <div class="grid_6">
            <p>Endereço</p>
            <input type="text" name="T002_endereco"                                                 value="<?php echo $vls['EnderecoCliente']?>"/>
        </div>

        <div class="clear"></div>


        <div class="grid_3">
            <p>Número</p>
            <input type="text" name="T002_numero"                                                   value="<?php echo $vls['NumeroCliente']?>"/>
        </div>

        <div class="grid_3">
            <p>Complemento</p>
            <input type="text" name="T002_complemento"                                              value="<?php echo $vls['ComplementoCliente']?>"/>
        </div>

        <div class="grid_3">
            <p>CEP</p>
            <input type="text" name="T002_cep"          class="cep"                                 value="<?php echo $vls['CepCliente']?>"/>
        </div>

        <div class="grid_1">
            <p>DDD</p>
            <input type="text" name="T002_ddd"          class="ddd"                                 value="(<?php echo $vls['DddCliente']?>)"/>
        </div>

        <div class="grid_2">
            <p>Telefone</p>
            <input type="text" name="T002_telefone"     class="telefone"                            value="<?php echo $vls['TelefoneCliente']?>"/>
        </div>

        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Alterar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        <?php }?>
    </div>        
</form>