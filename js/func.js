//adjust speed x=nr pixeli/loop , s = loop time in miliseconds
var x = 8;
var s = 5;

function goXleft() {
    top.frames['principala'].window.scrollBy(-x, 0);
    goxl = setTimeout('goXleft()', s);
}

function goXright() {
    top.frames['principala'].window.scrollBy(x, 0);
    goxr = setTimeout('goXright()', s);
}

function stopXleft() {
    clearTimeout(goxl);
}

function stopXright() {
    clearTimeout(goxr);
}

var nfiles = 1;

function Expand() {
    if (nfiles < 8) {
        var adh = dfile1.outerHTML;
        adh = adh.replace(/1/g, ++nfiles)
        files.insertAdjacentHTML('BeforeEnd', adh);
        var img_tit = document.getElementById('img_tit' + nfiles).value = ''
        var img_cred = document.getElementById('img_cred' + nfiles).value = ''
        return false;
    }
};

var nfiles_pt = 1;

function Expand_pt() {
    if (nfiles_pt < 8) {
        var adh_pt = dfile_pt_1.outerHTML;
        adh_pt = adh_pt.replace(/1/g, ++nfiles_pt)
        files_pt.insertAdjacentHTML('BeforeEnd', adh_pt);
        var img_tit = document.getElementById('img_tit' + nfiles_pt).value = ''
        var img_cred = document.getElementById('img_cred' + nfiles_pt).value = ''
        var img_desc = document.getElementById('img_desc' + nfiles_pt).value = 'pt'
        return false;
    }
};

var nfiles_in = 1;

function Expand_in() {
    if (nfiles_in < 8) {
        var adh_in = dfile_in_1.outerHTML;
        adh_in = adh_in.replace(/1/g, ++nfiles_in)
        files_in.insertAdjacentHTML('BeforeEnd', adh_in);
        var img_tit = document.getElementById('img_tit' + nfiles_in).value = ''
        var img_cred = document.getElementById('img_cred' + nfiles_in).value = ''
        var img_desc = document.getElementById('img_desc' + nfiles_in).value = 'in'
        return false;
    }
};

var nfiles_es = 1;

function Expand_es() {
    if (nfiles_es < 8) {
        var adh_es = dfile_es_1.outerHTML;
        adh_es = adh_es.replace(/1/g, ++nfiles_es)
        files_es.insertAdjacentHTML('BeforeEnd', adh_es);
        var img_tit = document.getElementById('img_tit' + nfiles_es).value = ''
        var img_cred = document.getElementById('img_cred' + nfiles_es).value = ''
        var img_desc = document.getElementById('img_desc' + nfiles_es).value = 'es'
        return false;
    }
};



function mostra_div(linha) {
    var linha = document.getElementById(linha);
    if (linha.style.display == 'none') {
        linha.style.display = '';

    } else {
        linha.style.display = 'none';
    }
}

function check_visu_acess(id) {
    var item = document.getElementsByClassName('item_acessorio_' + id)[0];
    if (document.getElementById('tem_acessorio_' + id).checked) {
        document.getElementById('exibe_acessorio_' + id).removeAttribute("disabled");
        document.getElementById('exibe_acessorio_' + id).checked = true;
        item.style.fontWeight = "bold";
    } else {
        document.getElementById('exibe_acessorio_' + id).checked = false;
        //document.getElementById('exibe_acessorio_'+id).value=''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
        document.getElementById('exibe_acessorio_' + id).setAttribute("disabled", "disabled");
        item.style.fontWeight = "normal";
    }
}

function check_visu_eletrica(id) {
    var item = document.getElementsByClassName('item_eletrica_' + id)[0];
    if (document.getElementById('tem_eletrica_' + id).checked) {
        document.getElementById('exibe_eletrica_' + id).removeAttribute("disabled");
        document.getElementById('exibe_eletrica_' + id).checked = true;
        item.style.fontWeight = "bold";
    } else {
        document.getElementById('exibe_eletrica_' + id).checked = false;
        document.getElementById('exibe_eletrica_' + id).setAttribute("disabled", "disabled");
        item.style.fontWeight = "normal";
    }
}

