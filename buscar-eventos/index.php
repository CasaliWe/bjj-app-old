<?php

// CONFIGURAÇÃO BASE URL
// Coloque aqui a URL base do seu servidor
$baseUrl = 'http://localhost/bjj-app-old/buscar-eventos/';

// CONFIGURAÇÃO DOS ESTADOS
// Adicione aqui os estados que você quer buscar
// Formato: 'nome-da-pasta' => numero_do_estado_na_url
$estados = [
    'rio-grande-do-sul' => 23,
    'sao-paulo' => 24,
    'rio-de-janeiro' => 19,
    // Adicione mais estados aqui conforme necessário
];

function baixarImagem($url, $eventoId, $pastaEstado, $baseUrl) {
    // Criar pasta principal se não existir
    $pastaImagensPrincipal = __DIR__ . '/imagens-evento';
    if (!is_dir($pastaImagensPrincipal)) {
        mkdir($pastaImagensPrincipal, 0755, true);
    }
    
    // Criar pasta específica do estado
    $pastaImagensEstado = $pastaImagensPrincipal . '/' . $pastaEstado;
    if (!is_dir($pastaImagensEstado)) {
        mkdir($pastaImagensEstado, 0755, true);
    }
    
    // Obter extensão da imagem
    $extensao = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    if (empty($extensao)) {
        $extensao = 'png'; // padrão
    }
    
    // Nome do arquivo local
    $nomeArquivo = 'evento_' . $eventoId . '.' . $extensao;
    $caminhoLocal = $pastaImagensEstado . '/' . $nomeArquivo;
    
    // Se já existe, retornar a URL completa
    if (file_exists($caminhoLocal)) {
        return $baseUrl . 'imagens-evento/' . $pastaEstado . '/' . $nomeArquivo;
    }
    
    // Tentar baixar a imagem
    $contexto = stream_context_create([
        'http' => [
            'timeout' => 30,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]
    ]);
    
    $dadosImagem = @file_get_contents($url, false, $contexto);
    
    if ($dadosImagem !== false) {
        if (file_put_contents($caminhoLocal, $dadosImagem)) {
            return $baseUrl . 'imagens-evento/' . $pastaEstado . '/' . $nomeArquivo;
        }
    }
    
    return false;
}

function limparImagensEstado($pastaEstado) {
    $pastaImagensEstado = __DIR__ . '/imagens-evento/' . $pastaEstado;
    
    if (is_dir($pastaImagensEstado)) {
        $arquivos = glob($pastaImagensEstado . '/*');
        foreach ($arquivos as $arquivo) {
            if (is_file($arquivo)) {
                unlink($arquivo);
            }
        }
        // echo "🗑️ Imagens antigas do estado $pastaEstado foram removidas.\n";
    }
}

