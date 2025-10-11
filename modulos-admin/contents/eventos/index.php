<?php
    include_once 'config/config.php';

    include_once __DIR__ . '/../../../helpers/estados-eventos.php';
?>

<style>
    ._container_imagem_evento{
        width: 100%;
        height: auto;
    }
    ._container_imagem_evento img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    ._titulo_evento{
        line-height: 1.2;
        max-height: calc(1.2em * 2);
        min-height: calc(1.2em * 2);
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        text-overflow: ellipsis;
    }

    ._btn_evento{
        width: 35%;
    }
</style>


<!-- EVENTOS -->
<section>
<h6 class="small mb-5">Fique por dentro dos <strong>eventos</strong> na sua região!</h6>

    <div class="row mb-5">
        <div class="col-12 col-lg-3">
            <p class="small mb-0">Filtrar por estado:</p>
            <select onchange="redirecionar()" id="select-estado-eventos" class="form-select">
                <option <?= isset($_GET['local']) ? '' : 'selected' ?> value="todos">Todos</option>    
                <?php foreach ($locaisEventos as $local) { ?>
                    <option <?= isset($_GET['local']) && $_GET['local'] == $local['estado'] ? 'selected' : '' ?> value="<?= $local['estado']; ?>"><?= $local['estado']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row">
        <?php foreach ($eventos as $evento) { ?>
            <div class="mb-5 py-2 py-lg-0 px-3 px-lg-2 col-12 col-lg-4">
                <h5 class="text-secondary _titulo_evento"><?= $evento['titulo']; ?></h5>
                <p class="my-0">Data: <?= $evento['data']; ?></p>
                <div class="_container_imagem_evento">
                    <img src="<?= $evento['imagem']; ?>">
                </div>
                <a href="<?= $evento['link']; ?>" target="_blank" class="_btn_evento mt-4 btn btn-dark">Acessar</a>
            </div>
        <?php } ?>


        <?php if (count($eventos) == 0) { ?>
            <div class="col-12">
                <p class="text-secondary border rounded py-3 text-center">Nenhum evento encontrado para esse estado!</p>
            </div>
        <?php } ?>
    </div>

</section>
<!-- EVENTOS -->



<script>
    function redirecionar(){
        var estado = document.getElementById("select-estado-eventos").value
        var url = new URL(window.location.href);
        url.searchParams.set('local', estado);
        window.location.href = url.toString();
    }
</script>





