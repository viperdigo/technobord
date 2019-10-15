<?php
//Instancia Class
$obj            =   new models_T0006()                  ;

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
        <div class="grid_7">
            <p>Nome*</p>
            <input type="text" name="T002_nome"         class="validate[required] text-input"       value="<?php echo $vls['NomeCliente']?>"/>
        </div>
        
        <div class="grid_3">
            <p>Endereço</p>
            <input type="text" name="T002_endereco"     class="text-input "                         value="<?php echo $vls['EnderecoCliente']?>"/>
        </div>
        
        <div class="grid_3">
            <p>Cep</p>
            <input type="text" name="T002_cep"          class="text-input cep"                      value="<?php echo $vls['CepCliente']?>"/>
        </div>
        
        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Alterar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        <?php }?>
    </div>        
</form>