$(document).ready(function () {
    $('#sair').on('click touchstart', function () {
        window.location.href = "/sair";
    });
});

$(document).ready(function () {
    $('#btnAlterarCliente').on('click touchstart', function () {
        var form = document.getElementById('formEditar');

        form.nome.disabled = false;
        form.cpf.disabled = false;
        form.telefone.disabled = false;
        form.email.disabled = false;

        form.btnExcluirCliente.disabled = true;
        form.btnSalvarCliente.disabled = false;
        form.btnCancelarCliente.disabled = false;
    });
});


$(document).ready(function () {
    $('#btnCancelarCliente').on('click touchstart', function () {
        var form = document.getElementById('formEditar');
        window.location.href = "/editarUser";
    });
});

$(document).ready(function () {
    $('#btnExcluirCliente').on('click touchstart', function () {
        var form = document.getElementById('formEditar');
        $.ajax({
            type: 'POST',
            url: '/ajaxExcluir',
            data: {
                id: form.btnExcluirCliente.value
            },
            success: function (data) {
                $('#retornoValidacao').html(data.toString());
            },
            error: function (data) {
                $('#retornoValidacao').html(data.toString());
            }
        });
    });
});

$(document).ready(function () {
    $('#btnSalvarCliente').on('click touchstart', function () {
        var form = document.getElementById('formEditar');

    });
});