<?php
include("../TelaLogin/Conexão.php");
session_start();

if (isset($_SESSION['ID'])) {
$id = $_SESSION['ID'];

    // Consulta SQL para buscar os dados do treino
    $sql = "SELECT exercicio, series, dias FROM usuarios WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $linha = $result->fetch_assoc();
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Treino</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }

        .forms {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input, select, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            height: 100px;
            background-color: #fff;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Editar Treino</h1>
<div class="forms">
    <form method="POST" action="salvar_treino.php">
        <input type="text" name="exercicio" value="<?php echo $linha['exercicio']; ?>" placeholder="Nome do exercício">
        <input type="text" name="series" value="<?php echo $linha['series']; ?>" placeholder="Séries e repetições">
        <select name="dias[]" multiple>
            <option value="Segunda" <?php echo (strpos($linha['dias'], 'Segunda') !== false) ? 'selected' : ''; ?>>Segunda</option>
            <option value="Terça" <?php echo (strpos($linha['dias'], 'Terça') !== false) ? 'selected' : ''; ?>>Terça</option>
            <option value="Quarta" <?php echo (strpos($linha['dias'], 'Quarta') !== false) ? 'selected' : ''; ?>>Quarta</option>
            <option value="Quinta" <?php echo (strpos($linha['dias'], 'Quarta') !== false) ? 'selected' : ''; ?>>Quinta</option>
            <option value="Sexta" <?php echo (strpos($linha['dias'], 'Quarta') !== false) ? 'selected' : ''; ?>>Sexta</option>
            <option value="Sábado" <?php echo (strpos($linha['dias'], 'Quarta') !== false) ? 'selected' : ''; ?>>Sábado</option>
            <option value="Domingo" <?php echo (strpos($linha['dias'], 'Quarta') !== false) ? 'selected' : ''; ?>>Domingo</option>
            <!-- outros dias -->
        </select>
        <button type="submit">Salvar</button>
    </form>
    <button class="voltar" onclick="history.back()">Voltar</button>
 </div>   

</body>
</html>

<?php
// Fechando a conexão
$conn->close();
?>
