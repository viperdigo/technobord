<?php                                                                               

/**************************************************************************/    
/* Criado em: 07/06/2012 por Rodrigo Alfieri                              */    
/* Descrição: Classe para executar as Querys do Programa T0004            */    
/**************************************************************************/    

class models_T0004 extends models                                               
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

    public function retornaDados($codigoCliente, $nome, $cnpj_cpf, $insc_rg, $tp_pessoa)
    {
        $sql    =   "  SELECT T02.T002_codigo      CodigoCliente      
                            , T02.T002_nome        NomeCliente
                            , T02.T002_cnpj_cpf    CpfCliente
                            , T02.T002_insc_rg     RgCliente
                            , T10.T010_codigo      CodTpPessoaCliente
                            , T10.T010_tipo        TpPessoaCliente
                            , T02.T009_codigo      EstadoCliente
                            , T02.T002_cidade      CidadeCliente
                            , T02.T002_bairro      BairroCliente
                            , T02.T002_endereco    EnderecoCliente
                            , T02.T002_numero      NumeroCliente
                            , T02.T002_complemento ComplementoCliente
                            , T02.T002_cep         CepCliente
                            , T02.T002_ddd         DddCliente
                            , T02.T002_telefone    TelefoneCliente
                            FROM t002_cliente T02
                            JOIN t009_estado T09    ON T09.T009_codigo = T02.T009_codigo
                            JOIN t010_tp_pessoa T10 ON T10.T010_codigo = T02.T010_codigo
                           WHERE 1  =   1";

        if (!empty($codigoCliente))
            $sql    .=  " AND T02.T002_codigo   =   $codigoCliente";

        if (!empty($nome))
            $sql    .=  " AND T02.T002_nome     LIKE    '%$nome%'";

        if (!empty($cnpj_cpf))
            $sql    .=  " AND T02.T002_cnpj_cpf =       '$cnpj_cpf'";

        if (!empty($insc_rg))
            $sql    .=  " AND T02.T002_insc_rg  =       '$insc_rg'";

        if (!empty($tp_pessoa))
            $sql    .=  " AND T02.T010_codigo   =       $tp_pessoa";

        return $this->query($sql);
    }    

}                                                                               
?>