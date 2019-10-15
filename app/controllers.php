<?php

/**************************************************************************/
/*                          DAVÓ SUPERMERCADOS                            */
/* Criado em: 19/03/2011 por Rodrigo Alfieri                              */
/* Descrição: Classe de controle das páginas Cabeçalho (Header)
 *          , Arquivos/Programas/Telas.php e Rodapé (Footer)              */
/**************************************************************************/

class controllers
{
    var $menu;

    public function execute($tipo)
    {
        //Captura nome da classe anteiormente chamada pelo Extends
        $class      = get_called_class();

        //Captura Objetos da Classe
        $variaveis  = get_object_vars($this);

        //Defini caminho da Página


        $file = "views/".$class."/".$tipo.".php";

        foreach($variaveis as $nomes=>$valores)
                ${$nomes} = $valores;


        //Tratamento de páginas que são carregadas internamente com o jQuery
        list($js) = explode(".",$tipo);

        //Arquivos que são processados pelo jQuery (javascript)
        if ($js=="js") 
        {
            include($file);        
        }
        else
        {
            //CABECALHO
            include('template/header.php');
            include('template/menu.php');
            include('template/dialogs.php');
            //Quando o $_SESSION destruir, ele direciona para a Home

            //CORPO
            include($file);
              
            //RODAPÉ
            include('template/footer.php');
        }
    }
}
?>
