<?php
    include_once 'config/config.php';
?>

<style>
    .container_imagem-noticia{
        width: 100%;
        height: 300px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container_imagem-noticia img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .titulo_noticia{
        line-height: 1.2;
        max-height: calc(1.2em * 2);
        min-height: calc(1.2em * 2);
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        text-overflow: ellipsis;
    }
    .descri_noticia{
        line-height: 1.2;
        max-height: calc(1.2em * 4);
        min-height: calc(1.2em * 4);
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 4;
        text-overflow: ellipsis;
    }
    .btn_noticia{
        width: 35%;
    }


    @media(min-width:1500px){
        .btn_noticia{
            width: 25%;
        }
    }
    @media(max-width:992px){
        .btn_noticia{
            width: 45%;
        }
    }
</style>


<!-- NOTÍCIAS -->
<section>
    <h6 class="small mb-5">Fique por dentro das principais <strong>notícias</strong> sobre o mundo dos esportes!</h6>

    <div class="row">
        <?php foreach ($noticias as $noticia) { ?>
            <div class="my-4 py-4 col-12 col-lg-6">
                <h4 class="titulo_noticia"><?= $noticia['titulo']; ?></h4>
                <p class="descri_noticia"><?= $noticia['descricao']; ?></p>
                <div class="mb-3 container_imagem-noticia">
                    <img src="<?= $noticia['imagem']; ?>">
                </div>
                <a href="<?= $noticia['url']; ?>" target="_blank" class="btn btn_noticia btn-dark">Acessar</a>
            </div>
        <?php } ?>
    </div>
</section>
<!-- NOTÍCIAS -->