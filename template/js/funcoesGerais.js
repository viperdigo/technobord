$(function(){
    
    // Tabs
    $('#tabs').tabs();  

    // Datepicker
    $.datepicker.regional['pt-BR'] = {
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
            'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
            'Jul','Ago','Set','Out','Nov','Dez'],
            dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);    
    $('.data').datepicker( $.datepicker.regional[ 'pt-BR' ] );

    //hover states on the static widgets
    $('#barra-botoes-links, ul#icons li, input').hover(
            function() {$(this).addClass('ui-state-hover');},
            function() {$(this).removeClass('ui-state-hover');}
    );

    //Mascaras
    $('.ddd').mask('(999)');
    $('.telefone').mask('9999-9999');
    $('.cnpj').mask('99.999.999/9999-99');
    $('.cpf').mask('999.999.999-99');
    $('.rg').mask('99.999.999-9');
    $('.cep').mask('99999-999');
    //$('.data').mask('99/99/9999');
    
    //Formata Valor
    $('.valor').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    
    //Ordenação de Tabela (Tablesorter)
//    $(".tablesorter").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
//    $(".tablesorter").tablesorter({sortList: [[0,0]], headers: {4:{sorter: false}}});
    
    //Input Filtro Dinamico (Quicksearch)
    $('input.filtroDinamico').quicksearch('table tbody tr');
    
    //Validação Formulário
    $('form.validar').validationEngine();
    
    //Abre e Fecha Filtros
    $('.abrirFiltros').live('click',function(){        
        var $div_filtro     = $('#barra-filtros').find('form');
        $div_filtro.toggle('fast');
    });       
    
    //Botão Excluir
    $('li.excluir').click(function(event){
        event.preventDefault();
        var linha   =   $(this).parents('td').parents('tr');
        var item    =   linha.find('.id').text();
        
        //Caixa de Dialogo
        $('#dialogExcluir').dialog({
                draggable: false,
                resizable: false,
                modal: true,
                width: 300,
                buttons: {
                        "Ok": function() {
                            var hashes      =   window.location.href.slice(window.location.href.indexOf('?') +1).split('/');    //captura url
                            var url         =   "?"+hashes[0]+"/js.excluir";                                                    //url js.excluir  
                            $.post(url,{item:item},function(dados){
                                if(dados==1)
                                    {
                                        linha.remove();                                        
                                        $('#dialogExcluir').dialog("close");                                                                                 
                                        mensagem("","Excluído com Sucesso!");
                                    }
                                    else
                                        {
                                            $('#dialogExcluir').dialog("close"); 
                                            mensagem("e","Não foi possível excluir!")
                                        }
                                        ;
                            });
                           
                        },
                        "Cancel": function() {
                            $(this).dialog("close");
                        }
                }
        });
              
    }); 
    
    //Deixar inputs com Caixa Alta
    
    //Quando Copiar e Colar
    $("input").bind('paste', function(e) {
        var el = $(this);
        setTimeout(function() {
            var text = $(el).val();
            el.val(text.toUpperCase());
        }, 100);
    });

    //Quando Digitado
    $("input").keypress(function() {
        var el = $(this);
        setTimeout(function() {
            var text = $(el).val();
            el.val(text.toUpperCase());
        }, 100);
    });
                          
});

var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};

function mensagem(tipo, texto) {
        var opts = {
                pnotify_title:          "Mensagem!",
                pnotify_text:           texto,
                pnotify_addclass:       "stack-bar-bottom",
                pnotify_width:          "30%",
                pnotify_stack:          stack_bar_bottom
        };
        switch (tipo) {
                case 'e': //Erro
                        opts.pnotify_title  = "Erro!";
                        opts.pnotify_type   = "error";
                        break;
                case 'i': //Informação
                        opts.pnotify_title  = "Informação!";
                        opts.pnotify_type   = "info";
                        break;
        }
        $.pnotify(opts);
};                
