<?php

session_start();

require '../../../config/bootstrap.php';
use Repositories\UserRepository;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // busca os users no banco
    $dadosLogin = UserRepository::getAllUsers();

    foreach ($dadosLogin as $login) { 
        // testando login
        $logado = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS) == $login['login'] && password_verify(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS), $login['senha']);
        
        if($logado){
            //criando o token
            $token = bin2hex(random_bytes(16));
            // verificando se o usuário quer permanecer logado
            if(isset($_POST['permanecer-logado'])){
                $res = UserRepository::updateTokenUser($login['identificador'], $token);
                if($res){
                    setcookie("identificador", $login['identificador'], time() + (86400 * 7), "/");
                    setcookie("token", $token, time() + (86400 * 7), "/");
                    header("Location: ../../../dashboard.php");
                    exit;
                }else{
                    header("Location: ../../../index.php?error=true");
                    exit;
                }
            }else{
                $res = UserRepository::updateTokenUser($login['identificador'], $token);
                if($res){
                    setcookie("identificador", $login['identificador'], 0, "/");
                    setcookie("token", $token, 0, "/");
                    header("Location: ../../../dashboard.php");
                    exit;
                }else{
                    header("Location: ../../../index.php?error=true");
                    exit;
                }
            }

        }
        
    }

    // se não encontrar o login
    $_SESSION['erro-login'] = true;
    header("Location: ../../../index.php");
    exit;


}

?>
