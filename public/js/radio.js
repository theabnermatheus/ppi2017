$(document).ready(function () {
    $("a").click(function () {
        var id = this.id;
        tocarMusicaAoClick(id);
    });
});

function tocarMusicaAoClick (id){    
   $.ajax({
            type: 'POST',
            url: '/trazerMusica',
            data: {
               codigo: id                              
            },
            success: function (data) {
                var tocador = document.getElementById("tocador");
                var mostraMusica = document.getElementById("mostraMusica");
                tocador.src = data;
                tocador.play();
                mostrarMusica.value = "tre"; 
            },
            error: function (data) {
                alert(data);
            }
        })    
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