<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Cache-Control, Authorization, Origin');

require '../../../../config/bootstrap.php';
use Repositories\CompeticaoRepository;

// pegando os dados
$id = $_POST['id-competicao-editar'];
$cidade = $_POST['cidade-competicao-editar'];
$data = $_POST['data-competicao-editar'];
$modalidade = $_POST['modalidade-competicao-editar'];
$colocacao = $_POST['colocacao-competicao-editar'];
$lutas = $_POST['lutas-competicao-editar'];
$vitorias = $_POST['vitorias-competicao-editar'];
$derrotas = $_POST['derrotas-competicao-editar'];
$finalizacoes = $_POST['finalizacoes-competicao-editar'];
$nomeEvento = $_POST['nome-evento-competicao-editar'];
$imagemNome = null;

if (isset($_FILES['imagem-competicao-editar']) && $_FILES['imagem-competicao-editar']['error'] != UPLOAD_ERR_NO_FILE) {
    $pastaDestino = "../../../../assets/imagens/site-admin/competicoes/";
    $dataHora = date('YmdHis');
    $imagemNome = $dataHora . basename($_FILES['imagem-competicao-editar']['name']);
    $caminhoDestino = $pastaDestino . $imagemNome;

    move_uploaded_file($_FILES['imagem-competicao-editar']['tmp_name'], $caminhoDestino);

    // salvando no banco
    $res = CompeticaoRepository::updateCompeticao($id, $cidade, $data, $modalidade, $colocacao, $lutas, $vitorias, $derrotas, $finalizacoes, $imagemNome, $nomeEvento);

    if($res) {
        header('Location: ../../../../competicoes.php?create=true');
        exit;
    } else {
        header('Location: ../../../../competicoes.php?error=true');
        exit;
    }
}

// salvando no banco
$res = CompeticaoRepository::updateCompeticao($id, $cidade, $data, $modalidade, $colocacao, $lutas, $vitorias, $derrotas, $finalizacoes, $imagemNome = null, $nomeEvento);

if($res) {
    header('Location: ../../../../competicoes.php?create=true');
    exit;
} else {
    header('Location: ../../../../competicoes.php?error=true');
    exit;
}
