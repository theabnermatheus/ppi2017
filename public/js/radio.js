$(document).ready(function () {
    $('a').on('click touchstart', function () {
        var tocador = document.getElementById("tocador");
        tocador.src = this.id;
        tocador.play();

        var btnPlay = document.getElementById("btnPlay");
        btnPlay.disabled = true;
        var pause = document.getElementById("btnPause");
        pause.disabled = false;
    });
});

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