<?php
include("../TelaLogin/Conexão.php");
session_start();

$id = $_SESSION['ID'];

$sql = "SELECT exercicio, series, dias FROM usuarios WHERE ID = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Treinos</title>
    <link rel="stylesheet" href="Style.css"> 
</head>
<body>
<button class="voltar" onclick="history.back()">↩Voltar</button>
    <h1>Treinos Cadastrados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Séries</th>
                <th>Dias</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibe os treinos cadastrados
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['exercicio'] . "</td>";
                    echo "<td>" . $row['series'] . "</td>";
                    echo "<td>" . $row['dias'] . "</td>";
                    echo "<td>
                        <a href='editar_treino.php?id=" . "'>Editar</a> |
                        <a href='excluir_treino.php?id=" . "'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum treino cadastrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>