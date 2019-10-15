<?php                                                                               

    /**************************************************************************/    
    /* Criado em: 14/06/2012 por                               */    
    /* Descrição: Classe para executar as Querys do Programa T0009            */    
    /**************************************************************************/    

    class models_T0009 extends models                                               
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


    }                                                                               
?>