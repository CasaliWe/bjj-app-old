<!-- modal excluir -->
<div class="modal fade" id="modal-excluir-user" tabindex="-1" aria-labelledby="modal-excluir-user" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" id="form-excluir-user" action="<?= $base_url; ?>modulos-admin/contents/admin/php/deletar-user.php" method="post">
          <div class="modal-body">

            <p>Deseja realmente deletar o usuário <span class="text-danger" id="nome-user-excluir"></span> ?</p>

            <!-- id user -->
            <input type="hidden" name="id_user_deletar" value="" id="id_user_deletar">      

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Excluír</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- modal excluir -->