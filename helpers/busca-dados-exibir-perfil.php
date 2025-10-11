<?php

use Repositories\UserRepository;
use Repositories\TreinoRepository;
use Repositories\CompeticaoRepository;

$usuario = UserRepository::getUser($_COOKIE['identificador']);
$treinos = TreinoRepository::getAllTreinos();
$competicoes = CompeticaoRepository::getAllCompeticoes();

// pegando numero dos treinos
$jj = [];
$nogi = [];
foreach ($treinos as $treino) {
    if($treino->tipo_treino == 'Jiu Jitsu'){
        $jj[] = $treino;
    }else{
        $nogi[] = $treino;
    }
} 

// pegando numero das competicoes
$totalJJ = [];
$totalNOGI = [];
$totalLutasJJ = 0;
$totalLutasNOGI = 0;
$totalVitoriasJJ = 0;
$totalVitoriasNOGI = 0;
$totalDerrotasJJ = 0;
$totalDerrotasNOGI = 0;
$totalFinalizacoesJJ = 0;
$totalFinalizacoesNOGI = 0;
$totalOuroJJ = 0;
$totalPrataJJ = 0;
$totalBronzeJJ = 0;
$totalOuroNOGI = 0;
$totalPrataNOGI = 0;
$totalBronzeNOGI = 0;
foreach ($competicoes as $competicao) {
    if($competicao->modalidade == 'Jiu Jitsu'){
        $totalJJ[] = $competicao;

        $totalLutasJJ += $competicao->numero_lutas;
        $totalVitoriasJJ += $competicao->numero_vitorias;
        $totalDerrotasJJ += $competicao->numero_derrotas;
        $totalFinalizacoesJJ += $competicao->numero_finalizacoes;

        if($competicao->colocacao == '1º'){
            $totalOuroJJ++;
        }else if($competicao->colocacao == '2º'){
            $totalPrataJJ++;
        }else if($competicao->colocacao == '3º'){
            $totalBronzeJJ++;
        }
    }else{
        $totalNOGI[] = $competicao;

        $totalLutasNOGI += $competicao->numero_lutas;
        $totalVitoriasNOGI += $competicao->numero_vitorias;
        $totalDerrotasNOGI += $competicao->numero_derrotas;
        $totalFinalizacoesNOGI += $competicao->numero_finalizacoes;

        if($competicao->colocacao == '1º'){
            $totalOuroNOGI++;
        }else if($competicao->colocacao == '2º'){
            $totalPrataNOGI++;
        }else if($competicao->colocacao == '3º'){
            $totalBronzeNOGI++;
        }
    }
}