<?php 
//Instacia Classe
$obj                    =   new models_T0005()                      ;

//Captura Parametro
$codigoFornecedor       =   intval($_POST['item'])                  ;

$tabela                 =   "t003_fornecedor"                       ;

$delimitador            =   "T003_codigo    =   $codigoFornecedor"  ;

$exclui                 =   $obj->excluir($tabela, $delimitador)    ;

if($exclui)
    echo 1;
else
    echo 0;

?>