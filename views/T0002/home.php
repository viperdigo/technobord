<?php
//Instancia 
$obj            =   new models_T0002();

//Variavel para verificar se existem dados de retorno para tabela não aparecer
$QtdeDados  =   0                   ;

//Filtros
if (!empty($_POST))
{
    $codigoEstrutura    =   null                    ;
    $nome               =   $_POST['T000_nome']      ;
    $descricao          =   $_POST['T000_descricao'] ;
    $titulo             =   $_POST['T000_titulo']    ;
    
    $dados              =   $obj->retornaDados($codigoEstrutura, $nome, $descricao, $titulo)    ;
}else
{
    //Sem Filtro
    $dados          =   $obj->retornaDados();
}

?>
<div id="barra-botoes">
    <a href="#"                         class="ui-state-default ui-corner-all botoes-links abrirFiltros">   <span class="ui-icon ui-icon-carat-2-n-s">  </span>Filtros</a>
    <a href="<?php echo ROUTER;?>novo"  class="ui-state-default ui-corner-all botoes-links">                <span class="ui-icon ui-icon-plus">         </span>Novo</a>
    <hr>    
</div>    
<div id="barra-filtros">
    <form action="" method="post">        
        <div class="conteudo_16">
            <!-- CAMPOS DA BARRA DE FILTROS -->
                <div class="grid_3">
                    <label>Dinâmico</label>
                    <input type="text"                          class="filtroDinamico"  />                  
                </div>
                <div class="grid_3">
                    <label>Nome</label>
                    <input type="text" name="T000_nome"                                 />                  
                </div>
                <div class="grid_3">
                    <label>Descrição</label>
                    <input type="text" name="T000_descricao"                            />                  
                </div>
                <div class="grid_3">
                    <label>Titulo</label>
                    <input type="text" name="T000_titulo"                               />                  
                </div>
                <div class="grid_2">
                    <input type="submit" value="Filtrar" class="ui-button ui-widget ui-state-default ui-corner-all botao" role="button" aria-disabled="false">                
                </div>
        </div>        

    </form>
</div>  
<div class="conteudo_16">
    <table class="tablesorter" cellspacing="1" cellpadding="0" border="0"> 
        <thead> 
            <tr> 
                <th>Nome</th> 
                <th>Descrição</th> 
                <th>Título</th> 
                <th>Pai</th> 
                <th>Ações</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php   foreach($dados    as $campos => $valores)
                    {   $QtdeDados++;
                        $formatoNome    =   $obj->retornaFormatoCodigoNome($valores['CodigoEstrutura'], $valores['NomeEstrutura']);   
                        $formatoNomePai =   $obj->retornaFormatoCodigoNome($valores['CodigoPaiEstrutura'], $valores['NomePaiEstrutura']);?>
                    <tr> 
                        <td style="display: none" class="id"><?php echo $valores['CodigoEstrutura'];?> </td> 
                        <td><?php echo $formatoNome;?>                                      </td> 
                        <td><?php echo $valores['DescricaoEstrutura'];?>                    </td> 
                        <td><?php echo $valores['TituloEstrutura'];?>                       </td> 
                        <td><?php echo $formatoNomePai;?>                                   </td> 
                        <td class="acoes">
                            <ul class="ui-widget ui-helper-clearfix" id="icons">
                                <li title="Alterar" class="ui-state-default ui-corner-all"><a href="<?php echo ROUTER?>alterar&codigoEstrutura=<?php echo $valores['CodigoEstrutura'];?>"><span   class='ui-icon ui-icon-pencil'></span></a></li>
                                <li title="Excluir" class="ui-state-default ui-corner-all excluir"><a href="#"><span class="ui-icon ui-icon-closethick"></span></li>
                            </ul>
                        </td> 
                    </tr>
            <?php   }?>
            <?php if ($QtdeDados==0){   ?>        
                    <!-- COLSPAN É A QUANTIDADE DE COLUNAS EXISTENTES NA TABELA -->    
                    <tr>
                        <td colspan="6" style="text-align: center">Não Existem Dados.</td>
                    </tr>    
            <?php }?>
        </tbody> 
    </table> 
</div>   
