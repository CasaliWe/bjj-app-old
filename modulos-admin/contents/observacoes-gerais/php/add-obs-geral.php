<?php

require '../../../../config/bootstrap.php';
use Repositories\ObservacoesGeraisRepository;

// pegando os dados
$obs = $_POST['add-obs-geral'];

// salvando no banco
$res = ObservacoesGeraisRepository::createObs($obs);

if($res) {
    header('Location: ../../../../anotacoes.php?create=true');
} else {
    header('Location: ../../../../anotacoes.php?error=true');
}

