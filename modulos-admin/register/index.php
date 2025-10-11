<?php
    include_once __DIR__.'/../../config/config.php';
?>


<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/register/css/style.css">



<main id="container-register" class="py-5" style="background-image: url(<?php echo $base_url ?>assets/imagens/site-admin/banner-login.webp);">
    <form onsubmit="loading()" action="modulos-admin/register/php/registrar.php" method="post" id="container-content" class="border-login">
        <img src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" id="logo-register">
        <p class="mb-4">CRIAR CONTA</p>
        
        <div class="w-100 d-flex justify-content-center align-items-center flex-column flex-lg-row flex-xxl-column">
            <input type="text" autofocus required class="small me-2 w-75 mb-3 form-control text-center text-capitalize" placeholder="Nome*" name="nome">
            <input type="text" autofocus required class="small w-75 mb-3 form-control text-center text-capitalize" placeholder="Sobrenome*" name="sobrenome">
        </div>
        <div class="w-100 d-flex justify-content-center align-items-center flex-column flex-lg-row flex-xxl-column">
            <input type="email" autofocus required class="small me-2 w-75 mb-3 form-control text-center" placeholder="E-mail*" name="email">
            <input type="text" autofocus required class="small w-75 mb-3 form-control text-center" placeholder="Login*" name="login">
        </div>
        <div class="w-100 d-flex justify-content-center align-items-center flex-column flex-lg-row flex-xxl-column">
            <input type="password" required class="small me-2 w-75 mb-3 form-control text-center" placeholder="Senha*" name="senha">
            <input type="password" required class="small w-75 mb-3 form-control text-center" placeholder="Confirme*" name="confirme">
        </div>

        <button type="submit" class="btn btn-principal rounded w-75">CRIAR</button>

        <a href="index.php" class="w-75 mt-2 btn btn-secondary">VOLTAR</a>

        <?php if(isset($_SESSION['erro-register'])){ ?>
            <h6 class="mt-3 fw-semibold text-danger"><?= $_SESSION['erro-register']; ?></h6>
        <?php } ?>
    </form>
</main>

    
<?php
    unset($_SESSION['erro-register']);
?>