function check_visu_instru(id) {
    var item = document.getElementsByClassName('item_instru_' + id)[0];
    if (document.getElementById('tem_instru_' + id).checked) {
        document.getElementById('exibe_instru_' + id).removeAttribute("disabled");
        document.getElementById('exibe_instru_' + id).checked = true;
        item.style.fontWeight = "bold";
    } else {
        document.getElementById('exibe_instru_' + id).checked = false;
        document.getElementById('exibe_instru_' + id).setAttribute("disabled", "disabled");
        item.style.fontWeight = "normal";
    }
}


function pessoa(tipo) {
    if (tipo == "fisica") {
        document.getElementById("pf").style.display = "inline";
        document.getElementById("pj").style.display = "none";
    } else if (tipo == "juridica") {
        document.getElementById("pf").style.display = "none";
        document.getElementById("pj").style.display = "inline";
    }
}


function tp_lcto(tipo) {
    if (tipo == "") {
        document.getElementById("a_pagar").style.display = "none";
        document.getElementById("a_receber").style.display = "none";
        document.getElementById("escolha_lcto").style.display = "inline";
    }
    if (tipo == "a_pagar") {
        document.getElementById("a_pagar").style.display = "inline";
        document.getElementById("a_receber").style.display = "none";
        document.getElementById("escolha_lcto").style.display = "none";
    }
    if (tipo == "a_receber") {
        document.getElementById("a_pagar").style.display = "none";
        document.getElementById("a_receber").style.display = "inline";
        document.getElementById("escolha_lcto").style.display = "none";
    }
}

function validar(obj) { // recebe um objeto
    var s = (obj.value).replace(/\D/g, '');
    var tam = (s).length; // removendo os caracteres não numéricos
    //if (!(tam==11 || tam==14 || tam==0)){ // validando o tamanho
    if (!(tam == 0 || tam == 11 || tam == 14)) { // validando o tamanho
        alert("'" + s + "' Não é um CPF ou um CNPJ válido!"); // tamanho inválido
        return false;
    }

    // se for CPF
    if (tam == 11) {
        if (!validaCPF(s)) { // chama a função que valida o CPF
            alert("'" + s + "' Não é um CPF válido!"); // se quiser mostrar o erro
            obj.select(); // se quiser selecionar o campo em questão
            return false;
        }
        //alert("'"+s+"' É um CPF válido!" ); // se quiser mostrar que validou		
        obj.value = maskCPF(s); // se validou o CPF mascaramos corretamente
        return true;
    }

    // se for CNPJ			
    if (tam == 14) {
        if (!validaCNPJ(s)) { // chama a função que valida o CNPJ
            alert("'" + s + "' Não é um CNPJ válido!"); // se quiser mostrar o erro
            obj.select(); // se quiser selecionar o campo enviado
            return false;
        }
        //alert("'"+s+"' É um CNPJ válido!" ); // se quiser mostrar que validou				
        obj.value = maskCNPJ(s); // se validou o CNPJ mascaramos corretamente
        return true;
    }
}
// fim da funcao validar()

// função que valida CPF
// O algorítimo de validação de CPF é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCPF(s) {
    var c = s.substr(0, 9);
    var dv = s.substr(9, 2);
    var d1 = 0;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (10 - i);
    }
    if (d1 == 0) return false;
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1) {
        return false;
    }
    d1 *= 2;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (11 - i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1) {
        return false;
    }
    return true;
}

// Função que valida CNPJ
// O algorítimo de validação de CNPJ é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCNPJ(CNPJ) {
    var a = new Array();
    var b = new Number;
    var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for (i = 0; i < 12; i++) {
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i + 1];
    }
    if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11 - x }
    b = 0;
    for (y = 0; y < 13; y++) {
        b += (a[y] * c[y]);
    }
    if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11 - x; }
    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
        return false;
    }
    return true;
}


