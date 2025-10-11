<?php
namespace Repositories;

use Models\Admin;

class AdminRepository {
    
    // atualiza o status da manutenção
    public static function manutencao($status) {
        try {
            if($status == 'ativo'){

                $res = Admin::where('id', 1)->update(['manutencao' => 1]);
                if($res){
                    return true;
                }else{
                    return false;
                }

            }else if($status == 'inativo'){

                $res = Admin::where('id', 1)->update(['manutencao' => 0]);
                if($res){
                    return true;
                }else{
                    return false;
                }

            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar atualizar o status manutenção: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // buscar o status da manutenção
    public static function getStatusManutencao() {
        try {
            $res = Admin::where('id', 1)->first();
            return $res;
        } catch (\Exception  $e) {
            error_log('Erro ao buscar o status manutenção: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}