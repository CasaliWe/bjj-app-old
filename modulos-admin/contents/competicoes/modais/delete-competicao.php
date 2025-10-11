<!-- modal excluir -->
<div class="modal fade" id="modal-deletar-competicao" tabindex="-1" aria-labelledby="modal-deletar-competicao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar Competição</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/competicoes/php/delete-competicao.php" method="post">
          <div class="modal-body">

            <p>Deseja realmente deletar essa competição?</p>

            <!-- id competição -->
            <input type="hidden" name="id-deletar-competicao" id="id-deletar-competicao">      

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