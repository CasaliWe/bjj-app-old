<div class="modal fade" id="modal-edit-obs" tabindex="-1" aria-labelledby="modal-edit-obs" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar observação geral +</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>/modulos-admin/contents/observacoes-gerais/php/edit-obs-geral.php" method="post">
          <div class="modal-body">
             <label for="obs-geral-editar" class="w-100 my-4">
               Observação geral
               <input type="text" class="form-control" required maxlength="80" minlength="10" id="obs-geral-editar" name="obs-geral-editar">
             </label>

             <input type="hidden" required name="obs-edit-id" id="obs-edit-id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Adicionar</button>
          </div>
      </form>
    </div>
  </div>
</div>