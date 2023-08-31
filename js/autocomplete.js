/* CLIENTES
 **********************************/
//teste

let listaClientes = [];
$("#p_cliente").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=cliente", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaClientes = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderCliente").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderCliente").style.display = ''
    },
});

// Depois de selecionar o cliente coloca o id no input id_cli

$("#p_cliente").on("autocompleteclose", function(event, ui) {
    debugger;
    listaClientes.forEach((item) => {
        if (item.split("|").includes(this.value)) document.getElementById("id_cli").value = item.split("|")[1]
    })
});

$("#p_cliente").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});

/* PEDIDOS
 **********************************/

let listaPedidos = [];
$("#b_pedidos").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=pedidos", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaPedidos = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderPedido").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderPedido").style.display = ''
    },
});

$("#b_pedidos").on("autocompleteclose", function(event, ui) {
    listaPedidos.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_ped").value = item.split("|")[1] })
});

$("#b_pedidos").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});

/* SOLICITAÇÕES
 **********************************/

let listaSolicitacoes = [];
$("#b_solicitacoes").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=solicitacoes", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaSolicitacoes = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        //document.getElementById("loaderPedido").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        //document.getElementById("loaderPedido").style.display = ''
    },
});

$("#b_solicitacoes").on("autocompleteclose", function(event, ui) {
    listaSolicitacoes.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_ped").value = item.split("|")[1] })
});

$("#b_solicitacoes").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});


/* APROVA
 **********************************/

let listaClientesAprova = [];
$("#p_cliente_aprova_consulta").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=clientepf", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                $('#nome_cliente').val($("#p_cliente_aprova_consulta").val());
                //document.getElementById("id_cli").value = "";
                response([]);
            } else {
                listaClientesAprova = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner
        document.getElementById("loaderCliente").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderCliente").style.display = ''
    },
});

function adicionaZero(numero) {
    if (numero <= 9)
        return "0" + numero;
    else
        return numero;
}

function isValidDate(d) {
    return d instanceof Date && !isNaN(d);
}
// Depois de selecionar o cliente coloca o id no input id_cli

$("#p_cliente_aprova_consulta").on("autocompleteclose", function(event, ui) {
    listaClientesAprova.forEach((item) => {
        if (item.split("|").includes(this.value)) {
            var cliente = null;

            $.get(host + "/adm/autocompleta.php?tp=cliente_nome", { q: item.split("|")[0] }, function(data) {

                })
                .done(function(data) {
                    if (data.length <= 1) {
                        response([]);
                    } else {
                        cliente = JSON.parse(data);
                    }

                    // SE encontrar dados do cliente, preenche os campos
                    if (cliente != null) {
                        $('#nome_cliente').val(cliente.nome);
                        $('#p_contato_cliente').val(cliente.contato);
                        $('#p_contato').val(cliente.contato);
                        $('#p_contato_2').val(cliente.contato);
                        $('#cpf').val(cliente.cpf_cnpj);
                        $('#rg').val(cliente.rg_ie);
                        $('#cargo').val(cliente.cargo);
                        $('#cargo1').val(cliente.cargo);

                        //var date = new Date(cliente.nascimento);
                        // var nascimento = (adicionaZero(date.getDate().toString()) + "/" + (adicionaZero(date.getMonth() + 1).toString()) + "/" + date.getFullYear());
                        // $('#nascimento').val(nascimento);

                        var date = new Date(cliente.nascimento + "T00:00:00");
                        var nascimento = "";
                        if (isValidDate(date)) {
                            nascimento = (adicionaZero(date.getDate().toString()) + "/" + (adicionaZero(date.getMonth() + 1).toString()) + "/" + date.getFullYear());
                        }
                        $('#nascimento').val(nascimento);

                        $('#cep').val(cliente.cep);
                        $('#endereco').val(cliente.endereco);
                        $('#nro').val(cliente.nro);
                        $('#compl').val(cliente.compl);
                        $('#p_ref').val(cliente.p_ref);
                        $('#bairro').val(cliente.bairro);
                        $('#cidade').val(cliente.cidade);
                        $('#uf').val(cliente.uf);
                        $('#tel1').val(cliente.tel1);
                        $('#email').val(cliente.email);
                        //$('#obs').val(cliente.obs);
                    }

                    document.getElementById("id_cli").value = item.split("|")[1]
                });
        }
    })
});

$("#p_cliente_aprova_consulta").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});

$("#p_contato").keyup(function() {
    console.log('aa');
    $("#p_contato_cliente").val($(this).val());
});

function updateContato(value) {
    $("#p_contato_cliente").val(value);
}


/* PARCEIROS
 **********************************/

let listaParceiros = [];
$("#p_parceiro").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=parceiro", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaParceiros = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderParceiro").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderParceiro").style.display = ''
    },
});

// Depois de selecionar o parceiro coloca o id no input id_parceiro

$("#p_parceiro").on("autocompleteclose", function(event, ui) {
    listaParceiros.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_parceiro").value = item.split("|")[1] })
});

$("#p_parceiro").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});


/* Busca PRODUTOS
 **********************************/

