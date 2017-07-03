$(document).ready(function () {
    $('#close').on('click touchstart', function () {
        $("#resposta").empty();
    });
});

$(document).ready(function () {
    $('#addMusicList').on('click touchstart', function () {
        $("#resposta").empty();
    });
});


$(document).ready(function () {
    $('button').on('click touchstart', function () {
        var id = this.id;
        var val = this.value;

        if (val == "btnPlay") {
            play();
        } else if (val == "btnPause") {
            pause();
        } else if (val == "BtnDiminuirVol") {
            volumeMenos();
        } else if (val == "BtnAumentarVol") {
            volumeMais();
        } else if (val == "BtnmutarVol") {
            volumeMudo();
        } else if (val == "tocar") {
            tocar(id);
        } else if (val == "Excluir") {
            if (confirm("Deseja Excluir?")) {
                $.ajax({
                    type: 'POST',
                    url: '/tirarMusica',
                    data: {
                        idDaMusica: id,
                        url: window.location.href
                    },
                    success: function (data) {
                        alert(data);
                        window.location.reload();
                    },
                    error: function (data) {
                        alert(data);
                        window.location.reload();
                    }
                });
            }
        } else if (val == "voltarList") {
            window.location.href = "/myList";

        } else if (val == "procurar") {
            $("#resposta").empty();
            var chave = $("#chave").val()
            $.ajax({
                type: 'POST',
                url: '/resultadoDaBusca',
                data: {
                    chave: chave
                },
                success: function (data) {
                    var item = data;
                    $("#resposta").append(item);
                },
                error: function (data) {
                    alert("Erro" + data);
                }
            });
        }
    });
});

function add(idDaMusica) {
    if (confirm("Deseja Adicionar?")) {
        $.ajax({
            type: 'POST',
            url: '/addMusicaInListPessoal',
            data: {
                idDamusica: idDaMusica,
                url: window.location.href
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (data) {
                alert("Erro" + data);
            }
        });
    }
}


function tocar(id) {
    var tocador = document.getElementById("tocador");
    tocador.src = "/" + id;
    tocador.play();
    var btnPlay = document.getElementById("btnPlay");
    btnPlay.disabled = true;

    var pause = document.getElementById("btnPause");
    pause.disabled = false;
}

function play() {
    var pause = document.getElementById("btnPause");
    var tocador = document.getElementById("tocador");
    pause.disabled = false;

    if (tocador.paused) {
        tocador.play();
    }
    var btnPlay = document.getElementById("btnPlay");
    btnPlay.disabled = true;
}

function pause() {
    var pause = document.getElementById("btnPause");
    pause.disabled = true;
    var tocador = document.getElementById("tocador");
    tocador.pause();
    var btnPlay = document.getElementById("btnPlay");
    btnPlay.disabled = false;
}

function volumeMais() {
    var tocador = document.getElementById("tocador");
    tocador.volume += 0.1;
}

function volumeMenos() {
    var tocador = document.getElementById("tocador");
    tocador.volume -= 0.1;
}
function volumeMudo() {
    var tocador = document.getElementById("tocador");
    var volume = tocador.volume;
    if (tocador.muted) {
        tocador.volume = volume;
    } else {
        tocador.volume = 0;
    }
}