<?php
//Instancia Class
$obj    =   new models_T0002();

$comboMenu  =   $obj->retornaDados();

if(!empty($_POST))
{
    $tabela =   "T000_estrutura";
    
    $inseri =   $obj->inserir($tabela, $_POST);
    
    if ($inseri)
    {

        //Codigo Programa
        $codigoEstrutura =   str_pad($obj->lastInsertId(), 4, "0", STR_PAD_LEFT); 

        //Verifica se Menu/Programa criado é Pai
        $sePai     =   $obj->retornaSePai($codigoEstrutura);
        
        if(!$sePai)
        {
        
            $diretorio      =   "T".$codigoEstrutura."\\";
            $arquivo        =   "T".$codigoEstrutura;
            //Cria Diretorios dos Programas
            $caminho        =   CAMINHO_FISICO."\\".NOME_SISTEMA."\\";
            $controllers    =   $caminho."controllers"."\\";
            $models         =   $caminho."models"."\\";        
            $views          =   $caminho."views"."\\";

            //Diretorio Controllers
            mkdir($controllers.$diretorio);       
            //Arquivo Controllers
            $pulaLinha  =   "\n";

            $fp = fopen($controllers.$diretorio.$arquivo.".php", 'w');
            fwrite($fp, $obj->criaArquivoControllers($arquivo));
            fclose($fp);        

            //Diretorio Models
            mkdir($models.$diretorio);

            //Arquivo Models
            $pulaLinha  =   "\n";

            $fp = fopen($models.$diretorio.$arquivo.".php", 'w');
            fwrite($fp, $obj->criaArquivoModels($arquivo));
            fclose($fp);        

            //Diretorio Views
            mkdir($views.$diretorio);

            //Arquivo Views
            $pulaLinha  =   "\n";

            $arquivo    =   "home";
            
            $fp = fopen($views.$diretorio.$arquivo.".php", 'w');
            fwrite($fp,$obj->criaArquivoHomeViews());
            fclose($fp);        
            
        }

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
        <div class="grid_3">
            <p>Nome*</p>
            <input type="text" name="T000_nome"         class="validate[required] text-input"   />                  
        </div>
        <div class="clear"></div>
        <div class="grid_6">
            <p>Descrição</p>
            <input type="text" name="T000_descricao"                                            />                  
        </div>
        <div class="clear"></div>
        <div class="grid_4">
            <p>Titulo*</p>
            <input type="text" name="T000_titulo"       class="validate[required] text-input"   />                  
        </div>
        <div class="clear"></div>
        <div class="grid_3">
            <p>Menu/Submenu de:*</p>
            <select name="t000_pai" class="validate[required]">      
                <option value=""></option>
                <option value="NULL">Sem Pai</option>
                <?php foreach($comboMenu as $campos => $valores){?>
                <option value="<?php echo $valores['CodigoEstrutura'];?>"><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoEstrutura'], $valores['NomeEstrutura'])?></option>
                <?php }?>
            </select>
        </div>            

        <div class="clear"></div>

        <div class="grid_2">
            <input type="submit" value="Gravar" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
    </div>        
</form>