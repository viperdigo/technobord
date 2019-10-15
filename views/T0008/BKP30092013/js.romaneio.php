<?php
class PDF extends FPDF
{
    //Current column
    var $col=0;
    //Ordinate of column start
    var $y0;

    var $codigoRomaneio;
    var $codigoCliente;

    function Header()
    {
        //Page header
        global $title;  

        $posicaoY=5;

        $this->Image('template/css/images/logo.gif',10,$posicaoY+5,30);    
        $this->SetFont('Arial','B',16);
        $this->SetXY(42, $posicaoY+6);
        $this->Cell(139, 5, utf8_decode("TECHNO BORD COMÉRCIO"), 0, 0, "L");
        $this->SetXY(42, $posicaoY+12);
        $this->Cell(139, 5, utf8_decode("DE BORDADOS LTDA ME"), 0, 0, "L");

        $this->SetFont('Arial','',8);
        $this->SetXY(44, $posicaoY+16);
        $this->Cell(139, 5, utf8_decode("RUA SOLBACH, N.118"), 0, 0, "L");
        $this->SetXY(44, $posicaoY+20);
        $this->Cell(139, 5, utf8_decode("BOM CLIMA, 07.196-260, GUARULHOS - SP"), 0, 0, "L");
        $this->SetXY(44, $posicaoY+24);
        $this->Cell(139, 5, utf8_decode("FONE: (11) 2088-2651"), 0, 0, "L");

        //Divisor
        $this->SetFont('Arial','B',10);
        $this->SetXY(146.5, $posicaoY+6);
        $this->Cell(139, 5, utf8_decode("|"), 0, 0, "L");   
        $this->SetXY(146.5, $posicaoY+100);
        $this->Cell(139, 5, utf8_decode("|"), 0, 0, "L");   
        $this->SetXY(146.5, $posicaoY+190);
        $this->Cell(139, 5, utf8_decode("|"), 0, 0, "L");   

        // SEGUNDA PARTE

        $this->Image('template/css/images/logo.gif',155,$posicaoY+5,30);
        $this->SetFont('Arial','B',16);
        $this->SetXY(190, $posicaoY+6);
        $this->Cell(139, 5, utf8_decode("TECHNO BORD COMÉRCIO"), 0, 0, "L");
        $this->SetXY(190, $posicaoY+12);
        $this->Cell(139, 5, utf8_decode("DE BORDADOS LTDA ME"), 0, 0, "L");       

        $this->SetFont('Arial','',8);
        $this->SetXY(192, $posicaoY+16);
        $this->Cell(139, 5, utf8_decode("RUA SOLBACH, N.118"), 0, 0, "L");
        $this->SetXY(192, $posicaoY+20);
        $this->Cell(139, 5, utf8_decode("BOM CLIMA, 07.196-260, GUARULHOS - SP"), 0, 0, "L");
        $this->SetXY(192, $posicaoY+24);
        $this->Cell(139, 5, utf8_decode("FONE: (11) 2088-2651"), 0, 0, "L");    

    }

    function AcceptPageBreak()
    {

    }

    function ChapterTitle()
    {

    }

