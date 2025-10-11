<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\CompeticaoRepository;

// pegando os dados
$cidade = $_POST['cidade-competicao'];
$data = $_POST['data-competicao'];
$modalidade = $_POST['modalidade-competicao'];
$colocacao = $_POST['colocacao-competicao'];
$lutas = $_POST['lutas-competicao'];
$vitorias = $_POST['vitorias-competicao'];
$derrotas = $_POST['derrotas-competicao'];
$finalizacoes = $_POST['finalizacoes-competicao'];
$nomeEvento = $_POST['nome-evento-competicao'];

if (isset($_FILES['imagem-competicao']) && $_FILES['imagem-competicao']['error'] != UPLOAD_ERR_NO_FILE) {
    $pastaDestino = "../../../../assets/imagens/site-admin/competicoes/";
    $dataHora = date('YmdHis');
    $imagemNome = $dataHora . basename($_FILES['imagem-competicao']['name']);
    $caminhoDestino = $pastaDestino . $imagemNome;

    move_uploaded_file($_FILES['imagem-competicao']['tmp_name'], $caminhoDestino);
}

// salvando no banco
$res = CompeticaoRepository::createCompeticao($cidade, $data, $modalidade, $colocacao, $lutas, $vitorias, $derrotas, $finalizacoes, $imagemNome, $nomeEvento);

if($res) {
    header('Location: ../../../../competicoes.php?create=true');
} else {
    header('Location: ../../../../competicoes.php?error=true');
}
