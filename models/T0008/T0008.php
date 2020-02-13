<?php

/**************************************************************************/
/* Criado em: 20/07/2012 por                               */
/* Descrição: Classe para executar as Querys do Programa T0008            */

/**************************************************************************/

class models_T0008 extends models
{

    public function __construct()
    {
        $conn = "";
        parent::__construct($conn);
    }

    public function inserir($tabela, $campos)
    {
        $insere = $this->exec($this->insere($tabela, $campos));

        //Mensagem
        if ($insere)
            $this->mostraMensagem("", "Gravado com Sucesso!");
        else
            $this->mostraMensagem("e", "Não foi possível gravar!");

        return $insere;
    }

    public function atualizar($tabela, $campos, $delim)
    {
        $conn = "";

        $altera = $this->exec($this->atualiza($tabela, $campos, $delim));

        //Mensagem
        if ($altera)
            $this->mostraMensagem("", "Alterado com Sucesso!");
        else
            $this->mostraMensagem("e", "Não foi possível alterar!");

        return $altera;
    }

    public function excluir($tabela, $delim)
    {
        $exclui = $this->exec($this->exclui($tabela, $delim));

        return $exclui;
    }

    public function retornaDados($codigoRomaneio = null, $dataRomaneio = null, $nomeCliente = null, $corte = null, $desenho = null, $ano = null)
    {
        //Formata data para 2012-01-01
        $dataRomaneio = $this->formataData($dataRomaneio);

        $sql = "  SELECT DISTINCT T03.T003_codigo    CodigoRomaneio
                                , T03.T003_data      DataRomaneio
                                , T03.T003_ano       AnoRomaneio
                                , T03.T003_total     TotalRomaneio
                                , T02.T002_codigo    CodigoCliente
                                , T02.T002_nome      NomeCliente
                            FROM t003_romaneio T03
                            JOIN t002_cliente T02 ON T02.T002_codigo = T03.T002_codigo
                            JOIN t004_romaneio_detalhe T04 ON T03.T003_codigo = T04.T003_codigo 
                                                          AND T03.T003_ano    = T04.T003_ano
                                                          AND T03.T002_codigo = T04.T002_codigo
                           WHERE 1=1";

        if (!empty($corte))
            $sql .= "   AND T04.T004_corte = '$corte'";
        if (!empty($desenho))
            $sql .= "   AND T04.T004_desenho LIKE '%$desenho%'";
        if (!empty($codigoRomaneio))
            $sql .= "   AND T03.T003_codigo =   $codigoRomaneio";
        if (!empty($dataRomaneio))
            $sql .= "   AND T03.T003_data   =   '$dataRomaneio'";
        if (!empty($nomeCliente))
            $sql .= "   AND T02.T002_nome  LIKE '%$nomeCliente%'";
        if ((empty($codigoRomaneio)) && (empty($dataRomaneio)) && (empty($nomeCliente)) && (empty($corte)) && (empty($desenho)))
            $sql .= "   AND T03.T003_data   =   '" . date("Y-m-d") . "'";
        if (!empty($ano))
            $sql .= "   AND T03.T003_ano   =   $ano";

        return $this->query($sql);

    }

    public function retornaDetalhes($codigoRomaneio, $codigoCliente, $anoRomaneio)
    {
        $sql = "   SELECT T03.T003_codigo      codigoRomaneio
                                 , T03.T002_codigo      codigoCliente
                                 , T03.T003_data        dataRomaneio
                                 , T03.T003_total       totalRomaneio
                                 , T04.T004_quantidade  quantidadeItem
                                 , T04.T004_corte       corteItem 
                                 , T04.T004_especie     especieItem
                                 , T04.T004_desenho     desenhoItem
                                 , T04.T004_valor       valorItem
                                 , T04.T004_subtotal    subtotalItem
                              FROM t003_romaneio T03
                              JOIN t004_romaneio_detalhe T04 ON T03.T003_codigo = T04.T003_codigo
                                                            AND T03.T002_codigo = T04.T002_codigo
                                                            AND T03.T003_ano = T04.T003_ano
                             WHERE T03.T003_codigo  = $codigoRomaneio
                               AND T03.T002_codigo  = $codigoCliente
                               AND T03.T003_ano     = $anoRomaneio";

        return $this->query($sql);
    }

