<?php

/**************************************************************************/
/*                          DAVÓ SUPERMERCADOS                            */
/* Criado em: 21/03/2011 por Rodrigo Alfieri                              */
/* Descrição: Classe para realizar conexão com os BD's e
 *           funções utilizadas em todos os programas                     */
/**************************************************************************/
  
class models extends PDO
{

    var $usuario;
    var $senha;
    var $consulta = "";
      
    public function __construct()
    { 
        parent::__construct('mysql:host='.PRD_HOST.';dbname='.PRD_BD, PRD_USER, PRD_PASS);
        $this->exec("SET NAMES 'utf8'");
        $this->exec("SET character_set_connection=utf8");
        $this->exec("SET character_set_client=utf8");
        $this->exec("SET character_set_results=utf8");
    }

    public function seleciona($tabela,$campos="*",$delimitador="",$quantidade=1)
    {
        $sql = false;
        if(!empty($tabela))
        {
            $sql = "SELECT ".$campos." FROM ".$tabela;
            if($delimitador!="")
            {
                $sql .= " WHERE ".$delimitador;
            }
        }
        
        
        return $sql;
    }

    public function insere($tabela,$campos)
    {
        $sql = false;
        if(!empty($tabela))
        {
            $sql = "INSERT INTO ".$tabela." (";
            foreach($campos as $nomes => $valores)
            {                
                $sql_aux1 .= $nomes. ",";
                $sql_aux2 .= $this->formataValor($tabela,$nomes,$valores). ",";
            }
            $sql_aux1 = substr($sql_aux1,0,strlen($sql_aux1)-1);
            $sql_aux2 = substr($sql_aux2,0,strlen($sql_aux2)-1);
//            echo $sql.$sql_aux1.") VALUES (".$sql_aux2.")";  
//            echo "<br/>"; 
            return  $sql.$sql_aux1.") VALUES (".$sql_aux2.")";
        }
    }

    public function atualiza($tabela,$campos,$delimitador)
    {
        $sql = false;
        if(!empty($tabela))
        {
            $sql = "UPDATE ".$tabela." SET ";
            foreach($campos as $nomes => $valores)
            {
                $sql_aux .= $nomes." = ".$this->formataValor($tabela,$nomes,$valores). ",";
            }
            $sql_aux = substr($sql_aux, 0, (strlen($sql_aux)-1));
//            echo  $sql.$sql_aux. " WHERE ".$delimitador;
//            echo "<br/>";
            return  $sql.$sql_aux. " WHERE ".$delimitador;
        }
    }

    public function exclui($tabela,$delimitador)
    {
        $sql = false;
        if(!empty($tabela))
        {
            $sql = "DELETE FROM ".$tabela. " WHERE ".$delimitador;
            //echo  $sql;
        }
        return $sql;
    }

    private function formataValor($tabela,$campo,$valor)
    {        
        if(strpos($campo,"senha") === 0)
        {
            return  "'".md5($valor)."'";

        }
        elseif($this->verificaTipo($tabela,$campo) == "VAR_STRING"
            || $this->verificaTipo($tabela,$campo) == "STRING"
            || $this->verificaTipo($tabela,$campo) == "TIME"
            || $this->verificaTipo($tabela,$campo) == "BLOB")
        {
            $valor  = str_replace("'", "`", $valor);
            return "'".$valor."'";
        }
        elseif($this->verificaTipo($tabela,$campo) == "DATE")
            //|| $this->verificaTipo($tabela,$campo) == "DATETIME")
        {
            if(empty($valor))
                return "null";
            else
                return "'".$this->formataData($valor)."'";
        }
        elseif ($this->verificaTipo($tabela,$campo) == "DATETIME")
        {
            if(empty($valor))
                return "null";
            else
            {
            $valor      = explode(" ", $valor);
            $valor[0]   = $this->formataData($valor[0]);

            $valor      = "'".$valor[0]." ".$valor[1]."'";
            return $valor;
            }
        }
        elseif($this->verificaTipo($tabela,$campo) == "LONG")
        {
            $valor  = str_replace("R$", "", $valor);
            $valor  = trim($valor);
            $valor  = str_replace(".","",$valor);
            $valor  = str_replace(",",".",$valor);
            return $valor;
        }
        else
        {                       
            $valor  = str_replace("R$", "", $valor);
            $valor  = trim($valor);
            $valor  = str_replace(".","",$valor);
            $valor  = str_replace(",",".",$valor);
            return $valor;
        }
    }

