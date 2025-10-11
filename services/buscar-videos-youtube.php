<?php
// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

use Repositories\VideoRepository;

// Chave da API do YouTube
$apiKey = $_ENV['KEY_YOUTUBE_API'];

// Termos de busca
$queries = ["finalizações jiu jitsu", "podcasts jiu jitsu"];

// Data de início
$dataAtual = new DateTime();

// Subtrair 7 dias para obter a data de uma semana atrás
$dataAtual->sub(new DateInterval('P30D'));

// Formatar a data para o formato ISO 8601
$publishedAfter = $dataAtual->format('Y-m-d\TH:i:s\Z');

// Número máximo de resultados por termo
$maxResults = 40;

// Função para fazer requisições à API do YouTube
function fetchVideos($query, $apiKey, $publishedAfter, $maxResults) {
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . urlencode($query) . "&type=video&publishedAfter=" . $publishedAfter . "&maxResults=" . $maxResults . "&relevanceLanguage=pt&key=" . $apiKey;
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Armazena todos os vídeos buscados
$allVideos = [];

// Busca vídeos para cada termo de busca
foreach ($queries as $query) {
    $data = fetchVideos($query, $apiKey, $publishedAfter, $maxResults);
    if (!empty($data['items'])) {
        $allVideos = array_merge($allVideos, $data['items']);
    }
}

// recebe os videos
$videos = [];

// Verifica se houve resultados
if (!empty($allVideos)) {

    // remover todos os videos do banco de dados
    VideoRepository::resetVideos();

    foreach ($allVideos as $item) {
        // Obtém detalhes do vídeo
        $videoId = $item['id']['videoId'];
        $title = $item['snippet']['title'];

        $videos[] = [
            'iframe' => 'https://www.youtube.com/embed/'.$videoId,
            'titulo' => $title
        ];
    }

    // salvar vídeos no banco de dados
    foreach ($videos as $video) {
        $res = VideoRepository::createVideo($video);
        if(!$res){
            enviarEmail('Erro ao atualizar vídeos no dia: '. date('d-m-Y'), 'Ocorreu um erro na tentativa de atualizar os vídeos no banco de dados.', null, null);
            exit;
        }
    }

    // RESPOSTA
    enviarEmail('Vídeos atualizados no dia: '. date('d-m-Y'), 'Os vídeos foram atualizados com sucesso no banco de dados.', null, null);

} else {
    enviarEmail('Erro ao atualizar vídeos no dia: '. date('d-m-Y'), 'Nenhum vídeo foi encontrado na tentativa de atualizar os vídeos no banco de dados.', null, null);
}
?>
