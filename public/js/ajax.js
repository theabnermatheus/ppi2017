$(document).ready(function () {
    $('#enviarMusica').on('click touchstart', function () {
        var formData = new FormData();
        var f = document.getElementById('formEnviarArquivo');
        var sel1 = $('#sel1').val();

        formData.append('acao', 'subirMusica');
        formData.append('titulo', f.titulo.value);
        formData.append('artista', f.artista.value);
        formData.append('genero', sel1);
        formData.append('arquivo', $('#arquivo').prop('files')[0]);

        $.ajax({
            url: 'controleUpload.php',
            data: formData,
            type: 'post',
            success: function (data) {
                alert(data);
            },
            beforeSend: function () {
                $('#procP').css({display: "block"});
            },
            complete: function () {
                $('#procP').css({display: "none"});
            },
            processData: false,
            cache: false,
            contentType: false
        });
    });
});


//usa essa função para trazer a musica do banco para o player
$(document).ready(function () {
    $('#testarMusic').on('click touchstart', function () {
        var formData = new FormData();
        formData.append('acao', 'pegarMusica');
        $.ajax({
            url: 'controleUpload.php',
            data: formData,
            type: 'post',
            success: function (data) {
                var tocador = document.getElementById("tocador");
                tocador.src = data;
                tocador.play();
            },
            beforeSend: function () {
                $('#procP').css({display: "block"});
            },
            complete: function () {
                $('#procP').css({display: "none"});
            },
            processData: false,
            cache: false,
            contentType: false
        });
    });
});


//cadastrar cliente
$(document).ready(function () {  
    $("#btnCadastrarCliente").on('click touchstart', function () {
        var form = document.getElementById('formCadastrarCliente');
        $.ajax({
            type: 'POST',
            url: '/ajaxCadastro',
            data: {               
                nome: form.nome.value,
                rg: form.rg.value,
                cpf: form.cpf.value,
                endereco: form.endereco.value,
                cidade: form.cidade.value,
                uf: form.uf.value,
                cep: form.cep.value,
                telefone: form.telefone.value,
                email: form.email.value,
                senha: form.senha.value,
                confirmarSenha: form.confirmarSenha.value
            },
            success: function (data) {
                $('#retornoValidacao').html(data);
            },
            error: function (data) {
                $('#retornoValidacao').html('Erro em carregar o Ajax' + data);
            }
        })
    })
})


//logar cliente
$(document).ready(function () {
    $('#entrar').on('click touchstart', function () {
        alert("teste");
    });
});
