<?php
include("../TelaLogin/Conexão.php");
session_start();

if (isset($_SESSION['ID'])) {
    $id_usuario = $_SESSION['ID'];

    // SQL para limpar os campos exercicio, series e dias
    $sql = "UPDATE usuarios SET exercicio = NULL, series = NULL, dias = NULL WHERE ID = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $id_usuario); // 'i' para inteiro

    if ($stmt->execute()) {
        // Redirecionando para a página de listagem após a atualização
        header("Location: listar_treino.php");
        exit;
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }

    $stmt->close();
} else {
    die("Usuário não autenticado.");
}

$conn->close();
?>
