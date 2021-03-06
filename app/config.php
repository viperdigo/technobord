<?php

/**************************************************************************/
/*                          TECHNOBORD                                    */
/* Criado em: 20/07/2012 por Rodrigo Alfieri                              */
/* Descrição: Arquivo de configurações e definições do sistema            */
/**************************************************************************/

/* Habilitar de 0 para 1 para exibir erros do PHP                 */
ini_set("display_errors", 0);

/* Inicializa characters com UTF-8 */
ini_set('default_charset', 'UTF-8');

/* Definir header depois de fazer um print          */
ob_start();

/* Configuração de DATA             */
date_default_timezone_set('America/Sao_Paulo');

/* Configuração de LOCAL     */
setlocale(LC_ALL, 'pt_BR', 'ptb', 'pt_BR.utf-8', 'br');

header('Content-type: text/html; charset=UTF-8');

/* Nome do Sistema                      */
define("NOME_SISTEMA", "Technobord");

/* Constantes de Ambiente (Produção, Teste e Extranet)*/
define("PRD_HOST","mysql");
define("PRD_BD","technobord");
define("PRD_USER","root");
define("PRD_PASS","2af41acf7909764373dbc61a66e8b5bf");

/* Caminho                                             */
define("CAMINHO_FISICO", dirname(getcwd()));

/* Router Atual                                        */
$router = explode("/", $_SERVER['QUERY_STRING']);
define("ROUTER", "?" . $router[0] . "/");

/*Programa Atual*/
$programa = explode("=", $router[0]);
if (isset($programa[1])) define("PROGRAMA", $programa[1]);

//abre sessões
session_start();

?>
