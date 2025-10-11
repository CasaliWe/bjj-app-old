<?php
namespace Repositories;

use Models\Categoria;
use Models\Posicao;
use Models\Finalizacao;

class TecnicaRepository {

    // Cria toda a tecnica com Categoria, Posicao e Finalizacao
    public static function createFinalizacao($treino_id, $categoria_finalizacao, $posicao_finalizacao, $finalizacao, $passo_a_passo_json, $obs_finalizacao_json, $video, $estrela, $plataforma) {
        try {
            $categoria = Categoria::firstOrCreate([
                'nome' => $categoria_finalizacao,
                'user_identificador' => $_COOKIE['identificador'],
                'treino_id' => $treino_id
            ]);
            
            $posicao = Posicao::firstOrCreate([
                'nome' => $posicao_finalizacao,
                'categoria_id' => $categoria->id,
                'user_identificador' => $_COOKIE['identificador']
            ]);
    
            $finalizacao = Finalizacao::create([
                'nome' => $finalizacao,
                'passo_a_passo' => $passo_a_passo_json,
                'observacoes' => $obs_finalizacao_json,
                'posicao_id' => $posicao->id,
                'video' => $video,
                'estrela' => $estrela,
                'plataforma' => $plataforma,
                'user_identificador' => $_COOKIE['identificador']
            ]);
    
            if($finalizacao) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao criar técnica do usúario: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Deleta a finalizacao
    public static function deleteFinalizacao($id) {
        try {
            $finalizacao = Finalizacao::find($id);
            if($finalizacao) {
                $finalizacao->delete();
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao deletar finalização: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Busca todas as posições por categoria
    public static function findByCategoria($categoria) {
        try {
            $categorias = Categoria::where('user_identificador', $_COOKIE['identificador'])->get();
            $idsCategoria = [];
            foreach ($categorias as $cat) {
                if($cat->nome === $categoria) {
                    $idsCategoria[] = $cat->id;
                }
            }

            $posicoes = [];
            foreach($idsCategoria as $idCat) {
                $posicoes[] = Posicao::where('categoria_id', $idCat)->pluck('nome');
            }
            if($posicoes) {    
                // Converter cada Collection para array antes de achatar
                $arrayAchatado = array_merge([], ...array_map(function ($item) {
                    return $item->toArray();
                }, $posicoes));

                // Remover duplicatas
                $arraySemDuplicatas = array_unique($arrayAchatado);

                // Reindexar o array
                $posicoes_finais = array_values($arraySemDuplicatas);

                return $posicoes_finais;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar posições por categoria: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // buscar tecnica por id
    public static function getFinalizacao($id) {
        try {
            $finalizacao = Finalizacao::where('id', $id)->first();
            if($finalizacao) {
                return $finalizacao;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar tecnica por id: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // Atualiza a finalizacao
    public static function updateFinalizacao($id, $finalizacao) {
        try {
            $finalizacao = Finalizacao::where('id', $id)->update($finalizacao);
            if($finalizacao) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar finalização: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Busca todas as posições do user apenas da categoria que ele selecionou
    public static function getPosicaoCategoria($cat) {
        try {
            $categorias = Categoria::with('posicoes.finalizacoes')
                          ->where('user_identificador', $_COOKIE['identificador'])
                          ->where('nome', $cat )  
                          ->get();
    
            if($categorias){
                // recebe as todas as posições repetidas
                $posicoesRepetidas = [];
                // percorre todas as categorias para salvar as posições repetidas no array
                foreach ($categorias as $cat) {
                    foreach ($cat->posicoes as $pos) {
                        $posicoesRepetidas[] = $pos->nome;
                    }
                }
                // retorna as posições sem repetição
                return array_unique($posicoesRepetidas);
            }else{
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar posições selecionadas pelo user: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Busca todas as finalizacoes do user apenas da posição que ele selecionou
    public static function getFinalizacoes($pos) {
        try {
            $posicoes = Posicao::with('finalizacoes')
                          ->where('user_identificador', $_COOKIE['identificador'])
                          ->where('nome', $pos )  
                          ->orderBy('created_at', 'desc') 
                          ->get();
    

            if($posicoes){
                $finalizacoes = [];
                foreach ($posicoes as $pos) {
                    foreach ($pos->finalizacoes as $finalizacao) {
                        $finalizacoes[] = $finalizacao;
                    }
                }

                return $finalizacoes;
            }else{
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar posições selecionadas pelo user: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }



    // buscar finalizações por data
    public static function getFinalizacaoByDate($dataInicio, $dataFim) {
        try {
            $res = Finalizacao::where('user_identificador', $_COOKIE['identificador'])
                            ->whereBetween('created_at', [$dataInicio, $dataFim])
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


    // buscar todas as finalizações
    public static function getAllTecnicas($ordem) {

        if($ordem == 'recentes') {
            $ordenar = 'desc';
            $chave = 'created_at';
        } else if($ordem == 'antigos') {
            $ordenar = 'asc';
            $chave = 'created_at';
        } else if($ordem == 'maior-avaliacao') {
            $ordenar = 'desc';
            $chave = 'estrela';
        } else if($ordem == 'menor-avaliacao') {
            $ordenar = 'asc';
            $chave = 'estrela';
        }

        try {
            $tecnicas = Finalizacao::with('posicoes')
            ->where('user_identificador', $_COOKIE['identificador'])
            ->orderBy($chave, $ordenar)
            ->get();
            if($tecnicas) {
                return $tecnicas;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todas as finalizações do usuário: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // Destacar finalizacao
    public static function destacarFinalizacao($id) {
        try {
            $finalizacao = Finalizacao::where('id', $id)->update(['destaque' => 1]);
            if($finalizacao) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao destacar finalização: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Remover destaque finalizacao
    public static function removerDestaqueFinalizacao($id) {
        try {
            $finalizacao = Finalizacao::where('id', $id)->update(['destaque' => 0]);
            if($finalizacao) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao remover destaque da finalização: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }
}