    function ChapterBody()
    {

        //Le dados

        //Instancia Classe
        $obj    =   new models_T0008();

        //Variaveis
        $this->codigoCliente    =   $_GET['codigoCliente'];
        $this->codigoRomaneio   =   $_GET['codigoRomaneio'];

        //Dados
        $dadosCabec     =   $obj->retornaDadosCabecPDF($this->codigoRomaneio, $this->codigoCliente) ;    
        $dadosDet       =   $obj->retornaDadosDetPDF($this->codigoRomaneio, $this->codigoCliente)   ;    

        //Margem Superior
        $posicaoY =   5;  

        //Posição Espelho
        $posicaoX =   145;    

        foreach($dadosCabec  as $campos  =>  $valores)
        {

            //Principal
            $this->SetFont('Arial','B',12);
            $this->SetXY(42, $posicaoY+29);
            $this->Cell(139, 5, utf8_decode("CLIENTE: ".$valores['NomeCliente']), 0, 0, "L");

            $this->SetLineWidth(0.8);
            $this->Line(140,$posicaoY+35,10,$posicaoY+35);       

            $this->SetLineWidth(0.3);
            $this->SetXY(10, $posicaoY+40);
            $this->Cell(56, 5, utf8_decode("ROMANEIO Nº")               , 1, 0, "R");    
            $this->Cell(25, 5, utf8_decode($valores['CodigoRomaneio'])  , 1, 0, "C");    
            $this->Cell(25, 5, utf8_decode("DATA")                      , 1, 0, "R");    
            $this->Cell(25, 5, utf8_decode($valores['DataRomaneio'])    , 1, 1, "C");  


            //Espelho
            $this->SetFont('Arial','B',12);
            $this->SetXY($posicaoX+45, $posicaoY+29);
            $this->Cell(139, 5, utf8_decode("CLIENTE: ".$valores['NomeCliente']), 0, 0, "L");

            $this->SetLineWidth(0.8);
            $this->Line(286,$posicaoY+35,$posicaoX+10,$posicaoY+35);       

            $this->SetLineWidth(0.3);
            $this->SetXY($posicaoX+10, $posicaoY+40);
            $this->Cell(56, 5, utf8_decode("ROMANEIO Nº")               , 1, 0, "R");    
            $this->Cell(25, 5, utf8_decode($valores['CodigoRomaneio'])  , 1, 0, "C");    
            $this->Cell(25, 5, utf8_decode("DATA")                      , 1, 0, "R");    
            $this->Cell(25, 5, utf8_decode($valores['DataRomaneio'])    , 1, 1, "C");  

            //Titulos Principal
            $this->SetFontSize(8);
            $this->SetXY(10, $posicaoY+48);
            $this->Cell(10, 5, utf8_decode("QTDE")      , 1, 0, "C");    
            $this->Cell(18, 5, utf8_decode("CORTE")     , 1, 0, "C");    
            $this->Cell(48, 5, utf8_decode("ESPÉCIE")   , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("DESENHO")   , 1, 0, "C");    
            $this->Cell(13, 5, utf8_decode("UNIT. R$")     , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("SUBTOTAL R$")  , 1, 1, "C");         

            //Titulos Espelho
            $this->SetFontSize(8);
            $this->SetXY($posicaoX+10, $posicaoY+48);
            $this->Cell(10, 5, utf8_decode("QTDE")      , 1, 0, "C");    
            $this->Cell(18, 5, utf8_decode("CORTE")     , 1, 0, "C");    
            $this->Cell(48, 5, utf8_decode("ESPÉCIE")   , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("DESENHO")   , 1, 0, "C");    
            $this->Cell(13, 5, utf8_decode("UNIT. R$")     , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("SUBTOTAL R$")  , 1, 1, "C"); 

            //Total Principal
            $this->SetXY(10, 185);
            $this->Cell(131, 5,"", "B", 1, "C");      
            $this->SetFont('Arial','B',14);
            $this->SetXY(10, 192);
            $this->Cell(110, 7,"TOTAL GERAL  R$", "TBL", 0, "R");      
            $this->SetFont('Arial','B',14);
            $this->Cell(21, 7,number_format($valores['TotalRomaneio']   , 2, ',', '.'), "TBR", 1, "R");     

            //Total Espelho
            $this->SetXY(155, 185);
            $this->Cell(131, 5,"", "B", 1, "C");      
            $this->SetFont('Arial','B',14);
            $this->SetXY(155, 192);
            $this->Cell(110, 7,"TOTAL GERAL  R$", "TBL", 0, "R");      
            $this->SetFont('Arial','B',14);
            $this->Cell(21, 7,number_format($valores['TotalRomaneio']   , 2, ',', '.'), "TBR", 1, "R");            

            $this->SetFont('Arial','',8);

            $y      =   55  ;
            $cont   =   0   ;

            foreach($dadosDet   as  $campos =>  $valores)
            {            
                //Principal
                $this->SetXY(10, $posicaoY+$y);
                $this->Cell(10, 5, utf8_decode($valores['QtdeItemRomaneio'])                        , "LTR", 0, "C");    
                $this->Cell(18, 5, utf8_decode($valores['CorteItemRomaneio'])                       , "LTR", 0, "C");    
                $this->Cell(48, 5, utf8_decode($valores['EspecieItemRomaneio'])                     , "LTR", 0, "C");    
                $this->Cell(21, 5, utf8_decode($valores['DesenhoItemRomaneio'])                     , "LTR", 0, "C");    
                $this->Cell(13, 5, number_format($valores['ValorItemRomaneio']      , 2, ',', '.')  , "LTR", 0, "C");    
                $this->Cell(21, 5, number_format($valores['SubtotalItemRomaneio']   , 2, ',', '.')  , "LTR", 1, "C");                        

                //Espelho
                $this->SetXY($posicaoX+10, $posicaoY+$y);
                $this->Cell(10, 5, utf8_decode($valores['QtdeItemRomaneio'])                        ,   "LTR", 0, "C");    
                $this->Cell(18, 5, utf8_decode($valores['CorteItemRomaneio'])                       ,   "LTR", 0, "C");    
                $this->Cell(48, 5, utf8_decode($valores['EspecieItemRomaneio'])                     ,   "LTR", 0, "C");    
                $this->Cell(21, 5, utf8_decode($valores['DesenhoItemRomaneio'])                     ,   "LTR", 0, "C");    
                $this->Cell(13, 5, number_format($valores['ValorItemRomaneio']      , 2, ',', '.')  ,   "LTR", 0, "C");    
                $this->Cell(21, 5, number_format($valores['SubtotalItemRomaneio']   , 2, ',', '.')  ,   "LTR", 1, "C");               

                $cont++;
                $y  = $y+5;
            }

            //Linhas em Branco
            for ($i=0;$i<26-$cont;$i++)
            {
                //Principal
                $this->SetXY(10, $posicaoY+$y);
                $this->Cell(10, 5, "", "LTR", 0, "C");    
                $this->Cell(18, 5, "", "LTR", 0, "C");    
                $this->Cell(48, 5, "", "LTR", 0, "C");    
                $this->Cell(21, 5, "", "LTR", 0, "C");    
                $this->Cell(13, 5, "", "LTR", 0, "C");    
                $this->Cell(21, 5, "", "LTR", 1, "C");                        

                //Espelho
                $this->SetXY($posicaoX+10, $posicaoY+$y);
                $this->Cell(10, 5, "", "LTR", 0, "C");    
                $this->Cell(18, 5, "", "LTR", 0, "C");    
                $this->Cell(48, 5, "", "LTR", 0, "C");    
                $this->Cell(21, 5, "", "LTR", 0, "C");    
                $this->Cell(13, 5, "", "LTR", 0, "C");    
                $this->Cell(21, 5, "", "LTR", 1, "C");                  
                
                $y  = $y+5;
            }
            
        }
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