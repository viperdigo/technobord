<?php
//Instancia Classe
$obj            =   new models_T0008();

//Combo Clientes
$comboClientes  =   $obj->retornaClientes();

if (!empty($_POST))
{
    $cliente    =   $_POST['T002_codigo']                   ;
    $dataInicio =   $obj->formataData($_POST['dataInicio']) ;
    $dataFim    =   $obj->formataData($_POST['dataFim'])    ;
            
    $dados  =   $obj->retornaDadosRelatorio($cliente, $dataInicio, $dataFim);
                
}

    $ultimoDiaMes   =   $obj->retornaUltimoDiaMes();
    $primeiroDiaMes =   '01';

    if (($dataInicio=='null') || (empty($dataInicio)))
        $dataInicio    =   $primeiroDiaMes."/".date("m/Y");
    else
        $dataInicio = $obj->formataData($dataInicio);
        
    if (($dataFim=='null') || (empty($dataFim)))
        $dataFim       =   $ultimoDiaMes."/".date("m/Y");
    else
        $dataFim = $obj->formataData($dataFim);    
    
?>
<div id="barra-botoes">
    <a href="#"                                 class="ui-state-default ui-corner-all botoes-links abrirFiltros">   <span class="ui-icon ui-icon-carat-2-n-s">  </span>Filtros</a>
    <a href="<?php echo ROUTER?>home" class="ui-state-default ui-corner-all botoes-links"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Voltar</a>
    <a href="<?php echo ROUTER?>js.pdfRomaneios&cliente=<?php echo $cliente?>&dataInicio=<?php echo $dataInicio?>&dataFim=<?php echo $dataFim?>" class="ui-state-default ui-corner-all botoes-links"><span class="ui-icon ui-icon-print"></span>Imprimir</a>
    <hr>    
</div>    
<div id="barra-filtros">
    <form action="" method="post" class="validar">        
        <div class="conteudo_16">
            <!-- CAMPOS DA BARRA DE FILTROS -->
                <div class="grid_3">
                    <label>Cliente</label>
                    <select name="T002_codigo" class="validate[required]" id="cpCliente">
                        <option value="">Selecione...</option>
                        <?php foreach($comboClientes as $campos=>$valores){?>
                        <option value="<?php echo $valores['CodigoCliente'];?>" <?php echo $cliente==$valores['CodigoCliente']?"selected":"";?>><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoCliente'], $valores['NomeCliente'])?></option>
                        <?php }?>
                    </select>                
                </div>
                <div class="grid_3">
                    <label>Data Inicial</label>
                    <input type="text" name="dataInicio"    class="data"   value="<?php echo $_POST['dataInicio']; ?>" />                  
                </div>
                <div class="grid_3">
                    <label>Data Final</label>   
                    <input type="text" name="dataFim"       class="data"   value="<?php echo $_POST['dataFim']; ?>" />                  
                </div>
                <div class="grid_2">
                    <input type="submit" value="Filtrar" class="ui-button ui-widget ui-state-default ui-corner-all botao" role="button" aria-disabled="false">                
                </div>
        </div>        
    </form>
</div> 
<div class="conteudo_16">
    
    <div class="grid_3">
        <p>Número Romaneio</p>        
    </div>
        
    <div class="grid_3">
        <p>Data</p>        
    </div>
        
    <div class="grid_3">
        <p>Subtotal</p>        
    </div>
        
    <div class="clear"></div>
    
    <?php 
    
    //Contador
    $cont = 0;
    
    foreach ($dados as $campos => $valores){
    
    ?>
    
        <div class="conteudo_16 linha" style="border: 1px solid #D3D3D3;">

            <div class="grid_3">
                <label class="codigoRomaneio" id="lRomaneio" style="margin-left: 50px;"><?php echo $valores['codigoRomaneio'];?></label>
                <label class="anoRomaneio"  style="display: none;"><?php echo $valores['anoRomaneio'];?></label>
            </div>

            <div class="grid_3">
                <label id="lData"><?php echo $obj->formataDataView($valores['dataRomaneio']);?></label>
            </div>

            <div class="grid_3">
                <label id="lTotal"><?php echo "R$ ".number_format($valores['totalRomaneio'], 2, ',', '.');?></label>
            </div>

        </div>
            
    <?php 
    
    $cont++;
    $totalGeral   +=  $valores['totalRomaneio'];}?>
    
    <div class="grid_1 prefix_5"><p>Total</p></div>
    <div class="grid_3">
        <label><?php echo "R$ ".number_format($totalGeral, 2, ',', '.'); ?></label>
    </div>
         
</div>
<div id="detalhesRomaneio" title="Detalhes do Romaneio" style="display:none">
    
    <div class="conteudo_16">
        
        <div class="grid_3">
            
            <p>Cliente:</p>
            <p id="pCliente"></p>
            
        </div>
        
        <div class="grid_3">
            
            <p>Data:</p>
            <p id="pData"></p>
            
        </div>
        
        <div class="grid_3">
            
            <p>Romaneio:</p>
            <p id="pRomaneio"></p>
            
        </div>
        
        <div class="clear"></div>
        
        <div class="conteudo_16">
            
            <div class="grid_1">            
                <p>Qtde.</p>
            </div>    
            
            <div class="grid_2">            
                <p>Corte</p>
            </div>
            
            <div class="grid_3">            
                <p>Espécie</p>
            </div>    
            
            <div class="grid_2">            
                <p>Desenho</p>
            </div>  
            
            <div class="grid_2">            
                <p>Unit.</p>
            </div>    
            
            <div class="grid_2">            
                <p>Subtotal</p>
            </div>    
                        
        </div>
        
        <div class="conteudo_16 dados">

            <!--   DADOS IMPORTADOS js.detalhesModal  -->
                        
        </div>
        
        <div class="conteudo_16 ">

            <div class="grid_1 prefix_9">
                <p>Total</p>
            </div>

            <div class="grid_2">
                <label id="l1Total"></label>
            </div>
                        
        </div>
        
    </div>
    
</div>