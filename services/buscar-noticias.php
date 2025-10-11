<?php
// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

use Repositories\NoticiaRepository;

// Seleciona uma chave aleatoriamente
$apiKey = $_ENV['KEY_NOTICIAS_API'];
// Consulta de busca
$query = 'jiu-jitsu OR UFC OR mma OR cbjj OR ibjjf OR adcc OR boxe OR judô OR grapping OR bjj';
// Define a data inicial
$dateFrom = date('Y-m-d', strtotime('-14 days'));
// Define a data final como a data atual
$dateTo = date('Y-m-d');
// URL da News API com a consulta, o parâmetro de idioma e o período
$url = "https://newsapi.org/v2/everything?q=" . urlencode($query) . "&language=pt&from=" . $dateFrom . "&to=" . $dateTo . "&apiKey=" . $apiKey;

// Inicializa o cURL
$ch = curl_init();

// Configurações do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: bjj_app/1.0'
]);

// Executa a requisição e obtém a resposta
$response = curl_exec($ch);

// Fecha a conexão cURL
curl_close($ch);

// Decodifica a resposta JSON
$newsData = json_decode($response);

// Inicializa um array para armazenar as notícias
$noticias = [];

// Verifica se a requisição foi bem-sucedida
if ($newsData->status === 'ok') {
    
    foreach ($newsData->articles as $article) {
        // Exibe apenas artigos que mencionam explicitamente "jiu-jitsu", "UFC", "boxe" ou "judô" no título ou descrição
        if (
            (preg_match('/\bjiu-jitsu\b/i', $article->title) || preg_match('/\bjiu-jitsu\b/i', $article->description)) ||
            (preg_match('/\bUFC\b/i', $article->title) || preg_match('/\bUFC\b/i', $article->description)) ||
            (preg_match('/\bboxe\b/i', $article->title) || preg_match('/\bboxe\b/i', $article->description)) ||
            (preg_match('/\bjudô\b/i', $article->title) || preg_match('/\bjudô\b/i', $article->description))
        ) {
            if(!$article->title == ''){
                $noticias[] = [
                    'titulo' => $article->title,
                    'descricao' => $article->description,
                    'url' => $article->url,
                    'imagem' => $article->urlToImage
                ];
            }
        }
    }


    // limpa a tabela de notícias
    NoticiaRepository::resetNoticias();

    // Cria as notícias no banco de dados
    foreach ($noticias as $noticia) {
        $res = NoticiaRepository::createNoticias($noticia);
        if(!$res){
            enviarEmail('Erro ao atualizar notícias no dia: '. date('d-m-Y'), 'Ocorreu um erro na tentativa de atualizar as notícias no banco de dados.', null, null);
            exit;
        }
    }

    // RESPOSTA
    enviarEmail('Notícias atualizadas no dia: '. date('d-m-Y'), 'As notícias foram atualizadas com sucesso.', null, null);

} else {
    enviarEmail('Erro ao atualizar notícias no dia: '. date('d-m-Y'), 'Ocorreu um erro na tentativa de atualizar as notícias no banco de dados.', null, null);
}
?>
