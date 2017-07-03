var tocador = document.getElementById("tocador");

window.onload = function () {
    var tocador = document.getElementById("tocador");
    tocador.src = "http://181fm-edge1.cdnstream.com/181-hairband_128k.mp3?cb=512585.mp3";
    tocador.play();
}

function play() {
    var tocador = document.getElementById("tocador");
    var btnPlay = document.getElementById("btnPlay");
    var pause = document.getElementById("btnPause");
    if (tocador.src == "") {
        tocador.src = "http://181fm-edge1.cdnstream.com/181-hairband_128k.mp3?cb=512585.mp3";
        tocador.load();
        tocador.play();
    } else {
        tocador.play();
        btnPlay.disabled = true;
        pause.disabled = false;
    }
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

function paginaDeCadastro(){
    alert('teste');   
}

