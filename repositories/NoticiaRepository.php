<?php
namespace Repositories;

use Models\Noticia;

class NoticiaRepository {
    
    // busca todas as noticias
    public static function getAllNoticias() {
        try {
            return Noticia::all();
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todas as noticias: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // criar várias noticias ao mesmo tempo 
    public static function createNoticias($noticias) {
        try {
            return Noticia::create($noticias);
        } catch (\Exception  $e) {
            error_log('Erro ao criar varias noticias: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
        }

    // limpar tabela
    public static function resetNoticias() {
        try {
            return Noticia::truncate();
        } catch (\Exception  $e) {
            error_log('Erro ao limpar tabela de noticias: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}