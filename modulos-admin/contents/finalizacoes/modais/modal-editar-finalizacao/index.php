<!-- modal add finalização treino -->
<div class="modal fade" id="modal-editar-finalizacao" tabindex="-1" aria-labelledby="modal-editar-finalizacao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar finalização +</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="modulos-admin/contents/finalizacoes/php/editar-finalizacao.php" method="post">
          <div class="modal-body">

              <!-- id treino -->
              <input type="hidden" name="finalizacao_id_editar" value="" id="finalizacao_id_editar">      

              <div class='mb-3'>
                <label for='finalizacao_editar' class="small">Finalização*</label>
                <input type="text" required name="finalizacao_editar" id="finalizacao_editar" class="form-control">
              </div>

              <div class='mb-3'>
                <label for='passo_a_passo_editar' class="small">Construção (passo a passo)*</label>
                <textarea class="form-control" name="passo_a_passo_editar" required rows="5" id="passo_a_passo_editar"></textarea>
              </div>

              <div class='mb-3'>
                <label for='obs_finalizacao_editar' class="small">Obervações da finalização*</label>
                <textarea class="form-control" name="obs_finalizacao_editar" required rows="5" id="obs_finalizacao_editar"></textarea>
              </div>

              <div class='mb-3'>
                <label for='estrela_editar' class="small">Avaliação (de 1 até 5 estrelas)*</label>
                <input type="number" required name="estrela_editar" id="estrela_editar" class="form-control" min="1" max="5">
              </div>

              <div class='mb-3'>
                <label for='video_editar' class="small">Url Vídeo OPCIONAL (apenas <strong>instagram</strong> ou <strong>youtube</strong>)*</label>
                <input type="text" name="video_editar" id="video_editar" class="form-control">
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- modal add finalização treino -->



<script>
  // mask passo a passo
  document.getElementById('passo_a_passo_editar').addEventListener('input', function(e) {
      var value = e.target.value;
      var linhas = (value.match(/\n/g) || []).length;
      if (value.length === 1 && value[0] !== '1- ') {
          e.target.value = '1- ' + value;
      } else if (value.slice(-1) === ';' && value.slice(-3) !== (linhas + 1) + '- ' && linhas < 5) {
          e.target.value = value + '\n' + (linhas + 2) + '- ';
      }
  });

  document.getElementById('passo_a_passo_editar').addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
          e.preventDefault(); // impede a quebra de linha padrão
          var value = e.target.value;
          var linhas = (value.match(/\n/g) || []).length;
          if (value.slice(-1) !== ';' && value.slice(-3) !== (linhas + 1) + '- ' && linhas < 5) {
              e.target.value = value + ';\n' + (linhas + 2) + '- ';
          }
      }
  });

  // mask observações
  document.getElementById('obs_finalizacao_editar').addEventListener('input', function(e) {
      var value = e.target.value;
      var asteriscos = (value.match(/\*/g) || []).length;
      if (value.length === 1 && value[0] !== '*' && asteriscos < 5) {
          e.target.value = '* ' + value;
      } else if (value.slice(-1) === ';' && value.slice(-3) !== '* ;' && asteriscos < 5) {
          e.target.value = value + '\n* ';
      }
  });

  document.getElementById('obs_finalizacao_editar').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
          e.preventDefault(); 
          var value = e.target.value;
          var linhas = (value.match(/\n/g) || []).length;
          if (value.slice(-1) !== ';' && value.slice(-3) !== (linhas + 1) + '- ' && linhas < 5) {
              e.target.value = value + ';\n' + '*' + ' ';
          }
    }
  });
</script>