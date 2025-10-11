<?php
    include_once 'config/config.php';
?>


<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/contents/competicoes/css/style.css">


<!-- COMPETIÇÕES -->
<section>
    <h6 class="small mb-5">Visualize todas as <strong>Competições</strong> que você participou!</h6>

    <button style="cursor: pointer;" class="mb-5 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-competicao">Adicionar competição +</button>

    <?php foreach ($competicoes as $competicao) { ?>
        <div class="mb-4 item-acordion accordion">
             <div class="accordion-item">
                 <h2 class="accordion-header d-flex justify-content-between align-items-center">
                    <button class="d-flex flex-column accordion-button collapsed align-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#competicao-<?= $competicao['id'] ?>" aria-expanded="false" aria-controls="competicao-<?= $competicao['id'] ?>">
                        <span class="fw-semibold"><?= $competicao['nome_evento'] ?></span>

                        <span class="small mt-1">
                            <?php
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                $data_completa = strftime('%d de %B de %Y', strtotime($competicao['data']));
                                echo $data_completa;
                            ?>
                        </span>
                    </button>

                    <div style="cursor: pointer;" class="dropdown px-2 me-2 me-lg-3" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v small"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a onclick="editarCompeticao('<?= $competicao['id'] ?>', '<?= $competicao['nome_evento'] ?>', '<?= $competicao['cidade'] ?>', '<?= $competicao['data'] ?>', '<?= $competicao['modalidade'] ?>', '<?= $competicao['colocacao'] ?>', '<?= $competicao['numero_lutas'] ?>', '<?= $competicao['numero_vitorias'] ?>', '<?= $competicao['numero_derrotas'] ?>', '<?= $competicao['numero_finalizacoes'] ?>', '<?= $competicao['imagem'] ?>')" class="dropdown-item">Editar</a></li>
                            <li><a class="dropdown-item" onclick="deletarCompeticao('<?= $competicao['id'] ?>')">Deletar</a></li>
                        </ul>
                    </div>
                 </h2>
                 <div id="competicao-<?= $competicao['id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
         
                         <div class="my-3 row">
                            <div class="mb-4 mb-lg-0 col-12 col-lg-6">
                                <div class="_container-img-competicao">
                                    <img onclick="abrirModalImgCompeticao('<?= $base_url?>assets/imagens/site-admin/competicoes/<?= $competicao['imagem'] ?>')" src="<?= $base_url?>assets/imagens/site-admin/competicoes/<?= $competicao['imagem'] ?>">
                                </div>
                            </div>

                            <div class="mb-4 mb-lg-0 col-12 col-lg-6 ps-3 pe-3 pe-lg-0 ps-lg-4">
                                <h5 class="mb-3">Informações sobre o evento:</h5>
                                
                                <p class="small mb-2"><strong>Nome do Evento:</strong> <?= $competicao['nome_evento'] ?></p>
                                <p class="small mb-2"><strong>Cidade:</strong> <?= $competicao['cidade'] ?></p>
                                <p class="small mb-2"><strong>Data:</strong> <?= $data_completa ?></p>
                                <p class="small mb-2"><strong>Modalidade:</strong> <?= $competicao['modalidade'] ?></p>
                                <p class="small mb-2"><strong>Colocação:</strong> <?= $competicao['colocacao'] ?></p>
                                <p class="small mb-2"><strong>Número de lutas:</strong> <?= $competicao['numero_lutas'] ?></p>
                                <p class="small mb-2"><strong>Número de Vitórias:</strong> <?= $competicao['numero_vitorias'] ?></p>
                                <p class="small mb-2"><strong>Número de Derrotas:</strong> <?= $competicao['numero_derrotas'] ?></p>
                                <p class="small mb-2"><strong>Número de Finalizações:</strong> <?= $competicao['numero_finalizacoes'] ?></p>
                            </div>
                         </div>
         
                     </div>
                 </div>
             </div>
        </div>
    <?php } ?>


    <?php if(count($competicoes) == 0){
        echo "<h6 class='p-3 text-center border rounded text-secondary'>Nenhuma competição cadastrada!</h6>";
    } ?>
</section>
<!-- COMPETIÇÕES -->



<script>
    // deletar
    function deletarCompeticao(id){
        document.getElementById("id-deletar-competicao").value = id;

        var modalDeletarCompeticao = new bootstrap.Modal(document.getElementById('modal-deletar-competicao'));
        modalDeletarCompeticao.show();
    }

    // abrir modal foto
    function abrirModalImgCompeticao(img){
        Swal.fire({
            imageUrl: img,
            imageAlt: 'Imagem da competição',
            showCloseButton: true,
            showConfirmButton: false,
        });
    }

    // editar
    function editarCompeticao(id, nomeEvento, cidade, data, modalidade, colocacao, numeroLutas, numeroVitorias, numeroDerrotas, numeroFinalizacoes, imagem){
        document.getElementById("id-competicao-editar").value = id;
        document.getElementById("nome-evento-competicao-editar").value = nomeEvento;
        document.getElementById("cidade-competicao-editar").value = cidade;
        document.getElementById("data-competicao-editar").value = data;
        document.getElementById("modalidade-competicao-editar").value = modalidade;
        document.getElementById("colocacao-competicao-editar").value = colocacao;
        document.getElementById("lutas-competicao-editar").value = numeroLutas;
        document.getElementById("vitorias-competicao-editar").value = numeroVitorias;
        document.getElementById("derrotas-competicao-editar").value = numeroDerrotas;
        document.getElementById("finalizacoes-competicao-editar").value = numeroFinalizacoes;
        document.getElementById("imagem-competicao-editar-preview").src = "<?= $base_url ?>assets/imagens/site-admin/competicoes/" + imagem;

        var modalEditarCompeticao = new bootstrap.Modal(document.getElementById('modal-editar-competicao'));
        modalEditarCompeticao.show();

    }
</script>