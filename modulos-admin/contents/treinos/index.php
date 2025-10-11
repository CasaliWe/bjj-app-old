<?php
    include_once 'config/config.php';
?>

<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/contents/treinos/css/style.css">

<!-- TREINOS -->
<section>
    <h6 class="small mb-5">Aqui você pode <strong>Adicionar</strong> os treinos do seu dia a dia!</h6>

    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-treino">Adicionar novo treino +</button>
        
        <div class="dropdown mt-3 mt-lg-0">
            <a class="small text-dark fw-semibold dropdown-toggle" href="#" role="button" id="dropdownOrdenarPor" data-bs-toggle="dropdown" aria-expanded="false">
                Filtrar por: <span class="text-success"> <?= $filtro; ?> <?= $filtro != 'Todos os Treinos' ? "<span class='text-danger'>(". count($treinos) ." treinos)</span>" : '' ?></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownOrdenarPor">
                <li><a class="dropdown-item" href="treinos.php">Todos os Treinos</a></li>
                <li><a class="dropdown-item" href="treinos.php?filtro=jj">Jiu Jitsu</a></li>
                <li><a class="dropdown-item" href="treinos.php?filtro=nogi">No Gi</a></li>
            </ul>
        </div>
    </div>

    <?php if(count($treinos) == 0){
        echo "<h6 class='p-3 mt-5 text-center border rounded text-secondary'>Nenhum treino cadastrado!</h6>";
    }?>

    <!-- dias -->
    <?php foreach ($treinos as $key => $treino) { ?>
        
        <?php
            // montando a data
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            $data_completa = strftime('%d de %B de %Y', strtotime($treino['data_treino'])); 
            $data_reduzida = date('d-m-Y', strtotime($treino['data_treino']));

            // pegando o nome das imagens do json
            $imgs_treino = $treino['img_treino'];

            // pegando as observações do treino
            $obsJson = $treino['observacoes_treino'];
            $observacoes = explode(';', $obsJson[0]);
        ?>

        <div class="my-4 item-acordion accordion">
            <div class="accordion-item">
                <h2 class="accordion-header d-flex justify-content-between align-items-center">
                    <button id="btn-treino-<?php echo $treino['treino_id'] ?>" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#treino-<?php echo $treino['treino_id'] ?>" aria-expanded="false" aria-controls="treino-<?php echo $treino['treino_id'] ?>">
                        <div class="row w-100 px-2">
                            <div class="col-6 col-lg-5 d-flex flex-column text-start">
                                <span class="d-none d-lg-block mb-1 small fw-semibold"><?= $treino['tipo_treino']; ?></span>
                                <span class="d-none d-lg-block small"> <span class="text-primary fw-semibold"><?= $treino['aula_treino']; ?>ª</span> aula </span>

                                <!-- mobile -->
                                <span style="font-size: 10px;" class="d-block d-lg-none mb-1 fw-semibold"><?= $treino['tipo_treino']; ?></span>
                                <span style="font-size: 10px;" class="d-block d-lg-none"> <span class="text-primary fw-semibold"><?= $treino['aula_treino']; ?>ª</span> aula </span>
                                <!-- mobile -->
                            </div>

                            <div class="col-6 col-lg-4 d-flex flex-column text-center">
                                <span class="mb-1 small d-none d-lg-block"><?= $treino['dia_treino']; ?> - <?= $treino['hora_treino']; ?> hrs</span>
                                <span class="small d-none d-lg-block"><?= $data_completa; ?></span>

                                <!-- mobile -->
                                <span style="font-size: 10px;" class="mb-1 d-block d-lg-none"><?= substr($treino['dia_treino'], 0, 3); ?> - <?= $treino['hora_treino']; ?> hrs</span>
                                <span style="font-size: 10px;" class="d-block d-lg-none"><?= $data_reduzida; ?></span>
                                <!-- mobile -->
                            </div>
                        </div>
                    </button>

                    <div style="cursor: pointer;" class="dropdown px-2 me-2 me-lg-4" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a onclick="editarTreino('<?= $treino['treino_id']; ?>')" class="dropdown-item">Editar</a></li>
                            <li><a class="dropdown-item" onclick="deletarTreino('<?= $treino['treino_id'] ?>')">Deletar</a></li>
                        </ul>
                    </div>
                </h2>
                <div id="treino-<?php echo $treino['treino_id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
        
                        <div class="row my-3">
                            <div id="slider" class="mb-4 col-12 col-lg-6 col-xxl-5">

                                <?php if(count($imgs_treino) == 1){ ?>
                                    <div onclick="abrirModalPreviaImgsTreino('<?= $imgs_treino[0]; ?>')" style="cursor: pointer;" class="swiper-slide container-img-treino"> <img src="<?= $base_url; ?>assets/imagens/site-admin/treinos/<?= $imgs_treino[0]; ?>"> </div>
                                <?php }else{ ?>
                                    <!-- Swiper -->
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            <?php foreach ($imgs_treino as $img) { ?>     
                                                <div onclick="abrirModalPreviaImgsTreino('<?= $img; ?>')" style="cursor: pointer;" class="swiper-slide container-img-treino"> <img src="<?= $base_url; ?>assets/imagens/site-admin/treinos/<?= $img ?>"> </div>
                                            <?php } ?>
                                            <!-- Slides -->
                                        </div>
                                        <!-- paginação -->
                                        <div class="swiper-pagination"></div>
                                    </div>
                                    <!-- Swiper -->
                                <?php } ?>

                            </div>

                            <div class="mb-4 col-12 col-lg-6 col-xxl-3 px-3">
                                <h6 class="fw-semibold mb-3">Observação do treino:</h6>

                                <div class="small">
                                    <?php foreach ($observacoes as $obs) { ?>
                                        <p class="mb-1"><?= $obs; ?></p>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- container finalizações -->
                            <div class="_container-finalizacao-treino pt-4 pt-xxl-0 col-12 col-lg-12 col-xxl-4 px-3 px-xxl-4">
                                
                                <div class="mb-3 d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                    <button type="button" onclick="adicionarIdModalAddFinalizacao('<?= $treino['treino_id']; ?>')" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddFinalizacao">Adicionar finalizações +</button>
                                </div>

                                <!-- finalizações -->
                                <?php 
                                    $posicoes = [];
                                    $finalizacaoes = [];

                                    if (isset($treino['categorias'])) {
                                        foreach ($treino['categorias'] as $categoria) {
                                            if (isset($categoria['posicoes'])) {
                                                foreach ($categoria['posicoes'] as $posicao) {
                                                    $posicoes[] = $posicao;
                                                }
                                            }
                                        }
                                    }
                                
                                    foreach ($posicoes as $posicao) {
                                        if (isset($posicao->finalizacoes)) {
                                            foreach ($posicao->finalizacoes as $finalizacao) { ?>
                                                <?php $finalizacaoes[] = $finalizacao; ?>

                                                <div class="mb-3 item-acordion accordion">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header d-flex px-2 align-items-center justify-content-between">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#finalizacao-<?php echo $finalizacao['id'] ?>" aria-expanded="false" aria-controls="finalizacao-<?php echo $finalizacao['id'] ?>">
                                                                <div class="d-flex flex-column">
                                                                    <div class="mb-1">
                                                                        <?php for ($i = 0; $i < 5; $i++) {
                                                                            if ($i < $finalizacao['estrela']) {
                                                                                echo '<i style="font-size: .5em;" class="text-danger fas fa-star"></i>';
                                                                            } else {
                                                                                echo '<i style="font-size: .5em;" class="text-dark fas fa-star"></i>';
                                                                            }
                                                                        } ?>
                                                                    </div>
                                                                    <?= $finalizacao['nome']; ?>
                                                                </div>
                                                            </button>

                                                            <div style="cursor: pointer;" class="dropdown ps-3 pe-1 ps-lg-3 pe-lg-3 d-flex justify-content-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v fs-5"></i>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <li><a class="dropdown-item" onclick="editarFinalizacao('<?= $finalizacao['id'] ?>')">Editar</a></li>
                                                                    <li><a class="dropdown-item" onclick="deletarFinalizacao('<?= $finalizacao['id'] ?>')">Deletar</a></li>
                                                                </ul>
                                                            </div>
                                                        </h2>
                                                        <div id="finalizacao-<?php echo $finalizacao['id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                
                                                                <div class="border-bottom pb-2 d-flex flex-column mb-3">
                                                                    <h6 class="mb-2">Passo a passo:</h6>

                                                                    <?php 
                                                                       $passos = $finalizacao['passo_a_passo'];

                                                                       foreach ($passos as $passo) { ?>
                                                                            <span class="mb-1 small"><?= $passo; ?></span>
                                                                       <?php } 
                                                                    ?>
                                                                </div>

                                                                <div class="d-flex flex-column">
                                                                    <h6 class="mb-2">Observações:</h6>

                                                                    <?php 
                                                                       $obs_finalizacao =$finalizacao['observacoes'];

                                                                       foreach ($obs_finalizacao as $obs) { ?>
                                                                            <span class="mb-1 small"><?= $obs; ?></span>
                                                                       <?php } 
                                                                    ?>
                                                                </div>

                                                                <?php if($finalizacao['plataforma'] == 'youtube') { ?>
                                                                    <a class="mt-4 mb-2 btn btn-sm btn-danger" href="<?= $finalizacao['video'] ?>" target="_blank"><i class="fab fa-youtube"></i> Vídeo da finalização</a>
                                                                <?php }else if($finalizacao['plataforma'] == 'instagram'){ ?>
                                                                    <a class="mt-4 mb-2 btn btn-sm btn-danger" href="<?= $finalizacao['video'] ?>" target="_blank"><i class="fab fa-instagram"></i> Vídeo da finalização</a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                            <?php } 
                                        }
                                    }

                                    // verifica se não tem finalizações para exibir
                                    if(count($posicoes) == 0) {
                                        echo '<p class="small">Nenhuma finalização cadastrada!</p>';
                                    }else{
                                        if(count($finalizacaoes) == 0) {
                                            echo '<p class="small">Nenhuma finalização cadastrada!</p>';
                                        }
                                    }
                                ?>
                                <!-- finalizações -->

                            </div>
                            <!-- container finalizações -->

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- dias -->

    </div>
</section>
<!-- TREINOS -->



<!-- FAZ O SCROLL ATÉ O TREINO E ABRE O ACCORDEON -->
<?php if(isset($_GET['scroll'])){ ?>
    <script>
        var element = document.getElementById("<?php echo $_GET['scroll'] ?>");
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }

        document.getElementById("<?php echo str_replace('btn-', '', $_GET['scroll']); ?>").classList.add('show');
    </script>
<?php } ?>                              
<!-- FAZ O SCROLL ATÉ O TREINO E ABRE O ACCORDEON -->


<script src="<?php echo $base_url ?>modulos-admin/contents/treinos/js/app.js"></script>








