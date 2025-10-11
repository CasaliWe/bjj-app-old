<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TecnicaRepository;

$id = $_GET['id'];

$res = TecnicaRepository::getFinalizacao($id);

if($res) {
    echo json_encode($res);
} else {
    echo json_encode([]);
}