    private function validaHora($tempo)
    {
       list($hora,$minuto) = explode(':',$tempo);

       if ($hora > -1 && $hora < 24 && $minuto > -1 && $minuto < 60)
       {
          return true;
       }
    }

    private function validaData($data)
    {
        $data = explode("/", $data);
        var_dump($data);die;
        if($data) {
            if (!checkdate($data[1], $data[0], $data[2]) and !checkdate($data[1], $data[2], $data[0])) {
                return false;
            }
        }
        return true;
    }

    public function formataData($data, $isDatetime = false)
    {
        if (empty($data)) {
            return $data;
        }

        $dateTime = new DateTime();
        if ($isDatetime) {
            $arrDate = explode(' ', $data);
            if ($arrDate[1])
                return $dateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d');
            else
                return $dateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d');
        } else {
            return $dateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d');
        }


    }

    public function formataDataView($data, $withHour = false)
    {
        if (empty($data)) {
            return $data;
        }

        $dateTime = new DateTime();
        if ($withHour)
            return $dateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y');
        else
            return $dateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y');

    }

    private function verificaTipo($tabela,$campo)
    {
        $coluna = $this->query($this->seleciona($tabela,$campo,false,1));

        if($coluna!==false)
        {
            $resultado = $coluna->getColumnMeta(0);
            return $resultado["native_type"];
        }
    }

    public function formataDataViewFix($data)
    {
        if (empty($data)) {
            return $data;
        }

        $dateTime = new DateTime();
        return $dateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y');

    }

    public function retiraMascara($valor)
    {
        $valor  = str_replace('/', "", $valor);
        $valor  = str_replace('_', "", $valor);
        $valor  = str_replace('-', "", $valor);
        $valor  = str_replace('|', "", $valor);
        $valor  = str_replace('.', "", $valor);
        $valor  = str_replace(',', "", $valor);
        $valor  = str_replace(':', "", $valor);
        $valor  = str_replace(':', "", $valor);
        $valor  =   trim($valor);

        return $valor;
    }

    public function retiraMascaraArray($array)
    {
        
        $retorno    =   array();
        
        function array_push_associative(&$arr) 
        {
            $args = func_get_args();
            foreach ($args as $arg) {
                if (is_array($arg)) {
                    foreach ($arg as $key => $value) {
                        $arr[$key] = $value;
                        $ret++;
                    }
                }else{
                    $arr[$arg] = "";
                }
            }
            
            return $ret;
            
        }        
        
        foreach($array as $campo => $valor)
        {
            $valor  = str_replace('/', "", $valor);
            $valor  = str_replace('_', "", $valor);
            $valor  = str_replace('-', "", $valor);
            $valor  = str_replace('|', "", $valor);
            $valor  = str_replace('.', "", $valor);
            $valor  = str_replace(',', "", $valor);
            $valor  = str_replace(':', "", $valor);
            $valor  = str_replace(':', "", $valor);
            $valor  = str_replace(')', "", $valor);
            $valor  = str_replace('(', "", $valor);
            $valor  = trim($valor);            
            
            $arr    =   array($campo => $valor);
            
            array_push_associative($retorno, $arr);
            
        }

        return $retorno;
    }



    /**************************************************************************
                    Intranet - DAVÓ SUPERMERCADOS
    * Criado em: 17/04/2012 por Rodrigo Alfieri
    * Descrição: esta função recebe um valor numérico e retorna uma 
    *           string contendo o valor de entrada por extenso
    * Entrada:  $valor (formato que a função number_format entenda :) 
    * Origens:  string com $valor por extenso 

    **************************************************************************
    */    

