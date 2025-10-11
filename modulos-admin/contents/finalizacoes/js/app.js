// pega a categoria selecionada
function selecionarPosicoesCategoria(){
    
    // ocultando ordenar por
    document.getElementById("ordenar-por").classList.add('d-none')

    var cat = document.getElementById("categoria-finalizacao").value

    document.getElementById("container-recebe-finalizacoes").innerHTML = ""
    
    // verifica se não está vazio o select
    if(cat == ''){
        alert('Selecione uma categoria')
        document.getElementById("posicao-finalizacao").setAttribute('disabled', true);
        document.getElementById("posicao-finalizacao").innerHTML = ""
        return
    }

    // verifica qual é a categoria selecionada para fazer a busca no banco
    if(cat == 'Guardeiro'){
        buscarPosicoes('Guardeiro')
    }else if(cat == 'Passador'){
        buscarPosicoes('Passador')
    }


    // func que busca as posições no banco
    async function buscarPosicoes(categoria){
        // fazendo a busca
        const res = await fetch(`${base_url}/modulos-admin/contents/finalizacoes/php/buscar-posicoes.php?cat=${categoria}`)
        const data = await res.json()
   
        // se tiver resultado, atualiza o select das posições
        if(data.success){
            // deixando o select ativo novamente
            document.getElementById("posicao-finalizacao").removeAttribute('disabled');
            // reiniciando o content do select
            document.getElementById("posicao-finalizacao").innerHTML = ""
            // adicionando as posições no select
            document.getElementById("posicao-finalizacao").innerHTML += `
                <option value="">-- Selecione a posição --</option>
            `
            // adicionando as posições no select
            data.posicoes.forEach((pos)=>{
                document.getElementById("posicao-finalizacao").innerHTML += `
                    <option value="${pos}">${pos}</option>
                `
            })
        }
        
    }
}



// pega a posição selecionada
async function selecionarFinalizacoesDaPosicao(){
    var pos = document.getElementById("posicao-finalizacao").value

    // verifica se não está vazio o select
    if(pos == ''){
        alert('Selecione uma posição')
        document.getElementById("posicao-finalizacao").innerHTML = ""
        return
    }

    // fazendo a busca
    const res = await fetch(`${base_url}/modulos-admin/contents/finalizacoes/php/buscar-finalizacoes.php?pos=${pos}`)
    const data = await res.json()
    if(data.success){
        inserirFinalizacoes(data.finalizacoes); 
    }
}


// func que insere as finalizações no container
function inserirFinalizacoes(finalizacoes){
    
    // ocultando ordenar por
    document.getElementById("ordenar-por").classList.add('d-none')

    var pai = document.getElementById("container-recebe-finalizacoes")
    pai.innerHTML = ""
    pai.innerHTML = "<h5 class='mb-2'>Finalizações filtradas:</h5>"

    // ordenando as finalizações por data de criação
    finalizacoes.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    
    // loop para montar os dados e inserir no container
    finalizacoes.forEach((fin)=>{

        // separando as estrelas
        let estrelasHtml = '';

        for (let i = 0; i < 5; i++) {
            if (i < fin.estrela) {
                estrelasHtml += '<i style="font-size: .5em;" class="text-danger fas fa-star"></i>';
            } else {
                estrelasHtml += '<i style="font-size: .5em;" class="text-dark fas fa-star"></i>';
            }
        }

        // separando o passo a passo
        let passoAPasso = '';
        fin.passo_a_passo.forEach((passo) => {
            passoAPasso += `
                <div class="d-flex align-items-center mb-2">
                    <div>${passo}</div>
                </div>
            `;
        });

        // separando as observações
        let observacoes = '';
        fin.observacoes.forEach((obs) => {
            observacoes += `
                <div class="d-flex align-items-center mb-2">
                    <div>${obs}</div>
                </div>
            `;
        });

        // ajustando o btn do video
        var btnVideo = ''
        if(fin.plataforma){
            if(fin.plataforma == 'youtube'){
                btnVideo = `<a class="mb-2 btn btn-sm btn-danger" href="${fin.video}" target="_blank"><i class="fab fa-youtube"></i> Vídeo da finalização</a>`
            }else if(fin.plataforma == 'instagram'){
                btnVideo = `<a class="mb-2 btn btn-sm btn-danger" href="${fin.video}" target="_blank"><i class="fab fa-instagram"></i> Vídeo da finalização</a>`
            }
        }
        console.log(fin.plataforma)

        // inserindo o accordeon
        pai.innerHTML += `
        
            <div class="mb-3 item-acordion accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex px-2 align-items-center justify-content-between">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#finalizacao-${fin.id}" aria-expanded="false" aria-controls="finalizacao-${fin.id}">
                            <div class="d-flex flex-column">
                                <div class="d-flex mb-1"> ${estrelasHtml} </div>
                                ${fin.nome}
                            </div>
                        </button>

                        <div style="cursor: pointer;" class="dropdown ps-3 pe-1 ps-lg-3 pe-lg-3 d-flex justify-content-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fs-5"></i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" onclick="editarFin('${fin.id}')">Editar</a></li>
                                <li><a class="dropdown-item" onclick="deletarFin('${fin.id}')">Deletar</a></li>
                            </ul>
                        </div>
                    </h2>
                    <div id="finalizacao-${fin.id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class='mb-4 pb-2 border-bottom'>
                                <h6>Passo a Passo:</h6>
                                ${passoAPasso}
                            </div>
                            
                            <div class='mb-2 pb-2'>
                                <h6>Observações:</h6>
                                ${observacoes}
                            </div>

                            ${btnVideo}
                          
                        </div>
                    </div>
                </div>
            </div>
        
        `
    })
}







// deletar finalização
async function deletarFin(id){
    document.getElementById("titulo-excluir").textContent = 'essa finalização?'
    document.getElementById("id_deletar").value = id
    document.getElementById("form-excluir").setAttribute('action', `${base_url}/modulos-admin/contents/finalizacoes/php/deletar-finalizacao.php`)
    
    openModalDelete()
}
function openModalDelete() {
    var meuModal = new bootstrap.Modal(document.getElementById('modal-excluir'));
    meuModal.show();
}




// editar finalização
async function editarFin(id){
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




// DESTACAR
async function destacar(id){
    const res = await fetch(`${base_url}/modulos-admin/contents/finalizacoes/php/destacar-finalizacao.php?id=${id}`)
    if (res) {
        var url = new URL(window.location.href);
        url.searchParams.set('success', 'true');
        window.location.href = url.toString();
    }
}

// REMOVER DESTAQUE
async function removerDestaque(id){
    const res = await fetch(`${base_url}/modulos-admin/contents/finalizacoes/php/remover-destaque-finalizacao.php?id=${id}`)
    if (res) {
        var url = new URL(window.location.href);
        url.searchParams.set('delete', 'true');
        window.location.href = url.toString();
    }
}