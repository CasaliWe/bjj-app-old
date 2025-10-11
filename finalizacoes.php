<?php
    // verifica auth
    include_once 'helpers/verifica-auth.php';

    // verifica manutencao
    include_once 'helpers/verifica-manutencao.php';

    // pegando a ordem pela URL
    $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'recentes';
    $textoOrdem = '';
    if($ordem == 'recentes'){
        $textoOrdem = 'Mais Recentes';
    }else if($ordem == 'antigos'){
        $textoOrdem = 'Mais Antigos';
    }else if($ordem == 'maior-avaliacao'){
        $textoOrdem = 'Maior Avaliação';
    }else if($ordem == 'menor-avaliacao'){
        $textoOrdem = 'Menor Avaliação';
    }else{
        $textoOrdem = 'Mais Recentes';
    }


    //busca totas as imagens dos treinos
    use Repositories\TecnicaRepository;
    $tecnicas = TecnicaRepository::getAllTecnicas($ordem);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- HEADER -->
    <?php include_once 'modulos-admin/header/index.php'; ?>
    <!-- HEADER -->

</head>
<body>

    <!-- LOADING -->
    <?php include_once 'modulos-admin/loading/index.php'; ?>
    <!-- LOADING -->

    <!-- NAVEGAÇÃO -->
    <?php include_once 'modulos-admin/navegacao/index.php'; ?>
    <!-- NAVEGAÇÃO -->


    <!-- CONTENT -->
    <main id="content-pagina">
        <h5 id="titulo-content-pagina" class="fw-semibold"><?php echo $tituloContentPagina ?></h5>

        <!-- módulo content página -->
        <?php include_once 'modulos-admin/contents/finalizacoes/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->

    
    <!-- MODAL AVISOS -->
     <?php include_once "modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADD FINALIZAÇÃO TREINO -->
    <?php include_once "modulos-admin/contents/finalizacoes/modais/modal-finalizacao-treino/index.php"; ?>
    <!-- MODAL ADD FINALIZAÇÃO TREINO -->

    <!-- MODAL EXCLUIR -->
    <?php include_once "modulos-admin/contents/finalizacoes/modais/modal-excluir/index.php"; ?>
    <!-- MODAL EXCLUIR -->

    <!-- MODAL EDITAR FINALIZAÇÃO -->
    <?php include_once "modulos-admin/contents/finalizacoes/modais/modal-editar-finalizacao/index.php"; ?>
    <!-- MODAL EDITAR FINALIZAÇÃO -->

    <!-- MODAL DESTAQUES -->
    <?php include_once "modulos-admin/contents/finalizacoes/modais/modal-destaques/index.php"; ?>
    <!-- MODAL DESTAQUES -->

    <!-- MODAL PERFIL -->
    <?php include_once "modulos-admin/modal-perfil/index.php"; ?>
    <!-- MODAL PERFIL -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        
</body>
</html>