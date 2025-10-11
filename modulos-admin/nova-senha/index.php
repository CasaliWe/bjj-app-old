<?php
    include_once __DIR__.'/../../config/config.php';
?>


<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/login/css/style.css">



<main id="container-login" style="background-image: url(<?php echo $base_url ?>assets/imagens/site-admin/banner-login.webp);">
    <form onsubmit="loading()" action="modulos-admin/nova-senha/php/resetar-senha.php" method="post" id="container-content" class="border-login">
        <img src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" id="logo-login">
        <p class="mb-4">JIU JITSU APP</p>

        <p class="w-75 text-center">Digite sua nova senha!</p>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="password" minlength="8" autofocus required class="w-75 mb-2 form-control text-center" placeholder="Nova senha*" name="nova">
        <input type="password" minlength="8" required class="w-75 mb-2 form-control text-center" placeholder="Repita*" name="confirme">
        <button type="submit" class="btn rounded btn-principal">ATUALIZAR</button>
        <a href="index.php" class="w-75 mt-2 btn btn-secondary">VOLTAR</a>

        <?php if(isset($_GET['error'])){ ?>
            <h6 class="mt-3 fw-semibold text-danger">As senhas precisam ser iguais!</h6>
        <?php } ?>
    </form>
</main>

    