// adicionar id no modal add finalização treino
function adicionarIdModalAddFinalizacao(id){
    document.getElementById("treino_id_modal_add_finalizacao").value = id
}

// deletar treino 
async function deletarTreino(id){
    document.getElementById("titulo-excluir").textContent = 'esse treino?'
    document.getElementById("id_deletar").value = id
    document.getElementById("form-excluir").action = 'modulos-admin/contents/treinos/php/deletar-treino.php'
    abrirModalExcluir()
}

// deletar finalização treino 
async function deletarFinalizacao(id){
    document.getElementById("titulo-excluir").textContent = 'essa finalização?'
    document.getElementById("id_deletar").value = id
    document.getElementById("form-excluir").action = 'modulos-admin/contents/treinos/php/deletar-finalizacao-treino.php'
    abrirModalExcluir()
}

function abrirModalExcluir() {
    var meuModal = new bootstrap.Modal(document.getElementById('modal-excluir'));
    meuModal.show();
}

// abrir modal e inserir dados para editar treino
async function editarTreino(id){
    const res = await fetch(`${base_url}/modulos-admin/contents/treinos/php/get-treino.php?id=${id}`)
    const dados = await res.json()

    document.getElementById("treino_id_editar").value = dados.treino_id

    document.getElementById("aula_treino_editar").value = dados.aula_treino
    document.getElementById("aula_treino_editar_show").value = `${dados.aula_treino} ª`
    document.getElementById("data_treino_editar").value = dados.data_treino
    if(dados.dia_treino == "Segunda Feira"){
        document.getElementById("seg").selected = true
    } else if(dados.dia_treino == "Terça Feira"){
        document.getElementById("ter").selected = true
    } else if(dados.dia_treino == "Quarta Feira"){
        document.getElementById("qua").selected = true
    } else if(dados.dia_treino == "Quinta Feira"){ 
        document.getElementById("qui").selected = true
    } else if(dados.dia_treino == "Sexta Feira"){
        document.getElementById('sex').selected = true
    } else if(dados.dia_treino == "Sábado"){
        document.getElementById('sab').selected = true
    } else if(dados.dia_treino == "Domingo"){
        document.getElementById('dom').selected = true
    }

    if(dados.hora_treino == "06:30"){
        document.getElementById("06:30").selected = true
    } else if(dados.hora_treino == "12:00"){
        document.getElementById("12:00").selected = true
    } else if(dados.hora_treino == "14:00"){
        document.getElementById("14:00").selected = true
    } else if(dados.hora_treino == "15:00"){
        document.getElementById("15:00").selected = true
    } else if(dados.hora_treino == "16:00"){
        document.getElementById("16:00").selected = true
    }else if(dados.hora_treino == "19:30"){
        document.getElementById("19:30").selected = true
    } else if(dados.hora_treino == "21:00"){
        document.getElementById("21:00").selected = true
    } else if(dados.hora_treino == "22:00"){
        document.getElementById("22:00").selected = true
    }

    if(dados.tipo_treino == 'Jiu Jitsu'){
        document.getElementById("editar_jiu_jitsu").selected = true
    } else if(dados.tipo_treino == 'No Gi'){
        document.getElementById("editar_no_gi").selected = true
    }

    // adicionar observações modal editar;
    document.getElementById("observacoes_treino_editar").value = dados.observacoes_treino;
    
    // adicionar imagens modal editar;
    var imagensArray = dados.img_treino
    document.getElementById("container-imgs-modal-treino-editar").innerHTML = "";
    imagensArray.forEach((img)=>{
        document.getElementById("container-imgs-modal-treino-editar").innerHTML += `
            <div id="container-${dados.treino_id}-${img}" class="p-2 d-flex flex-column align-items-center">
                <div class="_container-img-editar">
                <img src="${base_url}/assets/imagens/site-admin/treinos/${img}">
                </div>
    
                <i onclick="removerImgTreinoModalEditar('container-${dados.treino_id}-${img}', '${dados.treino_id}', '${img}')" style="cursor: pointer;" class="mt-1 fs-6 text-danger fas fa-close"></i>
            </div>
        `
    })



    openModal();
}

function openModal() {
    var meuModal = new bootstrap.Modal(document.getElementById('modal-editar-treino'));
    meuModal.show();
}





// abrir modal e editar finalização treino
async function editarFinalizacao(id){
    const res = await fetch(`${base_url}/modulos-admin/contents/treinos/php/get-finalizacao.php?id=${id}`)
    const dados = await res.json()
    document.getElementById("finalizacao_id_editar").value = dados.id
    document.getElementById("finalizacao_editar").value = dados.nome

    // adicionar passo a passo modal editar finalizacao;
    let itens = dados.passo_a_passo
    itens = itens.map(item => {
        if (!item.endsWith(';')) {
            item += '';
        }
        return item.trim();
    });
    itens = itens.filter(item => item);
    let itensString = itens.join('\n');
    document.getElementById("passo_a_passo_editar").value = itensString


    // adicionar observacoes modal editar finalizacao;
    let obsItems = dados.observacoes;
    let formattedItems = obsItems.map(item => {
        // Remove espaços em branco no início e no final
        item = item.trim();
        // Adiciona '*' no início e ';' no final de cada item
        return `${item}`;
    });
    // Junta todos os itens em uma string, separados por quebra de linha
    let finalString = formattedItems.join('\n');
    // Atribui a string formatada ao valor do textarea
    document.getElementById("obs_finalizacao_editar").value = finalString;

    document.getElementById("video_editar").value = dados.video
    document.getElementById("estrela_editar").value = dados.estrela

    openModalEditarFinalizacao()
}

function openModalEditarFinalizacao() {
    var meuModal = new bootstrap.Modal(document.getElementById('modal-editar-finalizacao'));
    meuModal.show();
}




// slider de imagens treino previa
var mySwiper = new Swiper('.mySwiper', {
    // Opções do Swiper
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    effect: 'fade',
    autoplay: {
        delay: 3000,
        disableOnInteraction: false, 
    },
    speed: 1000,
});



// abrir modal e inserir imagens full
function abrirModalPreviaImgsTreino(img){
    document.getElementById("imagem-full").src = `${base_url}/assets/imagens/site-admin/treinos/${img}`

    openModalImagensFull();
}

function openModalImagensFull() {
    var meuModal = new bootstrap.Modal(document.getElementById('modal-imagens-full'));
    meuModal.show();
}