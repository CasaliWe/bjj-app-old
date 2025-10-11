<?php
  include_once __DIR__ . '/../../helpers/busca-dados-exibir-perfil.php';
?>


<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/modal-perfil/css/style.css">


<div class="modal fade" id="modal-perfil" tabindex="-1" aria-labelledby="modal-perfil" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body">

          <div class="my-3 row">
              <div class="d-flex justify-content-center align-items-center col-4">
                <div class="_container-perfil-img">
                    <?php if($usuario->foto){ ?>
                        <img src="<?= $base_url ?>/assets/imagens/site-admin/ids/<?= $usuario->foto ?>" alt="Foto de perfil">
                    <?php  }else{ ?>
                        <img src="<?= $base_url ?>/assets/imagens/site-admin/ids/img-id.jpg" alt="Foto de perfil">
                    <?php } ?>
                </div>
              </div>

              <div class="border-start ps-3 col-8">
                <h5 class="fw-semibold"><?= $usuario->nome ?> <?= $usuario->sobrenome ?></h5>
                <p class="_bio-user"><?= $usuario->bio ?></p>

                <?php if($usuario->cidade){ ?>
                    <p class="fw-semibold _infos-user my-0">CIDADE: <span class="text-danger"><?= $usuario->cidade ?></span></p>
                <?php } ?>
                <p class="fw-semibold _infos-user my-0">FAIXA: <span class="text-danger"><?= $usuario->faixa ?></span></p>
                <p class="fw-semibold _infos-user my-0">ACADEMIA: <span class="text-danger"><?= $usuario->academia ?></span></p>
              </div>
          </div>

          <div class="pt-4 mb-4 border-top">
            <h6 class="fw-semibold">HISTÓRICO DE TREINOS:</h6>
            <p class="small my-1">- Total de treinos de JIU JITSU: <span class="fw-bold text-danger"><?= count($jj); ?></span></p>
            <p class="small my-1">- Total de treinos de NO GI: <span class="fw-bold text-danger"><?= count($nogi); ?></span></p>
          </div>

          <div class="pt-4 mb-4 border-top">
            <h6 class="fw-semibold">HISTÓRICO DE COMPETIÇÕES JIU JITSU:</h6>
            <p class="small my-1">- Ouro: <span class="fw-bold text-warning"><?= $totalOuroJJ ?></span></p>
            <p class="small my-1">- Prata: <span class="fw-bold text-secondary"><?= $totalPrataJJ ?></span></p>
            <p class="small my-1">- Bronze: <span class="fw-bold" style="color: orange;"><?= $totalBronzeJJ ?></span></p>
            <p class="small my-1">- Total de competições: <span class="fw-bold text-danger"><?= count($totalJJ); ?></span></p>
            <p class="small my-1">- Total Lutas: <span class="fw-bold text-danger"><?= $totalLutasJJ ?></span></p>
            <p class="small my-1">- Total Vitórias: <span class="fw-bold text-danger"><?= $totalVitoriasJJ ?></span></p>
            <p class="small my-1">- Total Derrotas: <span class="fw-bold text-danger"><?= $totalDerrotasJJ ?></span></p>
            <p class="small my-1">- Total Finalizações: <span class="fw-bold text-danger"><?= $totalFinalizacoesJJ ?></span></p>
          </div>

          <div class="pt-4 mb-4 border-top">
            <h6 class="fw-semibold">HISTÓRICO DE COMPETIÇÕES NO GI:</h6>
            <p class="small my-1">- Ouro: <span class="fw-bold text-warning"><?= $totalOuroNOGI ?></span></p>
            <p class="small my-1">- Prata: <span class="fw-bold text-secondary"><?= $totalPrataNOGI ?></span></p>
            <p class="small my-1">- Bronze: <span class="fw-bold" style="color: orange;"><?= $totalBronzeNOGI ?></span></p>
            <p class="small my-1">- Total de competições: <span class="fw-bold text-danger"><?= count($totalNOGI); ?></span></p>
            <p class="small my-1">- Total Lutas: <span class="fw-bold text-danger"><?= $totalLutasNOGI ?></span></p>
            <p class="small my-1">- Total Vitórias: <span class="fw-bold text-danger"><?= $totalVitoriasNOGI ?></span></p>
            <p class="small my-1">- Total Derrotas: <span class="fw-bold text-danger"><?= $totalDerrotasNOGI ?></span></p>
            <p class="small my-1">- Total Finalizações: <span class="fw-bold text-danger"><?= $totalFinalizacoesNOGI ?></span></p>
          </div>
         
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>