// Função que permite apenas teclas numéricas
// Deve ser chamada no evento onKeyPress desta forma
// return (soNums(event));
function soNums(e) {
    if (document.all) { var evt = event.keyCode; } else { var evt = e.charCode; }
    if (evt < 20 || (evt > 47 && evt < 58)) { return true; }
    return false;
}

//	função que mascara o CPF
function maskCPF(CPF) {
    return CPF.substring(0, 3) + "." + CPF.substring(3, 6) + "." + CPF.substring(6, 9) + "-" + CPF.substring(9, 11);
}

//	função que mascara o CNPJ
function maskCNPJ(CNPJ) {
    return CNPJ.substring(0, 2) + "." + CNPJ.substring(2, 5) + "." + CNPJ.substring(5, 8) + "/" + CNPJ.substring(8, 12) + "-" + CNPJ.substring(12, 14);
}


function zera(nro, max) {
    var todosSelect = document.getElementsByTagName("select");
    for (x = nro; x < max; x++) {
        todosSelect[x].value = "1";
        todosSelect[x].style.display = 'none';
    }
}


function MascaraPeso(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13 || whichCode == 8) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    //alert(len);
    for (i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for (; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    // alert(len);
    if (len == 12) {
        return false;
    }
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0' + SeparadorDecimal + '0' + '0' + aux;
    if (len == 2) objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
    if (len == 3) objTextBox.value = '0' + SeparadorDecimal + aux;
    //if (len == 4) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 3) {
        aux2 = '';
        for (j = 0, i = len - 4; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            //alert(aux2);
            j++;
        }
        objTextBox.value = '';
        //alert('1');
        len2 = aux2.length;
        //alert('2');
        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 3, len);
        //alert(aux.substr(len - 4, len));
    }
    return false;
}

function limpa_formulario_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('endereco').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
    //document.getElementById('ibge').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('endereco').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
        //document.getElementById('ibge').value=(conteudo.ibge);
    } else {
        //CEP não Encontrado.
        limpa_formulario_cep();
        //alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('endereco').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";
            //document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } else {
            //cep é inválido.
            limpa_formulario_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep();
    }
};

// Jurídica

function limpa_formulario_cep_j() {
    //Limpa valores do formulário de cep.
    document.getElementById('endereco_j').value = ("");
    document.getElementById('bairro_j').value = ("");
    document.getElementById('cidade_j').value = ("");
    document.getElementById('uf_j').value = ("");
    //document.getElementById('ibge').value=("");
}

function meu_callback_j(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('endereco_j').value = (conteudo.logradouro);
        document.getElementById('bairro_j').value = (conteudo.bairro);
        document.getElementById('cidade_j').value = (conteudo.localidade);
        document.getElementById('uf_j').value = (conteudo.uf);
        //document.getElementById('ibge').value=(conteudo.ibge);
    } else {
        //CEP não Encontrado.
        limpa_formulario_cep_j();
        //alert("CEP não encontrado.");
    }
}

function pesquisacep_j(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('endereco_j').value = "...";
            document.getElementById('bairro_j').value = "...";
            document.getElementById('cidade_j').value = "...";
            document.getElementById('uf_j').value = "...";
            //document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback_j';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } else {
            //cep é inválido.
            limpa_formulario_cep_j();
            alert("Formato de CEP inválido.");
        }
    } else {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep_j();
    }
};


// Veículos

function limpa_formulario_cep_v() {
    //Limpa valores do formulário de cep.
    document.getElementById('cidade_v').value = ("");
    document.getElementById('uf_v').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
}

function meu_callback_v(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('cidade_v').value = (conteudo.localidade);
        document.getElementById('uf_v').value = (conteudo.uf);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
    } else {
        //CEP não Encontrado.
        limpa_formulario_cep_v();
        //alert("CEP não encontrado.");
    }
}

function pesquisacep_v(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('cidade_v').value = "...";
            document.getElementById('uf_v').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";
            //document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback_v';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } else {
            //cep é inválido.
            limpa_formulario_cep_v();
            alert("Formato de CEP inválido.");
        }
    } else {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep_v();
    }
};

