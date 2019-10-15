<?php
 
/**************************************************************************/
/*                          TECHNOBORD                                    */
/* Criado em: 20/07/2012 por Rodrigo Alfieri                              */
/* Descrição: Arquivo de configurações e definições do sistema            */
/**************************************************************************/

/* Habilitar de 0 para 1 para exibir erros do PHP                 */
ini_set("display_errors",0);

/* Inicializa characters com UTF-8 */
ini_set('default_charset','UTF-8');

/* Definir header depois de fazer um print          */
ob_start();

/* Configuração de DATA             */
date_default_timezone_set('America/Sao_Paulo');

/* Configuração de LOCAL     */
setlocale(LC_ALL, 'pt_BR', 'ptb', 'pt_BR.utf-8', 'br');

header ('Content-type: text/html; charset=UTF-8');

/* Nome do Sistema                      */
define("NOME_SISTEMA","Technobord");

/* Constantes de Ambiente (Produção, Teste e Extranet)*/
define("SERVER_PRD","127.0.0.1");
define("PRD_HOST","us-cdbr-iron-east-05.cleardb.net");
define("PRD_BD","heroku_69d5d4c53791faa");
define("PRD_USER","bf6335bb24954b");
define("PRD_PASS","d1c109e0");

/* Caminho                                             */
define("CAMINHO_FISICO", dirname(getcwd()));

/* Router Atual                                        */
$router     =   explode("/",$_SERVER['QUERY_STRING']);
define("ROUTER", "?".$router[0]."/");

/*Programa Atual*/
$programa   =   explode("=",$router[0]);
if(isset($programa[1])) define("PROGRAMA",$programa[1]);

/* Usuario                                        */
define("USER",$_SESSION['user']);

//abre sessões
session_start();

?>
