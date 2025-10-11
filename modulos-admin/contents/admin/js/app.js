function abrirModalImgUser(img, userNome){
    Swal.fire({
        imageUrl: img,
        imageAlt: 'Imagem do Usuário ' + userNome,
        showCloseButton: true,
        showConfirmButton: false,
    });
}

// INSERIR DADOS PARA DELETAR USER NO MODAL PERGUNTA EXLUIR
function addInfosUserDeletar(id, nome){
    var elementoNome = document.getElementById("nome-user-excluir")
    elementoNome.textContent = nome

    var elementoId = document.getElementById("id_user_deletar")
    elementoId.value = id
}

// MODO EM MANUTENÇÃO
async function emManutencao(){
    var el = document.getElementById("status-manutencao")

    if(document.getElementById("toggler-manutencao").checked){

        const res = await fetch(`${base_url}/modulos-admin/contents/admin/php/manutencao.php?status=ativo`)
        if(res){
            Swal.fire({
                icon: 'warning',
                title: 'Modo Manutenção',
                text
                : 'O site está em manutenção!',
                showConfirmButton: false,
                showCloseButton: true,
            });
    
            el.classList.add("text-success")
            el.classList.remove("text-danger")
            el.textContent = "ATIVADO"
        }

    }else{

        const res = await fetch(`${base_url}/modulos-admin/contents/admin/php/manutencao.php?status=inativo`)

        if(res){
            Swal.fire({
                icon: 'success',
                title: 'Modo Manutenção Desativado',
                text
                : 'O site não está mais em manutenção!',
                showConfirmButton: false,
                showCloseButton: true,
            });
    
            el.classList.remove("text-success")
            el.classList.add("text-danger")
            el.textContent = "DESATIVADO"
        }

    }
}