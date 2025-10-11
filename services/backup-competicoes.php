<?php

// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

// Caminho da pasta com os arquivos
$pastaOrigem = __DIR__.'/../assets/imagens/site-admin/competicoes';

// Caminho da pasta para fazer o backup
$backupDir = __DIR__.'/../backups/competicoes/';
$dataAtual = date('d-m-Y');
$pastaTemporaria = $backupDir . $dataAtual . '_competicoes';

// Função para copiar uma pasta para outra
function copiarPasta($origem, $destino) {
    $dir = opendir($origem);
    @mkdir($destino);
    while (($file = readdir($dir)) !== false) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($origem . '/' . $file)) {
                copiarPasta($origem . '/' . $file, $destino . '/' . $file);
            } else {
                copy($origem . '/' . $file, $destino . '/' . $file);
            }
        }
    }
    closedir($dir);
}

try {
    // Cria a pasta temporária e copia a pasta fotos para ela
    @mkdir($pastaTemporaria);
    copiarPasta($pastaOrigem, $pastaTemporaria);

    // Envia um e-mail indicando que o backup foi criado com sucesso
    enviarEmail('Backup FOTOS COMPETIÇÕES criado com sucesso no dia: '. date('d-m-Y'), 'O backup dos arquivos foi criado com sucesso.', null, null);
} catch (Exception $e) {
    // Envia um e-mail indicando que houve um erro
    enviarEmail('Erro ao criar backup FOTOS no dia: '. date('d-m-Y'), 'Ocorreu um erro ao tentar criar o backup dos arquivos: ' . $e->getMessage(), null, null);
}