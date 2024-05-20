function atualizaDados() {
    // envia uma solicitação AJAX para o servidor para buscar os dados mais recentes
    $.ajax({
        url: 'atualiza_dados.php',
        success: function (dados) {
            // atualiza a página com os dados mais recentes
            $('#dados').html(dados);
        },
        complete: function () {
            // agenda a próxima atualização em 5 segundos
            setTimeout(atualizaDados, 5000);
        }
    });
}

// inicia a atualização de dados quando a página é carregada
$(document).ready(function () {
    atualizaDados();
});

function atualizaDados2() {
    // envia uma solicitação AJAX para o servidor para buscar os dados mais recentes
    $.ajax({
        url: 'atualiza_dados2.php',
        success: function (dados2) {
            // atualiza a página com os dados mais recentes
            $('#dados2').html(dados2);
        },
        complete: function () {
            // agenda a próxima atualização em 5 segundos
            setTimeout(atualizaDados2, 5000);
        }
    });
}

// inicia a atualização de dados quando a página é carregada
$(document).ready(function () {
    atualizaDados2();
});
