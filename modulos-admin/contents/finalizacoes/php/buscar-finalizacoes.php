<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TecnicaRepository;

$pos = $_GET['pos'];

//buscando finalizacoes
$res = TecnicaRepository::getFinalizacoes($pos);

if($res){
    echo json_encode(["success" => true ,"finalizacoes"=> $res]);
}else{
    echo json_encode(["success" => false, "message" => "Nenhuma finalização encontrada para ".$pos]);
}