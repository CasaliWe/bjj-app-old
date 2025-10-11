<div class="modal fade" id="modal-add-obs" tabindex="-1" aria-labelledby="modal-add-obs" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar observação geral +</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>/modulos-admin/contents/observacoes-gerais/php/add-obs-geral.php" method="post">
          <div class="modal-body">
             <label for="add-obs-geral" class="w-100 my-4">
               Observação geral
               <input type="text" class="form-control" required maxlength="80" minlength="10" id="add-obs-geral" name="add-obs-geral">
             </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Adicionar</button>
          </div>
      </form>
    </div>
  </div>
</div>