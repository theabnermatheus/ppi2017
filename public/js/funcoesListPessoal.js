$(document).ready(function () {
    $('a').on('click touchstart', function () {
        var t = this.id;
        if (t != "") {
             window.location.href = "/trazLista/"+t;
        }
    });
});


