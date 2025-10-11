<?php

session_start();

require '../../../config/bootstrap.php';
use Repositories\UserRepository;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $senhaInput = $_POST['senha'];
    $confirme = $_POST['confirme'];

    if ($senhaInput != $confirme) {
        $_SESSION['erro-register'] = 'As senhas não conferem!';
        header('Location: ../../../register.php');
        exit;
    }

    $user = UserRepository::findByLogin($login);
    if ($user) {
        $_SESSION['erro-register'] = 'Login já cadastrado!';
        header('Location: ../../../register.php');
        exit;
    }

    $user = UserRepository::findByEmail($email);
    if ($user) {
        $_SESSION['erro-register'] = 'E-mail já cadastrado!';
        header('Location: ../../../register.php');
        exit;
    }


    $token = bin2hex(random_bytes(16));
    $identificador = bin2hex(random_bytes(16));
    $senha = password_hash($senhaInput, PASSWORD_DEFAULT);

    $user = UserRepository::create([
        'login' => $login,
        'senha' => $senha,
        'token' => $token,
        'identificador' => $identificador,
        'nome' => $nome,
        'sobrenome' => $sobrenome,
        'email' => $email,
        'faixa' => 'branca',
        'academia' => 'Sem Academia'
    ]);

    if ($user) {
        // leva para dashboard
        header('Location: ../../../dashboard.php');
        setcookie("identificador", $user['identificador'], time() + (86400 * 7), "/");
        setcookie("token", $token, time() + (86400 * 7), "/");
        exit;
    } else {
        // mostra mensagem de erro ao criar o usuário
        header('Location: ../../../register.php?error=true');
    }

} else {
    header('Location: ../../../index.php');
    exit;
}

?>
