<?php
    // verifica auth
    include_once 'helpers/verifica-auth.php';

    // verifica manutencao
    include_once 'helpers/verifica-manutencao.php';

    // Pegando parametro do filtro da url
    $getFiltro = isset($_GET['filtro']) ? $_GET['filtro'] : 'todos';
    $filtro;
    if($getFiltro == 'todos'){
        $filtro = 'Todos os Treinos';
    }else if($getFiltro == 'jj'){
        $filtro = 'Jiu Jitsu';
    }else if($getFiltro == 'nogi'){
        $filtro = 'No Gi';
    }else{
        $filtro = 'Todos os Treinos';
    }

    //busca dados do usuário e pega os dias de treinos, depois faz o filtro
    use Repositories\UserRepository;
    $user = UserRepository::getUser($_COOKIE['identificador']);
    $treinos = []; // RECEBE OS TREINOS DO USUÁRIO
    if($filtro == 'Todos os Treinos'){
        $treinos = $user->treinos;
    }else{
        foreach ($user->treinos as $treino) {
             if($treino->tipo_treino == $filtro){
                    $treinos[] = $treino;
             }
        }
    }
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
        <?php include_once 'modulos-admin/contents/treinos/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->

    
    <!-- MODAL AVISOS -->
     <?php include_once "modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADD TREINO -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-treino/index.php"; ?>
    <!-- MODAL ADD TREINO -->

    <!-- MODAL EDITAR TREINO -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-editar-treino/index.php"; ?>
    <!-- MODAL EDITAR TREINO -->

    <!-- MODAL ADD FINALIZAÇÃO TREINO -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-finalizacao-treino/index.php"; ?>
    <!-- MODAL ADD FINALIZAÇÃO TREINO -->

    <!-- MODAL EDITAR FINALIZAÇÃO TREINO -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-editar-finalizacao-treino/index.php"; ?>
    <!-- MODAL EDITAR FINALIZAÇÃO TREINO -->

    <!-- MODAL IMAGENS FULL TREINO -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-imagens-full/index.php"; ?>
    <!-- MODAL IMAGENS FULL TREINO -->

    <!-- MODAL EXCLUIR -->
    <?php include_once "modulos-admin/contents/treinos/modais/modal-excluir/index.php"; ?>
    <!-- MODAL EXCLUIR -->

    <!-- MODAL PERFIL -->
    <?php include_once "modulos-admin/modal-perfil/index.php"; ?>
    <!-- MODAL PERFIL -->

    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        
</body>
</html>