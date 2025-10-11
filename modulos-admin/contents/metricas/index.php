<?php
    include_once 'config/config.php';
?>

<!-- MÉTRICAS -->
<section>
    <h6 class="small mb-5">Veja os resultados do seus treinos em um <strong>determinado período de tempo</strong>!</h6>

    <div class="row align-items-end">
        <div class='mb-3 mb-lg-0 col-12 col-lg-5'>
          <label for='data_inicial' class="small">Data inicial*</label>
          <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>" required id="data_inicial" name="data_inicial">
        </div>

        <div class='mb-4 mb-lg-0 col-12 col-lg-5'>
          <label for='data_final' class="small">Data Final*</label>
          <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required id="data_final" name="data_final">
        </div>

        <div class="mb-lg-0 col-12 col-lg-2">
            <button onclick="buscarMetricas()" type="button" class="py-2 w-100 btn btn-success btn-sm">Buscar</button>
        </div>
    </div>


    <div id="container_info_metricas" class="d-none mt-5">
        <h5 class="mb-3 fw-semibold">Métricas para o período selecionado:</h5>

        <p class="my-2" id="treinos_metrica"></p>
        <p class="my-2" id="finalizacoes_metrica"></p>
    </div>
</section>
<!-- MÉTRICAS -->




<script>
async function buscarMetricas(){
    var dataInicialStr = document.getElementById("data_inicial").value;
    var dataFinalStr = document.getElementById("data_final").value;

    // Convertendo strings para objetos Date
    var dataInicial = new Date(dataInicialStr);
    var dataFinal = new Date(dataFinalStr);

    // Subtraindo um dia da data inicial
    dataInicial.setDate(dataInicial.getDate() - 1);

    // Adicionando um dia à data final
    dataFinal.setDate(dataFinal.getDate() + 1);

    // Convertendo de volta para strings no formato YYYY-MM-DD
    var dataInicialFormatada = dataInicial.toISOString().split('T')[0];
    var dataFinalFormatada = dataFinal.toISOString().split('T')[0];

    const res = await fetch(`${base_url}/modulos-admin/contents/metricas/php/buscar-metricas.php?inicio=${dataInicialFormatada}&fim=${dataFinalFormatada}`);
    const data = await res.json();

    document.getElementById('container_info_metricas').classList.remove('d-none');
    document.getElementById('treinos_metrica').innerHTML = `Você participou de <span class="text-danger fw-bold">${data[0]}</span> treinos nesse período.`;
    document.getElementById('finalizacoes_metrica').innerHTML = `Você aprendeu <span class="text-danger fw-bold">${data[1]}</span> finalizações nesse período.`;
}
</script>