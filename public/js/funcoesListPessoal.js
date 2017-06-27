$(document).ready(function () {
    $('a').on('click touchstart', function () {
        var t = this.id;
        if (t != "") {
           alert(t);
        }
    });
});


