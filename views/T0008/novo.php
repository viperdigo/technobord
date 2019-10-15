<?php
//Instancia Class
$obj    =   new models_T0008();

//Combo Clientes
$comboClientes  =   $obj->retornaClientes();

if(!empty($_POST))
{
    //Inseri header
    
    $tabela =   "T003_romaneio";
    
    //Captura Numero Atual Romaneio
    $codigoCliente  =   $_POST['T002_codigo']   ;
    $dataRomaneio   =   $_POST['T003_data']     ;
    $totalRomaneio  =   $_POST['T003_total']    ;
    $dadosCliente   =   $obj->retornaClientes($codigoCliente);
    
    $arrData        =   explode("/",$dataRomaneio);
    $ano            =   $arrData[2];
    
    foreach($dadosCliente   as  $campos =>  $valores)
    {
        $numeroRomaneio =   $valores['NumeroRomaneio'];
    }
    
    $campos =   array(  "T003_codigo"   =>  $numeroRomaneio 
                     ,  "T002_codigo"   =>  $codigoCliente     
                     ,  "T003_ano"      =>  $ano 
                     ,  "T003_data"     =>  $dataRomaneio
                     ,  "T003_total"    =>  $totalRomaneio);
    
    $inseri =   $obj->inserir($tabela, $campos);
    
    //Inseri Detalhe   
    $tabela =   "T004_romaneio_detalhe";
    
    $qtdeCampos =   count($_POST['T004_quantidade']);
    
    for($i=0;$i<=$qtdeCampos;$i++)
    {
        if ($_POST['T004_quantidade'][$i]!="0")
        {
            $campos =      array( "T003_codigo"        =>  $numeroRomaneio
                                , "T002_codigo"        =>  $codigoCliente
                                , "T003_ano"           =>  $ano 
                                , "T004_quantidade"    =>  $_POST['T004_quantidade']   [$i]
                                , "T004_corte"         =>  $_POST['T004_corte']        [$i]
                                , "T004_especie"       =>  $_POST['T004_especie']      [$i]
                                , "T004_desenho"       =>  $_POST['T004_desenho']      [$i]
                                , "T004_valor"         =>  $_POST['T004_valor']        [$i]
                                , "T004_subtotal"      =>  $_POST['T004_subtotal']     [$i]
                            );

            $obj->inserir($tabela, $campos);            
        }        
    }   
    
    //Atualiza numero Romaneio
    $tabela =   "T002_cliente"                                      ;
    $campos =   array("T002_romaneio_numero" => $numeroRomaneio+1)  ; //Soma 1 no nro do Romaneio
    $delim  =   "T002_codigo    =   $codigoCliente"                 ;
    
    $altera =   $obj->atualizar($tabela, $campos, $delim)           ;
    
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
        <div class="grid_3">
            <p>Cliente*</p>
            <select name="T002_codigo" class="validate[required]">
                <option value="">Selecione...</option>
                <?php foreach($comboClientes as $campos=>$valores){?>
                    <option value="<?php echo $valores['CodigoCliente'];?>"><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoCliente'], $valores['NomeCliente'])?></option>
                <?php }?>
            </select>
        </div>
        
        <div class="grid_3">
            <p>Data*</p>
            <input type="text" name="T003_data"     class="text-input data"        value="<?php echo date("d/m/Y")?>"     />                  
        </div>
        
        <div class="grid_2 prefix_12">
            <p style="text-align: right;">Total</p>
        </div>
        <div class="grid_2">
            <input type="text" name="T003_total"    class="text-input valor campoTotal"  disabled      />
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

        <?php while($linha<26){?>
        
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
            <input type="text" name="T003_total"    class="text-input valor campoTotal"  disabled      />
        </div>        
        
        <div class="clear"></div>

        <div class="grid_2">
            <input type="button" value="Gravar" id="botaoGravar"    class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
        </div>
        
    </div>        
</form>