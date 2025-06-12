<?php
include ('../TelaLogin/Conexão.php');
session_start(); 

if (!isset($_SESSION['ID'])) { 
    header("Location: ../TelaLogin/index.php");
    exit();
} else { 
    $id = $_SESSION['ID']; 
}
if (isset($_POST['nome'])) {
    $nome = trim($_POST['nome']);
    $idade = (int)$_POST['idade'];
    $genero = $_POST['genero'];
    $peso = (float)$_POST['peso']; 
    $altura = (float)$_POST['altura'];
    $objetivo = $_POST['objetivo']; 

     $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, idade = ?, genero = ?, peso = ?, altura = ?, objetivo = ? WHERE id = ?");
     $stmt->bind_param('sisddsi', $nome, $idade, $genero, $peso, $altura, $objetivo, $id);

    if ($stmt) {
        $stmt->bind_param("sissdsi", $nome, $idade, $genero, $peso, $altura, $objetivo, $id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Dados adicionados com sucesso!');</script>";

            header("Location: ../TelaDeInicio/Tela.php");
            exit();
        } else {
            echo "Erro ao adicionar dados: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionário de Saúde</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <p id="titulo">Preencher o Questionário abaixo</p>

    <!-- Formulário -->
    <form method="post">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required>

        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
            <option value=""></option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
        </select>

        <label for="peso">Peso (kg):</label>
        <input type="number" step="0.01" id="peso" name="peso" required>

        <label for="altura">Altura (cm):</label>
        <input type="number" step="0.01" id="altura" name="altura" required>

        <label>Objetivos de Saúde:</label><br>
        <select id="objetivo" name="objetivo">
            <option value=""></option>
            <option value="Emagrecimento">Emagrecimento</option>
            <option value="Ganho de Massa">Ganho de Massa</option>
            <option value="Melhora do desempenho esportivo">Melhora do desempenho esportivo</option>
            <option value="Controle de peso">Controle de peso</option>
            <option value="Saúde Geral">Saúde Geral</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
