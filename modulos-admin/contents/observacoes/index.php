<?php
    include_once 'config/config.php';
?>


<!-- OBSERVAÇÕES -->
<section>
    <h6 class="small mb-5">Veja todas as suas <strong>observações</strong> cadastradas em cada um dos seus <strong>treinos</strong>!</h6>

    <?php if(count($observacoes) == 0){
        echo "<h6 class='p-3 mt-5 text-center border rounded text-secondary'>Nenhuma observação cadastrada!</h6>";
    }?>

    <div>
        <?php 
            $items = [];
            foreach ($observacoes as $obs) {
                foreach ($obs['observacoes_treino'] as $txtObs) {
                    if(strpos($txtObs, 'Sem observações') === false) {
                        echo "<p class='d-flex justify-content-between align-items-center py-2 border-bottom'><span class='w-75'>$txtObs</span> <a class='text-danger ms-4 small text-end' href='treinos.php?scroll=btn-treino-{$obs['treino_id']}'>Acessar treino</a></p>";
                    }
                }
            } 
        ?>
    </div>
</section>
<!-- OBSERVAÇÕES -->