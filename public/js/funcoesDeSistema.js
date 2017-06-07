$(document).ready(function () {
    $('#sair').on('click touchstart', function () {
        window.location.href = "/sair";
    });
});
$(document).ready(function () {
    $('#btnCadastrar').on('click touchstart', function () {
        window.location.href = "/cadastro";
    });
});

$(document).ready(function () {
    $('#btnEntrar').on('click touchstart', function () {
        window.location.href = "/login";
    });
});

$(document).ready(function () {
    $('#alterarEexcluir').on('click touchstart', function () {
        window.location.href = "/editarUser";
    });
});

$(document).ready(function () {
    $('#funcoesAdmin').on('click touchstart', function () {
        window.location.href = "/editarUserAdmin";
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
        if (confirm("Deseja Excluir?")) {
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
    }
    });
});

$(document).ready(function () {
    $('#btnSalvarCliente').on('click touchstart', function () {

        var form = document.getElementById('formEditar');
        $.ajax({
            type: 'POST',
            url: '/ajaxAlterar',
            data: {
                nome: form.nome.value,               
                cpf: form.cpf.value,               
                telefone: form.telefone.value,
                email: form.email.value
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
    $('#btnBuscarCliente').on('click touchstart', function () {
        var form = document.getElementById('formEditarAdmin');
        $.ajax({
            type: 'POST',
            url: '/buscarUserAdmin',
            data: {
                id: form.id.value
            },
            success: function (data) {
                var res = data.split("#")
                form.nome.value = res[0];
                form.cpf.value = res[1];
                form.telefone.value = res[2];
                form.email.value = res[3];
                form.login.value = res[4];
                form.senha.value = res[5];
                
                form.btnAlterarClienteAdmin.disabled = false;
                form.btnExcluirClienteAdmin.disabled = false;
            },
            error: function (data) {
                $('#retornoValidacao').html(data.toString());
            }
        })
    });
});

$(document).ready(function () {
    $('#btnAlterarClienteAdmin').on('click touchstart', function () {
        var form = document.getElementById('formEditarAdmin');

        form.nome.disabled = false;
        form.cpf.disabled = false;
        form.telefone.disabled = false;
        form.email.disabled = false;
        form.login.disabled = false;
        form.senha.dislabled = false;

        form.btnExcluirClienteAdmin.disabled = true;
        form.btnSalvarClienteAdmin.disabled = false;
        form.btnCancelarClienteAdmin.disabled = false;
    });
});

$(document).ready(function () {
    $('#btnExcluirClienteAdmin').on('click touchstart', function () {
        var form = document.getElementById('formEditarAdmin');
        if (confirm("Deseja Excluir?")) {
            $.ajax({
            type: 'POST',
            url: '/ajaxExcluirAdmin',
            data: {
                id: form.id.value
            },
            success: function (data) {
                $('#retornoValidacao').html(data.toString());
                    
            },
            error: function (data) {
                $('#retornoValidacao').html(data.toString());
                    
            }
        });
    }
    });
});

$(document).ready(function () {
    $('#btnSalvarClienteAdmin').on('click touchstart', function () {

        var form = document.getElementById('formEditarAdmin');
        $.ajax({
            type: 'POST',
            url: '/ajaxAlterarAdmin',
            data: {
                id: form.id.value,
                nome: form.nome.value,               
                cpf: form.cpf.value,               
                telefone: form.telefone.value,
                email: form.email.value,
                login: form.login.value,
                senha: form.senha.value
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