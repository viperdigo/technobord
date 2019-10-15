<?php
//Instancia 
$obj        =   new models_T0008()  ;

//Filtros
if (!empty($_POST))
{
    $codigoRomaneio     =   $_POST['T003_codigo']   ;                  
    $dataRomaneio       =   $_POST['T003_data']     ;                  
    $nomeCliente        =   $_POST['T002_nome']     ;     
    
    if(!empty($_POST['T003_ano']))
        $ano    =   $_POST['T003_ano'];
    else
        $ano    =   date("Y");
    
    $corte              =   $_POST['T004_corte']     ;                  
    
    $dados          =   $obj->retornaDados($codigoRomaneio, $dataRomaneio, $nomeCliente, $corte, $ano);
}else
{
    //Sem Filtro
    $dados          =   $obj->retornaDados();
}

//Variavel para verificar se existem dados de retorno para tabela não aparecer
$QtdeDados  =   0                   ;
?>
<div id="barra-botoes">
    <a href="#"                                 class="ui-state-default ui-corner-all botoes-links abrirFiltros">   <span class="ui-icon ui-icon-carat-2-n-s">  </span>Filtros</a>
    <a href="<?php echo ROUTER;?>novo"          class="ui-state-default ui-corner-all botoes-links">                <span class="ui-icon ui-icon-plus">         </span>Novo</a>
    <a href="<?php echo ROUTER;?>relatorios"    class="ui-state-default ui-corner-all botoes-links">                <span class="ui-icon ui-icon-note">         </span>Relatórios</a>
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
                    <label>Número</label>
                    <input type="text" name="T003_codigo"   value="<?php echo $codigoRomaneio ?>"                      />                  
                </div>
                <div class="grid_2">
                    <label>Data Romaneio</label>
                    <input type="text" name="T003_data"     class="data"  value="<?php echo $dataRomaneio ?>"          />                  
                </div>
                <div class="grid_3">
                    <label>Cliente</label>
                    <input type="text" name="T002_nome"    value="<?php echo $nomeCliente ?>"                        />                  
                </div>
                <div class="grid_3">
                    <label>Corte</label>
                    <input type="text" name="T004_corte"   value="<?php echo $corte ?>"                          />                  
                </div>
                <div class="grid_2">
                    <label>Ano</label>
                    <select name="T003_ano">
                        <option>2012</option>
                        <option selected>2013</option>
                    </select>
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
                <th>Número Romaneio </th> 
                <th>Data Romaneio   </th> 
                <th>Cliente         </th> 
                <th>Valor           </th> 
                <th>Ações           </th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php   foreach($dados    as $campos => $valores)
                    {   $QtdeDados++; ?>
                        <tr> 
                            <td class="id"><?php echo $obj->retornaFormatoCodigo($valores['CodigoRomaneio']);?> </td> 
                            <td><?php echo $obj->formataData($valores['DataRomaneio']);?></td> 
                            <td><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoCliente'], $valores['NomeCliente']);?></td> 
                            <td><?php echo "R$ ".number_format($valores['TotalRomaneio'], 2, ",", ".");?></td> 
                            <td class="acoes">
                                <ul class="ui-widget ui-helper-clearfix" id="icons">
                                    <li title="Alterar"     class="ui-state-default ui-corner-all"          ><a href="<?php echo ROUTER?>altera&codigoRomaneio=<?php echo $valores['CodigoRomaneio'];?>&codigoCliente=<?php echo $valores['CodigoCliente']?>&anoRomaneio=<?php echo $valores['AnoRomaneio']?>"                   ><span   class='ui-icon ui-icon-pencil'></span></a></li>
                                    <li title="Imprimir"    class="ui-state-default ui-corner-all"          ><a href="<?php echo ROUTER?>js.pdf&codigoRomaneio=<?php echo $valores['CodigoRomaneio'];?>&codigoCliente=<?php echo $valores['CodigoCliente']?>" target="_blank"   ><span class="ui-icon ui-icon-print"></span></li>
                                </ul>
                            </td> 
                        </tr>
            <?php   }  ?>
                    <!-- COLSPAN É A QUANTIDADE DE COLUNAS EXISTENTES NA TABELA -->    
            <?php if ($QtdeDados==0){    ?>        
                    <tr>
                        <td colspan="6" style="text-align: center">Filtre para obter os dados.</td>
                    </tr>    
            <?php }?>
        </tbody> 
    </table> 
</div>   
