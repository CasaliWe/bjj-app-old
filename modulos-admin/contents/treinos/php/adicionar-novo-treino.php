<?php

require '../../../../config/bootstrap.php';
use Repositories\TreinoRepository;

// pegando os dados do formulário
$tipo_treino = $_POST['tipo_treino'];
$aula_treino = $_POST['aula_treino'];
$dia_treino = $_POST['dia_treino'];
$hora_treino = $_POST['hora_treino'];
$data_treino = $_POST['data_treino'];

// pegando as observações do treino e transformando em um array
if($_POST['observacoes_treino'] == '') {
    $observacoes = '* Sem observações para esse treino';
    $observacoes = explode(";\n* ", $observacoes);
}else{
    $observacoes = $_POST['observacoes_treino'] ?? '* Sem observações para esse treino'; 
    $observacoes = explode(";\n* ", $observacoes);
} 

// pegando as imagens do treino
$nomesArquivos = [];

if (isset($_FILES['img_treino'])) {
    $pastaDestino = "../../../../assets/imagens/site-admin/treinos/";
    $dataHora = date('YmdHis');

    foreach ($_FILES['img_treino']['name'] as $key => $nomeArquivo) {
        if ($_FILES['img_treino']['error'][$key] == UPLOAD_ERR_OK) {
            $nomeArquivo = $dataHora . $nomeArquivo;
            $caminhoDestino = $pastaDestino . $nomeArquivo;

            move_uploaded_file($_FILES['img_treino']['tmp_name'][$key], $caminhoDestino);

            $nomesArquivos[] = $nomeArquivo;
        }
    }
} 


// criando o treino
$treino = TreinoRepository::createTreino($tipo_treino, $aula_treino, $dia_treino, $hora_treino, $data_treino, $observacoes, $nomesArquivos);
if($treino) {
    header('Location: ../../../../treinos.php?create=true');
} else {
    header('Location: ../../../../treinos.php?error=true');
}