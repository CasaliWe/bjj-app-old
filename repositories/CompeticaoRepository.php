<?php
namespace Repositories;

use Models\Competicao;

class CompeticaoRepository {
    
    // buscar todas as competicoes
    public static function getAllCompeticoes() {
        try {
            $res = Competicao::where('user_id', $_COOKIE['identificador'])->orderBy('updated_at', 'desc')->get();
            if($res) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todas as competições: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // criar uma competicao
    public static function createCompeticao($cidade, $data, $modalidade, $colocacao, $lutas, $vitorias, $derrotas, $finalizacoes, $imagem, $nomeEvento) {
        try {
            $res = Competicao::create([
                'cidade' => $cidade,
                'data' => $data,
                'modalidade' => $modalidade,
                'colocacao' => $colocacao,
                'numero_lutas' => $lutas,
                'numero_vitorias' => $vitorias,
                'numero_derrotas' => $derrotas,
                'numero_finalizacoes' => $finalizacoes,
                'imagem' => $imagem,
                'user_id' => $_COOKIE['identificador'],
                'nome_evento' => $nomeEvento
            ]);
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao criar uma competição: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // deletar uma competicao
    public static function deleteCompeticao($id) {
        try {
            $res = Competicao::where('id', $id)->delete();
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao deletar uma competição: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // atualizar uma competicao
    public static function updateCompeticao($id, $cidade, $data, $modalidade, $colocacao, $lutas, $vitorias, $derrotas, $finalizacoes, $imagem, $nomeEvento) {
        try {
            if($imagem == null) {
                $imagem = Competicao::where('id', $id)->first()->imagem;
            }
            
            $dados = [
                'cidade' => $cidade,
                'data' => $data,
                'modalidade' => $modalidade,
                'colocacao' => $colocacao,
                'numero_lutas' => $lutas,
                'numero_vitorias' => $vitorias,
                'numero_derrotas' => $derrotas,
                'numero_finalizacoes' => $finalizacoes,
                'imagem' => $imagem,
                'nome_evento' => $nomeEvento
            ];

            $res = Competicao::where('id', $id)->update($dados);
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar uma competição: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }
    

}