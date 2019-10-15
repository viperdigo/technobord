<?php                                                                               

    /**************************************************************************/    
    /* Criado em: 14/06/2012 por                               */    
    /* Descrição: Classe para executar as Querys do Programa T0005            */    
    /**************************************************************************/    

    class models_T0005 extends models                                               
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
        
        public function retornaDados($codigoFornecedor, $razao_social, $cnpj, $tp_pessoa)
        {
            $sql    =   "  SELECT T03.T003_codigo                CodigoFornecedor
                                , T10.T010_codigo                CodTpPessoaFornecedor
                                , T10.T010_tipo                  TpPessoaFornecedor
                                , T03.T003_razao_social          RazaoSocialFornecedor
                                , T03.T003_nome_fantasia         NomeFantasiaFornecedor
                                , T03.T003_cnpj                  CnpjFornecedor
                                , T03.T003_inscricao_estadual    InscEstadualFornecedor
                                , T03.T003_inscricao_municipal   InscMunicipalFornecedor
                                , T09.T009_codigo                CodEstadoFornecedor
                                , T09.T009_uf                    EstadoFornecedor
                                , T03.T003_cidade                CidadeFornecedor
                                , T03.T003_bairro                BairroFornecedor
                                , T03.T003_endereco              EnderecoFornecedor
                                , T03.T003_numero                NumeroFornecedor
                                , T03.T003_cep                   CepFornecedor     
                            FROM t003_fornecedor T03
                            JOIN t009_estado    T09 ON T03.T009_codigo = T09.T009_codigo
                            JOIN t010_tp_pessoa T10 ON T03.T010_codigo = T10.T010_codigo
                       LEFT JOIN t011_contato   T11 ON T03.T011_codigo = T11.T011_codigo
                            WHERE 1    =   1";
            
            if (!empty($codigoFornecedor))
                $sql    .=  " AND T03.T003_codigo       =       $codigoFornecedor   ";
            
            if (!empty($razao_social))
                $sql    .=  " AND T03.T003_razao_social LIKE    '%$razao_social%'   ";
            
            if (!empty($cnpj))
                $sql    .=  " AND T03.T003_cnpj         =       '$cnpj'             ";
            
            if (!empty($tp_pessoa))
                $sql    .=  " AND T10.T010_codigo       =       $tp_pessoa          ";
            
            return $this->query($sql);            
        }


    }                                                                               
?>