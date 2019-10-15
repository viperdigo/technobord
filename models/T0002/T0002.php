<?php

/**************************************************************************/
/* Criado em: 13/05/2012 por Rodrigo Alfieri                              */
/* Descrição: Classe para executar as Querys do Programa T0001            */
/**************************************************************************/

class models_T0002 extends models
{
   
    public function __construct()
    {
        $conn = "";
        parent::__construct($conn);        
    }  
    
    public function inserir($tabela,$campos)
    {
        $insere = $this->exec($this->insere($tabela, $campos));
        
        //Mensagem       
        if($insere)     
            $this->mostraMensagem("", "Gravado com Sucesso!");
        else
            $this->mostraMensagem("e", "Não foi possível gravar!");
        
        return $insere;
    }   
    
    public function atualizar($tabela,$campos,$delim)
    {
        $conn = "";
       
        $altera = $this->exec($this->atualiza($tabela, $campos, $delim));
        
        //Mensagem       
        if($altera)        
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
        
    public function retornaDados($codigoEstrutura, $nome, $descricao, $titulo)
    {
        $sql    =   "  SELECT T00.T000_codigo      CodigoEstrutura
                            , T00.T000_nome        NomeEstrutura
                            , T00.T000_descricao   DescricaoEstrutura
                            , T00.T000_titulo      TituloEstrutura
                            , T00B.T000_codigo     CodigoPaiEstrutura
                            , T00B.T000_nome       NomePaiEstrutura
                         FROM t000_estrutura T00
                    LEFT JOIN t000_estrutura T00B ON T00B.T000_codigo = T00.T000_pai
                        WHERE 1 =   1";
        
        if(!empty($codigoEstrutura))
            $sql    .=  " AND T00.T000_codigo       = $codigoEstrutura  ";
        
        if(!empty($nome))
            $sql    .=  " AND T00.T000_nome         LIKE '%$nome%'      ";
        
        if(!empty($descricao))
            $sql    .=  " AND T00.T000_descricao    LIKE '%$descricao%' ";
        
        if(!empty($titulo))
            $sql    .=  " AND T00.T000_titulo       LIKE '%$titulo%'    ";
        
        return $this->query($sql);
    }
    
    public function retornaSePai($codigoEstrutura)
    {
        $sql    =   "   -- SE PAI DE ALGUEM
                        SELECT 'SO PAI DE:'         estruturaPai
                             , T00A.T000_codigo     estruturaCodigo
                          FROM t000_estrutura T00
                          JOIN t000_estrutura T00A ON T00A.T000_pai = T00.T000_codigo
                         WHERE T00.T000_codigo  = $codigoEstrutura
                         UNION
                        -- SE PAI NULO
                        SELECT 'MEU CODIGO [SOU PAI]:'  estruturaPai
                             , T00.T000_codigo          estruturaCodigo
                          FROM t000_estrutura T00
                         WHERE T00.T000_codigo = $codigoEstrutura
                           AND T00.T000_pai IS NULL";
        
        $dados  =   $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
        return count($dados)?true:false;
        
    }
}
?>
