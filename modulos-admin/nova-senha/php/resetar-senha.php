<?php

session_start();

require '../../../helpers/enviar-email.php';
use Repositories\UserRepository;

$id = $_POST['id'];
$nova = $_POST['nova'];
$confirme = $_POST['confirme'];

// verificar se são iguais
if($nova != $confirme){
    header("Location: ../../../nova-senha.php?id=$id&error=true");
    exit;
}

// salvando a nova senha
$senha = password_hash($nova, PASSWORD_DEFAULT);
$res = UserRepository::updatePasswordUser($id, $senha);
if($res){
    $_SESSION['senha-atualizada'] = true;
    header("Location: ../../../index.php");
    exit;
}else{
    header("Location: ../../../nova-senha.php?id=$id&error=true");
    exit;
}