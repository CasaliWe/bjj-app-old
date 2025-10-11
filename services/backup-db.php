<?php

// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

$databaseFile = __DIR__.'/../db/db.sqlite';
$backupDir = __DIR__.'/../backups/db/';
$backupFile = $backupDir . 'backup_' . date('d-m-Y') . '.sqlite';

if (copy($databaseFile, $backupFile)) {
    enviarEmail('Backup criado com sucesso no dia: '. date('d-m-Y'), 'O backup do banco de dados foi criado com sucesso.', $backupFile, null);
} else {
    enviarEmail('Erro ao criar backup do banco de dados no dia: '. date('d-m-Y'), 'Ocorreu um erro na tentativa de fazer backup do banco sqlite.', null, null);
}