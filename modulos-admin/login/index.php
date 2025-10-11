<?php
    include_once __DIR__.'/../../config/config.php';
?>


<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/login/css/style.css">



<main id="container-login" style="background-image: url(<?php echo $base_url ?>assets/imagens/site-admin/banner-login.webp);">
    <form onsubmit="loading()" action="modulos-admin/login/php/logar.php" method="post" id="container-content" class="border-login">
        <img src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" id="logo-login">
        <p class="mb-4">JIU JITSU APP</p>
        <input type="text" autofocus required class="w-75 mb-2 form-control text-center" placeholder="Login" name="login">
        <input type="password" required class="w-75 mb-2 form-control text-center" placeholder="Senha" name="senha">
        <label class="w-75" for="permanecere-logado">
            <input type="checkbox" checked name="permanecer-logado">
            <span class="small">Permanecer logado</span>
        </label>
        <button type="submit" class="btn rounded btn-principal">ENTRAR</button>
        <a href="register.php" class="w-75 mt-2 btn btn-secondary">CRIAR CONTA</a>

        <a href="recuperar-senha.php" class="text-white mt-4">Esqueci minha senha</a>

        <?php if(isset($_SESSION['erro-login'])){ ?>
            <h6 class="mt-3 fw-semibold text-danger">Verifique os dados!</h6>
        <?php } ?>

        <?php if(isset($_SESSION['senha-atualizada'])){ ?>
            <h6 class="mt-3 fw-semibold text-success">Nova senha atualizada!</h6>
        <?php } ?>
    </form>
</main>



<?php 
    // removendo sessão
    unset($_SESSION['erro-login']);  
    unset($_SESSION['senha-atualizada']); 
    exit;
?>

    