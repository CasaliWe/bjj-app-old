<?php 
    include_once "config/config.php";
?>

<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/contents/admin/css/style.css">



<!-- ADMIN -->
<section>


    <!-- MODO EM MANUNTENÇÃO -->
    <div class="mb-5">
        <div>
            <h5 class="py-3 px-1 bg-dark text-white d-flex justify-content-between aligm-items-center">
                <span>EM MANUNTENÇÃO: <span class="<?= $statusManutencao->manutencao ? 'text-success' : 'text-danger' ?>" id="status-manutencao"><?= $statusManutencao->manutencao ? 'ATIVADO' : 'DESATIVADO' ?></span></span>

                <div class="align-self-center form-check form-switch">
                    <input onchange="emManutencao()" class="form-check-input" type="checkbox" role="switch" <?= $statusManutencao->manutencao ? 'checked' : '' ?> id="toggler-manutencao">
                </div>
            </h5>
        </div>
    </div>
    <!-- MODO EM MANUNTENÇÃO -->


    <!-- USUÁRIOS -->
    <div>
        <h6 class="fw-semibold mb-4">Todos os usuários do sistema: <span class="text-danger"><?= count($users); ?></span></h6>
        
        <?php foreach ($users as $u) { ?>
            <div class="border-bottom py-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="_container-img-perfil">
                        <img style="cursor: pointer;" onclick="abrirModalImgUser('<?= $u['foto'] ? $base_url . 'assets/imagens/site-admin/ids/'. $u['foto'] : $base_url . 'assets/imagens/site-admin/ids/'. 'img-id.jpg' ?>', '<?= $u['nome']; ?>')" src="<?php echo $base_url ?>assets/imagens/site-admin/ids/<?= $u->foto ? $u->foto : 'img-id.jpg' ?>">
                    </div>
                    <div>
                        <p class="small my-0 _infos-users"><strong>Nome:</strong> <?= $u['nome']; ?> <?= $u['sobrenome']; ?></p>
                        <p class="small my-0 _infos-users"><strong>Faixa:</strong> <?= strtoupper($u['faixa']) ?></p>
                        <p class="small my-0 _infos-users"><strong>Academia:</strong> <?= $u['academia']; ?></p>
                        <p class="small my-0 _infos-users"><strong>Cidade:</strong> <?= $u['cidade']; ?></p>
                    </div>
                </div>

                <button onclick="addInfosUserDeletar('<?= $u['identificador']; ?>', '<?= $u['nome']; ?>')" style="cursor: pointer;" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-excluir-user"><i class="fas fa-trash me-0 me-lg-2"></i> <span class="d-none d-lg-inline">Deletar</span></button>
            </div>
        <?php } ?>
    </div>
    <!-- USUÁRIOS -->
</section>
<!-- ADMIN -->




<script src="<?php echo $base_url ?>modulos-admin/contents/admin/js/app.js"></script>
