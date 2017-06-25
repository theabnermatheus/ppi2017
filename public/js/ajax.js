//cadastrar cliente
$(document).ready(function () {
    $("#btnCadastrarCliente").on('click touchstart', function () {
        var form = document.getElementById('formCadastrarCliente');
        $.ajax({
            type: 'POST',
            url: '/ajaxCadastro',
            data: {
                nome: form.nome.value,               
                cpf: form.cpf.value,               
                telefone: form.telefone.value,
                email: form.email.value,
                login:form.login.value,
                senha: form.senha.value,
                confirmarSenha: form.confirmarSenha.value
            },
            success: function (data) {
                $('#retornoValidacao').html(data.toString());
            },
            error: function (data) {
                $('#retornoValidacao').html(data.toString());
            }
        })
    })
})

//logar cliente
$(document).ready(function () {
    $('#btnLogin').on('click touchstart', function () {
        var form = document.getElementById('formLogin');      
        $.ajax({
            type: 'POST',
            url: '/validaLogin',
            data: {
                acao: 'login',
                login: form.login.value,
                senha: form.senha.value
            },
            success: function (data) {
                $('#retorno').html(data);
            },
            beforeSend: function () {
                $('#processando').css({display: 'inline'});
            },
            complete: function () {
                $('#processando').css({display: 'none'});
            },
            error: function (evento, request, settings) {
                alert(settings);
            }
        });
    });
});