    public function retornaCabecalho($codigoRomaneio, $codigoCliente, $anoRomaneio)
    {
        $sql = "   SELECT T03.T003_codigo      codigoRomaneio
                                 , T03.T002_codigo      codigoCliente
                                 , T03.T003_data        dataRomaneio
                                 , T03.T003_total       totalRomaneio
                              FROM t003_romaneio T03
                             WHERE T03.T003_codigo  = $codigoRomaneio
                               AND T03.T002_codigo  = $codigoCliente
                               AND T03.T003_ano     = $anoRomaneio";

        return $this->query($sql);
    }

    public function retornaClientes($codigoCliente = null)
    {
        $sql = "  SELECT T02.T002_codigo           CodigoCliente
                                , T02.T002_nome             NomeCliente
                                , T02.T002_romaneio_numero  NumeroRomaneio
                            FROM t002_cliente T02";

        if (!empty($codigoCliente))
            $sql .= " WHERE T02.T002_codigo =   $codigoCliente";

        return $this->query($sql);
    }

    public function retornaDadosCabecPDF($codigoRomaneio, $codigoCliente, $anoRomaneio)
    {
        $sql = "   SELECT T02.T002_nome                         NomeCliente
                                , T03.T003_codigo                        CodigoRomaneio
                                , date_format(T03.T003_data,'%d/%m/%Y')  DataRomaneio
                                , T03.T003_total     TotalRomaneio
                            FROM t003_romaneio T03
                            JOIN t002_cliente T02 ON T03.T002_codigo = T02.T002_codigo 
                           WHERE T03.T003_codigo  = $codigoRomaneio
                             AND T03.T002_codigo  = $codigoCliente
                             AND T03.T003_ano     = $anoRomaneio";

        return $this->query($sql);
    }

    public function retornaDadosDetPDF($codigoRomaneio, $codigoCliente, $anoRomaneio)
    {
        $sql = "  SELECT T04.T004_quantidade  QtdeItemRomaneio
                                , T04.T004_corte       CorteItemRomaneio
                                , T04.T004_especie     EspecieItemRomaneio
                                , T04.T004_desenho     DesenhoItemRomaneio
                                , T04.T004_valor       ValorItemRomaneio
                                , T04.T004_subtotal    SubtotalItemRomaneio
                             FROM t004_romaneio_detalhe T04
                            WHERE T04.T003_codigo  = $codigoRomaneio
                              AND T04.T002_codigo  = $codigoCliente
                              AND T04.T003_ano     = $anoRomaneio";

        return $this->query($sql);
    }

    public function retornaDadosRelatorio($cliente, $dataInicio, $dataFim)
    {
        $arrDtInicio = explode("-", $dataInicio);
        $anoInicio = $arrDtInicio[0];

        $arrDtFim = explode("-", $dataFim);
        $anoFim = $arrDtFim[0];

        $sql = "   SELECT T03.T003_codigo    codigoRomaneio
                                 , T03.T002_codigo    codigoCliente  
                                 , T03.T003_data      dataRomaneio  
                                 , T03.T003_total     totalRomaneio
                                 , T03.T003_ano       anoRomaneio
                              FROM t003_romaneio T03
                             WHERE 1    =   1";

        if (!empty($anoInicio))
            $sql .= "      AND T03.T003_ano   >= $anoInicio";
        if (!empty($anoFim))
            $sql .= "      AND T03.T003_ano   <= $anoFim";

        if ($dataInicio != 'null')
            $sql .= "      AND T03.T003_data   >= '$dataInicio'";
        if ($dataFim != 'null')
            $sql .= "      AND T03.T003_data   <= '$dataFim'";
        if (!empty($cliente))
            $sql .= "     AND T002_codigo      = $cliente";

//            echo $sql;

        return $this->query($sql);
    }

    public function retornaDadosRelatorioPDF($cliente, $dataInicio, $dataFim)
    {
        $dataInicio = $this->formataData($dataInicio);
        $dataFim = $this->formataData($dataFim);

        $sql = "   SELECT T03.T003_codigo    codigoRomaneio
                                 , T03.T002_codigo    codigoCliente  
                                 , T03.T003_data      dataRomaneio  
                                 , T03.T003_total     totalRomaneio
                              FROM t003_romaneio T03
                             WHERE 1    =   1";

        if ($dataInicio != 'null')
            $sql .= "      AND T03.T003_data   >= '$dataInicio'";
        if ($dataFim != 'null')
            $sql .= "      AND T03.T003_data   <= '$dataFim'";
        if (!empty($cliente))
            $sql .= "     AND T002_codigo      = $cliente";

        return $this->query($sql);
    }


}

?>