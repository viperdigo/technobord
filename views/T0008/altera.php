<?php
//Instancia Class
$obj    =   new models_T0008();

//Combo Clientes
$comboClientes  =   $obj->retornaClientes();

//Parametros
$codigoRomaneio =   $_REQUEST['codigoRomaneio'];
$codigoCliente  =   $_REQUEST['codigoCliente'];
$anoRomaneio    =   $_REQUEST['anoRomaneio'];

//Dados

if(!empty($_POST['T003_ano']))
    $ano    =   $_POST['T003_ano'];
else
    $ano    =   date("Y");

$dadosCabecalho         =   $obj->retornaCabecalho($codigoRomaneio, $codigoCliente,$anoRomaneio, $ano);
$dadosDetalhes          =   $obj->retornaDetalhes($codigoRomaneio,$codigoCliente, $anoRomaneio, $ano);

if(!empty($_POST))
{
    //Inseri header
    
    $tabela =   "T003_romaneio";
    
    //Captura Numero Atual Romaneio    
    $dataRomaneio   =   $_POST['T003_data']     ;
    $totalRomaneio  =   $_POST['T003_total']    ;
    
    $arrData        =   explode("/",$dataRomaneio);
    $ano            =   $arrData[2];
    
    $campos =   array(  "T003_data"     =>  $dataRomaneio
                     ,  "T003_ano"      =>  $ano
                     ,  "T003_total"    =>  $totalRomaneio);
    
    $delim  =   "       T003_codigo = $codigoRomaneio   ";
    $delim  .=  "   AND T002_codigo = $codigoCliente    ";
    $delim  .=  "   AND    T003_ano = $ano    ";
    
    
    $obj->atualizar($tabela, $campos, $delim);
                
    //Inseri Detalhe   
    $tabela =   "T004_romaneio_detalhe";
        
    //Limpa Detalhes e reinseri
    $obj->excluir($tabela, $delim);
    
    $qtdeCampos =   count($_POST['T004_quantidade']);
    
    for($i=0;$i<=$qtdeCampos;$i++)
    {
        if ((!empty($_POST['T004_quantidade'][$i])) && ($_POST['T004_quantidade'][$i]!="0"))
        {
            $campos =      array( "T003_codigo"        =>  $codigoRomaneio
                                , "T002_codigo"        =>  $codigoCliente
                                , "T003_ano"           =>  $ano
                                , "T004_quantidade"    =>  $_POST['T004_quantidade']   [$i]
                                , "T004_corte"         =>  $_POST['T004_corte']        [$i]
                                , "T004_especie"       =>  $_POST['T004_especie']      [$i]
                                , "T004_desenho"       =>  $_POST['T004_desenho']      [$i]
                                , "T004_valor"         =>  $_POST['T004_valor']        [$i]
                                , "T004_subtotal"      =>  $_POST['T004_subtotal']     [$i]
                            );

            $inseri =   $obj->inserir($tabela, $campos);            
        }        
    }   
    
    if ($inseri)
    {
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
        
        <?php foreach($dadosCabecalho as $cCabec => $vCabec){?>
        
            <div class="grid_3">
                <p>Número Romaneio</p>
                <input type="text"         class="text-input data" value="<?php echo $vCabec['codigoRomaneio']?>" disabled/>                  
            </div>        
        
            <div class="grid_3">
                <p>Cliente*</p>
                <select name="T002_codigo" class="validate[required]" disabled>
                    <?php foreach($comboClientes as $campos=>$valores){?>
                        <option value="<?php echo $valores['CodigoCliente'];?>" <?php echo $valores['CodigoCliente']==$vCabec['codigoCliente']?"selected":"";?>><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoCliente'], $valores['NomeCliente'])?></option>
                    <?php }?>
                </select>
            </div>
        
            <div class="grid_3">
                <p>Data*</p>
                <input type="text" name="T003_data"     class="text-input data" value="<?php echo $obj->formataDataView($vCabec['dataRomaneio'])?>" />                  
            </div>                             

            <div class="grid_2 prefix_12">
                <p style="text-align: right;">Total</p>
            </div>
            <div class="grid_2">
                <input type="text" name="T003_total"    class="text-input valor campoTotal"  disabled   value="<?php echo $vCabec['totalRomaneio'];?>"   />
            </div>  

            <div class="clear"></div>

            <div class="grid_2">
                <p>Quantidade</p>
            </div>

            <div class="grid_2">
                <p>Corte</p>
            </div>

            <div class="grid_6">
                <p>Espécie</p>
            </div>

            <div class="grid_2">
                <p>Desenho</p>
            </div>

            <div class="grid_2">
                <p>Valor Unit.</p>
            </div>        

            <div class="grid_2">
                <p>Subtotal</p>
            </div>

            <div class="clear"></div>            
            
            <?php $linha    =   0;
            
                  foreach($dadosDetalhes as $cDet => $vDet){
                        
                  if($linha%2==0){?>
            
            <div class="linha">
            
            <?php }else{?>
            
            <div style="background-color: #EEE9E9;" class="linha">    

            <?php }?>                

                <div class="grid_2">
                    <input type="text" name="T004_quantidade[]"         class="text-input campoQtde"                                value="<?php echo $vDet['quantidadeItem'];?>"/>                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_corte[]"              class="text-input"                      maxlength="10"      value="<?php echo $vDet['corteItem'];?>"/>                  
                </div>

                <div class="grid_6">
                    <input type="text" name="T004_especie[]"            class="text-input"                      maxlength="22"      value="<?php echo $vDet['especieItem'];?>"/>                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_desenho[]"            class="text-input"                      maxlength="12"      value="<?php echo $vDet['desenhoItem'];?>"/>                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_valor[]"              class="text-input campoVlrUnt valor"                        value="<?php echo $vDet['valorItem'];?>"/>                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_subtotal[]"           class="text-input campoSubtotal valor"                      value="<?php echo $vDet['subtotalItem'];?>"/>                  
                </div>

            </div>    

            <div class="clear"></div>    

            <?php $linha++;}?>
            
            <?php while(26>$linha){?>

            <?php if($linha%2==0){?>
            <div class="linha">
            <?php }else{?>
            <div style="background-color: #EEE9E9;" class="linha">    
            <?php }?>                

                <div class="grid_2">
                    <input type="text" name="T004_quantidade[]"         class="text-input campoQtde"                            />                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_corte[]"              class="text-input"                      maxlength="10"  />                  
                </div>

                <div class="grid_6">
                    <input type="text" name="T004_especie[]"            class="text-input"                      maxlength="22"  />                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_desenho[]"            class="text-input"                      maxlength="12"  />                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_valor[]"              class="text-input campoVlrUnt valor"                    />                  
                </div>

                <div class="grid_2">
                    <input type="text" name="T004_subtotal[]"           class="text-input campoSubtotal valor"                  />                  
                </div>

            </div>    

            <div class="clear"></div>    

            <?php $linha++;}?>            

            <div class="grid_2 prefix_12">
                <p style="text-align: right;">Total</p>
            </div>
            <div class="grid_2">
                <input type="text" name="T003_total"    class="text-input valor campoTotal"  disabled     value="<?php echo $vCabec['totalRomaneio'];?>" />
            </div>        

            <div class="clear"></div>

            <div class="grid_2">
                <input type="button" value="Alterar" id="botaoGravar"    class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
            </div>
        
       <?php }?>
        
    </div>        
</form>