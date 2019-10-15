<?php 
//Instacia Classe
$obj            =   new models_T0008()          ;

$codigoRomaneio =   $_REQUEST['codigoRomaneio'] ;
$codigoCliente  =   $_REQUEST['codigoCliente']  ;
$anoRomaneio    =   $_REQUEST['anoRomaneio']    ;

$dados  =   $obj->retornaDetalhes($codigoRomaneio, $codigoCliente, $anoRomaneio);

$html   =   '';
foreach($dados  as  $campos =>  $valores)
{
    $html .= '<div class="grid_1">            
                <label>'.$valores['quantidadeItem'].'</label>
              </div>';
    
    $html .='<div class="grid_2">            
                <label>'.$valores['corteItem'].'</label>
             </div>';
    
    $html .='<div class="grid_3">            
                <label>'.$valores['especieItem'].'</label>
             </div>';
    $html .='<div class="grid_2">            
                <label>'.$valores['desenhoItem'].'</label>
             </div>';
    $html .='<div class="grid_2">            
                <label>'.$valores['valorItem'].'</label>
             </div>';
    $html .='<div class="grid_2">            
                <label>R$'.number_format($valores['subtotalItem'], 2, ',', '.').'</label>
             </div>';        
    
    $html .='<div class="clear"></div>';
    
    
}

echo json_encode($html);

?>