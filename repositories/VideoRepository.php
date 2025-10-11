<?php
namespace Repositories;

use Models\Video;

class VideoRepository {
    
    // busca todos os vídeos
    public static function getAllVideos() {
        try {
            return Video::inRandomOrder()->limit(8)->get();
        } catch (\Exception  $e) {
            error_log('Erro ao buscar todos os videos: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

    // criar vários videos ao mesmo tempo
    public static function createVideo($video) {
        try {
            return Video::create($video);
        } catch (\Exception  $e) {
            error_log('Erro ao criar varios vídeos: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
        }

    // limpar tabela
    public static function resetVideos() {
        try {
            return Video::truncate();
        } catch (\Exception  $e) {
            error_log('Erro ao limpar tabela dos videos: ' . $e, 3, __DIR__ . '/../error.log');
            return false;
        }
    }

}