    function retornaValorPorExtenso($valor=0) {
        
            $singular = array(  "centavo"
                              , "real"
                              , "mil"
                              , "milhão"
                              , "bilhão"
                              , "trilhão"
                              , "quatrilhão"
                             );
            
            $plural = array(  "centavos"
                            , "reais"
                            , "mil"
                            , "milhões"
                            , "bilhões"
                            , "trilhões"
                            , "quatrilhões"
                           );

            $c = array(  ""
                       , "cem"
                       , "duzentos"
                       , "trezentos"
                       , "quatrocentos"
                       , "quinhentos"
                       , "seiscentos"
                       , "setecentos"
                       , "oitocentos"
                       , "novecentos"
                      );
            
            $d = array(  ""
                       , "dez"
                       , "vinte"
                       , "trinta"
                       , "quarenta"
                       , "cinquenta"
                       , "sessenta"
                       , "setenta"
                       , "oitenta"
                       , "noventa"
                      );
            
            $d10 = array(  "dez"
                         , "onze"
                         , "doze"
                         , "treze"
                         , "quatorze"
                         , "quinze"
                         , "dezesseis"
                         , "dezesete"
                         , "dezoito"
                         , "dezenove"
                        );
            
            $u = array(  ""
                       , "um"
                       , "dois"
                       , "três"
                       , "quatro"
                       , "cinco"
                       , "seis"
                       , "sete"
                       , "oito"
                       , "nove"
                      );

            $z=0;

            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            
            $valor = number_format($valor, 2, ".", ".");
            $inteiro = explode(".", $valor);
            for($i=0;$i<count($inteiro);$i++)
                    for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
                            $inteiro[$i] = "0".$inteiro[$i];

            // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
            $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
            for ($i=0;$i<count($inteiro);$i++) 
            {
                $valor = $inteiro[$i];
                $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

                $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
                $t = count($inteiro)-1-$i;
                $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000")$z++; elseif ($z > 0) $z--;
                if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
                if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
            }

            return($rt ? $rt : "zero");
    } 
    
    public function dateDiff($sDataInicial, $sDataFinal)
    {
        $sDataI = explode("-", $sDataInicial);
        $sDataF = explode("-", $sDataFinal);

        $nDataInicial = mktime(0, 0, 0, $sDataI[1], $sDataI[0], $sDataI[2]);
        $nDataFinal = mktime(0, 0, 0, $sDataF[1], $sDataF[0], $sDataF[2]);

        return ($nDataInicial > $nDataFinal) ?
            floor(($nDataInicial - $nDataFinal)/86400) : floor(($nDataFinal - $nDataInicial)/86400);
    }
    
    function calculaDigitoMod11($NumDado, $NumDig, $LimMult)
    {
        $Dado = $NumDado;
        for($n=1; $n<=$NumDig; $n++)
        {
            $Soma = 0;
            $Mult = 2;
            
            for($i=strlen($Dado) - 1; $i>=0; $i--)
            {
                $Soma += $Mult * intval(substr($Dado,$i,1));
                if(++$Mult > $LimMult) $Mult = 2;
            }
            
            $Dado .= strval(fmod(fmod(($Soma * 10), 11), 10));
        }
        return substr($Dado, strlen($Dado)-$NumDig);        
    }
    