let buscaProdutos = {};
$("#b_produto").autocomplete({
    source: function(request, response) {
        $.get('/adm/autocompleta.php?tp=b_medicamento', { q: request.term }, function(data) {
            if (data.split("||").length <= 1) {
                document.getElementById("messagemErroItem").style.display = 'flex';
                setTimeout(() => {
                    document.getElementById("messagemErroItem").style.display = 'none';
                }, 5000)

                // Limpa o input id_prod caso a pessoa pesquise, apague e pesquise algo que não existe no banco de dados.
                document.getElementById("id_prod").value = '';

                response([]);
            } else {
                listaProdutos = {};

                // Transforma o que servidor em um dicionário;
                data.split('||').forEach((item) => {

                    let x = item.split("|");

                    // Evita itens vazios
                    if (x[0] == '') return;

                    // Retira quebra de linha e tabulação do nome;
                    x[0] = x[0].replace(/[\n\r]/g, '')

                    // Retira espaços em branco do nome;
                    x[0] = x[0].trim();
                    listaProdutos[x[0]] = x[1];
                })

                //document.getElementById("messagemErroItem").style.display = 'none';
                response(Object.keys(listaProdutos));
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderProduto").style.display = 'none'
    },
    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderProduto").style.display = ''
    }
});

// Depois de selecionar o produto coloca o id no campo id_prod para ser adiconado ao dicionÃ¡rio de peÃ§as
$("#b_produto").on("autocompleteclose", function(event, ui) {

    if (listaProdutos[this.value]) {
        document.getElementById("id_prod").value = listaProdutos[this.value];
    } else {
        document.getElementById("id_prod").value = '';
    }

});

// Para estilizar as linhas alternadamente
$("#b_produto").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});

/* LISTA PRODUTOS
 **********************************/

let listaProdutos = {};
$("#p_produto").autocomplete({
    source: function(request, response) {
        $.get('/adm/autocompleta.php?tp=l_medicamento', { q: request.term }, function(data) {
            if (data.split("||").length <= 1) {
                document.getElementById("messagemErroItem").style.display = 'flex';
                setTimeout(() => {
                    document.getElementById("messagemErroItem").style.display = 'none';
                }, 5000)

                // Limpa o input id_prod caso a pessoa pesquise, apague e pesquise algo que não existe no banco de dados.
                document.getElementById("id_prod").value = '';

                response([]);
            } else {

                listaProdutos = {};

                // Transforma o que servidor em um dicionário;
                data.split('||').forEach((item) => {

                    let x = item.split("|");

                    // Evita itens vazios
                    if (x[0] == '') return;

                    // Retira quebra de linha e tabulação do nome;
                    x[0] = x[0].replace(/[\n\r]/g, '');

                    // Retira espaços em branco do nome;
                    x[0] = x[0].trim();
                    listaProdutos[x[0]] = x[1];
                })

                document.getElementById("messagemErroItem").style.display = 'none';
                response(Object.keys(listaProdutos));
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderPeca").style.display = 'none'
    },
    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderPeca").style.display = ''
    }
});

// Depois de selecionar o produto coloca o id no campo id_prod para ser adiconado ao dicionÃ¡rio de peÃ§as
$("#p_produto").on("autocompleteclose", function(event, ui) {

    if (listaProdutos[this.value]) {
        document.getElementById("id_prod").value = listaProdutos[this.value];
    } else {
        document.getElementById("id_prod").value = '';
    }

});

// Para estilizar as linhas alternadamente
$("#p_produto").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});




/* FABRICANTES
 **********************************/

let listaFabricante = [];
$("#p_fabricante").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=fabricante", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaClientes = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderFabricante").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderFabricante").style.display = ''
    },
});

// Depois de selecionar o cliente coloca o id no input id_cli

$("#p_fabricante").on("autocompleteclose", function(event, ui) {
    listaClientes.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_fabricante").value = item.split("|")[1] })
});

$("#p_fabricante").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});


/* FORNECEDORES
 **********************************/
let listaFornecedor = [];
$("#p_fornecedor").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=fornecedor", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaClientes = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderFornecedor").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderFornecedor").style.display = ''
    },
});

// Depois de selecionar o cliente coloca o id no input id_cli

$("#p_fornecedor").on("autocompleteclose", function(event, ui) {
    listaClientes.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_fornecedor").value = item.split("|")[1] })
});

$("#p_fornecedor").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});



/* TRANSPORTADORA
 **********************************/
let listaTransportadora = [];
$("#p_transportadora").autocomplete({
    source: function(request, response) {
        $.get(host + "/adm/autocompleta.php?tp=transportadora", { q: request.term }, function(data) {
            if (data.split("\n").length <= 1) {
                response([]);
            } else {
                listaClientes = data.split('\n').slice(0, data.split('\n').length - 1);
                let res = data.split('\n').map((val) => val.split("|")[0]);
                // Apaga o ultimo elemento vazio
                res = res.slice(0, res.length - 1);
                response(res);
            }
        });
    },
    scrollHeight: 180,
    response: function(event, ui) {
        // Assim que uma resposta retornar esconde o spinner  
        document.getElementById("loaderTransportadora").style.display = 'none'
    },

    search: function(event, ui) {
        // Assim que a pesquisa inicia, mostra o spinner
        document.getElementById("loaderTransportadora").style.display = ''
    },
});

// Depois de selecionar o cliente coloca o id no input id_cli

$("#p_transportadora").on("autocompleteclose", function(event, ui) {
    listaClientes.forEach((item) => { if (item.split("|").includes(this.value)) document.getElementById("id_transportadora").value = item.split("|")[1] })
});

$("#p_transportadora").on("autocompleteopen", function(event, ui) {
    let menuItem = document.getElementsByClassName("ui-menu-item");
    for (let i = 0; i < menuItem.length; i += 2) {
        menuItem[i].style.backgroundColor = "#EAEAEA";
    }
});
/*********************************************************/