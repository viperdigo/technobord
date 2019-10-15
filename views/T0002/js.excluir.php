<?php 
//Instacia Classe
$obj                =   new models_T0002()  ;

//Captura Parametro
$codigoEstrutura    =   $_POST['item']      ;

$tabela             =   "t000_estrutura";

$delimitador        =   "T000_codigo    =   $codigoEstrutura";

$exclui             =   $obj->excluir($tabela, $delimitador);

if($exclui)
    echo 1;
else
    echo 0;

?>