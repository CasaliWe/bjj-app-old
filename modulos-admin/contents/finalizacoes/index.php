<?php
    include_once 'config/config.php';
?>


<!-- FINALIZAÇÕES -->
<section>
    <h6 class="small mb-5">Adicione, remova ou atualize todas as suas <strong>finalizações</strong> cadastradas nesta sessão ou através de seus treinos!</h6>

    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddFinalizacao">Adicionar finalizações +</button>

    <h6 class="mt-5 fw-bold">Filtrar:</h6>
    <div class="mt-1 row pb-0 pb-lg-3">
        <div class="mb-3 mb-lg-0 col-12 col-lg-6">
            <label for="categoria-finalizacao" class="small">Selecione o estilo de jogo*</label>
            <select onchange="selecionarPosicoesCategoria()" class="form-select" id="categoria-finalizacao">
                <option value=""></option>
                <option value="Guardeiro">Guardeiro</option>
                <option value="Passador">Passador</option>
            </select>
        </div>

        <div class="mb-3 mb-lg-0 col-12 col-lg-6">
            <label for="posicao-finalizacao" class="small">Selecione a posição*</label>
            <select onchange="selecionarFinalizacoesDaPosicao()" disabled class="form-select" id="posicao-finalizacao">
                <!-- vem do js -->
            </select>
        </div>
    </div>
    
    <div class="mt-3 mt-lg-0 d-flex justify-content-between align-items-center">
        <div id="ordenar-por" class="dropdown">
                <a class="small text-dark fw-semibold dropdown-toggle" href="#" role="button" id="dropdownOrdenarPor" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenar por: <span class="text-success"> <?= $textoOrdem; ?></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownOrdenarPor">
                    <li><a class="dropdown-item" href="finalizacoes.php">Mais Recentes</a></li>
                    <li><a class="dropdown-item" href="finalizacoes.php?ordem=antigos">Mais Antigos</a></li>
                    <li><a class="dropdown-item" href="finalizacoes.php?ordem=maior-avaliacao">Maior Avaliação</a></li>
                    <li><a class="dropdown-item" href="finalizacoes.php?ordem=menor-avaliacao">Menor Avaliação</a></li>
                </ul>
        </div>
        
        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#destaques-finalizacoes">Destaques</button>
    </div>

    <div class="mt-5" id="container-recebe-finalizacoes">
        <!-- tecnicas filtradas vem do js -->

        <!-- tecnicas filtradas vem do js -->


        <!-- todas as tecnicas para exibir inicialmente caso não faça filtragem -->
        <?php if(count($tecnicas) > 0){
            echo "<h5 class='mb-2'>Todas as finalizações:</h5>";
        }else{
            echo "<h6 class='p-3 text-center border rounded text-secondary'>Nenhuma finalização cadastrada!</h6>";
        } ?>
        <?php foreach ($tecnicas as $tec) { ?>
            <div class="mb-3 item-acordion accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex px-2 align-items-center justify-content-between">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#finalizacao-<?= $tec['id'] ?>" aria-expanded="false" aria-controls="finalizacao-<?= $tec['id'] ?>">
                            <div class="d-flex flex-column">
                                <div class="d-flex mb-2"> 
                                    <?php
                                        for ($i=1; $i <= 5; $i++) { 
                                            if($i <= $tec['estrela']){
                                                echo '<i style="font-size: .5em;" class="text-danger fas fa-star"></i>';
                                            }else{
                                                echo '<i style="font-size: .5em;" class="text-dark fas fa-star"></i>';
                                            }
                                        }
                                    ?>
                                </div>
                                <div>
                                    <span class="text-secondary"><?= $tec['posicoes']['nome'] ?> -</span>
                                    <span class="fw-semibold <?= $tec['destaque'] ? 'text-danger' : '' ?>"><?= $tec['nome'] ?></span>
                                </div>
                            </div>
                        </button>

                        <div style="cursor: pointer;" class="dropdown ps-3 pe-1 ps-lg-3 pe-lg-3 d-flex justify-content-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fs-5"></i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" onclick="editarFin('<?= $tec['id'] ?>')">Editar</a></li>
                                <li><a class="dropdown-item" onclick="deletarFin('<?= $tec['id'] ?>')">Remover</a></li>
                                <?php if($tec['destaque']){ ?>
                                    <li><a class="dropdown-item" onclick="removerDestaque('<?= $tec['id'] ?>')">Tirar destaque</a></li>
                                <?php  }else{ ?>
                                    <li><a class="dropdown-item" onclick="destacar('<?= $tec['id'] ?>')">Destacar</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </h2>
                    <div id="finalizacao-<?= $tec['id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class='mb-4 pb-2 border-bottom'>
                                <h6>Passo a Passo:</h6>
                                <?php foreach ($tec['passo_a_passo'] as $passo) { ?>
                                    <p class="small my-1"><?= $passo; ?></p>
                                <?php } ?>
                            </div>
                            
                            <div class='mb-2 pb-2'>
                                <h6>Observações:</h6>
                                <?php foreach ($tec['observacoes'] as $obs) { ?>
                                    <p class="small my-1"><?= $obs; ?></p>
                                <?php } ?>
                            </div>

                            <?php
                                if($tec['plataforma'] == 'instagram'){
                                    echo '<a class="mb-2 btn btn-sm btn-danger" href="' . $tec['video'] . '" target="_blank"><i class="fab fa-instagram"></i> Vídeo da finalização</a>';
                                }else if($tec['plataforma'] == 'youtube'){
                                    echo '<a class="mb-2 btn btn-sm btn-danger" href="' . $tec['video'] . '" target="_blank"><i class="fab fa-youtube"></i> Vídeo da finalização</a>';
                                }
                            ?>
                          
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- todas as tecnicas para exibir inicialmente caso não faça filtragem -->
    </div>
</section>



<script src="<?= $base_url ?>modulos-admin/contents/finalizacoes/js/app.js"></script>