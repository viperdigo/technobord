<?php
//Instancia Class
$obj    =   new models_T0004();

$comboTpPessoa  =   $obj->retornaTpPessoa();
$comboEstado    =   $obj->retornaEstados();

if(!empty($_POST))
{
    $tabela =   "T002_cliente";
    
    $_POST  =   $obj->retiraMascaraArray($_POST);
    
    $inseri =   $obj->inserir($tabela, $_POST);
    
    if ($inseri)
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
        <div class="grid_2">
            <p>Tipo Pessoa</p>
            <select name="T010_codigo" class="validate[required]">      
                <?php foreach($comboTpPessoa as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoTpPessoa'];?>" <?php echo $valores['CodigoTpPessoa']==1?"selected":""?>><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoTpPessoa'], $valores['TipoTpPessoa'])?></option>
                <?php }?>
            </select>
        </div>

        <div class="clear"></div>

        <div class="grid_7">
            <p>Nome/Razão Social*</p>
            <input type="text" name="T002_nome"         class="validate[required] text-input"           />                  
        </div>
        
        <div class="grid_3">
            <p>CPF/CNPJ*</p>
            <input type="text" name="T002_cnpj_cpf"     class="validate[required] text-input cpf"       />                  
        </div>
        
        <div class="grid_3">
            <p>RG/Incrição Estadual*</p>
            <input type="text" name="T002_insc_rg"      class="validate[required] text-input rg"        />                  
        </div>
        
        <div class="clear"></div>

        <div class="grid_2">
            <p>Estado</p>
            <select name="T009_codigo"  class="validate[required]">   
                <option value="">Selecione...</option>
                <?php foreach($comboEstado as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoEstado'];?>" ><?php echo $valores['UfEstado'];?></option>
                <?php }?>
            </select>
        </div>

        <div class="grid_3">
            <p>Cidade</p>
            <input type="text" name="T002_cidade"                                                       />                  
        </div>

        <div class="grid_3">
            <p>Bairro</p>
            <input type="text" name="T002_bairro"                                                       />                  
        </div>

        <div class="grid_6">
            <p>Endereço</p>
            <input type="text" name="T002_endereco"                                                     />                  
        </div>

        <div class="clear"></div>


        <div class="grid_3">
            <p>Número</p>
            <input type="text" name="T002_numero"                                                       />                  
        </div>

        <div class="grid_3">
            <p>Complemento</p>
            <input type="text" name="T002_complemento"                                                  />                  
        </div>

        <div class="grid_3">
            <p>CEP</p>
            <input type="text" name="T002_cep"          class="cep"                                     />                  
        </div>

        <div class="grid_1">
            <p>DDD</p>
            <input type="text" name="T002_ddd"          class="ddd"                                     />                  
        </div>

        <div class="grid_2">
            <p>Telefone</p>
            <input type="text" name="T002_telefone"     class="telefone"                                />                  
        </div>

        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Gravar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
    </div>        
</form>