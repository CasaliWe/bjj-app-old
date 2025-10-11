<?php

require '../../../../config/bootstrap.php';
use Repositories\TreinoRepository;

$id_treino = $_POST['treino_id'];
$tipo_treino = $_POST['tipo_treino_editar'];
$aula_treino = $_POST['aula_treino_editar'];
$dia_treino = $_POST['dia_treino_editar'];
$hora_treino = $_POST['hora_treino_editar'];
$data_treino = $_POST['data_treino_editar'];
$observacoes_treino = $_POST['observacoes_treino_editar'];
$observacoes = explode(";\n* ", $observacoes_treino); 


$nomesArquivos = [];

if (isset($_FILES['novas-imagens-treino'])) {
    $pastaDestino = "../../../../assets/imagens/site-admin/treinos/";
    $dataHora = date('YmdHis');

    foreach ($_FILES['novas-imagens-treino']['name'] as $key => $nomeArquivo) {
        if ($_FILES['novas-imagens-treino']['error'][$key] == UPLOAD_ERR_OK) {
            $nomeArquivo = $dataHora . $nomeArquivo;
            $caminhoDestino = $pastaDestino . $nomeArquivo;

            move_uploaded_file($_FILES['novas-imagens-treino']['tmp_name'][$key], $caminhoDestino);

            $nomesArquivos[] = $nomeArquivo;
        }
    }
} 

if(count($nomesArquivos) > 0) {
    $img_treino_banco = TreinoRepository::getImagensTreino($id_treino);

    foreach ($img_treino_banco as $img) {
        $nomesArquivos[] = $img;
    }

    $treino = TreinoRepository::updateTreino($id_treino,[
        'tipo_treino' => $tipo_treino,
        'aula_treino' => $aula_treino,
        'dia_treino' => $dia_treino,
        'hora_treino' => $hora_treino,
        'data_treino' => $data_treino,
        'observacoes_treino' => $observacoes,
        'img_treino' => $nomesArquivos
    
    ]);

    if($treino) {
        header('Location: ../../../../treinos.php?success=true');
    } else {
        header('Location: ../../../../treinos.php?error=true');
    }
} else {
    $treino = TreinoRepository::updateTreino($id_treino,[
        'tipo_treino' => $tipo_treino,
        'aula_treino' => $aula_treino,
        'dia_treino' => $dia_treino,
        'hora_treino' => $hora_treino,
        'data_treino' => $data_treino,
        'observacoes_treino' => $observacoes
    ]);

    if($treino) {
        header('Location: ../../../../treinos.php?success=true');
    } else {
        header('Location: ../../../../treinos.php?error=true');
    }
}

