<?php
    // verificando qual página
    $urlAtual = $_SERVER['REQUEST_URI'];

    // titulos content páginas
    $tituloContentPagina = "";

    // link ativo página
    $activeDashboard = false;
    $activeTreinos = false;
    $activeFinalizacao = false;
    $activeObsTreino = false;
    $activeGaleria = false;
    $activeMetricas = false;
    $activeNoticias = false;
    $activeVideos = false;
    $activeEventos = false;
    $activeAdmin = false;
    $activeObsGerais = false;
    $activeCompeticoes = false;

    // Devolve o nome da página atual
    if(strpos($urlAtual, 'dashboard') !== false){
        $tituloContentPagina = "Dados do perfil";
        $activeDashboard = true;
    }else if(strpos($urlAtual, 'treinos') !== false){
        $tituloContentPagina = "Todos os treinos";
        $activeTreinos = true;
    }else if(strpos($urlAtual, 'finalizacoes') !== false){
        $tituloContentPagina = "Todas as Finalizações";
        $activeFinalizacao = true;
    }else if(strpos($urlAtual, 'observacoes') !== false){
        $tituloContentPagina = "Observações dos treinos";
        $activeObsTreino = true;
    }else if(strpos($urlAtual, 'galeria') !== false){
        $tituloContentPagina = "Imagens dos treinos";
        $activeGaleria = true;
    }else if(strpos($urlAtual, 'metricas') !== false){
        $tituloContentPagina = "Tudo sobre suas métricas";
        $activeMetricas = true;
    }else if(strpos($urlAtual, 'noticias') !== false){
        $tituloContentPagina = "Notícias sobre o mundo dos esportes";
        $activeNoticias = true;
    }else if(strpos($urlAtual, 'videos') !== false){
        $tituloContentPagina = "Vídeos sobre o mundo dos esportes";
        $activeVideos = true;
    }else if(strpos($urlAtual, 'eventos') !== false){
        $tituloContentPagina = "Eventos de Grappling";  
        $activeEventos = true;
    }else if(strpos($urlAtual, 'admin') !== false){
        $tituloContentPagina = "Administração do sistema";
        $activeAdmin = true;
    }else if(strpos($urlAtual, 'anotacoes') !== false){
        $tituloContentPagina = "Observações Gerais";
        $activeObsGerais = true;
    }else if(strpos($urlAtual, 'competicoes') !== false){
        $tituloContentPagina = "Minhas Competições";
        $activeCompeticoes = true;
    }
?>




<nav class="d-flex flex-column w-100">
    <a href="dashboard.php" class="link-nav-desktop <?= $activeDashboard ? 'active-link-desktop' : ''; ?>">Perfil</a>
    <a href="treinos.php" class="link-nav-desktop <?= $activeTreinos ? 'active-link-desktop' : ''; ?>">Meus Treinos</a>
    <a href="competicoes.php" class="link-nav-desktop <?= $activeCompeticoes ? 'active-link-desktop' : ''; ?>">Minhas Competições</a>
    <a href="finalizacoes.php" class="link-nav-desktop <?= $activeFinalizacao ? 'active-link-desktop' : ''; ?>">Minhas Finalizações</a>
    <a href="observacoes.php" class="link-nav-desktop <?= $activeObsTreino ? 'active-link-desktop' : ''; ?>">Observações Treinos</a>
    <a href="anotacoes.php" class="link-nav-desktop <?= $activeObsGerais ? 'active-link-desktop' : ''; ?>">Observações Gerais</a>
    <a href="galeria.php" class="link-nav-desktop <?= $activeGaleria ? 'active-link-desktop' : ''; ?>">Galeria de Fotos</a>
    <a href="metricas.php" class="link-nav-desktop <?= $activeMetricas ? 'active-link-desktop' : ''; ?>">Minhas Métricas</a>
    <a href="eventos.php" class="link-nav-desktop <?= $activeEventos ? 'active-link-desktop' : ''; ?>">Eventos de Grappling</a>
    <a href="videos.php" class="link-nav-desktop <?= $activeVideos ? 'active-link-desktop' : ''; ?>">Vídeos de Grappling</a>
    <a href="noticias.php" class="link-nav-desktop <?= $activeNoticias ? 'active-link-desktop' : ''; ?>">Notícias</a>
    <?php if($user->login == $_ENV['USER_ADMIN']){ ?>
        <a href="admin.php" class="link-nav-desktop <?= $activeAdmin ? 'active-link-desktop' : ''; ?>">Admin do sistema</a>
    <?php } ?>
    <a class="link-nav-desktop"><?php include "modulos-admin/btn-logout/index.php"; ?></a>
</nav>