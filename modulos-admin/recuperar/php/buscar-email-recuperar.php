<?php

session_start();

require '../../../helpers/enviar-email.php';
use Repositories\UserRepository;

$email = $_POST['email'];

$res = UserRepository::findByEmail($email);

if($res && $res->email == $email){
    enviarEmailRecuperarSenha($res->email, $res->identificador);
}else{
    $_SESSION['erro-email-recuperar'] = true;
    header("Location: ../../../recuperar-senha.php");
    exit;
}


// enviar email
function enviarEmailRecuperarSenha($email, $id){

    // enviar o email com o link para recuperar a senha
    enviarEmail('Recuperação de senha', '
        <div style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; border-radius: 10px; text-align: center;">
            <h2 style="color: #333;">Recuperação de Senha</h2>
            <p style="color: #666;">Clique no botão abaixo para redefinir sua senha:</p>
            <a href="'. $_ENV['BASE_URL'] .'/nova-senha.php?id='. $id .'" style="display: inline-block; padding: 10px 20px; color: #fff; background-color: black; border-radius: 5px; text-decoration: none;">Recuperar Senha</a>
        </div>
    ', null, $email);
    
    // leva para a mesma página e mostra mensagem de sucesso
    $_SESSION['success-email-recuperar'] = true;
    header("Location: ../../../recuperar-senha.php");
    exit;
    
}





