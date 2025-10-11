<!-- modal treino -->
<div class="modal fade" id="modal-treino" tabindex="-1" aria-labelledby="modal-treino" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar novo dia de treino</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="modulos-admin/contents/treinos/php/adicionar-novo-treino.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
          
            <div class='mb-3'>
              <label for='tipo_treino' class="small">Tipo do treino*</label>
              <select name="tipo_treino" required class="form-select" id="tipo_treino">
                <option value="Jiu Jitsu" selected>Jiu Jitsu</option>
                <option value="No Gi">No Gi</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='aula_treino' class="small">Número da aula*</label>
              <input type="hidden" name="aula_treino" required value="<?= count($treinos) +1 ?>">
              <input type='type' disabled value="<?= count($treinos) > 0 ? (int)$treinos[0]['aula_treino'] +1 : 1 ?>ª" id='aula_treino' class='form-control'>
            </div>

            <div class='mb-3'>
              <label for='dia_treino' class="small">Dia do treino*</label>
              <select name="dia_treino" id="dia_treino" class="form-select">
                <option value="Segunda Feira" selected>Segunda</option>
                <option value="Terça Feira">Terça</option>
                <option value="Quarta Feira">Quarta</option>
                <option value="Quinta Feira">Quinta</option>
                <option value="Sexta Feira">Sexta</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='hora_treino' class="small">Hora do treino*</label>
              <select name="hora_treino" id="hora_treino" class="form-select">
                 <option value="06:30">06:30 hrs</option>
                 <option value="12:00">12:00 hrs</option>
                 <option value="14:00">14:00 hrs</option>
                 <option value="15:00">15:00 hrs</option>
                 <option value="16:00">16:00 hrs</option>
                 <option value="19:30" selected>19:30 hrs</option>
                 <option value="21:00">21:00 hrs</option>
                 <option value="22:00">22:00 hrs</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='data_treino' class="small">Data do treino*</label>
              <input type='date' id='data_treino' value="<?php echo date('Y-m-d'); ?>" name='data_treino' class='form-control' required>
            </div>

            <div class='mb-3'>
              <label for='img_treino' class="small">Imagem do treino*</label>
              <input type='file' id='img_treino' name='img_treino[]' class='form-control' multiple required>
            </div>

            <div class='mb-3'>
              <label for='observacoes_treino' class="small">Observações do treino*</label> <br>
              <small>( Separe as observações por ponto e vírgula " ; " ou "enter")</small>
              <textarea style="font-size: 12px;" id='observacoes_treino' rows="5" name='observacoes_treino' class='form-control'></textarea>
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
<!-- modal treino -->


<!-- mask obervações -->
<script>
  // mask obervações
  var observacoesTreino = document.getElementById('observacoes_treino');
  observacoesTreino.addEventListener('input', function(e) {
      var value = e.target.value;

      if (!value.startsWith('* ')) {
          value = '* ' + value.trim();
      }

      value = value.charAt(0).toUpperCase() + value.slice(1);

      e.target.value = value;
  });

  observacoesTreino.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
          e.preventDefault(); // Impede a quebra de linha padrão
      }
  });

  
  // mask input aula
  document.getElementById('aula_treino').addEventListener('input', function(e) {
    var value = e.target.value;
    value = value.replace(/[^\d]/g, ''); // remove todos os caracteres que não são dígitos
    if (value.length > 0) {
        value = value + 'ª'; // adiciona 'ª' no final se a string não estiver vazia
    }
    e.target.value = value;
  });


  // verificando o numero de imagens adicionar no input
  document.addEventListener("DOMContentLoaded", function() {
      // Seleciona o input pelo seu ID
      var input = document.getElementById("img_treino");

      // Adiciona um ouvinte de evento para quando o valor do input mudar
      input.addEventListener("change", function() {
        // Verifica se o número de arquivos selecionados é maior que 3
        if (this.files.length > 3) {
          // Informa ao usuário que ele não pode selecionar mais de 3 arquivos
          alert("Você pode selecionar no máximo 3 imagens.");
          // Limpa os arquivos selecionados
          this.value = "";
        }
      });
  });
</script>
<!-- mask obervações -->