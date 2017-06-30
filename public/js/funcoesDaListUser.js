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
            var form = document.getElementById('formOculto');
            var idDaLista = form.inputOculto.value;
            if (confirm("Deseja Excluir?")) {
                $.ajax({
                    type: 'POST',
                    url: '/tirarMusica',
                    data: {
                        idDaMusica: id,
                        idDaPlaylist: idDaLista
                    },
                    success: function (data) {
                        alert(data);
                        window.location.reload()
                    },
                    error: function (data) {
                        alert(data);
                        window.location.reload()
                    }
                });
            }
        } else if (val == "voltarList") {
            window.location.href = "/myList";
        } else if (val == "procurar") {          
            var form = document.getElementById('formOculto');
            var idDaLista = form.inputOculto.value;
            for (var i = 0; i < 5; i++) {
                var item1 = $("<li class='list-group-item' onclick='add(" + i + ")'></li>").text("Item 1");
                $("#resposta").append(item1);
            }
        }
    });
});

function add(idDaMusica) { 
    var idDaLista = $("#codi").val();
    alert("O ID dá musica é : "+idDaMusica+ " O Id da lista é :" + idDaLista);
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
    if (tocador.muted) { // true se tiver mutado
        tocador.volume = volume;
    } else {
        tocador.volume = 0;
    }
}