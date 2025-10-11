<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\AdminRepository;

$status = $_GET['status'];

if($status == 'ativo'){
    try {
        $res = adminRepository::manutencao('ativo');
        if($res){
            echo true;
            exit;
        }else{
            echo false;
            exit;
        }
    } catch (\Throwable $th) {
        error_log('Erro ao ativar manutenção: ' . $th, 3, __DIR__ . '/../../../../error.log');
        return false;
    }
}else if($status == 'inativo'){
    try {
        $res = adminRepository::manutencao('inativo');
        if($res){
            echo true;
            exit;
        }else{
            echo false;
            exit;
        }
    } catch (\Throwable $th) {
        error_log('Erro ao ativar manutenção: ' . $th, 3, __DIR__ . '/../../../../error.log');
        return false;
    }
}else{
    echo false;
    exit;
}