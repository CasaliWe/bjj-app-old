<?php

namespace Repositories;

use Models\User;
use Models\Treino;
use Models\Categoria;
use Models\Posicao;
use Models\Finalizacao;

class UserRepository {

    // busca todos os usuários
    public static function getAllUsers() {
        try {
            return User::orderBy('nome', 'asc')->get();
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todos os usuários: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Busca um usuário pelo identificador
    public static function getUser($identificador) {
        try {
            $user = User::with(['treinos' => function($query) {
                $query->orderBy('created_at', 'desc');
            }, 'treinos.categorias.posicoes.finalizacoes'])->where('identificador', $identificador)->first();
    
            if($user){
                return $user;
            }else{
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar usuário pelo identificador: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Atualizar o campo 'token' diretamente
    public static function updateTokenUser($identificador, $valor) {
       try {
            $userSuccess = User::where('identificador', $identificador)->update(['token' => $valor]);

            if ($userSuccess) {
                return true;
            } else {
                return false;
            }
       } catch (\Exception  $e) {
            error_log('Erro ao atualizar o token: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
       }

    }

    // Busca um usuário pelo login
    public static function findByLogin($login) {
        try {
            $user = User::where('login', $login)->first();

            if($user){
                return $user;
            }else{
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar o usúario pelo login: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Busca um usuário pelo email
    public static function findByEmail($email) {
        try {
            $user = User::where('email', $email)->first();

            if($user){
                return $user;
            }else{
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao buscar o usúario pelo email: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Cria um novo usuário ja setando dados para ter exemplo
    public static function create($data) {
        try {
            // Cria o user
            $user = User::create($data);

            // criando um novo treino exemplo 
            for ($i=1; $i < 3; $i++) { 
                $treino = Treino::create([
                    'tipo_treino' => 'Jiu Jitsu',
                    'aula_treino' => $i,
                    'dia_treino' => 'Segunda Feira',
                    'hora_treino' => '19:30',
                    'data_treino' => '2024-06-2'.$i,
                    'img_treino' => ["preview.png"],
                    'observacoes_treino' => ["* Exemplo de observação para o treino $i;"],
                    'user_identificador' => $user['identificador']
                ]);
            }

            // Cria uma finalização para exemplo
            $categoria = Categoria::create([
                'nome' => 'Passador',
                'user_identificador' => $user['identificador'],
                'treino_id' => null
            ]);
            
            $posicao = Posicao::create([
                'nome' => '100kg',
                'categoria_id' => $categoria->id,
                'user_identificador' => $user['identificador']
            ]);
    
            $finalizacao = Finalizacao::create([
                'nome' => 'Triângulo (Exemplo)',
                'passo_a_passo' => ["1- Primeiro passo;","2- Segundo passo;","3- Terceiro passo;"],
                'observacoes' => ["* Exemplo de obervação para finalização;"],
                'posicao_id' => $posicao->id,
                'video' => null,
                'estrela' => 5,
                'plataforma' => null,
                'user_identificador' => $user['identificador']
            ]);

            if($user){
                return $user;
            }else{
                return false;
            }

        } catch (\Exception  $e) {
            error_log('Erro ao criar um novo usúario: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // Atualizar o campos diretamente
    public static function updateUserData($identificador, $nome, $sobrenome, $email, $faixa, $academia, $bio, $cidade) {
        try {
            // busca os emails e verifica se o email ja existe
            $user = User::where('email', $email)->first();
            if($user){
                if($user->identificador != $identificador){
                    return false;
                }
            }

            $userSuccess = User::where('identificador', $identificador)->update(['nome' => $nome, 'sobrenome' => $sobrenome, 'email' => $email, 'faixa' => $faixa, 'academia' => $academia, 'bio' => $bio, 'cidade' => $cidade]);
 
            if ($userSuccess) {
                return true;
            } else {
                 return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar dados do usúario: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        } 
    }

    // Atualizar o campo 'foto' diretamente
    public static function updateUserImage($identificador, $imagemPerfil) {
        try {
            $userSuccess = User::where('identificador', $identificador)->update(['foto' => $imagemPerfil]);
 
            if ($userSuccess) {
                return true;
            } else {
                 return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar o campo foto: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        } 
     }

    // Atualizar o campo 'senha' diretamente
    public static function updateUserPassword($identificador, $senha) {
        try {
            $userSuccess = User::where('identificador', $identificador)->update(['senha' => $senha]);
 
            if ($userSuccess) {
                return true;
            } else {
                 return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar a senha: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // Atualizar o campo 'senha' diretamente
    public static function updatePasswordUser($id, $senha) {
        try {
            $userSuccess = User::where('identificador', $id)->update(['senha' => $senha]);
 
            if ($userSuccess) {
                return true;
            } else {
                 return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao atualizar a senha: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }


    // Deletar um usuário
    public static function deletarUser($identificador) {
        try {
            $res = User::where('identificador', $identificador)->delete();

            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception  $e) {
            error_log('Erro ao deletar o usúario: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}