<?php
//Instancia 
$obj        =   new models_T0005()  ;

//Combos
$comboTpPessoa  =   $obj->retornaTpPessoa();

//Filtros
if (!empty($_POST))
{
    $codigoFornecedor   =   $_POST['T003_codigo']                   ;
    $razao_social       =   $_POST['T003_razao_social']             ;
    $cnpj               =   $obj->retiraMascara($_POST['T003_cnpj']);
    $tp_pessoa          =   $_POST['T010_codigo']                   ;
    
    $dados          =   $obj->retornaDados($codigoFornecedor, $razao_social, $cnpj, $tp_pessoa);
}else
{
    //Sem Filtro
    $dados          =   $obj->retornaDados();
}

//Variavel para verificar se existem dados de retorno para tabela não aparecer
$QtdeDados  =   0                   ;
?>
<div id="barra-botoes">
    <a href="#"                         class="ui-state-default ui-corner-all botoes-links abrirFiltros">   <span class="ui-icon ui-icon-carat-2-n-s">  </span>Filtros</a>
    <a href="<?php echo ROUTER;?>novo"  class="ui-state-default ui-corner-all botoes-links">                <span class="ui-icon ui-icon-plus">         </span>Novo</a>
    <hr>    
</div>    
<div id="barra-filtros">
    <form action="" method="post">        
        <div class="conteudo_16">
            <!-- CAMPOS DA BARRA DE FILTROS -->
                <div class="grid_3">
                    <label>Dinâmico</label>
                    <input type="text"                          class="filtroDinamico"  />                  
                </div>
                <div class="grid_4">
                    <label>Razão Social</label>
                    <input type="text" name="T003_razao_social"                         />                  
                </div>
                <div class="grid_3">
                    <label>CNPJ</label>
                    <input type="text" name="T003_cnpj"         class="cnpj"            />                  
                </div>
                <div class="grid_2">
                    <label>Tipo Pessoa</label>
                    <select name="T010_codigo">      
                        <option value="" selected>Selecione...</option>
                        <?php foreach($comboTpPessoa as $campos => $valores){?>
                        <option value="<?php echo $valores['CodigoTpPessoa'];?>"><?php echo $obj->retornaFormatoCodigoNome($valores['CodigoTpPessoa'], $valores['TipoTpPessoa'])?></option>
                        <?php }?>
                    </select>                 
                </div>
                <div class="grid_2">
                    <input type="submit" value="Filtrar" class="ui-button ui-widget ui-state-default ui-corner-all botao" role="button" aria-disabled="false">                
                </div>
        </div>        
    </form>
</div>  
<div class="conteudo_16">
    <table class="tablesorter" cellspacing="1" cellpadding="0" border="0"> 
        <thead> 
            <tr> 
                <th>Código          </th> 
                <th>Razão Social    </th> 
                <th>CNPJ            </th> 
                <th>Tipo Pessoa     </th> 
                <th>Contato(s)      </th> 
                <th>Ações           </th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php   foreach($dados    as $campos => $valores)
                    {   $QtdeDados++; ?>
                        <tr> 
                            <td class="id"><?php echo $obj->retornaFormatoCodigo($valores['CodigoFornecedor']);?>   </td> 
                            <td><?php echo $valores['RazaoSocialFornecedor'];?>                                     </td> 
                            <td><?php echo $valores['CnpjFornecedor'];?>                                            </td> 
                            <td><?php echo $valores['TpPessoaFornecedor'];?>                                        </td> 
                            <td width="22%"><table class="tablesorter" cellspacing="1" cellpadding="0" border="0">
                                    <thead>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Thiago</td>
                                            <td>(11) 333333333</td>
                                        </tr>
                                        <tr>
                                            <td>Rodrigo Alfieri</td>
                                            <td>(11) 222222222</td>
                                        </tr>
                                        <tr>
                                            <td>Ale</td>
                                            <td>(11) 111111111</td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </td> 
                            <td class="acoes">
                                <ul class="ui-widget ui-helper-clearfix" id="icons">
                                    <li title="Alterar" class="ui-state-default ui-corner-all"><a href="<?php echo ROUTER?>alterar&codigoFornecedor=<?php echo $valores['CodigoFornecedor'];?>"><span   class='ui-icon ui-icon-pencil'></span></a></li>
                                    <li title="Excluir" class="ui-state-default ui-corner-all excluir"><a href="#"><span class="ui-icon ui-icon-closethick"></span></li>
                                </ul>
                            </td> 
                        </tr>
            <?php   }  ?>
                    <!-- COLSPAN É A QUANTIDADE DE COLUNAS EXISTENTES NA TABELA -->    
            <?php if ($QtdeDados==0){    ?>        
                    <tr>
                        <td colspan="6" style="text-align: center">Não Existem Dados.</td>
                    </tr>    
            <?php }?>
        </tbody> 
    </table> 
</div>   
