<?php
namespace Repositories;

use Models\ObservacoesGerais;

class ObservacoesGeraisRepository {
    
    // buscar todas as observações gerais
    public static function getObservacoesGerais() {
        try {
            $res = ObservacoesGerais::where('user_id', $_COOKIE['identificador'])->orderBy('updated_at', 'desc')->get();
            if($res) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todas as obervações gerais: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // criar uma observação geral
    public static function createObs($obs) {
        try {
            $res = ObservacoesGerais::create([
                'observacao' => $obs,
                'user_id' => $_COOKIE['identificador']
            ]);
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            error_log('Erro ao criar uma observação geral: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // atualizar uma observação geral
    public static function updateObs($obs, $id) {
        try {
            $res = ObservacoesGerais::where('id', $id)->update([
                'observacao' => $obs
            ]);
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            error_log('Erro ao atualizar uma observação geral: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // deletar uma observação geral
    public static function deleteObs($id) {
        try {
            $res = ObservacoesGerais::where('id', $id)->delete();
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            error_log('Erro ao deletar uma observação geral: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}