<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TecnicaRepository;

// pegando o tipo da categoria
$categoria = $_GET['categoria'];

$res = TecnicaRepository::findByCategoria($categoria);

if($res) {
    echo json_encode($res);
} else {
    echo json_encode([]);
}