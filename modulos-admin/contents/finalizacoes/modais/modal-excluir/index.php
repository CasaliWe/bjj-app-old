<!-- modal excluir -->
<div class="modal fade" id="modal-excluir" tabindex="-1" aria-labelledby="modal-excluir" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" id="form-excluir" method="post">
          <div class="modal-body">

            <p>Deseja realmente deletar <span id="titulo-excluir"></span></p>

            <!-- id treino -->
            <input type="hidden" name="id_deletar" value="" id="id_deletar">      

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