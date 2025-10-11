<?php

// require
require '../../../../config/bootstrap.php';
use Repositories\UserRepository;

// Get user data
$identificador = $_POST['identificador'];

if (isset($_FILES['imagem-perfil']) && $_FILES['imagem-perfil']['error'] != UPLOAD_ERR_NO_FILE) {
    $pastaDestino = "../../../../assets/imagens/site-admin/ids/";
    $dataHora = date('YmdHis');
    $nomeArquivo = $dataHora . basename($_FILES['imagem-perfil']['name']);
    $caminhoDestino = $pastaDestino . $nomeArquivo;

    move_uploaded_file($_FILES['imagem-perfil']['tmp_name'], $caminhoDestino);

    // Update user data
    $res = UserRepository::updateUserImage($identificador, $nomeArquivo);
    if($res){
        header('Location: ../../../../dashboard.php?success=true');
    }else{
        header('Location: ../../../../dashboard.php?error=true');
    }
}