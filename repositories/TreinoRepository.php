<?php
namespace Repositories;

use Models\Treino;

class TreinoRepository {
    
    // busca todos os treinos do usuário
    public static function getAllTreinos() {
        try {
            return Treino::with('categorias.posicoes.finalizacoes')->where('user_identificador', $_COOKIE['identificador'])->get();
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todos os treinos do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    //criar um novo treino para o usuário
    public static function createTreino($tipo_treino, $aula_treino, $dia_treino, $hora_treino, $data_treino, $observacoes, $nomesArquivos) {
        try {
            $treino = Treino::create([
                'tipo_treino' => $tipo_treino,
                'aula_treino' => $aula_treino,
                'dia_treino' => $dia_treino,
                'hora_treino' => $hora_treino,
                'data_treino' => $data_treino,
                'img_treino' => $nomesArquivos,
                'observacoes_treino' => $observacoes,
                'user_identificador' => $_COOKIE['identificador']
            ]);
    
            if($treino) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao criar treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    //deletar um treino
    public static function delete($id) {
        try {
            // buscando as imagens do treino
            $img_treino = Treino::where('treino_id', $id)->value('img_treino');

            // deletando as imagens do treino
            $res = Treino::where('treino_id', $id)->delete();

            // removendo as imagens do servidor se não for a imagem preview
            if($img_treino) {
                foreach($img_treino as $img) {
                    if($img != 'preview.png')
                    unlink(__DIR__ . '/../assets/imagens/site-admin/treinos/' . $img);
                }
            }

            // respondendo a requisição
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao deletar treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // buscar treino
    public static function getTreino($id) {
        try {
            $treino = Treino::where('treino_id', $id)->first();
            if($treino) {
                return $treino;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // remover imagem do treino
    public static function deleteImgTreino($id, $imgName) {

        // verificando se é a iamgem preview que é usada quando novo user criar conta
        if($imgName == 'preview.png') {
            return false;
        }

        try {
            $img_treino = Treino::where('treino_id', $id)->value('img_treino');
    
            // Verifica se há apenas uma imagem no array
            if (count($img_treino) <= 1) {
                return false; 
            }
    
            // Encontra a chave da imagem a ser removida e a remove do array
            $key = array_search($imgName, $img_treino);
            if ($key !== false) {
                unset($img_treino[$key]);
            }
    
            $img_treino = array_values($img_treino);
    
            // Atualiza o registro diretamente com o novo valor de img_treino
            $res = Treino::where('treino_id', $id)->update(['img_treino' => $img_treino]);
    
            // removendo as imagem do servidor
            unlink(__DIR__ . '/../assets/imagens/site-admin/treinos/' . $imgName);
    
            if($res) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao remover imagem do treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // buscar imagens do treino
    public static function getImagensTreino($id) {
        try {
            $img_treino = Treino::where('treino_id', $id)->value('img_treino');
            if($img_treino) {
                return $img_treino;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar imagens do treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // atualizar treino
    public static function updateTreino($id, $data) {
        try {
            $res = Treino::where('treino_id', $id)->update($data);
    
            if($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // buscar imagens treino
    public static function getImgsTreino($id) {
        try {
            $res = Treino::where('treino_id', $id)->value('img_treino');
            if($res) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar imagens do treino do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // buscar as observacoes de todos os treinos
    public static function getObservacoesTreinos() {
        try {
            $res = Treino::select(['observacoes_treino', 'treino_id'])->where('user_identificador', $_COOKIE['identificador'])->orderBy('updated_at', 'desc')->get();
            if($res) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar observações dos treinos do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }



    // buscar todas as imagens de todos os treinos 
    public static function getAllImagensTreinos() {
        try {
            $res = Treino::select(['img_treino', 'data_treino'])
                         ->where('user_identificador', $_COOKIE['identificador'])
                         ->orderBy('data_treino', 'desc')
                         ->get();
                         
            if ($res->isNotEmpty()) {
                $todasAsImagensEData = [];
                foreach ($res as $treino) {
                    $dataFormatada = date('d-m-Y', strtotime($treino->data_treino));
                    // Adiciona um novo array com a imagem e a data de criação para cada treino
                    $todasAsImagensEData[] = [
                        'img_treino' => $treino->img_treino,
                        'created_at' => $dataFormatada // Formata a data conforme necessário
                    ];
                }
                return $todasAsImagensEData;
            } else {
                return [];
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar imagens dos treinos do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // buscar treinos por data
    public static function getTreinosByDate($dataInicio, $dataFim) {
        try {
            $res = Treino::where('user_identificador', $_COOKIE['identificador'])
                         ->whereBetween('data_treino', [$dataInicio, $dataFim])
                         ->get();
            if($res) {
                return count($res);
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar treinos por data do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}