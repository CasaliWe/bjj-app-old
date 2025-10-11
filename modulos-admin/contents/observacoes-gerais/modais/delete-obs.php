<!-- modal excluir -->
<div class="modal fade" id="modal-excluir-obs" tabindex="-1" aria-labelledby="modal-excluir-obs" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar Observação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/observacoes-gerais/php/delete-obs-geral.php" method="post">
          <div class="modal-body">

            <p>Deseja realmente deletar essa observação?</p>

            <!-- id obs -->
            <input type="hidden" name="id-obs-deletar" id="id-obs-deletar">      

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