    //Gera $superArray para criar o menu
    public function menu()
    {
        $superArray = array ();
           
        $sql  = "SELECT DISTINCT T1.T000_codigo
                               , T1.T000_pai
                               , T1.T000_nome
                            FROM T000_estrutura    T1
                           WHERE T000_pai          IS NULL";


        $menu = $this->query($sql);

        foreach ($menu as $campos=>$valores)
        {

            $this->query("SELECT * 
                            FROM T000_estrutura T1
                           WHERE T000_pai = " . $valores['T000_codigo'])->fetchAll(PDO::FETCH_ASSOC);

            $superArray[$valores['T000_nome']] = $this->tem_filho($valores['T000_codigo']);
        }
        return $superArray;
    }

    //Função para verificar os sub-menus
    public function tem_filho($id_menu)
    {

        $superArray =   array();
        $sql        =   "SELECT T1.*
                           FROM T000_estrutura T1
                          WHERE T000_pai = $id_menu";
        
        $menu       =   $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if($menu)
        {
            foreach ($menu as $campos=>$valores)
            {
                $superArray[$valores['T000_nome']] = $this->tem_filho($valores['T000_codigo']);
            }
            return $superArray;
        }
        else
        {
            return $id_menu;
        }
    }
    
    public function retornaFormatoCodigo($codigo)
    {        
        if (!empty($codigo))
        {
            $codigo     =   str_pad($codigo, 3, "0", STR_PAD_LEFT);
        }
        
        $formato    =   $codigo;
       
        return $formato;
    }    
    
    public function retornaFormatoCodigoNome($codigo, $nome)
    {        
        if (!empty($codigo))
        {
            $separador  =   "-";            
            $codigo     =   str_pad($codigo, 3, "0", STR_PAD_LEFT);
        }
        
        $formato=   $codigo.$separador.$nome;
       
        return $formato;
    }    
    
    public function mostraMensagem($tipo, $texto)
    {
        
        $_SESSION['msg']['status']  =   true;
        $_SESSION['msg']['tipo']    =   $tipo;
        $_SESSION['msg']['texto']   =   $texto;
        
    }
    
    public function criaArquivoControllers($arquivo)
    {
        //NÃO MEXER NO INDENTAMENTO
        
        $pulaLinha  =   "\n";
        $conteudo   =   '
<?php
class '.$arquivo.' extends controllers
    {
        public function index($tipo)
            {
                home::execute($tipo);
            }
    }

?>';
        return $conteudo;
    }
    
    public function criaArquivoModels($arquivo)
    {
        
        //NÃO MEXER NO INDENTAMENTO
        $data       =   date("d/m/Y");
        $pulaLinha  =   "\n";
        $conteudo   =   
'<?php                                                                               

    /**************************************************************************/    
    /* Criado em: '.$data.' por '.USER.'                              */    
    /* Descrição: Classe para executar as Querys do Programa '.$arquivo.'            */    
    /**************************************************************************/    

    class models_'.$arquivo.' extends models                                               
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
?>';        
        
        return $conteudo;
    }
    
    public function criaArquivoHomeViews()
    {
        $pulaLinha  =   "\n";
        $conteudo   =   "<?php echo 'Em Manutenção!!!'?>";
        
        return $conteudo;
    }
    
    public function retornaEstados()
    {
        $sql    =   "  SELECT T09.T009_codigo  CodigoEstado
                            , T09.T009_uf      UfEstado
                            , T09.T009_nome    NomeEstado
                         FROM t009_estado T09
                     ORDER BY 2";
        
        return $this->query($sql);
    }
    
      
    public function retornaTpPessoa()
    {
        $sql    =   "  SELECT T10.T010_codigo  CodigoTpPessoa
                            , T10.T010_tipo    TipoTpPessoa
                        FROM t010_tp_pessoa T10";

        return $this->query($sql);
    }
    
    public function retornaQtdeDados($dados)
    {
        foreach($dados  as  $campos =>  $valores)

        return count($valores)?true:false;
    }
    
    public function retornaUltimoDiaMes($data="")
    {
        if (!$data) {
           $dia = date("d");
           $mes = date("m");
           $ano = date("Y");
        } else {
           $dia = date("d",$data);
           $mes = date("m",$data);
           $ano = date("Y",$data);
        }
        $data = mktime(0, 0, 0, $mes, 1, $ano);
        return date("d",$data-1);
    }
    
    
}

?>
