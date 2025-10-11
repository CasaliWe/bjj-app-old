<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\TecnicaRepository;

$id = $_POST['finalizacao_id_editar'];
$finalizacao = $_POST['finalizacao_editar'];
$video = $_POST['video_editar'];
$estrela = $_POST['estrela_editar'];

$pass = $_POST['passo_a_passo_editar'];
$passos = explode(";", $pass);
// Adiciona ';' em cada item, exceto no último
for($i = 0; $i < count($passos) - 1; $i++) {
    $passos[$i] = trim($passos[$i]) . ';';
}
$passos = array_values($passos);

$obs = $_POST['obs_finalizacao_editar'];
$observacoes = explode(";", $obs);
// Adiciona ';' em cada item, exceto no último
for($i = 0; $i < count($observacoes) - 1; $i++) {
    $observacoes[$i] = trim($observacoes[$i]) . ';';
}
$observacoes = array_values($observacoes);



// verificando link video e salvando na var
if(strpos($video, 'youtube') !== false){
    $plataforma = 'youtube';
}else if(strpos($video, 'instagram') !== false){
    $plataforma = 'instagram';
}else{
    $plataforma = null;
}


// verificando se foi alterado o vídeo para salvar no banco
if($video != '') {
    $finalizacao = TecnicaRepository::updateFinalizacao($id,[
        'nome' => $finalizacao,
        'passo_a_passo' => $passos,
        'observacoes' => $observacoes,
        'video' => $video,
        'estrela' => $estrela,
        'plataforma' => $plataforma,
    ]);
}else{
    $finalizacao = TecnicaRepository::updateFinalizacao($id,[
        'nome' => $finalizacao,
        'passo_a_passo' => $passos,
        'observacoes' => $observacoes,
        'video' => null,
        'estrela' => $estrela,
        'plataforma' => null,
    ]);
}

if($finalizacao) {
    header('Location: ../../../../finalizacoes.php?success=true');
} else {
    header('Location: ../../../../finalizacoes.php?error=true');
}

