<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

// require
require '../../../../config/bootstrap.php';
use Repositories\TreinoRepository;
use Repositories\TecnicaRepository;

$inicio = $_GET['inicio'];
$fim = $_GET['fim'];

$resTreinos = TreinoRepository::getTreinosByDate($inicio, $fim);
$resTecnicas = TecnicaRepository::getFinalizacaoByDate($inicio, $fim);

echo json_encode([$resTreinos, $resTecnicas]);