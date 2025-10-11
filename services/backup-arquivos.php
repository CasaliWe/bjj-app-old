<?php

// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

$arquivoIDS = __DIR__.'/../assets/imagens/site-admin/ids';
$arquivoTREINOS = __DIR__.'/../assets/imagens/site-admin/treinos';
$backupDir = __DIR__.'/../backups/arquivos/';
$dataAtual = date('d-m-Y');
$pastaTemporaria = $backupDir . $dataAtual . '_arquivos';

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
    // Cria a pasta temporária e copia as pastas ids e treinos para ela
    @mkdir($pastaTemporaria);
    copiarPasta($arquivoIDS, $pastaTemporaria . '/ids');
    copiarPasta($arquivoTREINOS, $pastaTemporaria . '/treinos');

    // Envia um e-mail indicando que o backup foi criado com sucesso
    enviarEmail('Backup ARQUIVOS criado com sucesso no dia: '. date('d-m-Y'), 'O backup dos arquivos foi criado com sucesso.', null, null);
} catch (Exception $e) {
    // Envia um e-mail indicando que houve um erro
    enviarEmail('Erro ao criar backup ARQUIVOS no dia: '. date('d-m-Y'), 'Ocorreu um erro ao tentar criar o backup dos arquivos: ' . $e->getMessage(), null, null);
}