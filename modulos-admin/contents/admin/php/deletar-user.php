<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\UserRepository;

$id = $_POST['id_user_deletar'];

//deletando treino
$res = UserRepository::deletarUser($id);

if($res){
    header('Location: ../../../../admin.php?delete=true');
}else{
    header('Location: ../../../../admin.php?error=true');
}