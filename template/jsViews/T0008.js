$(function(){
        
    //TableSorter Orderna Coluna 1 e 2 Decrescente, com 4 colunas ativas
    $(".tablesorter").tablesorter( {sortList: [[0,1], [1,1]], headers: {4:{sorter: false}}});
    
    $('.campoSubtotal').attr({disabled:true});
        
    $('#botaoGravar').live("click",function(){
        $('.campoSubtotal').attr({disabled:false})  ;
        $('.campoTotal').attr({disabled:false})     ;
        
        $('.validar').submit()                      ;
    });
    
    $('.campoVlrUnt').live("blur",function(){
        
        var vlrQtde         =   $(this).parents('.linha').find('.campoQtde').val()  ;
        var vlrSubtotal     =   $(this).unmask()                                    ;
        var calculo         =   vlrQtde *   vlrSubtotal                             ;        
        var campoSubtotal   =   $(this).parents('.linha').find('.campoSubtotal')    ;        
    
        //Atribui Calculo            
        campoSubtotal.val(calculo);

        //Formata para Valor
        campoSubtotal.priceFormat({
            prefix: 'R$ ',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });
        
        var soma    =   $('.campoSubtotal').sum();   
        
        $('.campoTotal').val(soma);
        
        $('.campoTotal').priceFormat({
            prefix: 'R$ ',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });        
                
    }); 
    
    $('.campoQtde').live("focus",function(){
        $(this).priceFormat({
            prefix: '',
            centsSeparator: '',
            thousandsSeparator: ''
        });         
    }); 
    
    $('.campoQtde').live("blur", function(){        
        var campoVlrUnt     =   $(this).parents('.linha').find('.campoVlrUnt')  ;        
        var $this           =   $(this);
        var campoSubtotal   =   $(this).parents('.linha').find('.campoSubtotal');           
        var calculo         =   0   ;   
        
        if (campoVlrUnt.val()!="")
            {                
                campoVlrUnt =   campoVlrUnt.unmask()        ;
                calculo     =   $this.val() *   campoVlrUnt ;
                
                campoSubtotal.val(calculo)                  ;
                
                campoSubtotal.priceFormat({
                    prefix: 'R$ ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });    

                var soma    =   $('.campoSubtotal').sum();   

                $('.campoTotal').val(soma);

                $('.campoTotal').priceFormat({
                    prefix: 'R$ ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });  
            }
                    
    });
    
    $(".conteudo_16 .linha").live("mouseover", function(){
        $(this).css("background-color","#EEE9E9");
        
    });
    
    $(".conteudo_16 .linha").live("mouseout", function(){
        $(this).css("background-color","");
    });
    
    $(".conteudo_16 .linha").live("click", function(){
        var $this           =   $(this);
        var codigoRomaneio  =   $this.find(".codigoRomaneio").text();
        var codigoCliente   =   $("#cpCliente").val();
        var anoRomaneio     =   $this.find(".anoRomaneio").text();
        
        $.getJSON("?router=T0008/js.detalhesModal",{codigoRomaneio:codigoRomaneio,codigoCliente:codigoCliente, anoRomaneio:anoRomaneio},function(dados){
            var cliente =   $('#cpCliente option:selected').html();
            var data    =   $this.find('#lData').text();
            var romaneio=   $this.find('#lRomaneio').text();
            var total   =   $this.find('#lTotal').text();
            
            $('#pCliente').text(cliente);
            $('#pData').text(data);
            $('#pRomaneio').text(romaneio);
            $('#l1Total').text(total);
            $('.dados').html(dados);
        })
        
        $("#detalhesRomaneio").dialog
        ({
            resizable: false,
            autoopen: true,
            height:600,
            width:790,
            modal: true,
            draggable: false,
            buttons: 
                { "Fechar": function() { $(this).dialog("close"); } } 
        })        
        
        
    });
    

    
})
