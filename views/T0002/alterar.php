<?php
//Instancia Class
$obj                =   new models_T0002()                      ;

$codigoEstrutura    =   $_REQUEST['codigoEstrutura']            ;
    
//Dados do Combo
$comboMenu          =   $obj->retornaDados()                    ;

//Dados dos Campos
$dados              =   $obj->retornaDados($codigoEstrutura)    ;

if(!empty($_POST))
{
    $tabela         =   "T000_estrutura";
    
    $delimitador    =   "t000_codigo    =".$codigoEstrutura;
    
    $alterar =   $obj->atualizar($tabela, $_POST, $delimitador);
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
        <div class="grid_3">
            <p>Nome*</p>
            <input type="text" name="T000_nome"         class="validate[required] text-input"   value="<?php echo $vls['NomeEstrutura'];?>"/>                  
        </div>
        <div class="clear"></div>
        <div class="grid_3">
            <p>Descrição</p>
            <input type="text" name="T000_descricao"                                            value="<?php echo $vls['DescricaoEstrutura'];?>"/>                  
        </div>
        <div class="clear"></div>
        <div class="grid_3">
            <p>Titulo*</p>
            <input type="text" name="T000_titulo"       class="validate[required] text-input"   value="<?php echo $vls['TituloEstrutura'];?>"/>                  
        </div>
        <div class="clear"></div>
        <div class="grid_3">
            <p>Menu/Submenu de:*</p>
            <select name="t000_pai" class="validate[required]">      
                <option value="NULL" <?php echo $vls['CodigoPaiEstrutura']==""?"selected":"";?>>Sem Pai</option>
                <?php foreach($comboMenu as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoEstrutura'];?>" <?php echo $valores['CodigoEstrutura']==$vls['CodigoPaiEstrutura']?"selected":"";?>>
                    <?php echo $obj->retornaFormatoCodigoNome($valores['CodigoEstrutura'], $valores['NomeEstrutura'])?></option>
                <?php }?>
            </select>
        </div>            

        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Alterar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        <?php }?>
    </div>        
</form>