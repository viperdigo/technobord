<?php
//Instancia Class
$obj    =   new models_T0006();


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
        <div class="grid_7">
            <p>Nome*</p>
            <input type="text" name="T002_nome"         class="validate[required] text-input"           />                  
        </div>
        
        <div class="grid_3">
            <p>Endereço</p>
            <input type="text" name="T002_endereco"     class="text-input"                              />                  
        </div>
        
        <div class="grid_3">
            <p>Cep</p>
            <input type="text" name="T002_cep"          class="text-input cep"                          />                  
        </div>
        
        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Gravar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        
    </div>        
</form>