<?php 
//Instacia Classe
$obj                =   new models_T0008()                  ;

//Captura Parametro
$codigoCliente      =   intval($_POST['item'])              ;

$tabela             =   "t002_cliente"                      ;

$delimitador        =   "T002_codigo    =   $codigoCliente" ;

$exclui             =   $obj->excluir($tabela, $delimitador);

if($exclui)
    echo 1;
else
    echo 0;

?>