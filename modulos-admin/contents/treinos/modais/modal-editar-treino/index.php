<link rel="stylesheet" href="<?= $base_url ?>modulos-admin/contents/treinos/modais/modal-editar-treino/css/style.css">



<!-- modal treino -->
<div class="modal fade" id="modal-editar-treino" tabindex="-1" aria-labelledby="modal-editar-treino" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar treino</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="modulos-admin/contents/treinos/php/editar-treino.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <input type="hidden" id="treino_id_editar" name="treino_id">
          
            <div class='mb-3'>
              <label for='tipo_treino_editar' class="small">Tipo do treino*</label>
              <select name="tipo_treino_editar" required class="form-select" id="tipo_treino_editar">
                <option value="Jiu Jitsu" id="editar_jiu_jitsu">Jiu Jitsu</option>
                <option value="No Gi" id="editar_no_gi">No Gi</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='aula_treino_editar' class="small">Número da aula*</label>
              <input type="hidden" name="aula_treino_editar" required id="aula_treino_editar">
              <input type='type' id="aula_treino_editar_show" disabled class='form-control'>
            </div>

            <div class='mb-3'>
              <label for='dia_treino_editar' class="small">Dia do treino*</label>
              <select name="dia_treino_editar" id="dia_treino_editar" class="form-select">
                <option value="Segunda Feira" id="seg">Segunda</option>
                <option value="Terça Feira" id="ter">Terça</option>
                <option value="Quarta Feira" id="qua">Quarta</option>
                <option value="Quinta Feira" id="qui">Quinta</option>
                <option value="Sexta Feira" id="sex">Sexta</option>
                <option value="Sábado" id="sab">Sábado</option>
                <option value="Domingo" id="dom">Domingo</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='hora_treino_editar' class="small">Hora do treino*</label>
              <select name="hora_treino_editar" id="hora_treino_editar" class="form-select">
                 <option value="06:30" id="06:30">06:30 hrs</option>
                 <option value="12:00" id="12:00">12:00 hrs</option>
                 <option value="14:00" id="14:00">14:00 hrs</option>
                 <option value="15:00" id="15:00">15:00 hrs</option>
                 <option value="16:00" id="16:00">16:00 hrs</option>
                 <option value="19:30" id="19:30">19:30 hrs</option>
                 <option value="21:00" id="21:00">21:00 hrs</option>
                 <option value="22:00" id="22:00">22:00 hrs</option>
              </select>
            </div>

            <div class='mb-3'>
              <label for='data_treino_editar' class="small">Data do treino*</label>
              <input type='date' id='data_treino_editar' name='data_treino_editar' class='form-control' required>
            </div>

            <div class='mb-3'>
              <label for='observacoes_treino_editar' class="small">Observações do treino*</label> <br>
              <small>( Separe as observações por ponto e vírgula " ; " ou "enter")</small>
              <textarea style="font-size: 12px;" id='observacoes_treino_editar' rows="5" name='observacoes_treino_editar' class='form-control' required></textarea>
            </div>

            <div class="mb-3">
              <div>
                <label for="novas-imagens-treino">Adicionar novas imagens*</label>
                <input type="file" class="form-control" name="novas-imagens-treino[]" multiple id="novas-imagens-treino">
              </div>

              <div class="mt-1 d-flex px-1" id="container-imgs-modal-treino-editar">
                   <!-- vem do js -->
              </div>

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
<!-- modal treino -->


<script src="<?= $base_url ?>modulos-admin/contents/treinos/modais/modal-editar-treino/js/app.js"></script>