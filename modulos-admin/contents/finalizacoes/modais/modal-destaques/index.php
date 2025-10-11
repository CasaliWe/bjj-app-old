<div class="modal fade" id="destaques-finalizacoes" tabindex="-1" aria-labelledby="destaques-finalizacoes" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Finalizações destacadas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <?php
                    $finalizacoesDestaque = [];

                    foreach ($tecnicas as $fin) {
                        if($fin['destaque'] == true){
                            $finalizacoesDestaque[] = $fin;
                        }
                    }

                    if(count($finalizacoesDestaque) == 0){
                        echo '<p class="py-3 text-center small">Sem finalizações em destaque!</p>';
                    }

                    if(count($finalizacoesDestaque) != 0){
                        echo '<p class="mb-2 small">Total: <span class="text-danger fw-bold fs-6">'.count($finalizacoesDestaque).'</span></p>';
                    }
                ?>

                <?php foreach ($finalizacoesDestaque as $tec) { ?>
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
                                        <span class="fw-semibold"><?= $tec['nome'] ?></span>
                                    </div>
                                </div>
                            </button>

                            <div style="cursor: pointer;" class="dropdown ps-3 pe-1 ps-lg-3 pe-lg-3 d-flex justify-content-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fs-5"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" onclick="removerDestaque('<?= $tec['id'] ?>')">Remover destaque</a></li>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>



<script>
    // REMOVER DESTAQUE
    async function removerDestaque(id){
        const res = await fetch(`${base_url}/modulos-admin/contents/finalizacoes/php/remover-destaque-finalizacao.php?id=${id}`)
        if (res) {
            var url = new URL(window.location.href);
            url.searchParams.set('delete', 'true');
            window.location.href = url.toString();
        }
    }
</script>