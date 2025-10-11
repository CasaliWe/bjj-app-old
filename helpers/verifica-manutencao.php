<?php

    require __DIR__.'/../config/bootstrap.php';
    use Repositories\AdminRepository;
    use Repositories\UserRepository;

    // verificação 
    $statusManutencao = AdminRepository::getStatusManutencao();
    if($statusManutencao->manutencao){
        // Verifica se a página atual é em-manutencao.php
        $url = $_SERVER['REQUEST_URI'];
        if(strpos($url, 'em-manutencao') === false){
            // verifica se o user é o admin para permitir o acesso as páginas
            $user = UserRepository::getUser($_COOKIE['identificador']);
            if($user->login != $_ENV['USER_ADMIN']){
                header("Location: em-manutencao.php");
                exit;
            }
        }
    }else{
        // Verifica se a página atual é em-manutencao.php
        $url = $_SERVER['REQUEST_URI'];
        if(strpos($url, 'em-manutencao') !== false){
            header("Location: dashboard.php");
            exit;
        }
    }

?>