<?php

require '../../../../config/bootstrap.php';
use Repositories\ObservacoesGeraisRepository;

// pegando os dados
$obs = $_POST['obs-geral-editar'];
$id = $_POST['obs-edit-id'];

// salvando no banco
$res = ObservacoesGeraisRepository::updateObs($obs, $id);

if($res) {
    header('Location: ../../../../anotacoes.php?success=true');
} else {
    header('Location: ../../../../anotacoes.php?error=true');
}

