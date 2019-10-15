<?php                                                                               

    /**************************************************************************/    
    /* Criado em: 20/07/2012 por                               */    
    /* Descrição: Classe para executar as Querys do Programa T0006            */    
    /**************************************************************************/    

    class models_T0006 extends models                                               
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
        
        public function retornaDados($codigoCliente, $nomeCliente)
        {
            $sql    =   "  SELECT T02.T002_codigo      CodigoCliente
                                , T02.T002_nome        NomeCliente
                                , T02.T002_endereco    EnderecoCliente
                                , T02.T002_cep         CepCliente
                            FROM t002_cliente T02";
            
            if (!empty($codigoCliente))
                $sql    .=  " WHERE T02.T002_codigo =   $codigoCliente";
            if (!empty($endereco))
                $sql    .=  " AND T02.T002_nome   LIKE '%$nomeCliente%'";
                            
            return $this->query($sql);
        }


    }                                                                               
?>