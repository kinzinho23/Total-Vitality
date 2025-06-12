<?php
include("../TelaLogin/Conexão.php");
session_start();

$id = $_SESSION['ID'];

try {
    // Captura os dados enviados pelo formulário
    $exercicio = $_POST['exercicio'];
    $series = intval($_POST['series']);
    $dias = implode(", ", $_POST['dias']); // Concatena os dias selecionados

   // Captura os dados do formulário
$exercicio = $_POST['exercicio'];
$series = $_POST['series'];
$dias = implode(", ", $_POST['dias']); // Concatena os dias selecionados

// Consulta SQL para inserção
$sql = "UPDATE usuarios SET exercicio = ?, series = ?, dias = ? WHERE ID = ?";

// Preparando a consulta
$stmt = $conn->prepare($sql);

// Verificando se a preparação foi bem-sucedida
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Vinculando os parâmetros à consulta
$stmt->bind_param("sssi", $exercicio, $series, $dias, $id); // "sss" indica que todos os parâmetros são strings

// Executando a consulta
if ($stmt->execute()) {
    header("Location: ../TelaFitness/Fitness.php");
} else {
    echo "Erro ao salvar o treino: " . $stmt->error;
}
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
