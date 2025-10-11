<?php
    include_once 'config/config.php';
?>


<style>
    ._container_video{
        height: 250px;
        width: 100%;
    }

    ._titulo_video{
        position: relative;
        line-height: 1.2;
        max-height: calc(1.2em * 2);
        min-height: calc(1.2em * 2);
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        text-overflow: ellipsis;
    }

    @media(min-width: 1500px){
        ._container_video{
            height: 310px;
        }
    }
    @media(max-width: 992px){
        ._container_video{
            height: 220px;
        }
    }
</style>

<!-- VÍDEOS -->
<section>
    <h6 class="small mb-5">Veja alguns vídeos relevantes pelo mundo dos <strong>esportes</strong> de <strong>combate</strong>!</h6>

    <a href="videos.php" class="mb-5 btn btn-success btn-sm">Atualizar vídeos</a>

    <div class="row">
        <?php foreach ($videos as $video) { ?>
            <div class="mb-5 col-12 col-lg-6">
            <h6 class="_titulo_video text-secondary fw-bold mb-2 tex-uppercase"><?= strtoupper($video['titulo']); ?></h6>
                <iframe class="_container_video" src="<?= $video['iframe']; ?>" allowfullscreen frameborder="0"></iframe>
            </div>
        <?php } ?>
    </div>
</section>
<!-- VÍDEOS -->