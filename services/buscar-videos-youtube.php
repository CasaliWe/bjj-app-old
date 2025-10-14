<?php

// Chave da API do YouTube
$apiKey = '';

// Termos de busca
$queries = ["finalizações jiu jitsu", "ufc", "ibjjf"];

// Data de início
$dataAtual = new DateTime();

// Subtrair 14 dias para obter a data de duas semanas atrás
$dataAtual->sub(new DateInterval('P14D'));

// Formatar a data para o formato ISO 8601
$publishedAfter = $dataAtual->format('Y-m-d\TH:i:s\Z');

// Número máximo de resultados por termo
$maxResults = 20;

// Função para fazer requisições à API do YouTube
function fetchVideos($query, $apiKey, $publishedAfter, $maxResults) {
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . urlencode($query) . "&type=video&publishedAfter=" . $publishedAfter . "&maxResults=" . $maxResults . "&relevanceLanguage=pt&regionCode=BR&videoDuration=medium&key=" . $apiKey;
    
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

    foreach ($allVideos as $item) {
        // Obtém detalhes do vídeo
        $videoId = $item['id']['videoId'];
        $title = $item['snippet']['title'];
        
        // Filtrar para excluir reels/shorts (geralmente têm títulos ou descrições específicas)
        if (stripos($title, '#shorts') !== false || 
            stripos($title, 'reels') !== false || 
            stripos($title, 'short') !== false) {
            continue;
        }

        $videos[] = [
            'titulo' => $title,
            'url' => 'https://www.youtube.com/embed/' . $videoId
        ];
    }

    // EXIBIR JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($videos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['erro' => 'Nenhum vídeo foi encontrado nos termos de busca especificados.'], JSON_UNESCAPED_UNICODE);
}
?>
