<div class="modal fade" id="modal-add-competicao" tabindex="-1" aria-labelledby="modal-add-competicao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar nova competição +</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>/modulos-admin/contents/competicoes/php/add-competicao.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">

                <div class='mb-3'>
                  <label class="small" for='nome-evento-competicao'>Nome do Evento*</label>
                  <input type='text' id='nome-evento-competicao' name='nome-evento-competicao' class='form-control' required>
                </div>
             
                <div class='mb-3'>
                  <label class="small" for='cidade-competicao'>Cidade*</label>
                  <input type='text' id='cidade-competicao' name='cidade-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='data-competicao'>Data*</label>
                  <input type='date' id='data-competicao' name='data-competicao' class='form-control' value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='modalidade-competicao'>Modalidade*</label>
                  <select id='modalidade-competicao' name='modalidade-competicao' class='form-select' required>
                    <option value=''>Selecione a modalidade</option>
                    <option value='Jiu Jitsu'>Jiu Jitsu</option>
                    <option value='No Gi'>No Gi</option>
                  </select>
                </div>

                <div class='mb-3'>
                  <label class="small" for='colocacao-competicao'>Colocação*</label>
                  <input type='text' id='colocacao-competicao' name='colocacao-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='lutas-competicao'>Número de Lutas*</label>
                  <input type='number' id='lutas-competicao' name='lutas-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='vitorias-competicao'>Número de Vitórias*</label>
                  <input type='number' id='vitorias-competicao' name='vitorias-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='derrotas-competicao'>Número de Derrotas*</label>
                  <input type='number' id='derrotas-competicao' name='derrotas-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='finalizacoes-competicao'>Número de Finalizações*</label>
                  <input type='number' id='finalizacoes-competicao' name='finalizacoes-competicao' class='form-control' required>
                </div>

                <div class='mb-3'>
                  <label class="small" for='imagem-competicao'>Imagem*</label>
                  <input type='file' id='imagem-competicao' name='imagem-competicao' class='form-control' required>
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
        var input = document.getElementById('colocacao-competicao');

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