<?php

// importando autoload do composer
require __DIR__ . '/../config/bootstrap.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarEmail($destaque, $corpo, $anexo, $destino){

    // variáveis de configuração
    $user = $_ENV['EMAIL_USER'];
    $senha = $_ENV['EMAIL_SENHA'];
    $host = $_ENV['EMAIL_HOST'];
    $emailAdmin = $destino == null ? $_ENV['EMAIL_ADMIN'] : $destino;

    //enviar email
    $mail = new PHPMailer(true);


    $respostaSuccess = [
        "success" => true,
        "message" => "E-mail enviado!"
    ];

    $respostaError = [
        "success" => false,
        "message" => "E-mail não enviado!"
    ];


    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $senha;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Configuração da codificação de caracteres
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Destinatários
        $mail->setFrom($user, 'BJJ APP');
        $mail->addAddress($emailAdmin, 'Administrador BJJ APP');
        $mail->addReplyTo($user, 'Bot BJJ APP');

        // Cabeçalhos adicionais
        $mail->addCustomHeader('X-Mailer', 'PHP/' . phpversion());
        $mail->addCustomHeader('Precedence', 'bulk');

        // Anexos 
        if($anexo != null) {
            $mail->addAttachment($anexo);
        }

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $destaque;
        $mail->Body = $corpo;
        $mail->send();

        echo json_encode([$respostaSuccess]);

    } catch (Exception $e) {
        echo json_encode([$respostaError, $e]);
    }

}