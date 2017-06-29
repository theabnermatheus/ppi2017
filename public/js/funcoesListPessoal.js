$(document).ready(function () {
    $('button').on('click touchstart', function () {
        var id = this.id;
        var val = this.value;
        
        if(id == "addNewList"){
            window.location.href = "/addlist";
        }else if(val == "Abrir"){
            window.location.href = "/trazLista/"+this.id;
        }else if(val == "Excluir"){
            if (confirm("Deseja Excluir?")) {
                alert("o id da lista que vai ser excluido é : " + id);
            
            
            
            
            
            
            }else{
                alert("Cancelado");
            }           
        
        
        
        
        
        
        
        
        
        
        
        
        
        }else if(val == "Alterar"){
            alert("o id da lista que vai ser alterado é : " + id);
        }
           
    });
});