/*--------------------------------------------------------------
# Fim Funções
--------------------------------------------------------------*/



$(document).ready(function() {

    /*--------------------------------------------------------------
    # EDITOR
    --------------------------------------------------------------*/
    var config_p = { width: "100%", height: 150 };
    $('.editor_p').ckeditor(config_p);

    var config_p2 = { width: "100%", height: 100 };
    $('.editor_p2').ckeditor(config_p2);

    var config = { width: "100%", height: 280 };
    $('.editor').ckeditor(config);


    /*--------------------------------------------------------------
    # Tooltip - Popover - Modal - Toast
    --------------------------------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    $('#Modal').modal('show');
    //$('.toast').toast(option);


    ///Máscaras


    $(".cep").mask("99999-999");
    //$('.cep').mask('00000-0009');


    $(".placa").mask("AAA-AAAA");

    $(".data").mask("99/99/9999");
    $(".hora").mask("99:99");
    $(".periodo_de").mask("99/99/9999");
    $(".periodo_ate").mask("99/99/9999");
    $(".h_check_in").mask("99:99");
    $(".h_check_out").mask("99:99");
    //$("#periodo_de").mask("99/99/9999");
    //$("#periodo_ate").mask("99/99/9999");
    //$("#h_check_in").mask("99:99");
    //$("#h_check_out").mask("99:99");

    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");

    $(".mcpf").mask("999.999.999-99");
    $(".mcnpj").mask("99.999.999/9999-99");
    $(".cartao").mask("9999 9999 9999 9999");

    $('.money').mask('#.##0,00', { reverse: true });
    //$(".moeda").maskMoney({ decimal: ",", thousands: "." });
    $(".moeda").maskMoney({ showSymbol: true, symbol: "R$", decimal: ",", thousands: ".", allowZero: true });

    $(".moeda_cx").maskMoney({ showSymbol: false, symbol: "", decimal: ",", thousands: ".", allowZero: true });

    $(".us_moeda").maskMoney({ decimal: ".", thousands: "," });


    $(".tel").mask("(00) 0000-00009");
    //$(".tel").mask("(99) 9999-9999");


    $(".cel_ant").focusout(function() {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(00) 00000-000?9");
        } else {
            element.mask("(00) 0000-0000?9");
        }
    }).trigger('focusout');

    var SPMaskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.cel').mask(SPMaskBehavior, spOptions);

    var behavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function(val, e, field, options) {
                field.mask(behavior.apply({}, arguments), options);
            }
        };

    $('.phone').mask(behavior, options);



    $('#selectAll').click(function() {
        if (this.checked == true) {
            $("input[type=checkbox]").each(function() {
                this.checked = true;
            });
        } else {
            $("input[type=checkbox]").each(function() {
                this.checked = false;
            });
        }
    });



    function countchecked() {
        // conta check
        var n = $("input:checked").length;
        // if (n <= 1) { n==0 } else { n=n-1 } ;
        $("#anunciantes div.check").text("Estabelecimenos selecionados: (" + n + (n == 1 ? "" : "") + ")");
    }
    countchecked();
    $(":checkbox").click(countchecked);



    /*--------------------------------------------------------------
    # Datepicker
    --------------------------------------------------------------*/

    $('.data').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "pt-BR",
        autoclose: true,
        todayHighlight: true
    });

    var startDate = new Date('01/01/2020');
    var FromEndDate = new Date();
    var ToEndDate = new Date();

    ToEndDate.setDate(ToEndDate.getDate() + 365);

    $('.periodo_de').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "pt-BR",
        //endDate: FromEndDate,
        todayHighlight: true,
        autoclose: true
    })

    .on('changeDate', function(selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.periodo_ate').datepicker('setStartDate', startDate);
    });

    $('.periodo_ate')
        .datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            language: "pt-BR",
            //todayHighlight: true,
            startDate: startDate,
            endDate: ToEndDate,
            autoclose: true
        })

    .on('changeDate', function(selected) {
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.periodo_de').datepicker('setEndDate', FromEndDate);
    });


}); // fim do $(document).ready(function() {


