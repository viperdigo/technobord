<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
        <title>
            <?php echo NOME_SISTEMA?>
        </title>            
        <!-- INICIO CSS  -->        
        <link rel="stylesheet" type="text/css" href="template/css/geral.css" />
        <!-- FIM    CSS  -->
        
        <!--INICIO jQuery UI-->
        <link type="text/css" href="template/jQueryUI/css/custom-theme/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="template/jQueryUI/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="template/jQueryUI/js/jquery-ui-1.8.20.custom.min.js"></script>                       
        <!--FIM jQuery UI--> 
                
        <!-- INICIO IMPORT JS   -->                
        <script type="text/javascript" src="template/js/mask.js">               </script><!-- Mascaramento Campos                               -->
        <script type="text/javascript" src="template/js/menu.js">               </script><!-- Menu Principal                                    -->
        <script type="text/javascript" src="template/js/tablesorter.js">        </script><!-- Ordernar Tabelas Dinamicamente                    -->
        <script type="text/javascript" src="template/js/quicksearch.js">        </script><!-- Filtrar em Tabelas Dinamicamente                  -->
        <script type="text/javascript" src="template/js/validationLanguage.js"> </script><!-- Mensagens do Validador de Formulário              -->           
        <script type="text/javascript" src="template/js/validationEngine.js">   </script><!-- Validador de Formulário                           -->           
        <script type="text/javascript" src="template/js/mensagem.js">           </script><!-- Mensagens, Notificações                           -->           
        <script type="text/javascript" src="template/js/priceformat.js">        </script><!-- Formatação de Preço                               -->           
        <script type="text/javascript" src="template/js/calculation.js">        </script><!-- Calculo de campos dinamico                        -->           
        <script type="text/javascript" src="template/js/funcoesGerais.js">      </script><!-- Funções Gerais sistema, atribuições nas classes   -->                   
        <!-- FIM    IMPORT JS   -->        


        <!--   IMPORTA JS NO PROGRAMA CASO EXISTA     -->
        <?php 
        $arquivoJs  =   "template/jsViews/".PROGRAMA.".js";
        if (file_exists($arquivoJs))
            echo "<script src='$arquivoJs'></script>";
        ?>
        
        
        <!-- Limpa Logo Apycom   -->        
        <div style="visibility:hidden; display: none">
            <a href="http://apycom.com/">Apycom jQuery Menus</a>
        </div>                        
    </head>
    <body>    
        <div id="principal">
            <div id="cabecalho">
                <img src="template/css/images/logo.png" alt="DZone" class="floatleft" />  
            </div>

        
        