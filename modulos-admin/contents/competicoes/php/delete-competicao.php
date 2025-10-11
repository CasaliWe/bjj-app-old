<?php

require '../../../../config/bootstrap.php';
use Repositories\CompeticaoRepository;

// pegando os dados
$id = $_POST['id-deletar-competicao'];

// salvando no banco
$res = CompeticaoRepository::deleteCompeticao($id);

if($res) {
    header('Location: ../../../../competicoes.php?delete=true');
} else {
    header('Location: ../../../../competicoes.php?error=true');
}