/*--------------------------------------------------------------
# Cálculo 
--------------------------------------------------------------*/

function number_format(number, decimals, dec_point, thousands_sep) {
    var n = number,
        c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep,
        s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function calcula_venda() {

    var custo = document.getElementById("custo").value.split(",").join("").replace('.', '.');
    var margem = document.getElementById("margem").value.split(",").join("").replace('.', '.');
    var res_venda = (margem / 100) * custo;

    custo = parseFloat(custo);
    res_venda = parseFloat(res_venda);
    res_venda = res_venda + custo;

    document.pedidos_cad.venda.value = number_format(res_venda, 2, '.', ',');
    //document.pedidos_cad.venda.value = res_venda;
}

function startCalc() { // FUNÇÃO PARA CALCULAR CAMPOS NUMÉRICOS DO FORM
    interval = setInterval("calc()", 1);
}


function calc() {

    compra = $('#compra').val().replace(".", "").replace(",", ".");
    dinheiro = $('#dinheiro').val().replace(".", "").replace(",", ".");
    //cartao_deb_master = $('#cartao_deb_master').val().replace(".","").replace(",",".");
    //cartao_cred_master = $('#cartao_cred_master').val().replace(".","").replace(",",".");
    //cartao_deb_visa = $('#cartao_deb_visa').val().replace(".","").replace(",",".");
    //cartao_cred_visa = $('#cartao_cred_visa').val().replace(".","").replace(",",".");
    cartao_deb_outros = $('#cartao_deb_outros').val().replace(".", "").replace(",", ".");
    cartao_cred_outros = $('#cartao_cred_outros').val().replace(".", "").replace(",", ".");
    cheque_vista = $('#cheque_vista').val().replace(".", "").replace(",", ".");
    //cheque_pre = $('#cheque_pre').val().replace(".","").replace(",",".");
    //cartao_deb = $('#cartao_deb').val().replace(".","").replace(",",".");
    //cartao_cred = $('#cartao_cred').val().replace(".","").replace(",",".");

    desconto = $('#desconto').val().replace(".", "").replace(",", ".");

    p_desc = $('#p_desc').val().replace(".", "").replace(",", ".");

    if (p_desc != '' && p_desc != 0) {
        //desconto = ((100-p_desc)/100)*compra;
        desconto = (p_desc / 100) * compra;
        document.recebimento.desconto.value = number_format(desconto, 2, ',', '.');
    }

    //receita = (dinheiro * 1) + (cheque_vista * 1) + (cheque_pre * 1) + (cartao_deb * 1) + (cartao_cred * 1) + (desconto * 1);
    //receita = (dinheiro * 1) + (cartao_deb_master * 1) + (cartao_cred_master * 1) + (cartao_deb_visa * 1) + (cartao_cred_visa * 1) + (cartao_deb_outros * 1) + (cartao_cred_outros * 1) + (cheque_vista * 1) + (desconto * 1);
    receita = (dinheiro * 1) + (cartao_deb_outros * 1) + (cartao_cred_outros * 1) + (cheque_vista * 1) + (desconto * 1);

    total = (receita - compra);

    var resultado = document.getElementById("troco").innerHTML = number_format(total, 2, ',', '.');
    if (total < 0) {
        var cor_resultado = "<span style='color:#ff0000;font-size:17px;'>" + resultado + "</span>";
    } else {
        var cor_resultado = "<span style='color:#0000ff;font-size:17px;'>" + resultado + "</span>";
    }
    document.getElementById('troco').innerHTML = cor_resultado;
    // coloca o valor total no input em formato da moeda real
    //resultado = $('#total').val(number_format(total, 2, ',', '.'));	
    //document.getElementById("demo").innerHTML=number_format(total, 2, ',', '.');

    //$('#total').val(number_format(total, 2, ',', '.'));	
}

function stopCalc() {
    clearInterval(interval);
}