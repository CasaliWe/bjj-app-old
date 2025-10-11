<?php 
    include_once "config/config.php";
?>

<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/contents/dashboard/css/style.css">



<!-- DASHBOARD -->
<section>
    <h6 class="small mb-3">Aqui você pode <strong>atualizar</strong> todos os dados da sua conta!</h6>

    <button type="button" class="mb-5 btn-sm btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-perfil"><i class="fas fa-mouse-pointer me-2"></i> Visualizar meu perfil</button> 

    <form action="modulos-admin/contents/dashboard/php/atualizar-dados-user.php" class="row pb-4 border-bottom" method="post">
      <input type="hidden" name="identificador" value="<?= $_COOKIE['identificador']; ?>">  
     
      <div class='mb-3 col-12 col-lg-6'>
          <label for='nome' class="small">Nome*</label>
          <input type='type' id='nome' value="<?= $user->nome; ?>" name='nome' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='sobrenome' class="small">Sobrenome*</label>
          <input type='type' id='sobrenome' value="<?= $user->sobrenome; ?>" name='sobrenome' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='email' class="small">E-mail*</label>
          <input type='type' id='email' value="<?= $user->email; ?>" name='email' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='faixa' class="small">Faixa*</label>
          <select class="form-select" name="faixa" required>
            <option value="">-- Selecione uma faixa --</option>
            <option value="branca" <?= $user->faixa == 'branca' ? 'selected' : '' ?>>Branca</option>
            <option value="azul" <?= $user->faixa == 'azul' ? 'selected' : '' ?>>Azul</option>
            <option value="roxa" <?= $user->faixa == 'roxa' ? 'selected' : '' ?>>Roxa</option>
            <option value="marrom" <?= $user->faixa == 'marrom' ? 'selected' : '' ?>>Marrom</option>
            <option value="preta" <?= $user->faixa == 'preta' ? 'selected' : '' ?>>Preta</option>
          </select>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='academia' class="small">Academia*</label>
          <input type='text' maxlength="20" id='academia' value="<?= $user->academia; ?>" name='academia' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='cidade' class="small">Cidade*</label>
          <input type='text' maxlength="20" id='cidade' value="<?= $user->cidade; ?>" name='cidade' class='form-control' required>
        </div>

        <div class='mb-3 col-12'>
          <label for='bio' class="small">Bio*</label>
          <textarea rows="3" maxlength="100" id='bio' name='bio' class='form-control' required><?= $user->bio; ?></textarea>
        </div>

        

        <div class="col-12 col-lg-3 mb-4 text-center text-lg-start">
            <button type="submit" class="mt-3 py-2 px-5 py-lg-1 w-100 btn btn-success btn-sm">ATUALIZAR</button>
        </div>
    </form>

    

    <form action="modulos-admin/contents/dashboard/php/atualizar-imagem-user.php" class="mt-5 row pb-4 border-bottom" enctype="multipart/form-data" method="post">
      <input type="hidden" name="identificador" value="<?= $_COOKIE['identificador']; ?>">  
     
       <div class='mb-3 col-12 col-lg-10'>
          <label for='imagem-perfil' class="small">Foto de perfil*</label>
          <input type='file' id='imagem-perfil' name='imagem-perfil' class='form-control' required>
        </div>

        <div class="my-3 my-lg-0 col-12 col-lg-2 d-flex align-items-center justify-content-center justify-content-lg-end">
          <div class="container-preview-imagem-perfil">
            <img src="<?= $base_url; ?>assets/imagens/site-admin/ids/<?= $img ? $img : 'img-id.jpg' ?>" id="preview-imagem-perfil">
          </div>
        </div>

        <div class="col-12 col-lg-3 mb-4 text-center text-lg-start">
            <button type="submit" class="mt-3 py-2 px-5 py-lg-1 w-100 btn btn-success btn-sm">ATUALIZAR</button>
        </div>
    </form>


    <form action="modulos-admin/contents/dashboard/php/atualizar-senha-user.php" class="mt-5 row pb-3" method="post">
      <input type="hidden" name="identificador" value="<?= $_COOKIE['identificador']; ?>">  
     
        <div class='mb-3 col-12 col-lg-12'>
          <label for='senha' class="small">Senha antiga*</label>
          <input type='password' id='senha' name='senha' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='nova-senha' class="small">Nova senha*</label>
          <input type='password' id='nova-senha' name='nova-senha' class='form-control' required>
        </div>

        <div class='mb-3 col-12 col-lg-6'>
          <label for='confirm-senha' class="small">Confirme senha*</label>
          <input type='password' id='confirm-senha' name='confirm-senha' class='form-control' required>
        </div>

        <div class="col-12 col-lg-3 mb-4 text-center text-lg-start">
            <button type="submit" class="mt-3 py-2 py-lg-1 px-5 w-100 btn btn-success btn-sm">ATUALIZAR</button>
        </div>
    </form>
</section>
<!-- DASHBOARD -->




<script src="<?php echo $base_url ?>modulos-admin/contents/dashboard/js/app.js"></script>
