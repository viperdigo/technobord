<?php
//Instancia 
$obj        =   new models_T0006()  ;

//Filtros
if (!empty($_POST))
{
    $codigoCliente  =   $_POST['T002_codigo']                       ;                  
    $nome           =   $_POST['T002_nome']                         ;                    
    
    $dados          =   $obj->retornaDados($codigoCliente, $nomeCliente);
}else
{
    //Sem Filtro
    $dados          =   $obj->retornaDados();
}

//Variavel para verificar se existem dados de retorno para tabela não aparecer
$QtdeDados  =   0                   ;
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
                    <input type="text"                      class="filtroDinamico"  />                  
                </div>
                <div class="grid_1">
                    <label>Código</label>
                    <input type="text" name="T002_codigo"                           />                  
                </div>
                <div class="grid_3">
                    <label>Nome</label>
                    <input type="text" name="T002_nome"                             />                  
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
                <th>Código              </th> 
                <th>Nome                </th> 
                <th>Endereço            </th> 
                <th>Cep                 </th> 
                <th>Ações               </th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php   foreach($dados    as $campos => $valores)
                    {   $QtdeDados++; ?>
                        <tr> 
                            <td class="id"><?php echo $obj->retornaFormatoCodigo($valores['CodigoCliente']);?> </td> 
                            <td><?php echo $valores['NomeCliente'];?></td> 
                            <td><?php echo $valores['EnderecoCliente'];?></td> 
                            <td><?php echo $valores['CepCliente'];?></td> 
                            <td class="acoes">
                                <ul class="ui-widget ui-helper-clearfix" id="icons">
                                    <li title="Alterar" class="ui-state-default ui-corner-all"><a href="<?php echo ROUTER?>alterar&codigoCliente=<?php echo $valores['CodigoCliente'];?>"><span   class='ui-icon ui-icon-pencil'></span></a></li>
                                    <li title="Excluir" class="ui-state-default ui-corner-all excluir"><a href="#"><span class="ui-icon ui-icon-closethick"></span></li>
                                </ul>
                            </td> 
                        </tr>
            <?php   }  ?>
                    <!-- COLSPAN É A QUANTIDADE DE COLUNAS EXISTENTES NA TABELA -->    
            <?php if ($QtdeDados==0){    ?>        
                    <tr>
                        <td colspan="6" style="text-align: center">Não Existem Dados.</td>
                    </tr>    
            <?php }?>
        </tbody> 
    </table> 
</div>   
