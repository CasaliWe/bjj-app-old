<?php

// require
require '../../../../config/bootstrap.php';
use Repositories\UserRepository;

// Get user data
$identificador = $_POST['identificador'];
$senha = $_POST['senha'];
$nova = $_POST['nova-senha'];
$confirme = $_POST['confirm-senha'];

// Verificando se a senha antiga está correta
$user = UserRepository::getUser($identificador);
if($user){
    if(!password_verify($senha, $user->senha)){
        header('Location: ../../../../dashboard.php?error-password=true');
        exit;
    }
}

// Verificando se as senhas são iguais
if($nova != $confirme){
    header('Location: ../../../../dashboard.php?error-password=true');
    exit;
}

// Update user data
$senhaAtualizada = password_hash($nova, PASSWORD_DEFAULT);
$res = UserRepository::updateUserPassword($identificador, $senhaAtualizada);
if($res){
    header('Location: ../../../../dashboard.php?success=true');
}else{
    header('Location: ../../../../dashboard.php?error=true');
}