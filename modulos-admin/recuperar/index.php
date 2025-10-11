<?php
    include_once './config/config.php';
?>


<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/login/css/style.css">



<main id="container-login" style="background-image: url(<?php echo $base_url ?>assets/imagens/site-admin/banner-login.webp);">
    <form onsubmit="loading()" action="modulos-admin/recuperar/php/buscar-email-recuperar.php" method="post" id="container-content" class="border-login">
        <img src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" id="logo-login">
        <p class="mb-4">JIU JITSU APP</p>

        <p class="w-75 text-center">Digite seu e-mail cadastrado para prosseguir</p>
        <input type="email" autofocus required class="w-75 mb-2 form-control text-center" placeholder="E-mail" name="email">
        <button type="submit" class="btn rounded btn-principal">VERIFICAR</button>
        <a href="index.php" class="w-75 mt-2 btn btn-secondary">VOLTAR</a>

        <?php if(isset($_SESSION['erro-email-recuperar'])){ ?>
            <h6 class="mt-3 fw-semibold text-danger">E-mail não cadastrado!</h6>
        <?php } ?>

        <?php if(isset($_SESSION['success-email-recuperar'])){ ?>
            <h6 class="mt-3 fw-semibold text-success">Verifique seu e-mail para continuar!</h6>
        <?php } ?>
    </form>
</main>



<?php 
    // removendo sessão
    unset($_SESSION['erro-email-recuperar']);  
    unset($_SESSION['success-email-recuperar']);  
    exit;
?>

    