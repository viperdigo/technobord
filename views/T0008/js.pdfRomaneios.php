<?php
class PDF extends FPDF
{
    //Current column
    var $col=0;
    //Ordinate of column start
    var $y0;
    
    var $codigoCliente;
    
    var $dataInicio;
    
    var $dataFim;
    
    function Header()
    {
        //Page header
        global $title;  
        
        $obj    =   new models_T0008();
        
        $this->codigoCliente    =   $_GET['cliente']    ;
        $this->dataInicio       =   $_GET['dataInicio'] ;
        $this->dataFim          =   $_GET['dataFim']    ;
        
        $dadosCliente   =   $obj->retornaClientes($this->codigoCliente);
        
        $this->Image('template/css/images/logo.gif',5,5,30);    
                                                
        //Fonte Divisor
        $this->SetFont('Arial','B',20);

        //Titulo
        $this->SetXY(40, 7);
        $this->Cell(150, 7, utf8_decode("Fechamento Romaneio"), 0, 0, "L");   
        
        //Cliente
        $this->SetFont('Arial','B',16);
        $this->SetXY(40, 17);
        foreach($dadosCliente as $campos => $valores)
        {
            $this->Cell(150, 7, utf8_decode("Cliente: ".$valores['NomeCliente']), 0, 0, "L");   
        }
        //Período
        $this->SetXY(40, 26);
        $this->Cell(150, 7, utf8_decode("Período:"), 0, 0, "L");   
        $this->SetXY(65, 26);
        $this->Cell(150, 7, $this->dataInicio, 0, 0, "L");   
        $this->SetXY(96, 26);
        $this->Cell(150, 7, utf8_decode("à"), 0, 0, "L");   
        $this->SetXY(102, 26);
        $this->Cell(150, 7, $this->dataFim, 0, 0, "L");   
        
    }

    function AcceptPageBreak()
    {

    }

    function ChapterTitle()
    {

    }

    function ChapterBody()
    {

        //Instancia Classe
        $obj    =   new models_T0008();

        //Variaveis
        $cliente    =   $this->codigoCliente    ;
        $dataInicio =   $this->dataInicio       ;
        $dataFim    =   $this->dataFim          ;

        //Dados
        $dados                  =   $obj->retornaDadosRelatorioPDF($cliente, $dataInicio, $dataFim);
        
        $alt    =   40;
        
        $this->SetXY(6, $alt);
        $this->Cell(70, 7, utf8_decode("Nº ROMANEIO"), "LTR", 0, "L");    
        $this->SetXY(76, $alt);
        $this->Cell(70, 7, utf8_decode("DATA"), "TR", 0, "L");    
        $this->SetXY(146, $alt);
        $this->Cell(57, 7, utf8_decode("SUBTOTAL (R$)"), "TR", 0, "L");    
        
        $totalGeral =   0;
        foreach($dados as $campos => $valores)
        {
            $alt = $alt+7;
            
            $this->SetXY(6, $alt);
            $this->Cell(70, 7, utf8_decode($valores['codigoRomaneio']), "LTR", 0, "L");    
            $this->SetXY(76, $alt);
            $this->Cell(70, 7, utf8_decode($obj->formataDataView($valores['dataRomaneio'])), "TR", 0, "L");    
            $this->SetXY(146, $alt);
            $this->Cell(57, 7,number_format($valores['totalRomaneio'], 2, ',', '.'), "TR", 0, "L");    
            
            $totalGeral =   $totalGeral+$valores['totalRomaneio'];
        }
        
        $this->SetXY(6, $alt);
        $this->Cell(197, 7, "", "B", 0, "L");    
        
        $this->SetXY(6, $alt+10);
        $this->Cell(140, 7, "Total R$ ", 1, 0, "R");    
        
        $this->SetXY(146, $alt+10);
        $this->Cell(57, 7, number_format($totalGeral, 2, ',', '.'), 1, 0, "L");    
        
    }

    function PrintChapter($num,$title,$file)
    {
        //Add chapter
        $this->AddPage();
        $this->ChapterTitle($num,$title);
        $this->ChapterBody();
    }
}

$pdf      = new PDF("L");
$pdf->SetTitle("TESTE");
$pdf->PrintChapter(1,'TESTE','');
$pdf->Output();

?>