<?php
    include_once 'config/config.php';
?>

<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/contents/galeria/css/style.css">


<!-- GALERIA -->
<section>
    <h6 class="small mb-5">Veja todas as imagens dos seus <strong>treinos</strong> com data e de forma simplificada!</h6>

    <?php if(count($imagens) == 0){
        echo "<h6 class='p-3 mt-5 text-center border rounded text-secondary'>Nenhuma imagem cadastrada!</h6>";
    }?>

    <div class="row">
        <?php foreach ($imagens as $img) { ?>
            <?php foreach ($img['img_treino'] as $imagem) { ?>
                <div class="col-12 col-lg-6 p-3">
                    <p class="mb-1 small"><?= $img['created_at']; ?></p>
                    <div class="_container-imagem-galeria">
                        <img onclick="abrirModalImgGaleriaTreino('<?= $base_url; ?>assets/imagens/site-admin/treinos/<?= $imagem; ?>')" src="<?= $base_url; ?>assets/imagens/site-admin/treinos/<?= $imagem; ?>">
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</section>
<!-- GALERIA -->



<script>
    function abrirModalImgGaleriaTreino(img) {
        Swal.fire({
            imageUrl: img,
            imageAlt: 'Imagem do treino',
            showCloseButton: true,
            showConfirmButton: false,
        });
    }
</script>