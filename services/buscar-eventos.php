<?php
// importando o envio de email
require __DIR__ . '/../helpers/enviar-email.php';

use Repositories\EventoRepository;

// importando os estados para filtrar
include_once __DIR__ . '/../helpers/estados-eventos.php';

$contagemLoop = 0;

// resetando os eventos no banco de dados
EventoRepository::resetEventos();

function atualizarEvento(){
    global $locaisEventos, $contagemLoop;

    // Verificar se o loop chegou ao final
    if($contagemLoop == count($locaisEventos)){
        enviarEmail('Eventos atualizados com sucesso no dia: '. date('d-m-Y'), 'Os eventos foram atualizados com sucesso no banco de dados.', null, null);
        exit;
    }
    
    // pegando o numero e estado do local do evento
    $numero = $locaisEventos[$contagemLoop]['numero'];
    $estado = $locaisEventos[$contagemLoop]['estado'];

    // Conteúdo HTML do site
    $html = file_get_contents("https://soucompetidor.com.br/pt-br/eventos/todos-os-eventos/novos/?periodo_inicial=&periodo_final=&eventos=&modalidade=1&pais=1&estado=$numero");

    // Padrão para encontrar todas as informações relevantes
    $pattern = '/<div class="card shadow h-100">.*?<a href="(.*?)" title="Ver detalhes deste evento!">.*?<img class="card-img-top" src="(.*?)" alt=".*?">.*?<\/a>.*?<div class="card-title co-primary mb-2" style="min-height: 65px;">.*?<h6 class="m-0">(.*?)<\/h6>.*?<small class="text-body">(.*?)<\/small>.*?<\/div>.*?<p class="card-text">.*?<small>(.*?)<\/small>.*?<\/p>.*?<small class="float-left">.*?<i class="far fa-calendar co-primary"><\/i>\s*(.*?)\s*<\/small>.*?<\/div>/s';

    // Usando preg_match_all para encontrar todos os eventos
    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

    if (empty($matches)) {
        // Incrementar o contador do loop
        $contagemLoop++;

        // Atualizar o evento
        atualizarEvento();
    }

    // Array para armazenar os eventos
    $eventos = [];

    // Iterando sobre os eventos encontrados
    foreach ($matches as $event) {
        $link = $event[1]; // Link do evento
        $imagem = $event[2]; // URL da imagem
        $titulo = $event[3]; // Título do evento
        $codigo = $event[4]; // Código do evento
        $local = $event[5]; // Local do evento
        $data = $event[6]; // Data do evento

        // salvando o evento no array de eventos
        $eventos[] = [
            'imagem' => $imagem,
            'titulo' => $titulo,
            'codigo' => $codigo,
            'local' => $local,
            'data' => $data,
            'link' => 'https://soucompetidor.com.br/' . $link,
            'estado' => $estado
        ];
    }

    // verificar se teve eventos encontrados
    if (empty($eventos)) {
        die('Nenhum evento encontrado.');
    }

    // salvar cada evento dentro do array no banco de dados
    foreach ($eventos as $evento) {
        $res = EventoRepository::createEvento($evento);
        if(!$res){
            enviarEmail('Erro ao atualizar eventos no dia: '. date('d-m-Y'), 'Ocorreu um erro na tentativa de atualizar os eventos no banco de dados.', null, null);
            exit;
        }
    }

    // Incrementar o contador do loop
    $contagemLoop++;

    // Atualizar o evento
    atualizarEvento();
}
atualizarEvento();
