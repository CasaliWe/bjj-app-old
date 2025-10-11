<?php

require '../../../../config/bootstrap.php';
use Repositories\ObservacoesGeraisRepository;

// pegando os dados
$id = $_POST['id-obs-deletar'];

// salvando no banco
$res = ObservacoesGeraisRepository::deleteObs($id);

if($res) {
    header('Location: ../../../../anotacoes.php?delete=true');
} else {
    header('Location: ../../../../anotacoes.php?error=true');
}

