<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TreinoRepository;

$id = $_GET['id'];
$imgName = $_GET['imgName'];

//deletando img treino
$res = TreinoRepository::deleteImgTreino($id, $imgName);

if($res){
    echo json_encode(['status' => 'success', 'message' => 'Imagem deletada com sucesso!']);
}else{
    echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar Imagem!']);
}
