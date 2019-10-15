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

        $tamCell    =   60;
        $margEsq    =   41;
        $borda      =   0;
        
        $this->Image('template/css/images/logo_relat.jpg',10,$posicaoY+4,90);    

        //Divisor
        $this->SetFont('Arial','B',10);
        $this->SetXY(146.5, $posicaoY+6);
        $this->Cell(96, 5, utf8_decode("|"), 0, 0, "L");   
        $this->SetXY(146.5, $posicaoY+100);
        $this->Cell(96, 5, utf8_decode("|"), 0, 0, "L");   
        $this->SetXY(146.5, $posicaoY+190);
        $this->Cell(96, 5, utf8_decode("|"), 0, 0, "L");   

        //Espelho
        $tamCell    =   60;
        $margEsq    =   186;
        $borda      =   0;
        
        $this->Image('template/css/images/logo_relat.jpg',155,$posicaoY+4,90);    

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
            $this->SetLineWidth(0.8);
            $this->Line(140,$posicaoY+35,10,$posicaoY+35);       
            $this->SetLineWidth(0.3);
            
            $mEsq   =   101;
                        
            $this->SetFont('Arial','B',20);
            $this->SetXY($mEsq+13, $posicaoY+5);
            $this->SetTextColor(234,50,55);
            $this->Cell(9, 7, utf8_decode("Nº")  , 0, 0, "L");
            $this->SetFont('Arial','B',20);            
            $this->Cell(25, 7, utf8_decode(str_pad(($valores['CodigoRomaneio']),4,'0',STR_PAD_LEFT))  , 0, 0, "L");
            $this->SetTextColor(0,0,0);
            
            $this->SetFont('Arial','B',12);
            $this->SetXY($mEsq, $posicaoY+20);
            $this->Cell(17, 5, utf8_decode("Cliente:")  , 0, 0, "L");    
            $this->SetXY($mEsq+17, $posicaoY+20);
            $this->SetTextColor(234,50,55);
            $this->Cell(21, 5, utf8_decode($valores['NomeCliente'])  , 0, 0, "L");    
            $this->SetTextColor(0,0,0);
            
            $this->SetFont('Arial','B',12);
            $this->SetXY($mEsq, $posicaoY+27);
            $this->Cell(17, 7, "Data:"    , 0, 1, "L");  
            $this->SetXY($mEsq+15, $posicaoY+27);
            $this->Cell(23, 7, utf8_decode($valores['DataRomaneio'])    , 0, 1, "L");  

            //Espelho
            $this->SetLineWidth(0.8);
            $this->Line(285,$posicaoY+35,$posicaoX+10,$posicaoY+35);       
            $this->SetLineWidth(0.3);            
            
            $mEsq   =   247;
            
            $this->SetFont('Arial','B',20);
            $this->SetXY($mEsq+13, $posicaoY+5);
            $this->SetTextColor(234,50,55);
            $this->Cell(9, 7, utf8_decode("Nº")  , 0, 0, "L");
            $this->SetFont('Arial','B',20);            
            $this->Cell(25, 7, utf8_decode(str_pad(($valores['CodigoRomaneio']),4,'0',STR_PAD_LEFT))  , 0, 0, "L");
            $this->SetTextColor(0,0,0);
            
            $this->SetFont('Arial','B',12);
            $this->SetXY($mEsq, $posicaoY+20);
            $this->Cell(17, 5, utf8_decode("Cliente:")  , 0, 0, "L");    
            $this->SetXY($mEsq+17, $posicaoY+20);
            $this->SetTextColor(234,50,55);
            $this->Cell(21, 5, utf8_decode($valores['NomeCliente'])  , 0, 0, "L");    
            $this->SetTextColor(0,0,0);
            
            $this->SetFont('Arial','B',12);
            $this->SetXY($mEsq, $posicaoY+27);
            $this->Cell(17, 7, "Data:"    , 0, 1, "L");  
            $this->SetXY($mEsq+15, $posicaoY+27);
            $this->Cell(23, 7, utf8_decode($valores['DataRomaneio'])    , 0, 1, "L");  

            //Titulos Principal
            $this->SetFontSize(8);
            $this->SetXY(10, $posicaoY+40);
            $this->Cell(10, 5, utf8_decode("QTDE")      , 1, 0, "C");    
            $this->Cell(20, 5, utf8_decode("CORTE")     , 1, 0, "C");    
            $this->Cell(43, 5, utf8_decode("ESPÉCIE")   , 1, 0, "C");    
            $this->Cell(23, 5, utf8_decode("DESENHO")   , 1, 0, "C");    
            $this->Cell(13, 5, utf8_decode("UNIT. R$")     , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("SUBTOTAL R$")  , 1, 1, "C");         

            //Titulos Espelho
            $this->SetFontSize(8);
            $this->SetXY($posicaoX+10, $posicaoY+40);
            $this->Cell(10, 5, utf8_decode("QTDE")      , 1, 0, "C");    
            $this->Cell(20, 5, utf8_decode("CORTE")     , 1, 0, "C");    
            $this->Cell(43, 5, utf8_decode("ESPÉCIE")   , 1, 0, "C");    
            $this->Cell(23, 5, utf8_decode("DESENHO")   , 1, 0, "C");    
            $this->Cell(13, 5, utf8_decode("UNIT. R$")     , 1, 0, "C");    
            $this->Cell(21, 5, utf8_decode("SUBTOTAL R$")  , 1, 1, "C"); 

            //Total Principal
            $this->SetXY(10, 177);
            $this->Cell(131, 5,"", "B", 1, "C");      
            $this->SetFont('Arial','B',14);
            $this->SetXY(10, 189);
            $this->Cell(108, 7,"TOTAL GERAL  R$", "TBL", 0, "R");      
            $this->SetFont('Arial','B',14);
            $this->Cell(23, 7,number_format($valores['TotalRomaneio']   , 2, ',', '.'), "TBR", 1, "R");     

            //Total Espelho
            $this->SetXY(155, 177);
            $this->Cell(131, 5,"", "B", 1, "C");      
            $this->SetFont('Arial','B',14);
            $this->SetXY(155, 189);
            $this->Cell(108, 7,"TOTAL GERAL  R$", "TBL", 0, "R");      
            $this->SetFont('Arial','B',14);
            $this->Cell(23, 7,number_format($valores['TotalRomaneio']   , 2, ',', '.'), "TBR", 1, "R");            

            $this->SetFont('Arial','',8);

            $y      =   47  ;
            $cont   =   0   ;

            foreach($dadosDet   as  $campos =>  $valores)
            {            
                //Principal
                $this->SetXY(10, $posicaoY+$y);
                $this->Cell(10, 5, utf8_decode($valores['QtdeItemRomaneio'])                        , "LTR", 0, "C");    
                $this->Cell(20, 5, utf8_decode($valores['CorteItemRomaneio'])                       , "LTR", 0, "C");    
                $this->Cell(43, 5, utf8_decode($valores['EspecieItemRomaneio'])                     , "LTR", 0, "C");    
                $this->Cell(23, 5, utf8_decode($valores['DesenhoItemRomaneio'])                     , "LTR", 0, "C");    
                $this->Cell(13, 5, number_format($valores['ValorItemRomaneio']      , 2, ',', '.')  , "LTR", 0, "C");    
                $this->Cell(21, 5, number_format($valores['SubtotalItemRomaneio']   , 2, ',', '.')  , "LTR", 1, "C");                        

                //Espelho
                $this->SetXY($posicaoX+10, $posicaoY+$y);
                $this->Cell(10, 5, utf8_decode($valores['QtdeItemRomaneio'])                        ,   "LTR", 0, "C");    
                $this->Cell(20, 5, utf8_decode($valores['CorteItemRomaneio'])                       ,   "LTR", 0, "C");    
                $this->Cell(43, 5, utf8_decode($valores['EspecieItemRomaneio'])                     ,   "LTR", 0, "C");    
                $this->Cell(23, 5, utf8_decode($valores['DesenhoItemRomaneio'])                     ,   "LTR", 0, "C");    
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
                $this->Cell(20, 5, "", "LTR", 0, "C");    
                $this->Cell(43, 5, "", "LTR", 0, "C");    
                $this->Cell(23, 5, "", "LTR", 0, "C");    
                $this->Cell(13, 5, "", "LTR", 0, "C");    
                $this->Cell(21, 5, "", "LTR", 1, "C");                        

                //Espelho
                $this->SetXY($posicaoX+10, $posicaoY+$y);
                $this->Cell(10, 5, "", "LTR", 0, "C");    
                $this->Cell(20, 5, "", "LTR", 0, "C");    
                $this->Cell(43, 5, "", "LTR", 0, "C");    
                $this->Cell(23, 5, "", "LTR", 0, "C");    
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