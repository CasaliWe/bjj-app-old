document.getElementById("imagem-perfil").addEventListener('change', (event) => {
    var img = document.getElementById("preview-imagem-perfil");
    var file = event.target.files[0];
    
    if (file) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    }
});