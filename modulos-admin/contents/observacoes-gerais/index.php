<?php
    include_once 'config/config.php';
?>


<!-- OBSERVAÇÕES GERAIS -->
<section>
    <h6 class="small mb-5">Adicione, Atualize ou Remova <strong>observações gerais</strong> sobre treinos ou finalizações!</h6>

    <button style="cursor: pointer;" class="mb-5 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-obs">Adicionar observação +</button>

    <div>
        <?php foreach ($observacoesGerais as $obs) { ?>
            <div class="border-bottom py-4 d-flex justify-content-between align-items-center">
                <h6 class="w-75 my-0 fw-semibold small">* <?= $obs['observacao']; ?></h6>

                <div>
                    <button type="button" onclick="abrirModalObsEdit('<?= $obs['observacao']; ?>', '<?= $obs['id']; ?>')" style="border: none; background-color: transparent;" data-bs-toggle="modal" data-bs-target="#modal-edit-obs"> <i class="me-2 fs-5 fas fa-edit"></i> </button> 
                    <button type="button" onclick="abrirModalObsDelete('<?= $obs['id']; ?>')" style="border: none; background-color: transparent;" data-bs-toggle="modal" data-bs-target="#modal-excluir-obs"> <i class="me-2 fs-5 fas fa-trash"></i> </button> 
                </div>
            </div>
        <?php } ?>

        <?php if (count($observacoesGerais) == 0) { ?>
            <h6 class='p-3 text-center border rounded text-secondary'>Nenhuma observação geral cadastrada!</h6>
        <?php } ?>
    </div>
</section>
<!-- OBSERVAÇÕES GERAIS -->




<script>
    function abrirModalObsEdit(obs, id) {
        document.getElementById('obs-geral-editar').value = obs;
        document.getElementById('obs-edit-id').value = id;
    }


    function abrirModalObsDelete(id) {
        document.getElementById('id-obs-deletar').value = id;
    }
</script>