function extrairEventosEstado($nomeEstado, $numeroEstado, $baseUrl) {
    // URL específica para eventos de Jiu-Jitsu do estado
    $url = "https://soucompetidor.com.br/pt-br/eventos/todos-os-eventos/novos/?periodo_inicial=&periodo_final=&eventos=&modalidade=1&pais=1&estado=" . $numeroEstado;
    
    // echo "🔍 Buscando eventos para: $nomeEstado (ID: $numeroEstado)\n";
    
    $html = file_get_contents($url);
    
    if ($html === false) {
        return ['erro' => "Não foi possível buscar os dados do site para $nomeEstado"];
    }
    
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();
    
    $xpath = new DOMXPath($dom);
    
    // Buscar containers de eventos - tentar diferentes seletores
    $eventContainers = $xpath->query("//a[contains(@href, '/eventos/') and .//img]");
    
    // Se não encontrar, tentar outras abordagens
    if ($eventContainers->length == 0) {
        $eventContainers = $xpath->query("//img[contains(@alt, 'P2')]/..");
    }
    
    $eventos = [];
    $eventosProcessados = [];
    
    foreach ($eventContainers as $container) {
        /** @var DOMElement $container */
        $link = $container->getAttribute('href');
        
        // Extrair ID único do evento
        if (preg_match('/p(\d+)-/', $link, $matches)) {
            $eventoId = $matches[1];
            
            // Evitar duplicatas
            if (in_array($eventoId, $eventosProcessados)) {
                continue;
            }
            $eventosProcessados[] = $eventoId;
            
            $evento = [];
            
            // 1. IMAGEM
            $imagens = $xpath->query(".//img", $container);
            if ($imagens->length > 0) {
                /** @var DOMElement $img */
                $img = $imagens->item(0);
                $imagemSrc = $img->getAttribute('src');
                
                if (strpos($imagemSrc, 'http') !== 0) {
                    $imagemSrc = 'https://soucompetidor.com.br' . $imagemSrc;
                }
                
                // Tentar baixar e salvar a imagem
                $imagemLocal = baixarImagem($imagemSrc, $eventoId, $nomeEstado, $baseUrl);
                if ($imagemLocal) {
                    $evento['imagem'] = $imagemLocal;
                    $evento['imagem_status'] = 'salva_localmente';
                } else {
                    $evento['imagem'] = $imagemSrc;
                    $evento['imagem_status'] = 'erro_download';
                }
                
                // 2. NOME DO EVENTO (extrair do alt da imagem)
                $altText = $img->getAttribute('alt');
                if (preg_match('/P\d+-(.*?)$/', $altText, $matches)) {
                    $evento['nome'] = trim($matches[1]);
                }
            }
            
            // Buscar no container pai por mais informações
            $containerPai = $container->parentNode;
            while ($containerPai && $containerPai->nodeName !== 'div') {
                $containerPai = $containerPai->parentNode;
            }
            
            $textoCompleto = '';
            if ($containerPai) {
                $textoCompleto = trim($containerPai->textContent);
            } else {
                $textoCompleto = trim($container->textContent);
            }
            
            // 3. LOCAL (Cidade - Estado)
            if (preg_match('/([A-Z\s]+)\s*-\s*RS/', $textoCompleto, $matches)) {
                $evento['local'] = trim($matches[1]) . ' - RS';
            }
            
            // 4. DATA
            // Primeiro tentar período (data1 - data2)
            if (preg_match('/(\d{2}\/\d{2}\/\d{4})\s*-\s*(\d{2}\/\d{2}\/\d{4})/', $textoCompleto, $matches)) {
                $evento['data'] = $matches[1] . ' - ' . $matches[2];
            }
            // Se não, tentar data única
            elseif (preg_match('/(\d{2}\/\d{2}\/\d{4})/', $textoCompleto, $matches)) {
                $evento['data'] = $matches[1];
            }
            
            // Só adicionar se tiver pelo menos imagem e nome
            if (isset($evento['imagem']) && isset($evento['nome'])) {
                $eventos[] = $evento;
            }
        }
    }
    
    return $eventos;
}

// Executar extração para todos os estados
$todosEventos = [];
$totalGeralEventos = 0;

foreach ($estados as $nomeEstado => $numeroEstado) {
    // Limpar imagens antigas do estado
    limparImagensEstado($nomeEstado);
    
    // Extrair eventos do estado
    $eventosEstado = extrairEventosEstado($nomeEstado, $numeroEstado, $baseUrl);
    
    if (isset($eventosEstado['erro'])) {
        $todosEventos[$nomeEstado] = [
            'erro' => $eventosEstado['erro'],
            'total_eventos' => 0,
            'eventos' => []
        ];
    } else {
        $todosEventos[$nomeEstado] = [
            'total_eventos' => count($eventosEstado),
            'eventos' => $eventosEstado
        ];
        $totalGeralEventos += count($eventosEstado);
    }
}

// Configurar header para JSON
header('Content-Type: application/json; charset=utf-8');

// Retornar JSON
echo json_encode([
    'total_estados' => count($estados),
    'total_geral_eventos' => $totalGeralEventos,
    'data_busca' => date('d/m/Y H:i:s'),
    'estados' => $todosEventos
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>