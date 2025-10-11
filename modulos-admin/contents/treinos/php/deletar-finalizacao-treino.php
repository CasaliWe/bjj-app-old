<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TecnicaRepository;

$id = $_POST['id_deletar'];

//deletando treino
$res = TecnicaRepository::deleteFinalizacao($id);

if($res){
    header('Location: ../../../../treinos.php?delete=true');
}else{
    header('Location: ../../../../treinos.php?error=true');
}
