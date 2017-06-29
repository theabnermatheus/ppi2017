$(document).ready(function () {
    $('button').on('click touchstart', function () {
        var id = this.id;
        var val = this.value;

        if (id == "addNewList") {
            window.location.href = "/addlist";
        } else if (val == "Abrir") {
            window.location.href = "/trazLista/" + this.id;
        } else if (val == "Excluir") {
            if (confirm("Deseja Excluir?")) {              
                $.ajax({
                    type: 'POST',
                    url: '/deletarLista',
                    data: {
                        id: id
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
            } else {
                alert("Cancelado");
            }













        } else if (val == "Alterar") {
            alert("o id da lista que vai ser alterado é : " + id);
        }

    });
});
