<div class="modal fade" id="modal-editar-competicao" tabindex="-1" aria-labelledby="modal-editar-competicao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar competição +</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>/modulos-admin/contents/competicoes/php/edit-competicao.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">

                <input type='hidden' id='id-competicao-editar' name='id-competicao-editar'>

                <div class='mb-3'>
                  <label class="small" for='nome-evento-competicao-editar'>Nome do Evento*</label>
                  <input type='text' id='nome-evento-competicao-editar' name='nome-evento-competicao-editar' class='form-control' required>
                </div>
             
                <div class='mb-3'>
                  <label class="small" for='cidade-competicao-editar'>Cidade*</label>
                  <input type='text' id='cidade-competicao-editar' name='cidade-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='data-competicao-editar'>Data*</label>
                  <input type='date' id='data-competicao-editar' name='data-competicao-editar' class='form-control' value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='modalidade-competicao-editar'>Modalidade*</label>
                  <select id='modalidade-competicao-editar' name='modalidade-competicao-editar' class='form-select' required>
                    <option value=''>Selecione a modalidade</option>
                    <option value='Jiu Jitsu'>Jiu Jitsu</option>
                    <option value='No Gi'>No Gi</option>
                  </select>
                </div>

                <div class='mb-3'>
                  <label class="small" for='colocacao-competicao-editar'>Colocação*</label>
                  <input type='text' id='colocacao-competicao-editar' name='colocacao-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='lutas-competicao-editar'>Número de Lutas*</label>
                  <input type='number' id='lutas-competicao-editar' name='lutas-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='vitorias-competicao-editar'>Número de Vitórias*</label>
                  <input type='number' id='vitorias-competicao-editar' name='vitorias-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='derrotas-competicao-editar'>Número de Derrotas*</label>
                  <input type='number' id='derrotas-competicao-editar' name='derrotas-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='finalizacoes-competicao-editar'>Número de Finalizações*</label>
                  <input type='number' id='finalizacoes-competicao-editar' name='finalizacoes-competicao-editar' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='imagem-competicao-editar'>Imagem*</label>
                  <input type='file' id='imagem-competicao-editar' name='imagem-competicao-editar' class='form-control'>
                  <div class="ms-1 mt-2" style="width: 60px; height: 60px;">
                    <img id="imagem-competicao-editar-preview" src="" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Adicionar</button>
          </div>
      </form>
    </div>
  </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('colocacao-competicao-editar');

        input.addEventListener('input', function() {
            // Remove todos os caracteres não numéricos
            var valor = this.value.replace(/\D/g, '');
            
            // Adiciona o símbolo º ao final
            if (valor.length > 0) {
                this.value = valor + 'º';
            } else {
                this.value = '';
            }
        });
    });
</script>